CREATE TABLE IF NOT EXISTS `admin_action_log` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `actor_id` int(11) NOT NULL,
  `actor_name` varchar(100) NOT NULL DEFAULT '',
  `action_name` varchar(100) NOT NULL,
  `target_type` varchar(100) NOT NULL,
  `target_id` varchar(100) DEFAULT NULL,
  `details_json` text NOT NULL,
  `ip_digest` char(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_admin_action_log_actor` (`actor_id`, `created_at`),
  KEY `idx_admin_action_log_target` (`target_type`, `target_id`),
  KEY `idx_admin_action_log_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
