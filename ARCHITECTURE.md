# Inventaire de l’application — ISP-GOMBE

## Structure observée

- `index.php` : point d’entrée public, allowlist de pages, métadonnées et layout commun.
- `pages/` : vues publiques, espace étudiant, vues de résultats, formulaires et pages d’impression.
- `php/` : contrôleurs historiques, connexion, inscription, contenu et palmarès.
- `menu/` : navigation publique et pied de page.
- `admin/` : application de gestion, pages et fonctions de traitement.
- `css/`, `js/`, `fonts/`, `images/`, `media/` : styles et ressources locales.
- `pages/TCPDF-main/`, `pages/phpqrcode/` : génération PDF et QR code embarquée.
- `isp_gombe.sql` et l’export fourni : schéma/données historiques; l’export à la racine est désormais bloqué en HTTP.

## Navigation publique rétablie

- **Accueil** : présentation, accès aux formations, actualités, services et vidéo institutionnelle; l’ancre historique `#section` mène aux formations.
- **L’Institut** : création et mission, historique, direction générale, secrétariat général académique, recherche et bibliothèque, services administratifs, budget et comité de gestion (`?pages=isp&...`).
- **Formations** : sections organisées et départements; les sessions et niveaux restent accessibles dans leur contexte de parcours (département, année et session).
- **Vie de campus** : publications liées au campus.
- **Actualités** : publications, événements et activités.
- **Services** : préinscription, espace étudiant, palmarès et contact.

Cette arborescence reprend les rubriques visibles dans la navigation publique archivée et les relie aux routes réellement présentes dans le projet. Les entrées historiques sans page ou contenu identifiable ne sont pas transformées en pages fictives.

## Présentation visuelle des pages publiques

- La navigation, les bandeaux de page, les cartes éditoriales et les espacements suivent un système institutionnel commun défini dans `design-system/isp-gombe/MASTER.md`.
- Les pages Contact et Connexion étudiant utilisent des formulaires à labels visibles, messages accessibles et gabarits adaptés au mobile.
- Les fiches Section et Département chargent leurs données en contrôleurs dédiés et présentent descriptions, images, équipes et informations liées dans une mise en page homogène.
- Le lien d’évitement, les états de focus clavier, les zones tactiles et la réduction des animations sont partagés dans la feuille institutionnelle.

## Fonctionnalités préservées ou refondues dans cette phase

- Navigation publique par pages autorisées, accueil, pages institutionnelles, formations, actualités, contact, palmarès, admission et connexion étudiant.
- Accueil consommant les facultés et actualités publiées disponibles en base.
- Vue étudiant affichant le profil associé à la session courante, les communiqués de sa promotion, les pièces du dossier transmises par endpoint authentifié et le changement sécurisé du mot de passe.
- Connexion administrateur et étudiant avec migration au premier succès des hachages SHA-1 historiques.

## Fonctionnalités existantes nécessitant encore un audit avant réactivation/confiance

- Couverture complète du CRUD historique dans l’administration; le journal d’actions est démarré pour les mutations centralisées et les comptes, mais ne couvre pas encore chaque formulaire de création/modification.
- Téléversements, pièces jointes, impressions PDF et galeries privées.
- Cours, résultats, documents et horaires dans l’espace étudiant.
- Inscription complète et suivi de candidature.
- Contact par e-mail et notifications.
- Filtrage/pagination des actualités, recherche, SEO et sitemap.
- Les anciennes pages de gestion de services/offres hôtelières et galerie de restauration ont été désactivées; elles ne correspondent pas aux tables de l’export ISP-GOMBE.

Les fichiers listés dans le cahier des charges n’étaient pas tous présents sous forme d’archive; ce document décrit le répertoire réel examiné.

### Administration ajoutée en octobre 2026

Le panneau d’administration comprend désormais le tableau de bord, les réglages éditoriaux institutionnels (après application de la migration `site_setting`), la boîte de réception du formulaire de contact, les communiqués étudiants, la consultation des candidatures avec téléchargement protégé de pièces, la gestion des comptes administrateur et un journal réservé au niveau 7 (après migration `admin_action_log`). Les fonctions d’organisation académique raccordées au routeur sont conservées; leur couverture fonctionnelle reste à tester sur copie de base avant de considérer toute l’administration achevée.

## Rôles d’administration

Les rôles administrateur sont : 7 super-administrateur, 5 webmaster, 10 éditeur de contenu, 11 gestionnaire académique, 12 gestionnaire du personnel et 13 agent des admissions. Le routeur applique les autorisations côté serveur; la gestion des comptes et journaux reste réservée au niveau 7, et les pièces de candidature aux niveaux 7 et 13. La création publique de comptes est bloquée. Les responsabilités doivent être validées par l’établissement avant l’attribution de comptes réels.

Le Comité de gestion de la page d’accueil est alimenté par `committee_member`; le Webmaster, le Gestionnaire du personnel et le Super-administrateur peuvent y gérer les membres et leurs portraits. Importer `migrations/20261029_01_create_committee_member.sql` avant d’utiliser cet écran.

## Documents étudiants

Les pièces d’inscription sont proposées depuis l’espace étudiant à partir de la session courante. L’endpoint accepte uniquement une clé de document autorisée, relit la valeur de la colonne du seul étudiant connecté, contrôle le nom de fichier et le MIME, puis transmet le fichier en pièce jointe avec `no-store`. Les accès directs aux répertoires `media/` restent refusés par `.htaccess` et nécessitent une validation sur l’hébergement.
