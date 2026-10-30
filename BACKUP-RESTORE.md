# Sauvegarde et restauration de la base ISP-GOMBE

Cette procédure est un mode opératoire à valider sur une instance de test. Aucun export restauré n’a été vérifié dans cette phase. Le fichier SQL contient des données personnelles et des hachages de mots de passe : stockez les sauvegardes dans un dossier hors du répertoire Web, chiffrées et accessibles uniquement aux responsables autorisés.

## Sauvegarder

1. Vérifier le serveur et le nom de base dans l’environnement Apache/PHP (`ISPGOMBE_DB_HOST`, `ISPGOMBE_DB_NAME`, `ISPGOMBE_DB_USER`). Ne pas afficher ni copier le mot de passe dans le terminal.
2. Créer un dossier de sauvegarde protégé hors du site, puis lancer `mysqldump` depuis le terminal Laragon ou l’outil MariaDB/MySQL fourni avec l’hébergement. Exemple PowerShell, en adaptant l’hôte et l’utilisateur :

```powershell
$backupFile = 'D:\Backups\ispgombe-' + (Get-Date -Format 'yyyyMMdd-HHmmss') + '.sql'
mysqldump --host=127.0.0.1 --user=COMPTE_SQL --password --single-transaction --default-character-set=utf8mb4 --result-file="$backupFile" ispgombe
```

`--password` demande le secret sans le placer dans la commande. Vérifier que la commande s’est terminée sans erreur, que le fichier n’est pas vide et que sa taille est cohérente. Stocker une copie chiffrée séparée du serveur.

## Restaurer dans une instance de test

1. Utiliser un serveur ou une instance isolée de la production. Ne pas restaurer par-dessus la base de production.
2. Créer la base de test avec les droits du compte SQL de test, puis lancer `source` depuis le client MySQL :

```powershell
mysql --host=127.0.0.1 --user=COMPTE_SQL --password --execute="CREATE DATABASE ispgombe_restore CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
mysql --host=127.0.0.1 --user=COMPTE_SQL --password --database=ispgombe_restore --execute="source D:/Backups/ispgombe-AAAAMMJJ-HHMMSS.sql"
```

`--password` demande le mot de passe. Les commandes ci-dessus supposent une sauvegarde `mysqldump` sans l’option `--databases`, et une base `ispgombe_restore` déjà créée. L’export d’installation `database/ispgombe_full_install.sql` est une restauration initiale distincte : il sélectionne la base `ispgombe` et doit être importé une seule fois dans une base vide.
3. Vérifier les erreurs d’import, comparer le nombre de tables et les volumes de lignes aux valeurs relevées avant sauvegarde, puis ouvrir les parcours essentiels en pointant l’application de test vers cette base.
4. Tester un téléchargement étudiant avec deux comptes distincts, les permissions de rôles, le contact, les publications et la connexion. Supprimer ensuite l’instance de test selon la procédure interne de l’établissement.

## Limites actuelles

Les identifiants SQL ne sont pas configurés dans cette copie; aucune sauvegarde ni restauration réelle n’a été exécutée. La durée de conservation, le chiffrement retenu, les responsables et le calendrier des sauvegardes restent à décider par l’ISP-GOMBE.
