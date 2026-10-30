CREATE TABLE IF NOT EXISTS `home_slide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kicker` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `image_alt` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_home_slide_image_path` (`image_path`),
  KEY `idx_home_slide_active_order` (`is_active`, `sort_order`, `id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT IGNORE INTO `home_slide` (`kicker`, `title`, `image_path`, `image_alt`, `sort_order`, `is_active`) VALUES
('Vie institutionnelle', 'La communauté universitaire réunie', 'admin/media/images_activ/avs_0_act.jpg', 'Cérémonie académique à l’ISP-GOMBE', 1, 1),
('Apprendre et pratiquer', 'Des espaces dédiés à la formation', 'admin/media/couverture/Qcode_12.jpeg', 'Étudiantes et étudiants dans une salle informatique de l’ISP-GOMBE', 2, 1),
('Vie académique', 'Réflexion et partage au sein de l’institut', 'admin/media/images_activ/avs_3_act.jpg', 'Enseignants et membres académiques réunis en séance de travail', 3, 1);
