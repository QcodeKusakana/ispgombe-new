# Audit technique et sécurité — ISP-GOMBE

Date : 28 octobre 2026

## Périmètre

Application PHP procédurale avec vues publiques, administration, espace étudiant et bibliothèques locales (Bootstrap, jQuery, TCPDF et PHP QR Code). Les journaux du projet indiquent un déploiement sous PHP 8.1. L’archive ZIP citée dans le cahier des charges n’est pas présente dans le répertoire de travail; elle n’a donc pas pu être comparée ni sauvegardée ici. L’export SQL fourni est resté intact et n’a pas été importé. Un export SQL se trouve aussi à la racine du projet et les règles ajoutées bloquent son accès HTTP.

## Risques confirmés et mesures prises

- `index.php` servait `readme.php` aux robots et redirigeait les visites provenant de Google vers un site tiers. Ces comportements ont été retirés.
- `readme.php` contenait une page de vente de liens SEO en turc et de fausses métadonnées institutionnelles. Le fichier est isolé sous `.security-quarantine/`, avec accès HTTP refusé.
- Des pièces nominatives sont présentes dans cinq répertoires de `media/`. `.htaccess` bloque leur accès direct; `admin/download.php` fournit un téléchargement authentifié avec liste de champs autorisés, contrôle de chemin, type MIME et extension. La règle Apache doit encore être vérifiée sur l’hébergement.
- `.htaccess` désactive l’indexation des répertoires, bloque les exports SQL, journaux, configurations et archives, et pose les en-têtes `nosniff`, `Referrer-Policy`, `X-Frame-Options` et `Permissions-Policy`.
- Les identifiants SQL historiques ont été retirés des connecteurs. La connexion lit `ISPGOMBE_DB_HOST`, `ISPGOMBE_DB_NAME`, `ISPGOMBE_DB_USER` et `ISPGOMBE_DB_PASSWORD`, utilise `utf8mb4` et ne renvoie pas le détail des exceptions. `.env.example` ne contient que des valeurs fictives.
- Les connexions administrateur et étudiant migrent les hachages SHA-1 historiques vers `password_hash()` au premier succès; les nouveaux hachages sont vérifiés par `password_verify()`. Les sessions sont renouvelées et l’ancien cookie de mot de passe administrateur est expiré.
- Les connexions, la création de comptes administrateur et le changement de mot de passe étudiant utilisent des jetons CSRF. Les nouveaux mots de passe exigent 12 caractères minimum.

## Schéma SQL

L’export comporte 27 tables InnoDB déclarées en `latin1`, dont `admin`, `etudiant`, `faculte`, `departement`, `optioner`, `activite`, `annonce`, `communique` et `palmaresetudiant`. Les relations et index doivent être rapprochés de tous les usages applicatifs. Aucune conversion n’a été lancée. Une migration vers `utf8mb4` exige une copie de base, une vérification d’encodage et une comparaison avant/après.

## Refonte réalisée

Le routage public est limité à une liste de pages autorisées. Le menu et le pied de page sont responsive. L’accueil présente l’institut, les facultés et les actualités récentes venant de la base, sans chiffres ni calendrier inventés. Une page d’information remplace l’ancien formulaire d’admission instable et précise qu’elle ne soumet aucune demande. L’espace étudiant affiche le profil de la session connectée, les communiqués associés à sa promotion et un formulaire sécurisé de changement de mot de passe.

Le projet ne contient pas de logo officiel ni de photos authentiques du campus : les anciennes références d’images pointaient vers des fichiers absents. Les deux images présentes sont des photos génériques sans lien fiable avec l’établissement; elles ne sont pas réutilisées.

## Travaux restant nécessaires

- Les modules d’actualités, campus, personnel, agents, annonces, galeries et organisation académique utilisent maintenant POST + CSRF pour leurs actions de mutation. Les formulaires d’images modifiés vérifient le MIME réel, la taille et l’intégrité, puis attribuent un nom aléatoire. D’autres téléversements historiques et sorties HTML restent à auditer. Le formulaire de contact enregistre les messages dans la boîte de réception; aucune notification e-mail n’est configurée.
- Les suppressions et changements d’état des modules historiques raccordés au routeur ont été convertis en POST avec CSRF. Revoir les formulaires historiques de création/modification et les requêtes SQL restantes avant de considérer tout le CRUD comme terminé.
- Les téléversements des pages encore reliées au routeur utilisent le contrôle MIME et le nom aléatoire partagés; deux anciens contrôleurs (`equipe`, `partenaire`) ne sont reliés à aucune page routable. Plusieurs requêtes SQL historiques concatènent encore des paramètres et plusieurs pages privées demandent une revue d’accès.
- La limitation des tentatives est en place; la récupération de compte n’est pas implémentée faute d’e-mail institutionnel et de procédure approuvée.
- `indexdown.php` n’était pas présent dans cette copie. Les dossiers `cgi-bin/` et `wp-admin/` examinés sont vides.
- Les anciennes pages d’administration `a_service`, `a_offre` et `a_galerie` reprenaient un modèle hôtel/restauration sans tables correspondantes dans l’export fourni. Leurs routes sont désactivées et leurs fichiers conservés; une réactivation demanderait une validation institutionnelle et un modèle de données adapté.
- L’hébergement doit confirmer l’application des `.htaccess` et la disponibilité de `mod_rewrite`; ces règles n’ont pas été exécutées contre Apache ici.

