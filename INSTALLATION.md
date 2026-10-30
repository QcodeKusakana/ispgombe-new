# Installation locale

## Prérequis

- PHP 8.1 ou ultérieur avec PDO MySQL et les extensions requises par les modules utilisés.
- MySQL/MariaDB compatible avec le dump historique.
- Apache 2.4 avec `mod_rewrite` et `AllowOverride` activé pour appliquer `.htaccess`.

## Configuration

1. Configurer un hôte virtuel dont la racine pointe sur ce répertoire.
2. En développement local avec Laragon, `.env.local.php` fournit la connexion à la base locale `ispgombe`. Ce fichier est ignoré par Git, chargé uniquement sur `localhost`/`127.0.0.1`, et les fichiers cachés sont bloqués par Apache. Pour un autre environnement, configurer les variables PHP `ISPGOMBE_DB_HOST`, `ISPGOMBE_DB_NAME`, `ISPGOMBE_DB_USER` et `ISPGOMBE_DB_PASSWORD` depuis `.env.example`; ne pas y placer les secrets réels.
3. Pour une base de développement, restaurer l’export uniquement dans une base isolée et protégée. Ne pas déposer d’export SQL dans un répertoire servi par le Web.
4. Utiliser un compte SQL dédié aux opérations réellement nécessaires; ne pas réutiliser un compte d’administration serveur.
5. Vérifier dans le navigateur les pages publiques, les formulaires, les sessions et les journaux PHP. La copie locale ne fournit pas le mot de passe de la base et aucune importation n’a été réalisée dans cette phase.

## Avant publication

Vérifier que les règles `.htaccess` sont effectives avec le serveur cible, installer le certificat HTTPS, fournir des visuels institutionnels validés, compléter l’audit des modules privés et effectuer les tests de migration et de restauration décrits dans `MIGRATION-PLAN.md`. Ne pas publier tant que les contrôles restant dans `SECURITY-AUDIT.md` ne sont pas satisfaits.

## Base SQL complète

Le fichier `database/ispgombe_full_install.sql` restaure les tables et les données de l’export fourni, crée la base locale `ispgombe`, puis ajoute les tables `site_setting`, `admin_action_log`, `home_slide` et `committee_member` (avec sa description éditable). Dans phpMyAdmin, sélectionnez Importer et choisissez ce fichier. Utilisez une base vide et importez-le une seule fois; ne l’exécutez pas sur une base existante ni sur la production sans sauvegarde. Configurez ensuite `ISPGOMBE_DB_NAME=ispgombe` et les identifiants MySQL dans l’environnement Apache/PHP. Pour une base déjà restaurée, appliquez dans l’ordre les migrations non exécutées de `migrations/`.

Le fichier reprend aussi les données personnelles et les comptes déjà présents dans l’export original; gardez-le privé et ne le publiez pas dans le répertoire web en production. La connexion locale suppose la configuration Laragon habituelle (`root`, sans mot de passe); adaptez `.env.local.php` si votre serveur MySQL local utilise d’autres identifiants.

## Comptes administrateur

La route publique d’inscription administrateur est désactivée. Un super-administrateur connecté ouvre `admin/?pages=valider_adm` et crée un compte en choisissant parmi les rôles 5 (Webmaster), 10 (Éditeur de contenu), 11 (Gestionnaire académique), 12 (Gestionnaire du personnel) et 13 (Agent des admissions). Le niveau 7 est réservé au super-administrateur et ne doit être attribué qu’à un compte autorisé. Les responsabilités de chaque rôle doivent être validées par l’établissement avant l’attribution de comptes réels. Les nouveaux mots de passe doivent contenir au moins 12 caractères.

Pour une base complète créée avec le script ci-dessus, ouvrir directement `admin/?pages=comite_gestion`. Pour une base déjà restaurée, importer `migrations/20261029_01_create_committee_member.sql` puis `migrations/20261029_02_add_committee_member_description.sql` si la table n’existe pas encore; si elle existe déjà, importer uniquement la migration `02`. Ajouter le nom, la fonction, une description mise en forme, l’ordre et une photo JPG, PNG ou WebP de 15 Mo maximum pour chaque membre. Seuls les membres publiés sont visibles sur le site; aucune identité ni photo n’est préremplie sans validation.
