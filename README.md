# ISP-GOMBE — Site institutionnel

Site web public et panneau d’administration de l’Institut Supérieur Pédagogique de la Gombe (ISP-GOMBE), à Kinshasa.

Le projet est développé en PHP avec MySQL/MariaDB. Il comprend notamment les pages institutionnelles, les formations, les actualités, les événements, les résultats académiques et une interface d’administration pour gérer les contenus.

## Prérequis

- PHP 8.1 ou ultérieur avec PDO MySQL et les extensions PHP utilisées par le projet.
- MySQL ou MariaDB.
- Apache 2.4 avec `mod_rewrite` et `AllowOverride` activés pour utiliser les règles `.htaccess`.
- Laragon est recommandé pour le développement local sous Windows.

## Installation locale avec Laragon

1. Clonez le dépôt dans le répertoire web de Laragon, par exemple `C:\laragon\www\ispgombe-new`.
2. Démarrez Apache et MySQL depuis Laragon.
3. Créez une base de développement MySQL nommée `ispgombe` et importez les données et migrations nécessaires. Consultez [INSTALLATION.md](INSTALLATION.md) pour les procédures de restauration et de migration.
4. Créez `.env.local.php` à la racine pour la connexion locale. Ce fichier est ignoré par Git. En dehors de localhost, fournissez les variables d’environnement décrites dans [`.env.example`](.env.example) :

   - `ISPGOMBE_DB_HOST`
   - `ISPGOMBE_DB_NAME`
   - `ISPGOMBE_DB_USER`
   - `ISPGOMBE_DB_PASSWORD`

5. Ouvrez le site dans votre navigateur à l’adresse configurée dans Laragon, par exemple `http://ispgombe-new.test/`.

### Lancer avec le serveur PHP intégré

Pour un aperçu local rapide, ouvrez CMD dans le dossier du projet et lancez :

```cmd
php -S 127.0.0.1:8000 index.php
```

Puis visitez [http://127.0.0.1:8000/](http://127.0.0.1:8000/). Ce serveur est réservé au développement ; utilisez Apache ou un serveur web configuré pour les règles `.htaccess` avant tout déploiement.

## Administration

- Site public : `/`
- Administration : `/admin/`
- Connexion administrateur : `/admin/?pages=login`

Les comptes et rôles administrateur sont gérés par un super-administrateur depuis le panneau. Le dépôt ne définit pas de mot de passe par défaut : utilisez un compte local configuré de manière sûre et ne partagez jamais ses identifiants.

## Structure du projet

- `index.php` — point d’entrée du site public et routage des pages.
- `pages/` — vues des pages publiques.
- `php/` — contrôleurs et fonctions du site public.
- `admin/` — panneau et fonctions d’administration.
- `css/`, `js/`, `images/` — styles, scripts et ressources publiques.
- `database/` — scripts SQL de restauration locale.
- `migrations/` — migrations versionnées de la base.
- `INSTALLATION.md` — instructions détaillées d’installation et de migration.

## Sécurité et données

- Ne commitez jamais `.env.local.php`, des mots de passe, des clés privées, des sauvegardes ou des exports SQL contenant des données personnelles ou des comptes réels.
- Le fichier `database/ispgombe_full_install.sql` sert à une restauration locale contrôlée. Vérifiez son contenu et retirez ou anonymisez les données personnelles et comptes avant toute publication publique du dépôt.
- Utilisez une base de développement isolée pour les imports. Ne restaurez pas le dump sur la production sans sauvegarde et validation.
- En production, configurez HTTPS, les secrets dans l’environnement du serveur et les limites de téléversement adaptées. Les images envoyées via l’administration sont limitées à JPG, PNG ou WebP, 15 Mo maximum.
- Consultez [SECURITY-AUDIT.md](SECURITY-AUDIT.md) et [MIGRATION-PLAN.md](MIGRATION-PLAN.md) avant toute mise en production.

## Contribution

1. Créez une branche pour votre modification.
2. Gardez les changements ciblés et vérifiez la syntaxe PHP des fichiers modifiés.
3. Ne joignez pas de données de production, de mots de passe ou de secrets aux commits et aux issues.
4. Ouvrez une pull request en expliquant le changement et les vérifications effectuées.

## Licence

Aucune licence open source n’est déclarée dans ce dépôt pour le moment. Demandez l’autorisation de l’établissement avant de réutiliser ou redistribuer le code, le contenu ou les images.
