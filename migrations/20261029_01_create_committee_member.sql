CREATE TABLE IF NOT EXISTS `committee_member` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(160) NOT NULL,
  `fonction` varchar(160) NOT NULL,
  `photo` varchar(80) NOT NULL,
  `sort_order` int NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_committee_member_active_order` (`is_active`, `sort_order`, `id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
