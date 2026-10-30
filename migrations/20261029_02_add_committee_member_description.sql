ALTER TABLE `committee_member`
  ADD COLUMN `description` LONGTEXT NULL AFTER `fonction`;

UPDATE `committee_member`
SET `description` = ''
WHERE `description` IS NULL;

ALTER TABLE `committee_member`
  MODIFY COLUMN `description` LONGTEXT NOT NULL;
