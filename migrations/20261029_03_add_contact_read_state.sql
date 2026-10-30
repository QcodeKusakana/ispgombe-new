ALTER TABLE `contact`
  ADD COLUMN `is_read` TINYINT(1) NOT NULL DEFAULT 0 AFTER `message`,
  ADD KEY `idx_contact_read_state_id` (`is_read`, `id`);
