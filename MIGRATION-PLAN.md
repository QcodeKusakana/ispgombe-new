# Plan de migration réversible

Les migrations `20261028_01_create_site_setting.sql` et `20261028_02_create_admin_action_log.sql` sont incluses, mais aucune n’a été exécutée dans cette phase. Le dump source est conservé séparément; le script d’installation complète intègre ces deux tables supplémentaires.

## Préparation

1. Obtenir l’archive originale et la placer dans un stockage privé, hors du webroot. Elle n’était pas présente dans le répertoire de travail pendant l’audit.
2. Prendre une sauvegarde cohérente de la base de production et conserver un exemplaire chiffré et séparé du serveur Web.
3. Restaurer cette sauvegarde dans une base de préproduction isolée.
4. Relever le nombre de lignes par table, les identifiants min/max, les index, les contraintes et les valeurs d’encodage avant migration. Contrôler un échantillon d’accents et caractères spéciaux sans exporter de données personnelles dans les journaux.

## Conversion éventuelle latin1 vers utf8mb4

1. Déterminer d’abord l’encodage réel des octets de chaque table; ne pas convertir à l’aveugle les colonnes qui contiennent des données déjà encodées en UTF-8.
2. Pour toute conversion d’encodage, écrire une migration SQL versionnée et documenter précisément la conversion des tables/colonnes, index et collations.
3. Exécuter la migration seulement sur la copie isolée; comparer les nombres de lignes, identifiants, relations, textes accentués et requêtes métier.
4. Prévoir une restauration complète de la sauvegarde d’origine si un contrôle échoue. Ne pas appliquer une conversion inverse automatique qui pourrait perdre des caractères.
5. Faire valider la fenêtre d’intervention, la sauvegarde et le plan de retour arrière avant le déploiement.

## Retour arrière

En cas d’échec, arrêter les écritures applicatives, restaurer la sauvegarde complète de la base et remettre les fichiers applicatifs de la version précédente depuis une archive privée conservée séparément. Vérifier les comptes, relations, parcours principaux et volumes avant de rouvrir le site. Tester cette procédure sur préproduction avant toute opération réelle.
