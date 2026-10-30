ALTER TABLE `contact`
  DROP INDEX `idx_contact_read_state_id`,
  DROP COLUMN `is_read`;
