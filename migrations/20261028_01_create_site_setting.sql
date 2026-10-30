CREATE TABLE `site_setting` (
  `setting_key` varchar(80) NOT NULL,
  `setting_value` text NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`setting_key`),
  KEY `idx_site_setting_updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `site_setting` (`setting_key`, `setting_value`) VALUES
('hero_title', 'Former aujourd’hui'),
('hero_highlight', 'les éducateurs de demain.'),
('hero_description', 'Un établissement d’enseignement supérieur dédié à la formation intellectuelle et professionnelle, au cœur de Kinshasa.'),
('about_title', 'Un cadre de formation'),
('about_highlight', 'au service du savoir.'),
('about_intro', 'L’ISP-GOMBE accompagne ses étudiants dans une formation exigeante, portée par l’apprentissage, la pratique et la vie de campus. Découvrez l’institution, ses formations et les informations utiles pour préparer votre parcours.'),
('admissions_notice', 'Pour connaître les conditions d’admission et les pièces à fournir, contactez l’administration de l’ISP-GOMBE. Les modalités peuvent varier selon la formation et l’année académique.'),
('contact_email', 'contact@ispgombe.ac.cd'),
('contact_phone', ''),
('contact_address', 'Avenue Père Boka, au croisement de l’avenue Kisangani — Commune de la Gombe, Kinshasa'),
('institution_history', ''),
('institution_mission', ''),
('institution_vision', ''),
('institution_values', ''),
('institution_organization', ''),
('institution_authorities', ''),
('institution_administration', ''),
('institution_budget', ''),
('campus_description', ''),
('research_description', '');