## Vérifications et limites

PHP 8.1 a validé la syntaxe des points d’entrée, connecteurs, contrôleurs d’authentification, vues publiques et espace étudiant modifiés. Les rendus CLI de l’accueil, de la connexion étudiant et de l’admission sans base configurée ont été vérifiés avec un chemin de session temporaire accessible. Le jeton CSRF et les fonctions de hachage ont été contrôlés isolément. La base de production n’a pas été connectée. Les migrations SQL, autorisations par rôle, tests HTTP CSRF/XSS/injection, téléversements et restauration de sauvegarde restent à vérifier. Ce rapport ne constitue pas une certification ni une approbation de déploiement.


## Mise à jour — administration et contact (28 octobre 2026)

Le formulaire public de contact valide les champs, applique CSRF et protections anti-robot, puis enregistre les messages dans la table historique `contact`; l’administration dispose d’une boîte de réception. L’envoi d’e-mail n’est pas activé, faute de configuration de messagerie.

L’administration a maintenant un tableau de bord, une interface de contenu institutionnel et de coordonnées, la consultation des candidatures avec téléchargement authentifié de pièces, la gestion de communiqués étudiants et une interface de comptes administrateur restreinte au niveau 7. Les changements de rôle et d’état de compte sont POST + CSRF; aucune transition de candidature n’a été ajoutée sans définition fiable des valeurs historiques `etat` et `confirmer`.

La migration `migrations/20261028_01_create_site_setting.sql` doit être appliquée avant que les textes éditables soient enregistrés. Elle n’a pas été exécutée et aucune base n’a été modifiée. Le catalogue historique conserve plusieurs modules d’administration et téléchargements qui doivent encore être audités et convertis; cette phase ne rend donc pas encore chaque donnée du site gérable depuis un écran unique. Les règles `.htaccess` restent à valider sur l’hébergement Apache.

La syntaxe PHP 8.1 des pages et contrôleurs ajoutés ou modifiés a été vérifiée. Les tests de connexion et d’écriture SQL restent impossibles sans configuration locale de base de données.

## Mise à jour — administration historique (28 octobre 2026)

Les suppressions, publications et activations des modules historiques de contenu ont été converties en POST protégés par jeton CSRF. Le routage d’administration refuse maintenant les autres mutations POST sans jeton. Les écrans de téléversement de contenus, personnel, annonces image et galeries contrôlent les images JPEG/PNG réelles, limitent la taille à 5 Mo et génèrent un nom aléatoire. Les tables sensibles restent à vérifier par un essai fonctionnel sur copie de la base avant déploiement.

### Matrice d’accès administrateur

- Niveau 7 — super-administrateur : accès complet, gestion des comptes et journaux inclus.
- Niveau 5 — webmaster : gestion de tous les contenus et réglages du site public.
- Niveau 10 — éditeur de contenu : actualités, vie de campus, galeries, annonces et communiqués.
- Niveau 11 — gestionnaire académique : sections, départements, options, promotions et palmarès.
- Niveau 12 — gestionnaire du personnel : personnel, agents et messagerie.
- Niveau 13 — agent des admissions : consultation des candidatures et téléchargement de leurs pièces.

Les niveaux 10 à 13 sont de nouveaux codes enregistrés dans le champ historique `admin.niveau`; les niveaux 5 et 7 gardent leur sens antérieur. L’interface de gestion des comptes est réservée au niveau 7. Les droits sont vérifiés côté serveur à chaque requête et l’identité/rôle est relu depuis la base à chaque chargement d’une page admin. Les nouveaux comptes sont créés actifs avec le rôle sélectionné; la protection empêche de suspendre, supprimer ou rétrograder le dernier super-administrateur actif.

La matrice doit être validée par l’établissement avant déploiement, car l’export ne décrit pas les responsabilités institutionnelles attendues. Aucun compte ni aucune base n’a été modifié par cette mise à jour du code.

### Autorisations et espace étudiant — mise à jour

Le routage d’administration applique la matrice ci-dessus côté serveur. Le téléchargement des pièces de candidature est réservé aux niveaux 7 et 13. L’espace étudiant inclut un téléchargement de pièces qui sélectionne les fichiers à partir de l’identifiant de session, sans identifiant étudiant fourni par l’URL. Cette vérification nécessite encore un essai avec des comptes et des fichiers de test sur une copie isolée de la base.

## Vérifications complémentaires

Le contrôle de syntaxe PHP 8.1 a couvert 79 fichiers concernés par cette phase. Les essais antérieurs de rendu du tableau de bord ont couvert les niveaux 5 et 7; les nouveaux rôles 10 à 13 ont été ajoutés ensuite. Le routeur refuse les pages non autorisées selon la matrice courante, l’inscription publique administrateur et les mutations POST sans CSRF. L’endpoint de téléchargement étudiant refuse une session absente. Les lectures/écritures sur la base, le téléchargement d’un document existant, les téléversements et les permissions Apache restent à valider sur une copie locale configurée.

### Endpoints AJAX des formulaires historiques

Les listes déroulantes AJAX des formulaires historiques valident maintenant les identifiants POST, utilisent des requêtes préparées et échappent les libellés HTML. Le chaînage suit les clés du schéma fourni entre faculté, département, option et promotion; la liste des enseignants lit la table `prof`. La syntaxe des dix scripts PHP concernés a été contrôlée. Les résultats réels restent à confirmer avec une base MySQL locale configurée.

### Comité de gestion et portraits

La page d’accueil lit les noms, fonctions, portraits et ordre d’affichage depuis `committee_member`. L’administration offre ajout, modification, remplacement de photo, publication, masquage et suppression; les photos passent par le contrôle MIME partagé et les actions POST sont protégées par CSRF. Les migrations `20261029_01_create_committee_member.sql` et `20261029_02_add_committee_member_description.sql` doivent être appliquées dans l’ordre avant utilisation sur une base déjà restaurée. Aucun nom ni portrait n’est prérempli, car les enregistrements disponibles ne permettent pas d’identifier les autorités actuelles.

Chaque fiche possède aussi une description éditable par un éditeur visuel. Les HTML soumis sont nettoyés côté serveur avec une liste blanche de balises et de liens avant stockage, puis nettoyés à nouveau au rendu public. Appliquer la migration `20261029_02_add_committee_member_description.sql` sur les bases ayant déjà créé la table sans ce champ.

## Fonctions toujours en attente

- La préinscription publique est une page d’information; elle ne crée pas de dossier. L’ancien handler d’inscription, qui utilisait un mot de passe par défaut et des téléversements insuffisamment validés, est neutralisé. Un nouveau parcours ne doit être activé qu’après validation des champs, règles de promotion, accusé de réception et procédure de première connexion.
- L’espace étudiant propose maintenant les pièces déjà associées au compte connecté, mais le téléchargement doit être essayé avec un vrai compte et un vrai fichier sur une copie de la base.
- Aucun test de connexion, d’écriture ou de migration SQL n’a été réalisé car l’application n’a pas de configuration de base locale. L’import SQL reste à faire dans une instance isolée.
- La limitation des connexions utilise désormais un compteur local verrouillé, hors webroot, par adresse réseau et identifiant (8 échecs sur 15 minutes). Le journal des actions sensibles couvre les changements d’état centralisés, les créations des modules actifs, les changements éditoriaux et les opérations de comptes; appliquer `20261028_02_create_admin_action_log.sql` sur une base existante. Certaines modifications directes historiques ne sont pas encore journalisées.
- La politique de conservation des messages et de durée du journal doit être validée par l’établissement. La procédure de sauvegarde/restauration est documentée, mais n’a pas été testée.
- La récupération de compte reste non implémentée; elle nécessite une messagerie institutionnelle opérationnelle et un processus de vérification d’identité approuvé.
- Les règles Apache, permissions de répertoires et téléchargements privés doivent être vérifiés sur l’hébergement. Les modules historiques de téléversement non repris dans cette phase restent à auditer.
- La matrice complète des rôles 5, 7 et 10 à 13 doit être validée par l’établissement; le dump fourni ne décrit pas les responsabilités institutionnelles attendues.
- Les métadonnées par page et `robots.txt` sont présents; aucun sitemap avec URL canonique n’est publié faute de domaine public confirmé.
