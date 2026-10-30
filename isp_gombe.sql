-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour isp_gombe
CREATE DATABASE IF NOT EXISTS `isp_gombe` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `isp_gombe`;

-- Listage de la structure de table isp_gombe. activite
CREATE TABLE IF NOT EXISTS `activite` (
  `id_act` int NOT NULL AUTO_INCREMENT,
  `titre` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `description` text,
  `photo` varchar(50) DEFAULT NULL,
  `categorie` int DEFAULT NULL,
  `id_adm` int DEFAULT NULL,
  `date_pub` datetime DEFAULT NULL,
  `etat_depot` int DEFAULT '0',
  `etat_modifier` int DEFAULT '0',
  PRIMARY KEY (`id_act`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.activite : ~7 rows (environ)
INSERT INTO `activite` (`id_act`, `titre`, `description`, `photo`, `categorie`, `id_adm`, `date_pub`, `etat_depot`, `etat_modifier`) VALUES
	(8, 'ISP-GOMBE : Un Pool d’Intelligence au Rayonnement national et International en RDC. L’acte se lie à la Parole, Et la Professeure Emilienne AKONGA EDUMBE se distingue.', 'L’organisation des Enseignements\r\nActuellement les unités d’enseignement à l’ISP-GOMBE s’articulent autour des grandes sections. On peut citer la Section Lettres et Sciences Humaines avec Quatre Départements ; la Section Sciences Exactes avec deux Départements ; la Section Sciences Commerciales et Administratives et informatique avec deux Départements ; la Section Sciences et Techniques d’Accueil avec également ses deux Départements ; on y adjoint la Bibliothèque et le Centre de Recherche Scientifique, d’Edition et de Diffusion des Documents Pédagogique (CRESEDIP).\r\n\r\nIl convient de préciser que l’ISP-GOMBE met chaque année sur le marché d’emploi plus de deux mille diplômés dont les futurs enseignants, les Administrateurs, les Gestionnaires, les informaticiens et les gestionnaires des entreprises touristiques et\r\nHôtelières, bien formés car c’est ici l’occasion de le souligner, l’ISP-GOMBE est compté parmi les rares institutions publiques d’enseignement supérieur où les valeurs ont encore leur place.\r\n\r\nDans le même ordre d’idée et pour mettre en évidence la marque de distinction de l’actuel comité de gestion, l’ISP-GOMBE a été choisi depuis février 2014, parmi toutes les institutions d’enseignement supérieur de la RD Congo pour abriter le centre d’enseignement à distance et en ligne de l’Université Virtuelle Africaine (e-Learning UVA). Ce centre facilite l’accès à l’enseignement supérieur de haute portée et à la formation continue en Afrique touchant un nombre importants d’étudiants et professionnels. Il facilite également l’accès à des ressources de Formation Ouverte\r\nà Distance et d’Elearning (FOADeL) qui sont utiles à l’Afrique et encore plus à la RDC. En outre ce Centre permet d’Améliorer les capacités de l’ISP-GOMBE en enseignement supérieur, d’effectuer des activités de recherche sans peine, d’augmenter le nombre d’enseignants maîtrisant les TIC et de promouvoir la mobilité des enseignants au niveau régional.\r\n\r\nLes Réalisations et Innovations du Comité Emilienne AKONGA\r\nAprès sa nomination à la tête de l’ISP-GOMBE, Akonga Emilienne, Directrice Générale de cet établissement public d’enseignement supérieur a mis sur pieds un plan stratégique d’urgence pour faire de l’ISP un pool d’intelligence au rayonnement national et international. Ce plan contient plus de 16 ambitieux projets pour installer la culture de l’excellence car dit-elle dans son speech,', 'avs_6_act.jpg', NULL, 1, '2024-07-08 09:05:40', 0, 1),
	(9, 'ISP-GOMBE : Un Pool d’Intelligence au Rayonnement national et International en RDC. L’acte se lie à la Parole, Et la Professeure Emilienne AKONGA EDUMBE se distingue.', '« Nous pensons que la formation de l’excellence ne peut être possible que par un changement des comportements et des mentalités, ainsi qu’une mobilisation d’ensemble pour un travail de qualité ». Elle a pour ce faire institué 8 commissions permanentes et une Direction d’audit interne pour s’assurer de l’aboutissement et de la réussite de tous ces projets. \r\n\r\nLa bonne nouvelle à ce stade c’est que bon nombre de ces projets sont passés de l’abstrait au concret. Il s’agit de :\r\n- La maîtrise de l’état des lieux de l’Institution, au terme des consultations générales ; - La mise en place d’une Direction de l’Audit Interne ; - La mise en place de nouvelles autorités décanales qui a permis de donner une nouvelle ligne de conduite et un nouveau dynamisme; - La mise en place de la commission chargée de l’élaboration du plan stratégique de l’ISP-GOMBE ; - L’acquisition d’un équipement approprié pour l’Informatisation de la gestion administrative; - L’achat et l’installation, pour la première fois, depuis des décennies, des citernes qui permettent la desserte en eau des douches et des toilettes des pensionnaires du Home Sebyera;\r\nle rafraîchissement des murs du Home Détienne et du Centre de Santé ; - La réfection et le remplacement des portes de l’amphithéâtre; - L’aménagement d’une salle de travail pour le Personnel académique; - L’aménagement de la Bibliothèque; - La réparation des toitures de deux laboratoires de chimie et de biologie; - L’embellissement de la Clôture de l’ISP/Gombe; - L’aménagement d’une salle d’attente. \r\n\r\nIl faut également noter que dans le cadre de l’ouverture au monde extérieur, plusieurs partenariats ont été signés entre l’ISP d’Emilienne Akonga et plusieurs universités dans le monde où elle est maître de plusieurs conférences. L’ISP-GOMBE par l’entremise de la professeure Akonga Edumbe vend valablement auprès des tierces partout dans le monde, l’image de l’université congolaise sur plusieurs plates-formes régionales et internationales.\r\nConsidérant sa situation géographique, l’ISP-GOMBE sert aujourd’hui comme l’avait prédit sa Directrice Générale, de vitrine et de modèle de modernisation\r\ninstitutions publiques de l’Enseignement Supérieur et Universitaire, conformément à la vision salvatrice du Chef de l’Etat.\r\n\r\nPar ailleurs, quelques défis demeurent présents pour concrétiser à 100% le rêve d’Emilienne Akonga. Elle tient à court et à moyen terme à rendre opérationnel le centre entrepreneurial, incubateur d’emplois par excellence ; Disposer de son laboratoire d’analyse biomédicale ; Disposer de ses unités de transformation et conservation des aliments ainsi que de fabrication de vins ; Augmenter son potentiel logistique et ses infrastructures tant d’enseignements que d’appui à l’enseignement, conformément aux standards internationaux ; Poursuivre l’ouverture de l’institution au monde tant scientifique que professionnel par la signature des partenariats avec d’autres institutions, des entreprises et organismes de développement ; Finaliser le dossier de réouverture du troisième cycle ; S’inscrire dans la démarche du gouvernement pour la réforme du système éducatif et le pari sera totalement gagné.\r\n', 'avs_1_act.jpg', NULL, 1, '2024-07-08 09:09:08', 0, 1),
	(10, 'En réalité ce que nous sommes est plus éloquent que ce que nous clamons, Et nos œuvres constituent le meilleur reflet de nos valeurs intrinsèques ;', 'En réalité ce que nous sommes est plus éloquent que ce que nous clamons, Et nos œuvres constituent le meilleur reflet de nos valeurs intrinsèques ; il est donc certain d\'affirmer que toute institution est généralement une expression de ce qu\'est en réalité son animateur car dit-on, la plus belle fille du monde ne donne que ce qu\'elle a. Cette logique nous amène de prime abord à nous appesantir tant soit peu sur la professeure AKONGA EDUMBE Emilienne, l\'actuelle Directrice Générale qui préside à la destinée de l\'ISP-GOMBE, dans le but de nous faire une idée claire et distincte sur les arcanes qui sous-tendent sa distinction, bien avant de creuser le vif.\r\n\r\nSon Profil\r\nEmilienne AKONGA EDUMBE,\r\nDocteur en philosophie et lettres option langues et littératures des Facultés de Saint Louis de Bruxelles avec une thèse sur l\'écrivain belge Henry Bauchau.\r\nDirectrice Générale de l\'Institut Supérieur Pédagogique de la Gombe à Kinshasa (RDC)\r\nProfesseur des questions spéciales de littératures francophones, de la	Méthodologie Spéciale du Français et de techniques et méthodes de recherche en littérature.\r\n\r\nEn collaboration avec les Archives et Musée de la Littérature (de Bruxelles), elle coordonne en RDC le projet intitulé « Pour la constitution de la mémoire historique de l’Afrique Centrale à partir de la Littérature » dont la première anthologie des Grands lacs est sous presse.\r\n\r\nSon profil de dirigeante caractérisée par l’esprit d’innovation, de la réforme et de créativité en vue de l’intégration de l’Institution au Standard international se lit à travers les projets de développement de l’ISP/Gombe qu’elle a initié pour les 4 années à venir.\r\n\r\nPetite Historique sur l’ISP-GOMBE\r\nL’Institut Supérieur Pédagogique de la Gombe (ISP-GOMBE) est un établissement d’Enseignement Supérieur et Universitaire, installé en pleine Capitale de la RDC dont la création remonte à 1961, fondée par la Sœur Marie de Terwagne de la congrégation des Religieuses du Sacré-Cœur pour l’éducation de la jeune fille Congolaise, sous la dénomination d’Ecole Normale Moyenne (ENM).\r\n\r\nTrois ans après soit en 1963 les premiers finalistes obtinrent leurs diplômes d’agrégation. Au départ cet établissement	fonctionnait dans les bâtiments du Lycée Sacré-Cœur jusqu’en 1972, l’année où, grâce au financement du Fonds Européen de Développement l’actuelle Union Européenne, il a acquis les actuelles installations sises au N°2, Avenue Père BOKA, Commune de la GOMBE, à KINSHASA en RDC. L’ENM avait ouvert ses portes avec une seule section de Régendat qui devint par la suite le Graduat de Français-histoire, et en suite plusieurs autres options telles que l’actuelle Géographie et sciences naturelles, Français-Histoire, et Histoire-Culture Africaine. \r\n\r\nL’option Coupe et Couture a été également ouverte mais au regard de nombre d’étudiantes qui y affluaient, en 1972, elle fut détachée de l’ENM pour créer l’actuel Institut Supérieur des Arts et des Métiers (ISAM) qui est considérait comme la fille ainée de l’ISP-GOMBE. Depuis les années 70 l’ISP-GOMBE formait déjà des enseignants et des hauts cadres du Pays dans les 5 Départements suivants : Français-Linguistique Africaine, Anglais Culture Africaine, Histoire-Sciences Sociales, Géographie Sciences Naturelles et Biologie-Chimie.\r\nVoilà pour la petite histoire.', 'avs_2_act.jpg', NULL, 1, '2024-07-08 09:10:59', 0, 1),
	(11, 'Formation du Personnel Académique, Scientifique et Administratif de l&#039;ISP/GOMBE en prévision de l&#039;arrimage au Système LMD', 'En prévision de l’arrimage au Système LMD : les Membres du Personnel Académique, Scientifique et Administratif de l’ISP/GOMBE outillés en Nouvelles Technologies de l’Information et de la Communication.\r\n\r\nDès la rentrée académique 2019-2020, les filières des Sciences Exactes de l’Institut Supérieur Pédagogique de la Gombe basculeront vers le Système LMD (Licence-Maitrise-Doctorat), point de chute du processus amorcé par le PEQPESU (Projet d’Education pour la Qualité et la Pertinence des Enseignements aux Niveaux Secondaire et Universitaire).\r\nAnnonce faite par la Directrice Générale de l’ISP/GOMBE, Professeure Emilienne AKONGA EDUMBE, à l’occasion de la double cérémonie de Collation des grades académiques et de Clôture de l’année académique 2018-2019 tenue le mercredi 31 juillet 2019 à l’amphithéâtre de cet Etablissement d’Enseignement Supérieur et Universitaire.\r\n\r\nEn prévision de cet arrimage au Système LMD, plusieurs Membres des Corps Académique, Scientifique et Administratif de l’ISP/GOMBE sont outillés en Nouvelles Technologies de l’Information et de la Communication (NTIC), à travers une session de formation dispensée à l’Université Virtuelle Africaine (UVA/ISP-GOMBE).\r\n\r\nDébutée le lundi 12 août 2019, ladite formation est assurée par le Professeur MUNDALA de l’Université de Kinshasa. Ce dernier est assisté par monsieur Yves BIKUNDI, Expert de l’UVA (Université Virtuelle Africaine) et 4 membres du Département de l’Informatique de l’Institut Supérieur Pédagogique de la Gombe.', 'avs_3_act.jpg', NULL, 1, '2024-07-08 09:13:34', 0, 1),
	(12, 'La concrétisation du grand partenariat entre Institut pédagogique de la Gombe et l’Université intercontinentale libre « sup ‘management »', 'a délégation de l’Institut supérieur pédagogique de la Gombe s’est rendue au Maroc sur une invitation de l’Université Intercontinentale Libre « Sup ‘management ». Ceux qui ont pris part en cette conférence sont : la Directrice générale, Le professeur AKONGA EDUMBE Emilienne, le professeur KABATALABIRNKI Félix et Chef des travaux KANKA Jérôme.\r\n\r\nEn effet, la séance de travail a pris trois jours au sein de l’Université intercontinentale Libre « sup ‘management ». Mardi 2 mai ; la première séance on a parlé de la formation initiale de la formation continue et la recherche c\'est-à-dire l’organisation des études, comment adhérer à la conférence internationale. A la deuxième séance, soit mercredi, on a abordé l’amendement1 de la convention de collaboration signée le 06 décembre 2016. Ils ont chuté sur le point de l’organisation globale de leur enseignement, la possibilité d’encadrement à distance, des travaux de fin d’études des étudiants, la possibilité d’abonnement à leur bibliothèque virtuelle et les informations sur leur école doctorale. Et afin, le troisième jour la séance de signature de l avenant1 et nous voyons La Directrice Générale de l’ISP/Gombe a signé l adhésion à la conférence internationale des universités partenaires du Sup ‘Management.\r\nLes deux parties ont décidé de mettre en place un comité de suivi de part et d’autre. L’un Fès à Maroc et l autre à l ISP/Gombe en République Démocratique du Congo.', 'avs_4_act.jpg', NULL, 1, '2024-07-08 09:14:23', 0, 1),
	(13, 'ISP-GOMBE d’Emilienne AKONGA EDUMBE, ETABLISSEMENT PILOTE DES INSTITUTS', 'Du pôle d’excellence, au centre de rayonnement et d’amélioration du système éducatif national, Professeure Emilienne AKONGA EDUMBE poursuit à l’ISP/Gombe la concrétisation d’un programme salutaire au secteur de l’enseignement supérieur et universitaire de la République Démocratique du Congo, conformément à la stratégie sectorielle de l’éducation de la formation 2016-2025 du Gouvernement de la République. Selon cette stratégie, le Gouvernement de la RDC s’est engagé de faire du pays un pool d’excellence d’ici l’horizon 2030. Il revient donc à chaque acteur et responsable du secteur d’assumer sa responsabilité.\r\nNotre livraison précédente a communiqué sa vision et quelques réalisations à son actif au terme de sa seconde année d’un mandat prolifique.\r\nLe rayonnement de l’ISP/Gombe au niveau tant national qu’international, justifié par les projets de développement dans tous les aspects du fonctionnement d’un Etablissement d’enseignement et les commissions permanentes qui accompagnent sa mise en œuvre, continue à susciter l’attention de notre rédaction et de tout celui qui s’intéresse de plus près au développement et la réforme du système éducatif de la RDC.\r\nCap sur le renversement du RATIO d’encadrement scientifique.\r\nL’UNESCO a fixé un seuil de 18 à 20 apprenants à encadrer par un personnel académique. Compte tenu des difficultés d’organisation de la formation du cycle, cette pyramide est toujours renversée.\r\n\r\nDans le cadre de la Stratégie Sectorielle de l’Education et la formation (SSEF), p.13 dans l’axe de l’amélioration de la qualité des apprentissages, en ce qui concerne l’enseignement supérieur et universitaire, le Gouvernement préconise que les « objectifs visés portent sur la promotion de l’Excellence, le renforcement des capacités de pilotage, le recours au partenariat impliquant l’administration centrale, les entités administratives décentralisées, le secteur privé et les partenaires techniques et financiers. L’ouverture au monde et aux technologies modernes et l’adhésion et la participation des bénéficiaires et des acteurs du changement. Ceci se fera par l’amélioration de la gouvernance du sous-secteur [entendez l’Enseignement Supérieur], de la qualité de la formation, d’une meilleure adéquation de l’offre avec les besoins, de la mise au point des plans stratégiques annuels dans les établissements, le recours aux TIC, à l’enseignement ouverts à distance, à la mise en œuvre progressive du système LMD, du renforcement de la recherche, du renforcement des liens, les facultés de sciences de l’éducation, les Instituts Supérieurs Pédagogiques, les Instituts Supérieurs\r\n\r\nPédagogiques Techniques et les Ministères impliqués … ».\r\n\r\nDepuis sa création, l’ISP/Gombe n’a pas accompli sa noble mission de mener des recherches approfondies en pédagogie appliquée afin de proposer des réformes et produire des manuels scolaires adaptés aux réalités du pays et à l’évolution du monde.\r\n', 'avs_5_act.jpg', NULL, 1, '2024-07-08 09:16:21', 0, 1),
	(14, 'EN BEAUTE, L’ISP-GOMBE A RESERVE UNE FIN HEUREUSE A L’ANNEE ACADEMIQUE 2017-2018', 'Après avoir déjoué avec dextérité et de fort belle manière tous les pronostics qui présageaient insurrections et autres soulèvements de tout bord avec susceptibilité d’imposer une éventuelle année blanche, la Professeure Emilienne AKONGA EDUMBE, Directrice Générale de l’Institut Supérieur Pédagogique de la Gombe (ISP-Gombe) et son Comité de Gestion ont clôturé ce mardi 31 juillet 2018 dans une cérémonie haute en couleur de collation des grades académiques, la très agitée année académique susmentionnée.\r\nDans son discours statutaire de clôture de l’année académique, la Directrice Générale de l’ISP-Gombe procède par paliers pour passer en revue l’année académique 2017-2018 et faire des projections pour l’année académique prochaine.\r\n\r\nAu chapitre des félicitations, elle stipule : « Pour tant d’efforts fournis et sacrifices consentis pour non seulement terminer, mais aussi et surtout réussir en 1ère session, les voix des membres du comité de gestion se joignent à la mienne pour dire bravo et Coup de chapeau à ceux qui se sont distingués ;\r\nTous nos encouragements à ceux qui ont encore des épreuves à présenter en septembre.\r\nS’agissant de l’aboutissement heureux de cette année Académique, la Directrice Générale de l’ISP de la Gombe précise, « La réussite de cette année est due : au respect du calendrier académique (ouverture le 15 octobre 2017 et fermeture le 31 juillet 2018); à l’engagement et la détermination du Comité de Gestion pour un travail de qualité et d’excellence; au résultat d’une parfaite collaboration entre autorités académiques, décanales, enseignants, administratifs et collaborateurs ; ainsi qu’à la franche et permanente collaboration au sein de l’établissement ».\r\n', 'avs_6_act.jpg', NULL, 1, '2024-07-08 09:17:49', 0, 1);

-- Listage de la structure de table isp_gombe. activity_bars
CREATE TABLE IF NOT EXISTS `activity_bars` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.activity_bars : ~3 rows (environ)
INSERT INTO `activity_bars` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
	(1, 'Informatique', '#094e2e', '2024-06-03 02:57:22', '2024-06-03 02:57:22'),
	(2, 'Comptable', '#aa1d1d', '2024-06-03 02:57:41', '2024-06-03 02:57:41'),
	(4, 'Assurance', '#fd8b3f', '2024-06-03 02:58:46', '2024-06-03 02:58:46');

-- Listage de la structure de table isp_gombe. admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id_adm` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `niveau` int DEFAULT '7',
  `confirmer` int DEFAULT '0',
  PRIMARY KEY (`id_adm`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table isp_gombe.admin : ~2 rows (environ)
INSERT INTO `admin` (`id_adm`, `pseudo`, `mail`, `password`, `niveau`, `confirmer`) VALUES
	(1, 'Qui-vive', 'qcodeur@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 7, 1),
	(3, 'ANDRE PAUL', 'andrepaul@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 7, 1);

-- Listage de la structure de table isp_gombe. affectcours
CREATE TABLE IF NOT EXISTS `affectcours` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cours` int DEFAULT NULL,
  `promotion` int DEFAULT NULL,
  `prof` int DEFAULT NULL,
  `NombreHeure` int DEFAULT NULL,
  `annee` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.affectcours : ~4 rows (environ)
INSERT INTO `affectcours` (`id`, `cours`, `promotion`, `prof`, `NombreHeure`, `annee`) VALUES
	(6, 9, 3, 2, 45, 2022),
	(7, 11, 3, 1, 45, 2022),
	(8, 6, 3, 1, 30, 2022),
	(10, 25, 1, 1, 30, 2022);

-- Listage de la structure de table isp_gombe. annee
CREATE TABLE IF NOT EXISTS `annee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table isp_gombe.annee : ~10 rows (environ)
INSERT INTO `annee` (`id`, `intitule`) VALUES
	(1, '2022'),
	(2, '2021'),
	(3, '2023'),
	(4, '2024'),
	(5, '2025'),
	(6, '2020'),
	(7, '2019'),
	(8, '2018'),
	(9, '1962-1963'),
	(10, '1980');

-- Listage de la structure de table isp_gombe. annonce
CREATE TABLE IF NOT EXISTS `annonce` (
  `id` int NOT NULL AUTO_INCREMENT,
  `resumer` text,
  `faculte` int DEFAULT NULL,
  `departement` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.annonce : ~3 rows (environ)
INSERT INTO `annonce` (`id`, `resumer`, `faculte`, `departement`) VALUES
	(1, 'Le message d&#039;erreur que vous rencontrez indique que votre application a tenté d&#039;effectuer une requête POST sur https://127.0.0.1:8000/api/login/, mais que le serveur a répondu avec un code d&#039;état 404, ce qui signifie que l&#039;itinéraire spécifié n&#039;a pas été trouvé. Voici quelques étapes pour résoudre ce problème :', 6, NULL),
	(2, 'Consultez les journaux du serveur pour voir s’il existe des erreurs ou des messages pouvant fournir plus de contexte sur la raison pour laquelle l’itinéraire n’a pas été trouvé.\r\n', 6, NULL),
	(4, 'Si votre frontend et votre backend s&#039;exécutent sur des ports ou des domaines différents, assurez-vous que CORS est correctement configuré sur votre backend pour autoriser les requêtes de votre frontend.', NULL, 31);

-- Listage de la structure de table isp_gombe. campus
CREATE TABLE IF NOT EXISTS `campus` (
  `id_act` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(150) DEFAULT NULL,
  `description` text,
  `photo` varchar(50) DEFAULT NULL,
  `categorie` int DEFAULT NULL,
  `id_adm` int DEFAULT NULL,
  `date_pub` datetime DEFAULT NULL,
  `etat_depot` int DEFAULT '0',
  `etat_modifier` int DEFAULT '0',
  PRIMARY KEY (`id_act`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.campus : ~6 rows (environ)
INSERT INTO `campus` (`id_act`, `titre`, `description`, `photo`, `categorie`, `id_adm`, `date_pub`, `etat_depot`, `etat_modifier`) VALUES
	(1, 'Le Président de la République a accueilli son homologue helvétique au Palais de la Nation', 'IMF, COOPEC et autres acteurs ont conféré autour du thème « Accroitre l’impact de la Microfinance par le numérique et les produits innovants ». La 2ème Edition, un témoignage d\'élan vers l’organisation des sessions d’Education Financièr, \r\n\r\nIMF, COOPEC et autres acteurs ont conféré autour du thème « Accroitre l’impact de la Microfinance par le numérique et les produits innovants ». La 2ème Edition, un témoignage d\'élan vers l’organisation des sessions d’Education Financière…\r\n\r\nIMF, COOPEC et autres acteurs ont conféré autour du thème « Accroitre l’impact de la Microfinance par le numérique et les produits innovants ». La 2ème Edition, un témoignage d\'élan vers l’organisation des sessions d’Education Financière…\r\n\r\nIMF, COOPEC et autres acteurs ont conféré autour du thème « Accroitre l’impact de la Microfinance par le numérique et les produits innovants ». La 2ème Edition, un témoignage d\'élan vers l’organisation des sessions d’Education Financière…', 'avs_0_act.jpg', NULL, 1, '2023-09-28 02:46:07', 0, 1),
	(2, 'Afrique Amazing Poems from Shel Silverstein with Valuable Life Lessons', 'Le siège de l’ANIMF est situé à l’Immeuble SOFIDE-Kinshasa-GOMBE (Réf. vers Rond-point des Evolués). Ses points de contacts sont +243 81 213 37 60 | animf.rdcongo@gmail.com | www.animf-rdc.net\r\n\r\nLe siège de l’ANIMF est situé à l’Immeuble SOFIDE-Kinshasa-GOMBE (Réf. vers Rond-point des Evolués). Ses points de contacts sont +243 81 213 37 60 | animf.rdcongo@gmail.com | www.animf-rdc.net\r\n\r\nLe siège de l’ANIMF est situé à l’Immeuble SOFIDE-Kinshasa-GOMBE (Réf. vers Rond-point des Evolués). Ses points de contacts sont +243 81 213 37 60 | animf.rdcongo@gmail.com | www.animf-rdc.net\r\n\r\nLe siège de l’ANIMF est situé à l’Immeuble SOFIDE-Kinshasa-GOMBE (Réf. vers Rond-point des Evolués). Ses points de contacts sont +243 81 213 37 60 | animf.rdcongo@gmail.com | www.animf-rdc.net\r\n\r\nLe siège de l’ANIMF est situé à l’Immeuble SOFIDE-Kinshasa-GOMBE (Réf. vers Rond-point des Evolués). Ses points de contacts sont +243 81 213 37 60 | animf.rdcongo@gmail.com | www.animf-rdc.net', 'avs_1_act.jpg', NULL, 1, '2023-09-28 02:54:55', 0, 1),
	(3, 'XX Le Président de la République a accueilli son homologue helvétique au Palais de la Nation', 'Découvrez les résultats des activités de toutes les IMFs, membres de l\'ANIMF. Il s\'agit d\'un tableau qui présente les statistiques sur leur sensibilisation relative au rôle et à l’importance du secteur de la microfinance en RDC.\r\n\r\nDécouvrez les résultats des activités de toutes les IMFs, membres de l\'ANIMF. Il s\'agit d\'un tableau qui présente les statistiques sur leur sensibilisation relative au rôle et à l’importance du secteur de la microfinance en RDC.\r\n\r\nDécouvrez les résultats des activités de toutes les IMFs, membres de l\'ANIMF. Il s\'agit d\'un tableau qui présente les statistiques sur leur sensibilisation relative au rôle et à l’importance du secteur de la microfinance en RDC.\r\n\r\nDécouvrez les résultats des activités de toutes les IMFs, membres de l\'ANIMF. Il s\'agit d\'un tableau qui présente les statistiques sur leur sensibilisation relative au rôle et à l’importance du secteur de la microfinance en RDC.', 'avs_2_act.jpg', NULL, 1, '2023-09-28 02:55:21', 0, 1),
	(4, 'LES OBJECTIFS POURSUIVIS PAR L’ANIMF-RDC', 'Etre un acteur clé dans l’inclusion financière, l’émergence de la classe moyenne en RDC à travers le financement de MPME micro, petites et moyennes entreprise, pour aboutir à une croissance inclusive et la réduction de la pauvreté.', 'avs_3_act.jpg', NULL, 1, '2023-09-28 02:56:09', 0, 1),
	(5, 'POUR LA RSE: JE PLANTE 1 ARBRE', 'Les Membres de l\'ANIMF, tous mobilisés, ont résolu, de partout où ils ouvrent en RDC, de planter des arbres, à la Journée internationale dédié de l\'ARBRE, pour participer à réduire ce grand fléau qu’est le réchauffement climatique.\r\n\r\nLes Membres de l\'ANIMF, tous mobilisés, ont résolu, de partout où ils ouvrent en RDC, de planter des arbres, à la Journée internationale dédié de l\'ARBRE, pour participer à réduire ce grand fléau qu’est le réchauffement climatique.\r\n\r\nLes Membres de l\'ANIMF, tous mobilisés, ont résolu, de partout où ils ouvrent en RDC, de planter des arbres, à la Journée internationale dédié de l\'ARBRE, pour participer à réduire ce grand fléau qu’est le réchauffement climatique.', 'avs_4_act.jpg', NULL, 1, '2023-09-28 02:56:40', 0, 1),
	(7, 'La coordination nationale de la médecine traditionnelle pool des inspecteurs OPJ/CR, reçoit le feu vert du ministère de la justice et garde des sceaux', 'La CLI Symfony est un outil de développement pour vous aider à créer, exécuter et gérer vos applications Symfony directement depuis votre terminal. Il est Open Source, fonctionne sur macOS, Windows et Linux, et vous ne devez l\'installer qu\'une seule fois sur votre système.\r\n\r\nLa CLI Symfony est un outil de développement pour vous aider à créer, exécuter et gérer vos applications Symfony directement depuis votre terminal. Il est Open Source, fonctionne sur macOS, Windows et Linux, et vous ne devez l\'installer qu\'une seule fois sur votre système.', 'avs_5_act.jpg', NULL, 1, '2024-06-08 13:23:46', 0, 1);

-- Listage de la structure de table isp_gombe. civil_status
CREATE TABLE IF NOT EXISTS `civil_status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.civil_status : ~2 rows (environ)
INSERT INTO `civil_status` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
	(1, 'Célibataire', '#54c9c7', '2024-06-03 01:41:40', '2024-06-03 01:46:31'),
	(2, 'Marié', '#98722f', '2024-06-03 01:45:06', '2024-06-03 01:45:06');

-- Listage de la structure de table isp_gombe. communique
CREATE TABLE IF NOT EXISTS `communique` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) DEFAULT NULL,
  `contenu` text,
  `datepub` datetime DEFAULT NULL,
  `promotion` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table isp_gombe.communique : ~3 rows (environ)
INSERT INTO `communique` (`id`, `titre`, `contenu`, `datepub`, `promotion`) VALUES
	(1, 'Deliberation ', '24-09-2022 15:19: Modification de la cote de l\'étudiant MULUMA ADO ADO. Le jury l\'a attribué une note de 10 pour le cours de (d\') Blockchain', '2022-10-23 06:40:55', 3),
	(2, 'Departement', '24-09-2022 15:19: Modification de la cote de l\'étudiant MULUMA ADO ADO. Le jury l\'a attribué une note de 10 pour le cours de (d\') Blockchain', '2022-10-23 06:40:55', 3),
	(3, 'Faculté', '24-09-2022 15:19: Modification de la cote de l\'étudiant MULUMA ADO ADO. Le jury l\'a attribué une note de 10 pour le cours de (d\') Blockchain', '2022-10-23 06:40:55', 3);

-- Listage de la structure de table isp_gombe. company
CREATE TABLE IF NOT EXISTS `company` (
  `id` int NOT NULL AUTO_INCREMENT,
  `activity_bars_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_4FBF094F21278852` (`activity_bars_id`),
  CONSTRAINT `FK_4FBF094F21278852` FOREIGN KEY (`activity_bars_id`) REFERENCES `activity_bars` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.company : ~2 rows (environ)
INSERT INTO `company` (`id`, `activity_bars_id`, `name`, `color`, `created_at`, `updated_at`) VALUES
	(1, 4, 'SONAS', '#b35151', '2024-06-03 02:59:16', '2024-06-03 02:59:16'),
	(2, 1, 'ENYWORK', '#b81414', '2024-06-03 03:01:53', '2024-06-03 03:02:00');

-- Listage de la structure de table isp_gombe. computer_skills
CREATE TABLE IF NOT EXISTS `computer_skills` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.computer_skills : ~4 rows (environ)
INSERT INTO `computer_skills` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
	(1, 'WORD', '#cac9c9', '2024-06-03 02:33:17', '2024-06-03 02:33:17'),
	(2, 'EXCEL', '#7b5151', '2024-06-03 02:33:35', '2024-06-03 02:33:35'),
	(3, 'WINDOWS', '#cd2323', '2024-06-03 02:33:52', '2024-06-03 02:33:52'),
	(4, 'SPSS', '#161b64', '2024-06-03 02:34:07', '2024-06-03 02:34:07');

-- Listage de la structure de table isp_gombe. com_ter
CREATE TABLE IF NOT EXISTS `com_ter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.com_ter : ~3 rows (environ)
INSERT INTO `com_ter` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
	(1, 'Gombe', '#f6c231', '2024-06-03 01:54:45', '2024-06-03 01:55:47'),
	(2, 'Kinshasa', '#321515', '2024-06-03 01:55:06', '2024-06-03 01:55:06'),
	(3, 'Kintambo', '#db9706', '2024-06-03 01:55:23', '2024-06-03 01:55:23');

-- Listage de la structure de table isp_gombe. cours
CREATE TABLE IF NOT EXISTS `cours` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `maximum` int NOT NULL,
  `ponderation` int NOT NULL,
  `prof` int NOT NULL,
  `code` int NOT NULL,
  `fin` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.cours : ~25 rows (environ)
INSERT INTO `cours` (`id`, `titre`, `maximum`, `ponderation`, `prof`, `code`, `fin`) VALUES
	(1, 'Mathématique financière', 254, 2, 1, 0, 0),
	(2, 'Les prevus', 20, 1, 0, 0, 0),
	(3, 'Les études', 20, 1, 0, 0, 0),
	(4, 'qsdsqd', 20, 1, 0, 0, 0),
	(5, 'qfqfds', 20, 1, 0, 0, 0),
	(6, 'fqsfq', 20, 1, 0, 0, 0),
	(7, 'qsdqs', 20, 1, 0, 0, 0),
	(8, 'sdfsd', 20, 1, 0, 0, 0),
	(9, 'Comptabilité Générale', 20, 1, 0, 0, 1),
	(10, 'Informatique Général', 20, 1, 0, 0, 0),
	(11, 'Blockchain', 20, 1, 0, 0, 1),
	(12, 'ANGLAIS DES AFFAIRES', 20, 1, 0, 0, 0),
	(13, 'Q.A POLITIQUE DE REMUNERATION', 20, 1, 0, 0, 0),
	(14, 'LEGISLATION SOCIALE DU TRAVAIL', 20, 1, 0, 0, 0),
	(15, 'SEMINAIRE SUR LES CONFLITS ET PRATIQUE DE LA NEGOCIATION', 20, 1, 0, 0, 0),
	(16, 'SEMINAIRE DE MARKETING', 20, 1, 0, 0, 0),
	(17, 'Q.A MANAGEMENT DES RESSOURCES HUMAINES ET DEVELOPPEMENT DES COMPETENCE PROFESSIONNELLES', 20, 1, 0, 0, 0),
	(18, 'POLITIQUE D\'ENTREPRISE', 20, 1, 0, 0, 0),
	(19, 'PSYCHOLOGIE DES ORGANISATIONS', 20, 1, 0, 0, 0),
	(20, 'ETHIQUE ET DEONTHOLOGIE EN SCIENCE DE GESTION', 20, 1, 0, 0, 0),
	(21, 'MRS', 20, 1, 0, 0, 0),
	(22, 'PSYCHOPATHO EN MILIEU PROFESSIONNEL', 20, 1, 0, 0, 0),
	(23, 'GEST. PREV. DES EMPLOIS ET COMPETENCES', 20, 1, 0, 0, 0),
	(24, 'Mathématique financière', 254, 2, 1, 0, 0),
	(25, 'Comptabilité Générale', 20, 1, 0, 0, 1);

-- Listage de la structure de table isp_gombe. couverture
CREATE TABLE IF NOT EXISTS `couverture` (
  `id_cv` int NOT NULL AUTO_INCREMENT,
  `photo_cv` varchar(50) DEFAULT NULL,
  `faculte` int DEFAULT NULL,
  `departement` int DEFAULT NULL,
  PRIMARY KEY (`id_cv`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.couverture : ~5 rows (environ)
INSERT INTO `couverture` (`id_cv`, `photo_cv`, `faculte`, `departement`) VALUES
	(7, 'Qcode_0.jpg', 6, NULL),
	(8, 'Qcode_1.jpg', 6, NULL),
	(9, 'Qcode_2.jpg', 6, NULL),
	(10, 'Qcode_3.png', NULL, 31),
	(11, 'Qcode_4.PNG', 7, NULL);

-- Listage de la structure de table isp_gombe. data_sheet
CREATE TABLE IF NOT EXISTS `data_sheet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ide_id` int NOT NULL,
  `nationality_id` int NOT NULL,
  `kind_id` int NOT NULL,
  `civil_status_id` int NOT NULL,
  `province_of_origin_id` int NOT NULL,
  `com_ter_id` int NOT NULL,
  `province_id` int NOT NULL,
  `level_of_education_id` int NOT NULL,
  `types_of_studies_id` int DEFAULT NULL,
  `reason_for_departure_id` int DEFAULT NULL,
  `number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_date` datetime NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `postname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_of_birth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` datetime NOT NULL,
  `number_of_people` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress_or_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_or_venue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quarter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `options` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute_or_university` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starting_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `place_of_study` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_training` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_job` tinyint(1) DEFAULT NULL,
  `last_job_held` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration_of_employment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_of_departure` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_sector` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_search` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `professional_experience` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_s_license` tinyint(1) DEFAULT NULL,
  `salary` int DEFAULT NULL,
  `visited_country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code_unq` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `faculty_or_section` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C9835D7D677335AF` (`ide_id`),
  KEY `IDX_C9835D7D1C9DA55` (`nationality_id`),
  KEY `IDX_C9835D7D30602CA9` (`kind_id`),
  KEY `IDX_C9835D7D96DE64FD` (`civil_status_id`),
  KEY `IDX_C9835D7DE7862705` (`province_of_origin_id`),
  KEY `IDX_C9835D7D5DA4769B` (`com_ter_id`),
  KEY `IDX_C9835D7DE946114A` (`province_id`),
  KEY `IDX_C9835D7D4CE2C845` (`level_of_education_id`),
  KEY `IDX_C9835D7D8BA6B99C` (`types_of_studies_id`),
  KEY `IDX_C9835D7D3871A67` (`reason_for_departure_id`),
  CONSTRAINT `FK_C9835D7D1C9DA55` FOREIGN KEY (`nationality_id`) REFERENCES `nationality` (`id`),
  CONSTRAINT `FK_C9835D7D30602CA9` FOREIGN KEY (`kind_id`) REFERENCES `kind` (`id`),
  CONSTRAINT `FK_C9835D7D3871A67` FOREIGN KEY (`reason_for_departure_id`) REFERENCES `reason_for_departure` (`id`),
  CONSTRAINT `FK_C9835D7D4CE2C845` FOREIGN KEY (`level_of_education_id`) REFERENCES `level_of_education` (`id`),
  CONSTRAINT `FK_C9835D7D5DA4769B` FOREIGN KEY (`com_ter_id`) REFERENCES `com_ter` (`id`),
  CONSTRAINT `FK_C9835D7D677335AF` FOREIGN KEY (`ide_id`) REFERENCES `ide` (`id`),
  CONSTRAINT `FK_C9835D7D8BA6B99C` FOREIGN KEY (`types_of_studies_id`) REFERENCES `types_of_studies` (`id`),
  CONSTRAINT `FK_C9835D7D96DE64FD` FOREIGN KEY (`civil_status_id`) REFERENCES `civil_status` (`id`),
  CONSTRAINT `FK_C9835D7DE7862705` FOREIGN KEY (`province_of_origin_id`) REFERENCES `province` (`id`),
  CONSTRAINT `FK_C9835D7DE946114A` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.data_sheet : ~1 rows (environ)
INSERT INTO `data_sheet` (`id`, `ide_id`, `nationality_id`, `kind_id`, `civil_status_id`, `province_of_origin_id`, `com_ter_id`, `province_id`, `level_of_education_id`, `types_of_studies_id`, `reason_for_departure_id`, `number`, `entry_date`, `code`, `registration_date`, `year`, `month`, `registration_number`, `name`, `postname`, `first_name`, `place_of_birth`, `date_of_birth`, `number_of_people`, `phone_number`, `mail`, `adress_or_number`, `street_or_venue`, `district`, `quarter`, `department`, `options`, `institute_or_university`, `starting_year`, `end_year`, `place_of_study`, `other_training`, `first_job`, `last_job_held`, `duration_of_employment`, `year_of_departure`, `business_sector`, `job_search`, `professional_experience`, `duration`, `driver_s_license`, `salary`, `visited_country`, `status`, `thumbnail`, `code_unq`, `created_at`, `updated_at`, `faculty_or_section`) VALUES
	(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '01', '2024-05-30 10:58:00', '01', '2024-06-22 10:58:00', '2000', 'Avril', '01', 'KASEREKA', 'USHINDI', 'Vicky', 'MUSIENENE', '2024-06-19 10:59:00', '0', '+243979064470', '', '', '', '', '', '', '', '', '0', '0', '', '', 0, '', '', '0', '', '', '', '', 1, 0, '', 0, NULL, 'compte-compte665d9437c7f4e', '2024-06-03 12:00:24', '2024-06-03 12:00:24', '');

-- Listage de la structure de table isp_gombe. data_sheet_computer_skills
CREATE TABLE IF NOT EXISTS `data_sheet_computer_skills` (
  `data_sheet_id` int NOT NULL,
  `computer_skills_id` int NOT NULL,
  PRIMARY KEY (`data_sheet_id`,`computer_skills_id`),
  KEY `IDX_B6747F5141CCCF79` (`data_sheet_id`),
  KEY `IDX_B6747F513AB841F5` (`computer_skills_id`),
  CONSTRAINT `FK_B6747F513AB841F5` FOREIGN KEY (`computer_skills_id`) REFERENCES `computer_skills` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B6747F5141CCCF79` FOREIGN KEY (`data_sheet_id`) REFERENCES `data_sheet` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.data_sheet_computer_skills : ~0 rows (environ)

-- Listage de la structure de table isp_gombe. data_sheet_languages
CREATE TABLE IF NOT EXISTS `data_sheet_languages` (
  `data_sheet_id` int NOT NULL,
  `languages_id` int NOT NULL,
  PRIMARY KEY (`data_sheet_id`,`languages_id`),
  KEY `IDX_E9D6020C41CCCF79` (`data_sheet_id`),
  KEY `IDX_E9D6020C5D237A9A` (`languages_id`),
  CONSTRAINT `FK_E9D6020C41CCCF79` FOREIGN KEY (`data_sheet_id`) REFERENCES `data_sheet` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_E9D6020C5D237A9A` FOREIGN KEY (`languages_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.data_sheet_languages : ~0 rows (environ)

-- Listage de la structure de table isp_gombe. departement
CREATE TABLE IF NOT EXISTS `departement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `faculte` int NOT NULL,
  `resume` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.departement : ~1 rows (environ)
INSERT INTO `departement` (`id`, `titre`, `faculte`, `resume`) VALUES
	(31, 'Français-langues africaines ', 6, 'Chers lecteurs, chers étudiants et étudiantes ! nous sommes heureux de vous savoir nombreux à nous lire .\r\nComme toute Méré , en tant que présidente du comité estudiantine de l&#039; ISP / Gombe , je commence par vous présenter une bienvenu sur notre site web .\r\nOui ! l&#039; ISP / Gombe . c&#039; est notre patrimoine à tous , il a besoin de tous les bras , tous les cerveaux et toutes les volontés de ses filles et fils pour bien préserver ses avoirs envisager l&#039; avenir avec optimisme et bien jouer son rôle de l&#039; institut phare , situé dans la commune institutionnelle de la capitales d&#039; un pays qui se dit le cœur de l&#039; Afrique .\r\nMain dans la main, animée par l&#039;esprit de patriotisme, agissants en digne fils du pays pour le bien être de la jeûnes congolais .\r\nQue vive la RDC notre pays !\r\nQue vive l&#039; ISP / Gombe notre patrimoine');

-- Listage de la structure de table isp_gombe. doctrine_migration_versions
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Listage des données de la table isp_gombe.doctrine_migration_versions : ~2 rows (environ)
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20240602230752', '2024-06-03 01:08:07', 3678),
	('DoctrineMigrations\\Version20240603064159', '2024-06-03 08:42:10', 123);

-- Listage de la structure de table isp_gombe. document
CREATE TABLE IF NOT EXISTS `document` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fichier` varchar(250) DEFAULT NULL,
  `etudiant` int DEFAULT NULL,
  `dat` datetime DEFAULT NULL,
  `promotion` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table isp_gombe.document : ~10 rows (environ)
INSERT INTO `document` (`id`, `fichier`, `etudiant`, `dat`, `promotion`) VALUES
	(19, 'tmp-0.jpg', 1, '2022-10-12 17:50:32', 0),
	(20, 'tmp-1.jpg', 1, '2022-10-12 17:50:48', 0),
	(21, 'tmp-2.jpg', 1, '2022-10-12 17:51:57', 0),
	(22, 'tmp-3.jpg', 1, '2022-10-12 17:52:14', 0),
	(23, 'tmp-4.jpg', 2, '2022-10-12 18:41:28', 0),
	(24, 'tmp-5.jpg', 2, '2022-10-12 18:42:05', 3),
	(25, 'tmp-6.jpg', 2, '2022-10-12 18:42:19', 0),
	(26, 'tmp-7.jpg', 2, '2022-10-13 07:39:45', 0),
	(27, 'tmp-8.jpg', 2, '2022-10-13 07:40:28', 3),
	(28, 'tmp-9.jpg', 3, '2022-10-23 11:52:36', 0);

-- Listage de la structure de table isp_gombe. etudiant
CREATE TABLE IF NOT EXISTS `etudiant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `matricule` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `postnom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `lieuNaiss` varchar(255) NOT NULL,
  `dateNaiss` varchar(255) NOT NULL,
  `sexe` varchar(255) NOT NULL,
  `etatCivil` varchar(255) NOT NULL,
  `nationalite` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `photo` text NOT NULL,
  `nomDuPere` varchar(255) NOT NULL,
  `nomDeLaMere` varchar(255) NOT NULL,
  `province` int NOT NULL DEFAULT '0',
  `district` int NOT NULL DEFAULT '0',
  `territoire` int NOT NULL DEFAULT '0',
  `adresseDuCandidat` text NOT NULL,
  `personnePrevenir` varchar(50) NOT NULL DEFAULT '',
  `telephonePersonnePrevenir` varchar(50) NOT NULL DEFAULT '',
  `nomDeEcoleDeFreq` varchar(255) NOT NULL DEFAULT '',
  `adresseDeEcoleProvince` text NOT NULL,
  `sectionSuiviAuxHum` varchar(50) NOT NULL DEFAULT '0',
  `nomDuCentreDeExetat` varchar(255) NOT NULL DEFAULT '',
  `anneeObtentionDuDiplome` varchar(255) NOT NULL DEFAULT '',
  `pourcentageDuDiplome` int NOT NULL DEFAULT '0',
  `numeroDuDiplomeEtat` int NOT NULL DEFAULT '0',
  `activiteProfessionelles` varchar(255) NOT NULL DEFAULT '0',
  `etudesPostSecondaireEntreprise` varchar(255) NOT NULL DEFAULT '0',
  `promotion` int NOT NULL,
  `facChoix1` int NOT NULL,
  `depChoix1` int NOT NULL,
  `facChoix2` int NOT NULL,
  `depChoix2` int NOT NULL,
  `cycle` varchar(50) NOT NULL DEFAULT '',
  `diplomeAttest` text NOT NULL,
  `certificat` text NOT NULL,
  `bulletin` text NOT NULL,
  `carteIdentite` text NOT NULL,
  `attestNaissance` text NOT NULL,
  `mdp` text NOT NULL,
  `defaut` int DEFAULT NULL,
  `date_inscrit` date DEFAULT NULL,
  `qrcode` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `etat` int NOT NULL DEFAULT '0',
  `cp` int NOT NULL DEFAULT '0',
  `departement` int NOT NULL DEFAULT '0',
  `faculte` int NOT NULL DEFAULT '0',
  `optioner` int NOT NULL DEFAULT '0',
  `confirmer` int NOT NULL DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.etudiant : ~17 rows (environ)
INSERT INTO `etudiant` (`id`, `matricule`, `nom`, `postnom`, `prenom`, `lieuNaiss`, `dateNaiss`, `sexe`, `etatCivil`, `nationalite`, `telephone`, `photo`, `nomDuPere`, `nomDeLaMere`, `province`, `district`, `territoire`, `adresseDuCandidat`, `personnePrevenir`, `telephonePersonnePrevenir`, `nomDeEcoleDeFreq`, `adresseDeEcoleProvince`, `sectionSuiviAuxHum`, `nomDuCentreDeExetat`, `anneeObtentionDuDiplome`, `pourcentageDuDiplome`, `numeroDuDiplomeEtat`, `activiteProfessionelles`, `etudesPostSecondaireEntreprise`, `promotion`, `facChoix1`, `depChoix1`, `facChoix2`, `depChoix2`, `cycle`, `diplomeAttest`, `certificat`, `bulletin`, `carteIdentite`, `attestNaissance`, `mdp`, `defaut`, `date_inscrit`, `qrcode`, `type`, `etat`, `cp`, `departement`, `faculte`, `optioner`, `confirmer`, `email`) VALUES
	(1, '62324', 'KUSAKANA', 'SALA', 'QUI-VIVE', 'KIN', '2022-10-05', 'Masculin', 'Célibataire', 'Congolaise', '243816340682', 'Profil_0.jpg', 'THEOPHIL', 'WENGE', 2, 72, 10, 'lemba', 'XAVIER', '081634048834', 'TERRE', 'KIN', 'BICHIMIE', 'KK', '2022', 67, 45665, 'Enseignant', 'UON', 1, 1, 1, 3, 3, 'GRADUAT', '0_Diplome.pdf', '0_Certificat.jpg', '0_Bulletin.jpg', '0_CarteIdentite.pdf', '0_Attestation.jpg', '46d3c0e64e2ef0dd190d36b593eaf6bafd82c36a', 1234, '2022-10-05', 'images', 'LMD', 0, 1, 0, 0, 0, 1, NULL),
	(2, '475369', 'MUKISI', 'MFUKU', 'FILS', 'KIN', '2022-10-19', 'Masculin', 'Célibataire', 'Congolaise', '243828856089', 'Profil_1.jpg', 'MUKISI', 'RUTH', 2, 88, 14, 'BUMBU', 'XAVIER', '081634048834', 'TERRE', 'KIN', 'BICHIMIE', 'KK', '2022', 78, 3445555, 'Enseignant', 'UON', 3, 3, 3, 1, 1, 'GRADUAT', '1_Diplome.pdf', '1_Certificat.pdf', '1_Bulletin.jpg', '1_CarteIdentite.jpg', '1_Attestation.jpg', '46d3c0e64e2ef0dd190d36b593eaf6bafd82c36a', 1234, '2022-10-05', 'images', 'LMD', 0, 0, 0, 0, 0, 1, NULL),
	(3, '533432', 'KWETE', 'KIVUVU', 'EDEN', 'KINSHASA', '2022-10-07', 'Masculin', 'Célibataire', 'Congolaise', '243816340682', 'Profil_2.jpg', 'MUKISI', 'RUTH', 2, 73, 10, 'MPASA', 'MM', '081634048834', 'TERRE', 'KIN', 'BICHIMIE', 'KK', '2022', 68, 85858, 'Enseignant', 'UON', 3, 3, 3, 1, 1, 'GRADUAT', '2_Diplome.pdf', '2_Certificat.pdf', '2_Bulletin.pdf', '2_CarteIdentite.jpg', '2_Attestation.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234, '2022-10-07', 'images', 'LMD', 0, 1, 0, 0, 0, 1, NULL),
	(5, '275040', 'KUSAKANA', 'MFUKU', 'FILS', 'KIN', '2022-10-09', 'Masculin', 'Célibataire', 'Congolaise', '243816340682', 'Profil_3.jpg', 'THEOPHIL', 'WENGE', 4, 103, 18, 'DD', 'XAVIER', '081634048834', 'TERRE', 'KIN', 'BICHIMIE', 'KK', '2022', 60, 6768, 'Enseignant', 'UON', 1, 1, 1, 3, 3, 'GRADUAT', '3_Diplome.jpg', '3_Certificat.jpg', '3_Bulletin.jpg', '3_CarteIdentite.jpg', '3_Attestation.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234, '2022-10-09', '.png', 'LMD', 0, 0, 0, 0, 0, 0, NULL),
	(9, 'SFK01207-2022', 'SALA', 'KIVUVU', 'FILS', 'KIN', '2022-10-09', 'Masculin', 'Célibataire', 'Congolaise', '243816340682', 'Profil_4.jpg', 'THEOPHIL', 'WENGE', 4, 107, 19, 'SZ', 'XAVIER', '081634048834', 'TERRE', 'KIN', 'BICHIMIE', 'KK', '2022', 78, 6789, 'Enseignant', 'UON', 1, 1, 1, 3, 3, 'GRADUAT', '4_Diplome.jpg', '4_Certificat.jpg', '4_Bulletin.jpg', '4_CarteIdentite.jpg', '4_Attestation.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234, '2022-10-09', '.png', 'LMD', 0, 0, 0, 0, 0, 0, NULL),
	(10, 'KAK01766-2022', 'KINZANZA', 'KIVUVU', 'ADEL', 'KIN', '2022-10-28', 'Féminin', 'Célibataire', 'Congolaise', '243816340682', 'Profil_5.jpg', 'THEOPHIL', 'WENGE', 4, 99, 17, 'LEMBA', 'XAVIER', '081634048834', 'TERRE', 'KIN', 'BICHIMIE', 'KK', '2022', 78, 456, 'Enseignant', 'UON', 1, 1, 1, 3, 3, 'GRADUAT', '5_Diplome.jpg', '5_Certificat.jpg', '5_Bulletin.jpg', '5_CarteIdentite.jpg', '5_Attestation.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234, '2022-10-09', '.png', 'LMD', 0, 0, 0, 0, 0, 0, NULL),
	(11, 'NSN01895-2022', 'NAMUISI', 'NDALA', 'SALA', 'KIN', '2022-10-20', 'Masculin', 'Célibataire', 'Congolaise', '243816340682', 'Profil_6.jpg', 'KUSAKANA', 'SALA', 1, 2, 1, 'KKF', 'QUI-VIVE SALA KUSAKANA', '081634048834', 'FF', 'KIN', 'BICHIMIE', 'GR', '2022', 76, 69095, 'Enseignant', 'UON', 1, 1, 1, 3, 3, 'GRADUAT', '6_Diplome.pdf', '6_Certificat.pdf', '6_Bulletin.pdf', '6_CarteIdentite.pdf', '6_Attestation.pdf', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234, '2022-10-09', '.png', 'LMD', 0, 0, 0, 0, 0, 0, NULL),
	(12, 'KTM01998-2022', 'KIBAU', 'MFUKU', 'THADDEE', 'ML', '2022-10-20', 'Masculin', 'Célibataire', 'Congolaise', '243898059698', 'Profil_7.jpg', 'QUI-VIVE SALA KUSAKANA', 'QUI-VIVE SALA KUSAKANA', 2, 67, 9, 'MLL', 'MK', '081634048834', 'HJ', 'OML', 'BICHIMIE', 'LKJ', '2022', 87, 988, 'Enseignant', 'UON', 1, 1, 1, 3, 3, 'GRADUAT', '7_Diplome.pdf', '7_Certificat.pdf', '7_Bulletin.pdf', '7_CarteIdentite.pdf', '7_Attestation.pdf', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234, '2022-10-09', '.png', 'LMD', 0, 0, 0, 0, 0, 1, NULL),
	(13, 'KQS01958-2022', 'KUSAKANA', 'SALA', 'QUI-VIVE', 'sk', '2022-10-09', 'Masculin', 'Célibataire', 'Congolaise', '243816340682', 'Profil_8.jpg', 'SALA KUSAKANA', 'KUSAKANA', 1, 3, 1, 'sq', 'QUI-VIVE SALA KUSAKANA', '081634048834', 'ksdk', 'KIN', 'BICHIMIE', 'QUI-VIVE SALA KUSAKANA', '2022', 34, 3444, 'Enseignant', 'UON', 1, 1, 1, 3, 3, 'GRADUAT', '8_Diplome.pdf', '8_Certificat.pdf', '8_Bulletin.pdf', '8_CarteIdentite.pdf', '8_Attestation.pdf', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234, '2022-10-09', '.png', 'LMD', 0, 0, 0, 0, 0, 1, NULL),
	(14, 'KHK01410-2022', 'KALAVANDA', 'KALAV', 'HERVE', 'KIN', '2022-10-10', 'Masculin', 'Célibataire', 'Congolaise', '243816340682', 'Profil_9.jpg', 'SALA KUSAKANA', 'ANA', 2, 68, 9, 'KD', 'KUSAKANA', '081634048834', 'QUDA', 'KIN', 'BICHIMIE', 'LS', '2022', 70, 894309, 'Enseignant', 'UON', 1, 1, 1, 3, 3, 'GRADUAT', '9_Diplome.pdf', '9_Certificat.pdf', '9_Bulletin.pdf', '9_CarteIdentite.pdf', '9_Attestation.pdf', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234, '2022-10-10', '.png', 'LMD', 0, 1, 0, 0, 0, 0, NULL),
	(18, 'QQM01601-2022', 'QRCODE', 'MFUKU', 'QUI-VIVE', 'KIN', '2022-10-10', 'Masculin', 'Célibataire', 'Congolaise', '243816340682', 'Profil_10.jpg', 'OPQ', 'SDC', 4, 97, 16, 'E', 'DL', '081634048834', 'SX', 'KIN', 'BICHIMIE', 'XD', '2022', 65, 76542, 'Enseignant', 'UON', 1, 1, 1, 3, 3, 'GRADUAT', '10_Diplome.pdf', '10_Certificat.pdf', '10_Bulletin.pdf', '10_CarteIdentite.pdf', '10_Attestation.pdf', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234, '2022-10-10', '10.png', 'LMD', 0, 0, 0, 0, 0, 0, NULL),
	(19, 'KQM01981-2022', 'KUSAKANA', 'MFUKU', 'QUI-VIVE', 'KIN', '2022-10-21', 'Masculin', 'Célibataire', 'Congolaise', '243816340682', 'Profil_11.jpg', 'KUS', 'WENGE', 2, 68, 9, 'KIN', 'XAVIER', '081634048834', 'DP', 'KIN', 'BICHIMIE', 'KD', '2022', 56, 3456, 'Enseignant', 'UON', 1, 1, 1, 3, 3, 'GRADUAT', '11_Diplome.pdf', '11_Certificat.pdf', '11_Bulletin.jpg', '11_CarteIdentite.pdf', '11_Attestation.pdf', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234, '2022-10-12', '11.png', 'LMD', 0, 0, 0, 0, 0, 0, NULL),
	(20, 'KQS01983-2022', 'KUSAKANA', 'SALA', 'QUI-VIVE', 'KIN', '2022-10-12', 'Masculin', 'Célibataire', 'Congolaise', '243816340682', 'Profil_12.jpg', 'KUSAKANA', 'WENGE', 3, 143, 25, 'KIN', 'ldl', '081634048834', 'op', 'KD', 'BICHIMIE', 'CK', '2022', 98, 534, 'Enseignant', 'UON', 1, 1, 1, 3, 3, 'GRADUAT', '12_Diplome.pdf', '12_Certificat.pdf', '12_Bulletin.pdf', '12_CarteIdentite.pdf', '12_Attestation.pdf', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234, '2022-10-12', '12.png', 'LMD', 0, 0, 0, 0, 0, 0, NULL),
	(21, 'KBB01773-2022', 'KUSAKANA', 'BISEWU', 'BYBY', 'KIN', '2022-10-14', 'Féminin', 'Célibataire', 'Congolaise', '243816340682', 'Profil_13.jpg', 'KUS', 'W', 2, 67, 9, 'LEMBA', 'XAVIER', '081634048834', 'JR', 'KIN', 'BICHIMIE', 'HD', '2022', 67, 479, 'Enseignant', 'UON', 1, 1, 1, 3, 3, 'GRADUAT', '13_Diplome.jpg', '13_Certificat.jpg', '13_Bulletin.jpg', '13_CarteIdentite.jpg', '13_Attestation.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234, '2022-10-14', '13.png', 'LMD', 0, 0, 0, 0, 0, 0, NULL),
	(22, 'AHH01146-2022', 'ARMEL', 'HASH', 'HERVE', 'KIN', '2022-10-11', 'Masculin', 'Célibataire', 'Congolaise', '243851017539', 'Profil_14.jpg', 'QJw', 'ksx', 4, 94, 16, 'KIN', 'sxkl', '081634048834', 'usduy', 'iiud', 'BICHIMIE', 'uaui', '2022', 67, 856896589, 'Enseignant', 'UON', 1, 1, 1, 3, 3, 'GRADUAT', '14_Diplome.jpg', '14_Certificat.jpg', '14_Bulletin.jpg', '14_CarteIdentite.jpg', '14_Attestation.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234, '2022-10-14', '14.png', 'LMD', 0, 0, 0, 0, 0, 0, NULL),
	(23, 'MAH01448-2022', 'MBENZA', 'HASH', 'ARMEL', 'KIN', '2022-10-14', 'Masculin', 'Célibataire', 'Congolaise', '243851017539', 'Profil_15.jpg', 'QUI-VIVE SALA KUSAKANA', 'QUI-VIVE SALA KUSAKANA', 4, 104, 18, 'KIN', 'QUI-VIVE SALA KUSAKANA', '081634048834', 'QUI-VIVE SALA KUSAKANA', 'KIN', 'BICHIMIE', 'QUI-VIVE SALA KUSAKANA', '2022', 67, 9584, 'Enseignant', 'UON', 1, 1, 1, 3, 3, 'GRADUAT', '15_Diplome.jpg', '15_Certificat.jpg', '15_Bulletin.jpg', '15_CarteIdentite.jpg', '15_Attestation.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234, '2022-10-14', '15.png', 'LMD', 0, 0, 0, 0, 0, 0, NULL),
	(24, 'kdu01303-2024', 'kie', 'udud', 'du', 'kin', '2024-06-21', 'Masculin', 'Marié(e)', 'Congolaise', '243976691596', 'Profil_16.jpg', 'kus', 'wenge', 4, 100, 17, 'kinshasa', 'fore', '0816340682', 'DED', 'Kinshasa', 'PEDA', 'Q-solutions', '2017', 56, 97574, 'ERR', 'KIT', 1, 1, 1, 3, 3, 'LICENCE', '16_Diplome.pdf', '16_Certificat.JPG', '16_Bulletin.jpg', '16_CarteIdentite.jpg', '16_Attestation.jpg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1234, '2024-06-04', '16.png', 'LMD', 0, 0, 0, 0, 0, 0, NULL);

-- Listage de la structure de table isp_gombe. faculte
CREATE TABLE IF NOT EXISTS `faculte` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `resume` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.faculte : ~4 rows (environ)
INSERT INTO `faculte` (`id`, `titre`, `resume`) VALUES
	(6, 'LETTRES ET SCIENCES HUMAINES', 'Les finalistes de la Faculté des Lettres et Sciences Humaines peuvent travailler au vu des compétences développées dans plusieurs secteurs: L’enseignement.'),
	(7, 'SCIENCES EXACTES', 'Ce cursus en quatre ans vise à transmettre au candidat un enseignement de qualité et pluridisciplinaire axé notamment sur l’acquisition de la physique, de la chimie et des mathématiques.'),
	(8, 'SCIENCES COMMERCIALES ET INFORMATIQUE', 'Le commercial informatique analyse et comprend les problèmes ou les besoins des clients et leur propose une solution informatique adaptée à leur demande.'),
	(9, 'SCIENCES ET TECHNIQUES D’ACCUEIL', 'Nous offrons des connaissances fondamentales sur les sciences de gestions, du management hôtelier aux étudiants');

-- Listage de la structure de table isp_gombe. horaire
CREATE TABLE IF NOT EXISTS `horaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jour` int DEFAULT NULL,
  `prof` int DEFAULT NULL,
  `affectcours` int DEFAULT NULL,
  `matin` int DEFAULT NULL,
  `midi` int DEFAULT NULL,
  `soir` int DEFAULT NULL,
  `annee` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table isp_gombe.horaire : ~2 rows (environ)
INSERT INTO `horaire` (`id`, `jour`, `prof`, `affectcours`, `matin`, `midi`, `soir`, `annee`) VALUES
	(1, 1, 2, 6, 1, 0, 0, 2022),
	(5, 5, 1, 8, 0, 0, 1, 2022);

-- Listage de la structure de table isp_gombe. ide
CREATE TABLE IF NOT EXISTS `ide` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.ide : ~2 rows (environ)
INSERT INTO `ide` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
	(1, 'IDE1', '#b78a8a', '2024-06-03 01:33:44', '2024-06-03 01:34:46'),
	(2, 'IDE2', '#501b1b', '2024-06-03 01:34:03', '2024-06-03 01:34:03');

-- Listage de la structure de table isp_gombe. jour
CREATE TABLE IF NOT EXISTS `jour` (
  `id` int NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table isp_gombe.jour : ~6 rows (environ)
INSERT INTO `jour` (`id`, `intitule`) VALUES
	(1, 'LUNDI'),
	(2, 'MARDI'),
	(3, 'MERCREDI'),
	(4, 'JEUDI'),
	(5, 'VENDREDI'),
	(6, 'SAMEDI');

-- Listage de la structure de table isp_gombe. kind
CREATE TABLE IF NOT EXISTS `kind` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.kind : ~2 rows (environ)
INSERT INTO `kind` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
	(1, 'Masculin', '#67cb43', '2024-06-03 01:51:27', '2024-06-03 01:51:27'),
	(2, 'Féminin', '#36c0d9', '2024-06-03 01:51:50', '2024-06-03 01:51:50');

-- Listage de la structure de table isp_gombe. languages
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.languages : ~2 rows (environ)
INSERT INTO `languages` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
	(1, 'Francais', '#001870', '2024-06-03 02:31:36', '2024-06-03 02:31:36'),
	(2, 'Anglais', '#1b8188', '2024-06-03 02:31:55', '2024-06-03 02:31:55');

-- Listage de la structure de table isp_gombe. level_of_education
CREATE TABLE IF NOT EXISTS `level_of_education` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.level_of_education : ~3 rows (environ)
INSERT INTO `level_of_education` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
	(1, 'Primaire', '#7376ce', '2024-06-03 01:59:03', '2024-06-03 01:59:03'),
	(2, 'Sécondaire', '#350303', '2024-06-03 02:02:53', '2024-06-03 02:02:53'),
	(3, 'Universitaire', '#657667', '2024-06-03 02:03:16', '2024-06-03 02:03:16');

-- Listage de la structure de table isp_gombe. membre
CREATE TABLE IF NOT EXISTS `membre` (
  `id_mbr` int NOT NULL AUTO_INCREMENT,
  `noms_mbr` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo_mbr` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `desc_mbr` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `valider` int DEFAULT '0',
  PRIMARY KEY (`id_mbr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.membre : ~0 rows (environ)

-- Listage de la structure de table isp_gombe. messenger_messages
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.messenger_messages : ~0 rows (environ)

-- Listage de la structure de table isp_gombe. nationality
CREATE TABLE IF NOT EXISTS `nationality` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.nationality : ~1 rows (environ)
INSERT INTO `nationality` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
	(1, 'Congolaise', '#f62c2c', '2024-06-03 01:47:19', '2024-06-03 01:47:19');

-- Listage de la structure de table isp_gombe. niveau
CREATE TABLE IF NOT EXISTS `niveau` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.niveau : ~4 rows (environ)
INSERT INTO `niveau` (`id`, `titre`) VALUES
	(1, 'GRADUAT'),
	(2, 'LICENCIE'),
	(3, 'MASTER'),
	(4, 'DOCTORAT');

-- Listage de la structure de table isp_gombe. optioner
CREATE TABLE IF NOT EXISTS `optioner` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `departement` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.optioner : ~1 rows (environ)
INSERT INTO `optioner` (`id`, `titre`, `departement`) VALUES
	(1, 'INFORMATIQUE DE GESTION', 1);

-- Listage de la structure de table isp_gombe. palmaresetudiant
CREATE TABLE IF NOT EXISTS `palmaresetudiant` (
  `id_pe` int NOT NULL AUTO_INCREMENT,
  `noms` varchar(50) DEFAULT NULL,
  `anne` varchar(50) DEFAULT NULL,
  `session` int NOT NULL,
  `departement` int NOT NULL,
  `niveau` int NOT NULL,
  PRIMARY KEY (`id_pe`),
  KEY `FK_palmaresetudiant_sessions` (`session`),
  KEY `FK_palmaresetudiant_departement` (`departement`),
  CONSTRAINT `FK_palmaresetudiant_departement` FOREIGN KEY (`departement`) REFERENCES `departement` (`id`),
  CONSTRAINT `FK_palmaresetudiant_sessions` FOREIGN KEY (`session`) REFERENCES `sessions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.palmaresetudiant : ~4 rows (environ)
INSERT INTO `palmaresetudiant` (`id_pe`, `noms`, `anne`, `session`, `departement`, `niveau`) VALUES
	(1, 'KUSAKANA SALA', '2020', 2, 31, 1),
	(2, 'MUKISI FILS', '2020', 1, 31, 1),
	(3, 'NGEMBA', '2022', 1, 31, 1),
	(4, 'CHARLIER Renée, ép. BIERLAIRE', '1962-1963', 1, 31, 1);

-- Listage de la structure de table isp_gombe. personnel
CREATE TABLE IF NOT EXISTS `personnel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `noms` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telephone` varchar(25) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `fonction` varchar(100) NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `faculte` int NOT NULL DEFAULT '0',
  `departement` int NOT NULL DEFAULT '0',
  `valider` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.personnel : ~3 rows (environ)
INSERT INTO `personnel` (`id`, `noms`, `telephone`, `mail`, `fonction`, `photo`, `faculte`, `departement`, `valider`) VALUES
	(7, 'MUKISI FILS', '243816340682', 'fils@gmail.com', '01', 'MUKISI FILS_3.jpg', 0, 31, 0),
	(8, 'KUSAKANA SALA', '0816340682', 'qcodeur@gmail.com', 'CHEF DE LA SECTION', 'KUSAKANA SALA_1.jpg', 6, 0, 0),
	(9, 'FILS MUKISI', '0816340683', 'fils@gmail.com', 'CHEF DE LA SECTION', 'FILS MUKISI_2.jpg', 6, 0, 0);

-- Listage de la structure de table isp_gombe. prestation
CREATE TABLE IF NOT EXISTS `prestation` (
  `id_pres` int NOT NULL AUTO_INCREMENT,
  `dateDeSeance` date DEFAULT NULL,
  `matiere` varchar(50) DEFAULT NULL,
  `heure` int DEFAULT NULL,
  `prof` int DEFAULT NULL,
  `etudiant` int DEFAULT NULL,
  `cours` int DEFAULT NULL,
  `promotion` int DEFAULT NULL,
  `heureDbt` time DEFAULT NULL,
  `heureFin` time DEFAULT NULL,
  `DateCloture` date DEFAULT NULL,
  `annee` int DEFAULT NULL,
  PRIMARY KEY (`id_pres`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table isp_gombe.prestation : ~15 rows (environ)
INSERT INTO `prestation` (`id_pres`, `dateDeSeance`, `matiere`, `heure`, `prof`, `etudiant`, `cours`, `promotion`, `heureDbt`, `heureFin`, `DateCloture`, `annee`) VALUES
	(2, '2022-10-10', 'INTRODUCTION', 11, 2, 1, 9, 1, '08:43:00', '19:43:00', '2022-10-23', 2022),
	(3, '2022-10-12', 'CHAPITRE 1', 8, 2, 3, 9, 3, '08:41:00', '16:41:00', '2022-10-23', 2022),
	(4, '2022-10-12', 'INTRODUCTION', 10, 1, 3, 11, 3, '07:42:00', '17:43:00', '2022-10-23', 2022),
	(6, '2022-10-12', 'CHAPITRE 2', 9, 2, 3, 9, 3, '08:45:00', '17:45:00', '2022-10-23', 2022),
	(7, '2022-10-12', 'CHAPITRE 3', 11, 2, 3, 9, 3, '07:46:00', '18:46:00', '2022-10-23', 2022),
	(8, '2022-10-12', 'CHAPITRE 4', 4, 2, 3, 9, 3, '08:46:00', '12:46:00', '2022-10-23', 2022),
	(9, '2022-10-12', 'CHAPITRE 5', 8, 2, 3, 9, 3, '07:47:00', '16:45:00', '2022-10-23', 2022),
	(10, '2022-10-12', 'CHAPITRE 1', 15, 1, 3, 11, 3, '06:06:00', '21:06:00', '2022-10-23', 2022),
	(11, '2022-10-12', 'CHAPITRE 2', 11, 1, 3, 11, 3, '12:07:00', '23:07:00', '2022-10-23', 2022),
	(12, '2022-10-12', 'CHAPITRE 3', 12, 1, 3, 11, 3, '06:07:00', '18:07:00', '2022-10-23', 2022),
	(13, '2022-10-12', 'INTRODUCTION', 9, 1, 3, 6, 3, '08:13:00', '17:13:00', NULL, 2022),
	(14, '2022-10-12', 'INTRODUCTION', 9, 1, 1, 25, 1, '08:27:00', '17:27:00', '2022-10-23', NULL),
	(15, '2022-10-12', 'INTRODUCTION', 9, 1, 1, 25, 1, '08:27:00', '17:27:00', '2022-10-23', 2022),
	(16, '2022-10-12', 'CHAPITRE 1', 6, 1, 1, 25, 1, '07:38:00', '13:38:00', '2022-10-23', 2022),
	(17, '2022-10-12', 'CHAPITRE 1', 6, 1, 1, 25, 1, '07:38:00', '13:38:00', '2022-10-23', 2022);

-- Listage de la structure de table isp_gombe. prof
CREATE TABLE IF NOT EXISTS `prof` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `postnom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `mdp` text NOT NULL,
  `list_faculte` varchar(255) NOT NULL,
  `list_departement` varchar(255) NOT NULL,
  `faculte` int NOT NULL,
  `departement` int NOT NULL,
  `optioner` int NOT NULL,
  `promotion` int NOT NULL,
  `etudiant` int NOT NULL,
  `cours` int NOT NULL,
  `prof` int NOT NULL,
  `lmd` int NOT NULL,
  `list_lmd` varchar(255) NOT NULL,
  `delibe` int NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `fonction` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.prof : ~4 rows (environ)
INSERT INTO `prof` (`id`, `nom`, `postnom`, `prenom`, `telephone`, `mdp`, `list_faculte`, `list_departement`, `faculte`, `departement`, `optioner`, `promotion`, `etudiant`, `cours`, `prof`, `lmd`, `list_lmd`, `delibe`, `adresse`, `fonction`, `grade`, `email`) VALUES
	(1, 'KABUIKA', 'KASONGO', 'SAM', '243810325246', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1', '1', 1, 1, 1, 1, 1, 1, 1, 1, '1', 1, '', '', 'Professeur', ''),
	(2, 'MAYALA', 'LEMBA', 'FRANCIS', '243990715553', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2', '2', 1, 1, 0, 1, 0, 0, 0, 0, '', 1, '', '', 'Chef des travaux', ''),
	(3, 'KUIKALA', 'MOLUMNO', 'Roger', '243895645521', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', 'Professeur ordinaire', ''),
	(4, 'KABUIKA', 'KASONGO', 'caillou', '24387545215212', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', 'Assistant', '');

-- Listage de la structure de table isp_gombe. promotion
CREATE TABLE IF NOT EXISTS `promotion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `optioner` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.promotion : ~5 rows (environ)
INSERT INTO `promotion` (`id`, `titre`, `optioner`) VALUES
	(3, 'G1', 3),
	(4, 'G2', 3),
	(5, 'G3', 3),
	(6, 'L1', 3),
	(8, 'L3', 1);

-- Listage de la structure de table isp_gombe. province
CREATE TABLE IF NOT EXISTS `province` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.province : ~5 rows (environ)
INSERT INTO `province` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
	(1, 'Bas-Uélé', '#d99696', '2024-06-03 01:48:50', '2024-06-03 01:48:50'),
	(2, 'Haut-Uélé', '#ca2121', '2024-06-03 01:49:05', '2024-06-03 01:49:05'),
	(3, 'Ituri', '#402626', '2024-06-03 01:49:21', '2024-06-03 01:49:21'),
	(4, 'Tshopo', '#810909', '2024-06-03 01:49:37', '2024-06-03 01:49:37'),
	(5, 'Mongala', '#783f5e', '2024-06-03 01:49:52', '2024-06-03 01:49:52');

-- Listage de la structure de table isp_gombe. provinces
CREATE TABLE IF NOT EXISTS `provinces` (
  `id_p` int NOT NULL AUTO_INCREMENT,
  `nom_p` varchar(50) DEFAULT NULL,
  `lettre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_p`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table isp_gombe.provinces : ~26 rows (environ)
INSERT INTO `provinces` (`id_p`, `nom_p`, `lettre`) VALUES
	(1, 'Bas-Uele', 'A'),
	(2, 'Equateur ', 'B'),
	(3, 'Haut-Lomami ', 'C'),
	(4, 'Haut-Katanga ', 'D'),
	(5, 'Kinshasa', 'J'),
	(6, 'Haut-Uele', 'E'),
	(7, 'Ituri ', 'F'),
	(8, 'Kasai', 'G'),
	(9, 'Kasai Central ', 'H'),
	(10, 'Kasai Oriental ', 'I'),
	(11, 'Kongo Central', 'K'),
	(12, 'Kwango', 'L'),
	(13, 'Kwilu', 'M'),
	(14, 'Lomami ', 'N'),
	(15, 'Lualaba ', 'O'),
	(16, 'Mai-Ndombe ', 'P'),
	(17, 'Maniema ', 'Q'),
	(18, 'Mongala ', 'R'),
	(19, 'Nord-Kivu ', 'S'),
	(20, 'Nord- Ubangi ', 'T'),
	(21, 'Sankuru', 'U'),
	(22, 'Sud-Kivu ', 'V'),
	(23, 'Sud-Ubangi ', 'W'),
	(24, 'Tanganyika ', 'X'),
	(25, 'Tshopo ', 'Y'),
	(26, 'Tshuapa ', 'Z');

-- Listage de la structure de table isp_gombe. reason_for_departure
CREATE TABLE IF NOT EXISTS `reason_for_departure` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.reason_for_departure : ~2 rows (environ)
INSERT INTO `reason_for_departure` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
	(1, 'Fin de contrat', '#701515', '2024-06-03 02:24:27', '2024-06-03 02:24:59'),
	(2, 'Licenciment', '#525f11', '2024-06-03 02:24:49', '2024-06-03 02:24:49');

-- Listage de la structure de table isp_gombe. repartition
CREATE TABLE IF NOT EXISTS `repartition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `motif` varchar(100) NOT NULL,
  `service` double NOT NULL,
  `faculte` double NOT NULL,
  `departement` double NOT NULL,
  `comite` double NOT NULL,
  `prof` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.repartition : ~3 rows (environ)
INSERT INTO `repartition` (`id`, `motif`, `service`, `faculte`, `departement`, `comite`, `prof`) VALUES
	(1, 'delibe', 20, 20, 50, 10, 0),
	(2, 'inscription', 0, 0, 0, 100, 0),
	(3, 'cours', 20, 0, 0, 0, 80);

-- Listage de la structure de table isp_gombe. secteurs
CREATE TABLE IF NOT EXISTS `secteurs` (
  `id_sec` int NOT NULL AUTO_INCREMENT,
  `nom_sec` varchar(50) DEFAULT NULL,
  `id_tr` int DEFAULT NULL,
  PRIMARY KEY (`id_sec`)
) ENGINE=InnoDB AUTO_INCREMENT=1061 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table isp_gombe.secteurs : ~1 060 rows (environ)
INSERT INTO `secteurs` (`id_sec`, `nom_sec`, `id_tr`) VALUES
	(1, 'Aketi ', 1),
	(2, 'Likati ', 1),
	(3, 'Avuru-Duma ', 1),
	(4, 'Avuru-Gatanga ', 1),
	(5, 'Bondongola ', 1),
	(6, 'Mobati-Boyali', 1),
	(7, 'Kolongwandi', 1),
	(8, 'Mabinza ', 1),
	(9, 'Ngbongi ', 1),
	(10, 'Yoko ', 1),
	(11, 'Ango', 2),
	(12, 'Ezo ', 2),
	(13, 'Mopoyi ', 2),
	(14, 'Ngindo ', 2),
	(15, 'Sasa  ', 2),
	(16, 'Bambesa', 3),
	(17, 'Dingila', 3),
	(18, 'Bakete', 3),
	(19, 'Bokapo', 3),
	(20, 'Bokiba', 3),
	(21, 'Bolungwa', 3),
	(22, 'Makere', 3),
	(23, 'Makere II', 3),
	(24, 'Makere-Bakete', 3),
	(25, 'Mange', 3),
	(26, 'Mondongwale', 3),
	(27, 'Bondo', 4),
	(28, 'Bosso', 4),
	(29, 'Deni', 4),
	(30, 'Duaru', 4),
	(31, 'Gama', 4),
	(32, 'Gaya', 4),
	(33, 'Gbiamang', 4),
	(34, 'Goa', 4),
	(35, 'Kassa', 4),
	(36, 'Mobenge-Mondila', 4),
	(37, 'Soa', 4),
	(38, 'Babade', 5),
	(39, 'Dobea', 5),
	(40, 'Finant', 5),
	(41, 'Tepatondele', 5),
	(42, 'Bayeu-Bogongea', 6),
	(43, 'Bayeu-Bogbama', 6),
	(44, 'Mobati', 6),
	(45, 'Monganzulu', 6),
	(46, 'Nguru', 6),
	(47, 'Barissi', 6),
	(48, 'Mongingita-Bakango', 6),
	(49, 'Poko', 7),
	(50, 'Babena', 7),
	(51, 'Bakengaie', 7),
	(52, 'Gamu', 7),
	(53, 'Kipate', 7),
	(54, 'Kumendeni', 7),
	(55, 'Mabanga', 7),
	(56, 'Madi', 7),
	(57, 'Malele', 7),
	(58, 'Ngbaradi', 7),
	(59, 'Soronga', 7),
	(60, 'Zune', 7),
	(61, 'Abarambo', 7),
	(62, 'Kembisa', 7),
	(63, 'Basankusu CT', 8),
	(64, 'Basankusu', 8),
	(65, 'Gombalo', 8),
	(66, 'Waka Bokeka', 8),
	(67, 'Bikoro', 9),
	(68, 'Ekonda', 9),
	(69, 'Elanga', 9),
	(70, 'Lac Ntomba', 9),
	(71, 'Bolomba CT', 10),
	(72, 'Dianga', 10),
	(73, 'Bolomba', 10),
	(74, 'Busira', 10),
	(75, 'Losangania', 10),
	(76, 'Mampoko', 10),
	(77, 'Bomongo', 11),
	(78, 'Dzamba', 11),
	(79, 'Ngiri', 11),
	(80, 'Ingende', 12),
	(81, 'Bokatola', 12),
	(82, 'Duali', 12),
	(83, 'Eungu', 12),
	(84, 'Lukolela', 13),
	(85, 'Banunu Bobangi', 13),
	(86, 'Lusankani', 13),
	(87, 'Mpama', 13),
	(88, 'Mankanza', 14),
	(89, 'Bangala', 14),
	(90, 'Mweko', 14),
	(91, 'Ndobo', 14),
	(92, 'Mbandaka', 15),
	(93, 'Wangata', 15),
	(94, 'Kambove', 16),
	(95, 'Basanga', 16),
	(96, 'Lufira', 16),
	(97, 'Source du Congo', 16),
	(98, 'Kasenga', 17),
	(99, 'Bakunda', 17),
	(100, 'Kafira', 17),
	(101, 'Kisamamba', 17),
	(102, 'Luapula', 17),
	(103, 'Kipushi', 18),
	(104, 'Kaponda', 18),
	(105, 'Kinama', 18),
	(106, 'Bukanda', 18),
	(107, 'Kikula', 19),
	(108, 'Likasi', 19),
	(109, 'Panda', 19),
	(110, 'Shituru', 19),
	(111, 'Annexe', 20),
	(112, 'Kamalondo', 20),
	(113, 'Kampemba', 20),
	(114, 'Katuba', 20),
	(115, 'Kenya', 20),
	(116, 'Lubumbashi', 20),
	(117, 'Ruashi', 20),
	(118, 'Mitwaba', 21),
	(119, 'Kiona-Ngoy', 21),
	(120, 'Balomotwa', 21),
	(121, 'Banweshi', 21),
	(122, 'Pweto CT', 22),
	(123, 'Kiona-Nzini', 22),
	(124, 'Mpweto', 22),
	(125, 'Mwenge', 22),
	(126, 'Moero', 22),
	(127, 'Mokambo', 23),
	(128, 'Musoshi-Kasumbalesa', 23),
	(129, 'Sakania', 23),
	(130, 'Balala', 23),
	(131, 'Balamba', 23),
	(132, 'Baushi', 23),
	(133, 'Bukama', 24),
	(134, 'Luena', 24),
	(135, 'Butumba', 24),
	(136, 'Kabondo-Dianda', 24),
	(137, 'Kapamay', 24),
	(138, 'Kibanda', 24),
	(139, 'Kinkondja', 24),
	(140, 'Umpungu', 24),
	(141, 'Lualaba', 24),
	(142, 'Kabongo CT', 25),
	(143, 'Kabongo', 25),
	(144, 'Kayamba', 25),
	(145, 'Nord-Baluba', 25),
	(146, 'Dimayi', 26),
	(147, 'Kamina', 26),
	(148, 'Sobongo', 26),
	(149, 'Kasongo-Nyembo', 27),
	(150, 'Kinda', 27),
	(151, 'Kaniama', 28),
	(152, 'Mutombo Mukulu', 28),
	(153, 'Malemba', 29),
	(154, 'Kayumba Nkulu', 29),
	(155, 'Mulongo', 29),
	(156, 'Museka', 29),
	(157, 'Nkulu', 29),
	(158, 'Badia', 29),
	(159, 'Mwanza', 29),
	(160, 'Barumbu', 61),
	(161, 'Gombe', 61),
	(162, 'Kinshasa', 61),
	(163, 'Kintambo', 61),
	(164, 'Lingwala', 61),
	(165, 'Ngaliema', 61),
	(166, 'Mont-Ngafula', 61),
	(167, 'Bandalungwa', 62),
	(168, 'Bumbu', 62),
	(169, 'Kalamu', 62),
	(170, 'Kasa-Vubu', 62),
	(171, 'Makala', 62),
	(172, 'Ngiri-Ngiri', 62),
	(173, 'Selembao', 62),
	(174, 'Lemba', 63),
	(175, 'Limete', 63),
	(176, 'Kisenso', 63),
	(177, 'Matete', 63),
	(178, 'Ngaba', 63),
	(179, 'Kimbanseke', 64),
	(180, 'Maluku', 64),
	(181, 'Masina', 64),
	(182, 'N’djili', 64),
	(183, 'N’sele', 64),
	(184, 'Dungu', 30),
	(185, 'Malingindu', 30),
	(186, 'Ndolomo', 30),
	(187, 'Wando', 30),
	(188, 'Aba', 31),
	(189, 'Faradje', 31),
	(190, 'Dongo', 31),
	(191, 'Kakwa', 31),
	(192, 'Logo-Bagela', 31),
	(193, 'Logo-Doka', 31),
	(194, 'Logo-Obeleba', 31),
	(195, 'Logo-Ogambi', 31),
	(196, 'Mondo', 31),
	(197, 'Aba', 163),
	(198, 'Faradje', 163),
	(199, 'Dongo', 163),
	(200, 'Kakwa', 163),
	(201, 'Logo-Bagela', 163),
	(202, 'Logo-Doka', 163),
	(203, 'Logo-Lolia', 163),
	(204, 'Logo-Obeleba', 163),
	(205, 'Logo-Ogambi', 163),
	(206, 'Mondo', 163),
	(207, 'Kupa', 32),
	(208, 'Mambaya', 32),
	(209, 'Mendambo', 32),
	(210, 'Niangara', 33),
	(211, 'Boime', 33),
	(212, 'Kerebono', 33),
	(213, 'Kopa', 33),
	(214, 'Mangbele', 33),
	(215, 'Mangbetu', 33),
	(216, 'Manziga', 33),
	(217, 'Okondo', 33),
	(218, 'Rungu', 34),
	(219, 'Azanga', 34),
	(220, 'Mayogo-Mabozo', 34),
	(221, 'Mayogo-Magbay', 34),
	(222, 'Mboli', 34),
	(223, 'Medje-Mango', 34),
	(224, 'Mongo-Masi', 34),
	(225, 'Ndey', 34),
	(226, 'Wamba', 35),
	(227, 'Bafwagada', 35),
	(228, 'Bafwakoy', 35),
	(229, 'Balika-Toriko', 35),
	(230, 'Mahaa', 35),
	(231, 'Makoda', 35),
	(232, 'Malamba', 35),
	(233, 'Malika-Ateru', 35),
	(234, 'Mangbele', 35),
	(235, 'Timoniko', 35),
	(236, 'Wadimbisa', 35),
	(237, 'Mabudu Malika Babyeru (Mmb)', 35),
	(238, 'Watsa', 36),
	(239, 'Andikofa', 36),
	(240, 'Andobi', 36),
	(241, 'Ateru', 36),
	(242, 'Kebo', 36),
	(243, 'Mari-Minza', 36),
	(244, 'Walese', 36),
	(245, 'Gombari', 36),
	(246, 'Kibali', 36),
	(247, 'Mangbutu', 36),
	(248, 'Aru', 37),
	(249, 'Aluru', 37),
	(250, 'Kakwa', 37),
	(251, 'Kaliko-Omi', 37),
	(252, 'Lu', 37),
	(253, 'Nio-Kamule', 37),
	(254, 'Otso', 37),
	(255, 'Zaki', 37),
	(256, 'Ndo', 37),
	(257, 'Mbunya', 38),
	(258, 'Nyakasanza', 38),
	(259, 'Shari', 38),
	(260, 'Djugu', 39),
	(261, 'Mangbalu', 39),
	(262, 'Bahema Baguru', 39),
	(263, 'Bahema-Badjere', 39),
	(264, 'Bahema-Banywagi', 39),
	(265, 'Bahema-Nord', 39),
	(266, 'Mabendi', 39),
	(267, 'Mambisa', 39),
	(268, 'Ndo-Okebo', 39),
	(269, 'Banyali-Kilo', 39),
	(270, 'Walendu-Djatsi', 39),
	(271, 'Walendu-Pitsi', 39),
	(272, 'Walendu-Tatsi', 39),
	(273, 'Irumu', 40),
	(274, 'Andisoma', 40),
	(275, 'Babelebe', 40),
	(276, 'Baboa-Bokoe', 40),
	(277, 'Bahema d’Irumu', 40),
	(278, 'Bahema Mitego', 40),
	(279, 'Bahema-Boga', 40),
	(280, 'Banyari-Tchabi', 40),
	(281, 'Basili', 40),
	(282, 'Mobala', 40),
	(283, 'Walendu Bindi', 40),
	(284, 'Walese Vonkutu', 40),
	(285, 'Bahema Sud', 40),
	(286, 'Mahagi', 41),
	(287, 'Alur-Djuganda', 41),
	(288, 'Anghal', 41),
	(289, 'Djukoth', 41),
	(290, 'Mokambu', 41),
	(291, 'Panduru', 41),
	(292, 'Wagongo', 41),
	(293, 'Walendu-Watsi', 41),
	(294, 'War-Palara', 41),
	(295, 'Mambasa', 42),
	(296, 'Babila Babombi', 42),
	(297, 'Babila-Bakwanza', 42),
	(298, 'Bandaka', 42),
	(299, 'Bombo-Bagumba', 42),
	(300, 'Walese-Dese', 42),
	(301, 'Walese-Karo', 42),
	(302, 'Dekese', 43),
	(303, 'Dekese-Ikolombe-Isolu', 43),
	(304, 'Yaelima', 43),
	(305, 'Ilebo', 44),
	(306, 'Basongo (Entre Lubi-Konduye)', 44),
	(307, 'Ell Mapangu', 44),
	(308, 'Malu Malu', 44),
	(309, 'Sud-Banga', 44),
	(310, 'Kamonia', 45),
	(311, 'Bakwa-Nyambi', 45),
	(312, 'Bapende', 45),
	(313, 'Kasadisadi', 45),
	(314, 'Kasai-Kabambaie', 45),
	(315, 'Kasai-Lunyeka', 45),
	(316, 'Kasai-Longatshimo', 45),
	(317, 'Lovua-Longatshimo', 45),
	(318, 'Lovua-Lushiku', 45),
	(319, 'Tshikapa', 45),
	(320, 'Luebo', 46),
	(321, 'Luebo-Kabambaie', 46),
	(322, 'Luebo-Lulengele', 46),
	(323, 'Luebo-Wedi', 46),
	(324, 'Ndjoko-Punda', 46),
	(325, 'Kakenge', 47),
	(326, 'Mweka', 47),
	(327, 'Bakuba', 47),
	(328, 'Dibumba', 48),
	(329, 'Kanzala', 48),
	(330, 'Mabondo', 48),
	(331, 'Mbumba', 48),
	(332, 'Bena Leka', 49),
	(333, 'Demba', 49),
	(334, 'Bena Mamba', 49),
	(335, 'Diofwa', 49),
	(336, 'Lombelo', 49),
	(337, 'Lusonge', 49),
	(338, 'Muanza-Ngoma', 49),
	(339, 'Tshibote', 49),
	(340, 'Tshibungu', 49),
	(341, 'Dibaya', 50),
	(342, 'Tshimbulu', 50),
	(343, 'Dibanda', 50),
	(344, 'Dibataie', 50),
	(345, 'Kamwandu', 50),
	(346, 'Kasangidi', 50),
	(347, 'Tshishilu', 50),
	(348, 'Dimbelenge', 51),
	(349, 'Kunduyi', 51),
	(350, 'Lubi', 51),
	(351, 'Lubudi', 51),
	(352, 'Lukibu', 51),
	(353, 'Mashala', 51),
	(354, 'Kananga', 52),
	(355, 'Katoka', 52),
	(356, 'Lukonga', 52),
	(357, 'Ndesha', 52),
	(358, 'Nganza', 52),
	(359, 'Kazumba', 53),
	(360, 'Bulungu', 53),
	(361, 'Kafuba', 53),
	(362, 'Kavula', 53),
	(363, 'Matamba', 53),
	(364, 'Mboie', 53),
	(365, 'Miao', 53),
	(366, 'Muswaswa', 53),
	(367, 'Mutefu', 53),
	(368, 'Tshitadi', 53),
	(369, 'Luiza', 54),
	(370, 'Bambaie', 54),
	(371, 'Kabelekese', 54),
	(372, 'Kalunga', 54),
	(373, 'Loatshi', 54),
	(374, 'Lueta', 54),
	(375, 'Lusanza', 54),
	(376, 'Mbushimaie', 54),
	(377, 'Kabeya-Kamwanga', 55),
	(378, 'Kalela', 55),
	(379, 'Lac Mukamba', 55),
	(380, 'Mpemba', 55),
	(381, 'Ndomba', 55),
	(382, 'Katanda', 56),
	(383, 'Baluba-Lubilanji', 56),
	(384, 'Bena- Tshitolo', 56),
	(385, 'Mutuayi', 56),
	(386, 'Nsangu', 56),
	(387, 'Lupatapata', 57),
	(388, 'Kabala', 57),
	(389, 'Mudiba', 57),
	(390, 'Mukumbi', 57),
	(391, 'Mulenda', 57),
	(392, 'Bipemba', 58),
	(393, 'Dibindi', 58),
	(394, 'Diulu', 58),
	(395, 'Kanshi', 58),
	(396, 'Muya', 58),
	(397, 'Miabi', 59),
	(398, 'Kakangayi', 59),
	(399, 'Movo-Nkatshia', 59),
	(400, 'Tshijiba', 59),
	(401, 'Tshilundu', 59),
	(402, 'Lukalaba', 60),
	(403, 'Tshilenge', 60),
	(404, 'Bakwa-Kalonji', 60),
	(405, 'Kabondo', 65),
	(406, 'Kalamu', 65),
	(407, 'Nzadi', 65),
	(408, 'Kasangulu', 66),
	(409, 'Luila', 66),
	(410, 'Lukunga-Mputu', 66),
	(411, 'Kimvula', 67),
	(412, 'Benga', 67),
	(413, 'Lubisi', 67),
	(414, 'Lula-Lumene', 67),
	(415, 'Lemba', 68),
	(416, 'Lukula', 68),
	(417, 'Nsioni', 68),
	(418, 'Fubu', 68),
	(419, 'Kakongo', 68),
	(420, 'Phatu', 68),
	(421, 'Tsanga-Sud', 68),
	(422, 'Tsundi-Sud', 68),
	(423, 'Luozi', 69),
	(424, 'Balari', 69),
	(425, 'De La Kenge', 69),
	(426, 'Kimbanza', 69),
	(427, 'Kimumba', 69),
	(428, 'Kinkenge', 69),
	(429, 'Kivunda', 69),
	(430, 'Mbanza-Mona', 69),
	(431, 'Mbanza-Muembe', 69),
	(432, 'Mbanza-Ngoyo', 69),
	(433, 'Mongo-Luala', 69),
	(434, 'Inkisi', 70),
	(435, 'Madimba', 70),
	(436, 'Kinkosi-Luidi', 70),
	(437, 'Mfidi Malele', 70),
	(438, 'Mfuma (Mfuma-Kibambi)', 70),
	(439, 'Ngeba', 70),
	(440, 'Ngufu', 70),
	(441, 'Wungu', 70),
	(442, 'Matadi', 71),
	(443, 'Mvuzi', 71),
	(444, 'Nzanza', 71),
	(445, 'Kwilu-Ngongo', 72),
	(446, 'Lukala', 72),
	(447, 'Mbanza-Ngungu', 72),
	(448, 'Boko', 72),
	(449, 'Gombe-Matadi', 72),
	(450, 'Gombe-Sud', 72),
	(451, 'Kivuvu', 72),
	(452, 'Lunzadi', 72),
	(453, 'Ntimansi', 72),
	(454, 'Moanda', 73),
	(455, 'Assolongo', 73),
	(456, 'Boma Bungu', 73),
	(457, 'La mer', 73),
	(458, 'Kinzau-Vuete', 74),
	(459, 'Seke-Banza', 74),
	(460, 'Bundi', 74),
	(461, 'Isangila', 74),
	(462, 'Lutu', 74),
	(463, 'Mbavu', 74),
	(464, 'Sumbi', 74),
	(465, 'Kimpese', 75),
	(466, 'Songololo', 75),
	(467, 'Bamboma', 75),
	(468, 'Luima', 75),
	(469, 'Palabala', 75),
	(470, 'Wombo', 75),
	(471, 'Tshela', 76),
	(472, 'Bula-Naku', 76),
	(473, 'Loango', 76),
	(474, 'Lubolo', 76),
	(475, 'Lubuzi', 76),
	(476, 'Maduda', 76),
	(477, 'Mbanga', 76),
	(478, 'Nganda-Tsundi', 76),
	(479, 'Nzobe-Luzi', 76),
	(480, 'Kahemba', 78),
	(481, 'Bangu', 78),
	(482, 'Bindu', 78),
	(483, 'Kulunji', 78),
	(484, 'Muloshi', 78),
	(485, 'Mwamushiko', 78),
	(486, 'Mwendjila', 78),
	(487, 'Kasongo-Lunda', 79),
	(488, 'Kingwangala', 79),
	(489, 'Tembo', 79),
	(490, 'Kasa', 79),
	(491, 'Kibunda', 79),
	(492, 'Kingulu', 79),
	(493, 'Kizamba', 79),
	(494, 'Mawanga', 79),
	(495, 'Panzi', 79),
	(496, 'Swa-Tenda', 79),
	(497, 'Kenge', 80),
	(498, 'Bukanga-Lonzo', 80),
	(499, 'Dinga', 80),
	(500, 'Kolokoso', 80),
	(501, 'Mosamba', 80),
	(502, 'Pelende-Nord', 80),
	(503, 'Cinq Mai', 81),
	(504, 'Laurent-Désiré Kabila', 81),
	(505, 'Manonga', 81),
	(506, 'Masikita', 81),
	(507, 'Mavula', 81),
	(508, 'Popokabaka', 82),
	(509, 'Lufuna', 82),
	(510, 'Yonso', 82),
	(511, 'Feshi', 164),
	(512, 'Feshi-Maziomo (Maziomo-Feshi)', 164),
	(513, 'Ganaketi', 164),
	(514, 'Lobo', 164),
	(515, 'Mukoso', 164),
	(516, 'Bagata', 255),
	(517, 'Kidzweme', 255),
	(518, 'Kwango-Kasaï', 255),
	(519, 'Kwilu-Ntobere', 255),
	(520, 'Manzasay', 255),
	(521, 'Wamba-Fatundu', 255),
	(522, 'Basoko', 256),
	(523, 'Disasi', 256),
	(524, 'Mayoyo', 256),
	(525, 'Bulungu', 257),
	(526, 'Dwe', 257),
	(527, 'Imbongo', 257),
	(528, 'Kilunda', 257),
	(529, 'Kipuka', 257),
	(530, 'Kwenge', 257),
	(531, 'Kwilu-Kimbata', 257),
	(532, 'Luniungu', 257),
	(533, 'Mikwi', 257),
	(534, 'Niadi Nkara', 257),
	(535, 'Nko', 257),
	(536, 'Gungu', 258),
	(537, 'Kandale', 258),
	(538, 'Kilamba', 258),
	(539, 'Kilembe', 258),
	(540, 'Kisunzu', 258),
	(541, 'Kobo', 258),
	(542, 'Kondo', 258),
	(543, 'Lozo', 258),
	(544, 'Lukamba', 258),
	(545, 'Mulikalunga', 258),
	(546, 'Mungindu', 258),
	(547, 'Ngudi', 258),
	(548, 'Dibaya-Lubwe', 259),
	(549, 'Idiofa', 259),
	(550, 'Mangai', 259),
	(551, 'Panu', 259),
	(552, 'Banga', 259),
	(553, 'Belo', 259),
	(554, 'Bulwem', 259),
	(555, 'Kalanganda', 259),
	(556, 'Kanga', 259),
	(557, 'Kapia', 259),
	(558, 'Kipuku', 259),
	(559, 'Madimbi', 259),
	(560, 'Mateko', 259),
	(561, 'Musanga Idiofa', 259),
	(562, 'Sedzo', 259),
	(563, 'Yasa-Lokwa', 259),
	(564, 'Kazamba', 260),
	(565, 'Lukemi', 260),
	(566, 'Lukolela', 260),
	(567, 'Nzinda', 260),
	(568, 'Bindungi', 261),
	(569, 'Kibolo', 261),
	(570, 'Kinzenga', 261),
	(571, 'Kinzenzengo', 261),
	(572, 'Kiloy', 261),
	(573, 'Masi-Manimba', 261),
	(574, 'Mokano', 261),
	(575, 'Mosango', 261),
	(576, 'Pay-Kongila', 261),
	(577, 'Sungu', 261),
	(578, 'Kabondo', 167),
	(579, 'Kabuelabuela', 167),
	(580, 'Kajiba', 167),
	(581, 'Mudingayi', 167),
	(582, 'Baluba-Lubangue', 263),
	(583, 'Kabinda', 263),
	(584, 'Ludimbi-Lukula', 263),
	(585, 'Lufubu-Lomami', 263),
	(586, 'Lukashie-Lualu', 263),
	(587, 'Vunayi', 263),
	(588, 'Bekalebwe', 264),
	(589, 'Kamiji', 264),
	(590, 'Lubao', 264),
	(591, 'Luekeshi', 264),
	(592, 'Kisengwa', 264),
	(593, 'Tshofa', 264),
	(594, 'Lubao', 265),
	(595, 'Luputa', 266),
	(596, 'IN-KAN (Kanintshina)', 266),
	(597, 'Kanda-Kanda', 266),
	(598, 'Kanyoka de Katshisungu', 266),
	(599, 'Kanyoka de Mulundu', 266),
	(600, 'Bondoyi', 267),
	(601, 'Musadi', 267),
	(602, 'Mwene-Ditu', 267),
	(603, 'Bakwa-Mulumba', 268),
	(604, 'Baluba-Shankadi', 268),
	(605, 'Bena-Kalambayi (Kalambayi)', 268),
	(606, 'Ngandajika', 268),
	(607, 'Tshiyamba', 268),
	(608, 'Dilolo', 168),
	(609, 'Kasaji', 168),
	(610, 'Luena', 168),
	(611, 'Lulua-Lukoshi', 168),
	(612, 'Mutanda', 168),
	(613, 'Muyeye', 168),
	(614, 'Mwakandala', 168),
	(615, 'Mwatshisenge', 168),
	(616, 'Ndumba', 168),
	(617, 'Saluseke', 168),
	(618, 'Tshisangama', 168),
	(619, 'Kapanga', 169),
	(620, 'Mwant-Yav', 169),
	(621, 'Dilala', 170),
	(622, 'Manika', 170),
	(623, 'Fungurume', 171),
	(624, 'Lubudi', 171),
	(625, 'Bayeke', 171),
	(626, 'Manzangule', 171),
	(627, 'Mulumbu', 171),
	(628, 'Mwana-Muadi', 171),
	(629, 'Luilu', 172),
	(630, 'Lufupa', 172),
	(631, 'Mukuleshi', 172),
	(632, 'Mutshatsha', 172),
	(633, 'Kayembe-Muadi', 173),
	(634, 'Lumanga', 173),
	(635, 'Mbako', 173),
	(636, 'Muteba', 173),
	(637, 'Sakundundu', 173),
	(638, 'Samutoma', 173),
	(639, 'Sandoa', 173),
	(640, 'Tshibanda', 173),
	(641, 'Tshipao', 173),
	(642, 'Bolobo', 190),
	(643, 'Bateke Nord', 190),
	(644, 'Basengele', 175),
	(645, 'Bolia', 175),
	(646, 'Inongo', 175),
	(647, 'Bonse', 176),
	(648, 'Mpolo', 176),
	(649, 'Mpongonzoli', 176),
	(650, 'Beronge', 177),
	(651, 'Kiri', 177),
	(652, 'Lutoy', 177),
	(653, 'Pendjwa', 177),
	(654, 'Badia', 178),
	(655, 'Batere', 178),
	(656, 'Bokoro', 178),
	(657, 'Kemba', 178),
	(658, 'Kutu', 178),
	(659, 'Lwabo', 178),
	(660, 'Mfimi', 178),
	(661, 'Nioki', 178),
	(662, 'Semendwa', 178),
	(663, 'Tolo', 178),
	(664, 'Bateke Sud (Twa)', 179),
	(665, 'Kwamouth', 179),
	(666, 'Baboma Nord', 180),
	(667, 'Mushie', 180),
	(668, 'ELL (Entre Lukenie et Lokoro) NKAW', 181),
	(669, 'Kangara', 181),
	(670, 'Lokolama', 181),
	(671, 'Lukenie', 181),
	(672, 'Oshwe', 181),
	(673, 'Mongama', 182),
	(674, 'Yumbi', 182),
	(675, 'Ambwe', 184),
	(676, 'Balanga', 184),
	(677, 'Bangengele', 184),
	(678, 'Kailo', 184),
	(679, 'Wasongola', 184),
	(680, 'BB/Bahemba', 191),
	(681, 'BB/Kabambare bahombo', 191),
	(682, 'BB/Lulindi', 191),
	(683, 'BB/Salamabila', 191),
	(684, 'BB/Wamaza', 191),
	(685, 'Babuyu', 191),
	(686, 'Kabambare', 191),
	(687, 'Bakwange', 185),
	(688, 'Basonge I', 185),
	(689, 'Basonge II-Mweho', 185),
	(690, 'Benia-Samba', 185),
	(691, 'Kasongo', 185),
	(692, 'Mamba Kasenga', 185),
	(693, 'Nonda', 185),
	(694, 'Wagenia', 185),
	(695, 'Wazimba wa Maringa', 185),
	(696, 'Wazimba wa Mulu', 185),
	(697, 'Wazura', 185),
	(698, 'Alumba', 186),
	(699, 'Ankutshu', 186),
	(700, 'Bahina', 186),
	(701, 'Bakongola', 186),
	(702, 'Kibombo', 186),
	(703, 'Matapa', 186),
	(704, 'Alunguli', 187),
	(705, 'Kasuku', 187),
	(706, 'Mikelenge', 187),
	(707, 'Bitule', 188),
	(708, 'Lubutu', 188),
	(709, 'Obokote', 188),
	(710, 'Babene', 189),
	(711, 'Bela', 189),
	(712, 'Ikama', 189),
	(713, 'Kalima', 189),
	(714, 'Pangi', 189),
	(715, 'Wakabango II', 189),
	(716, 'Bitule', 192),
	(717, 'Lubutu', 192),
	(718, 'Obokote', 192),
	(719, 'Babene', 269),
	(720, 'Bela', 269),
	(721, 'Ikama', 269),
	(722, 'Kalima', 269),
	(723, 'Pangi', 269),
	(724, 'Wakabango II', 269),
	(725, 'Ntand Embelo', 175),
	(726, 'Babira Bakwame', 270),
	(727, 'Baleka', 270),
	(728, 'Punia', 270),
	(729, 'Ulindi', 270),
	(730, 'Bongandanga', 193),
	(731, 'Boso-Djanoa', 193),
	(732, 'Boso-Melo', 193),
	(733, 'Boso-Simba', 193),
	(734, 'Banda-Yowa', 194),
	(735, 'Bumba', 194),
	(736, 'Itimbiri', 194),
	(737, 'Loeka', 194),
	(738, 'Molua', 194),
	(739, 'Monzamboli', 194),
	(740, 'Yandongi', 194),
	(741, 'Bolikango', 195),
	(742, 'Mongala', 195),
	(743, 'Binga', 196),
	(744, 'Mongala-Motima', 196),
	(745, 'Ngomba-Dako', 196),
	(746, 'Ngombe-Mombangi', 196),
	(747, 'Bashu', 197),
	(748, 'Beni', 197),
	(749, 'Bulongo', 197),
	(750, 'Lume', 197),
	(751, 'Kyondo', 197),
	(752, 'Mangina', 197),
	(753, 'Oicha', 197),
	(754, 'Ruwezori', 197),
	(755, 'Watalinga', 197),
	(756, 'Beu', 198),
	(757, 'Bungulu', 198),
	(758, 'Mulekera', 198),
	(759, 'Ruwenzori', 198),
	(760, 'Bulengera', 199),
	(761, 'Kimeni', 199),
	(762, 'Mususa', 199),
	(763, 'Vulamba', 199),
	(764, 'Goma', 200),
	(765, 'Karisimbi', 200),
	(766, 'Bahunde', 201),
	(767, 'Bamate', 201),
	(768, 'Bapere', 201),
	(769, 'Bashali', 201),
	(770, 'Batangi', 201),
	(771, '(Osso) Banyungu', 201),
	(772, 'Kanyabayonga', 201),
	(773, 'Katoyi', 201),
	(774, 'Kayna', 201),
	(775, 'Kirumba', 201),
	(776, 'Lubero', 201),
	(777, 'Masisi', 201),
	(778, 'Baswagha', 201),
	(779, 'Bamate', 271),
	(780, 'Bapere', 271),
	(781, 'Baswagha', 271),
	(782, 'Batangi', 271),
	(783, 'Kanyabayonga', 271),
	(784, 'Kayna', 271),
	(785, 'Kirumba', 271),
	(786, 'Lubero', 271),
	(787, '(Osso) Banyungu', 202),
	(788, 'Bahunde', 202),
	(789, 'Bashali', 202),
	(790, 'Katoyi', 202),
	(791, 'Masisi', 202),
	(792, 'Bakumu', 203),
	(793, 'Bwisha', 204),
	(794, 'Bwito', 204),
	(795, 'Rutshuru', 204),
	(796, 'Bakono', 205),
	(797, 'Walikale', 205),
	(798, 'Wanianga', 205),
	(799, 'Bandas', 206),
	(800, 'Bili', 206),
	(801, 'Bosobolo', 206),
	(802, 'Bosobolo CT', 206),
	(803, 'Bodangabo', 207),
	(804, 'Businga', 207),
	(805, 'Karawa', 207),
	(806, 'Gbadolite', 208),
	(807, 'Molegbe', 208),
	(808, 'Nganza', 208),
	(809, 'Mobayi-Mbongo', 209),
	(810, 'Otto-Banza', 209),
	(811, 'Abumombazi', 210),
	(812, 'Yakoma', 210),
	(813, 'Wapinda', 210),
	(814, 'Basambala', 211),
	(815, 'Batetela arabisés-Lomami', 211),
	(816, 'Djalo', 211),
	(817, 'Katako-Kombe', 211),
	(818, 'Lonya', 211),
	(819, 'Lukumbe', 211),
	(820, 'Ngandu de Katako-Kombe', 211),
	(821, 'Ukulungu', 211),
	(822, 'Watambulu-Nord', 211),
	(823, 'Watambulu-Sud', 211),
	(824, 'Atshuru', 212),
	(825, 'Bankutshu-Dibele', 212),
	(826, 'Bankutshu-Lukenie', 212),
	(827, 'Basho', 212),
	(828, 'Batetela-Dibele', 212),
	(829, 'Kole', 212),
	(830, 'Ohindo', 212),
	(831, 'Lodja', 213),
	(832, 'Ahamba-Mange', 213),
	(833, 'Kondo-Tshumbe', 213),
	(834, 'Lukfungu', 213),
	(835, 'Lutshimba-Eduo-Piete-Kolombe', 213),
	(836, 'Nambelo-Lohembe', 213),
	(837, 'Olemba', 213),
	(838, 'Vunge', 213),
	(839, 'Watambulu', 213),
	(840, 'Lomela', 214),
	(841, 'Bahamba I', 214),
	(842, 'Bahamba II', 214),
	(843, 'Bakela', 214),
	(844, 'Batetela-Lomela', 214),
	(845, 'Djonga', 214),
	(846, 'Okutu', 214),
	(847, 'Lubefu', 215),
	(848, 'Mondja-Ngandu', 215),
	(849, 'Ndjovu', 215),
	(850, 'Ngandu-Wuma', 215),
	(851, 'Okutu Basonge', 215),
	(852, 'Kabondo', 216),
	(853, 'Lupembe', 216),
	(854, 'Lusambo', 216),
	(855, 'Tusuanganyi', 216),
	(856, 'Basonge', 217),
	(857, 'Batetela', 217),
	(858, 'EKM (Entre Kunduye et Maalaba)', 217),
	(859, 'ELK (Entre Lubi et Kunduye)', 217),
	(860, 'Kashidi', 217),
	(861, 'Lubi', 217),
	(862, 'Mpania-Mutombo', 217),
	(863, 'Sankuru', 217),
	(864, 'Bagira', 218),
	(865, 'Ibanda', 218),
	(866, 'Kadutu', 218),
	(867, 'Fizi', 219),
	(868, 'Lulenge', 219),
	(869, 'Mutambala', 219),
	(870, 'Ngandja', 219),
	(871, 'Tanganyika', 219),
	(872, 'Ntambika', 220),
	(873, 'Rubenga', 220),
	(874, 'Kabare', 221),
	(875, 'Nindja', 221),
	(876, 'Bahavu', 222),
	(877, 'Buloho', 222),
	(878, 'Basile', 223),
	(879, 'Burhinyi', 223),
	(880, 'Itombwe', 223),
	(881, 'Kamituga', 223),
	(882, 'Luhwindja', 223),
	(883, 'Lwindi', 223),
	(884, 'Wamuzimu', 223),
	(885, 'Shabunda', 224),
	(886, 'Bakisi', 224),
	(887, 'Wakabango', 224),
	(888, 'Kiliba', 225),
	(889, 'Luvungi', 225),
	(890, 'Sange', 225),
	(891, 'Uvira', 225),
	(892, 'Bafuliro', 225),
	(893, 'Bavira', 225),
	(894, 'Plaine de la Ruzizi', 225),
	(895, 'Kaziba', 226),
	(896, 'Ngweshe', 226),
	(897, 'Budjala', 227),
	(898, 'Banga', 227),
	(899, 'Bolingo', 227),
	(900, 'Mongala-Motima', 227),
	(901, 'Ndolo-Liboko', 227),
	(902, 'Ngombe-Doko', 227),
	(903, 'Gbazubu', 228),
	(904, 'Labo', 228),
	(905, 'Lac-Ntumba', 228),
	(906, 'Mont Gila', 228),
	(907, 'Banga-Kungu', 229),
	(908, 'Bowase', 229),
	(909, 'Mbari', 229),
	(910, 'Nguya', 229),
	(911, 'Kungu', 230),
	(912, 'Bomboma', 230),
	(913, 'Dongo', 230),
	(914, 'Lua', 230),
	(915, 'Moanda', 230),
	(916, 'Songo', 230),
	(917, 'Libenge', 231),
	(918, 'Libenge-Centre', 231),
	(919, 'Libenge-Nord', 231),
	(920, 'Libenge-Sud', 231),
	(921, 'Nzulu', 232),
	(922, 'Wango', 232),
	(923, 'Kabalo', 233),
	(924, 'Luela-Luvunguyi', 233),
	(925, 'Lukuswa', 233),
	(926, 'Kalemie', 234),
	(927, 'Lac', 234),
	(928, 'Lukuga', 234),
	(929, 'Benze', 235),
	(930, 'Ruluku', 235),
	(931, 'Tumbwe', 235),
	(932, 'Kongolo', 236),
	(933, 'Baluba', 236),
	(934, 'Basonge', 236),
	(935, 'Bayashi', 236),
	(936, 'Bena-nyembo', 236),
	(937, 'Lubunda', 236),
	(938, 'Mambwe', 236),
	(939, 'Muhona', 236),
	(940, 'Munono', 236),
	(941, 'Nkuvu', 236),
	(942, 'Yambula', 236),
	(943, 'Manono', 237),
	(944, 'Bakongolo', 237),
	(945, 'Kamalondo', 237),
	(946, 'Kiluba', 237),
	(947, 'Kyofwe', 237),
	(948, 'Luvua', 237),
	(949, 'Nyemba', 237),
	(950, 'Moba', 238),
	(951, 'Bena-Kamanya', 238),
	(952, 'Bena-Tanga', 238),
	(953, 'Kansabala', 238),
	(954, 'Kayabala', 238),
	(955, 'Manda', 238),
	(956, 'Nganye', 238),
	(957, 'Nyunzu', 239),
	(958, 'Nords-Lukuga', 239),
	(959, 'Sud-Lukuga', 239),
	(960, 'Bafwasende', 240),
	(961, 'Bafwandaka', 240),
	(962, 'Bakumu d’Angumu', 240),
	(963, 'Bakundumu', 240),
	(964, 'Barumbi-Opienge', 240),
	(965, 'Bekeni-Kondolole', 240),
	(966, 'Bemili', 240),
	(967, 'Banalia', 241),
	(968, 'Baboro', 241),
	(969, 'Babwa de Kole', 241),
	(970, 'Bamanga', 241),
	(971, 'Banalia-Bangba', 241),
	(972, 'Popoy', 241),
	(973, 'Basoko', 242),
	(974, 'Bangelema-Mongandjo', 242),
	(975, 'Bomenge', 242),
	(976, 'Lokutu', 242),
	(977, 'Mobango Itimbiri', 242),
	(978, 'Turumbu', 242),
	(979, 'Wahanga', 242),
	(980, 'Yaliwasa', 242),
	(981, 'Yamandundu', 242),
	(982, 'Isangi', 243),
	(983, 'Yangambi', 243),
	(984, 'Baluolambila', 243),
	(985, 'Bambelota', 243),
	(986, 'Bolomboki', 243),
	(987, 'Kombe', 243),
	(988, 'Liutua', 243),
	(989, 'Lokombe', 243),
	(990, 'Luete', 243),
	(991, 'Turumbu', 243),
	(992, 'Yalihila', 243),
	(993, 'Yalikandja-Yanonge', 243),
	(994, 'Yalikoka-Mboso', 243),
	(995, 'Yaokandja', 243),
	(996, 'Yawembe-Basoa-Baonga', 243),
	(997, 'Kabondo', 244),
	(998, 'Kisangani', 244),
	(999, 'Lubunga', 244),
	(1000, 'Makiso', 244),
	(1001, 'Mangobo', 244),
	(1002, 'Tshopo', 244),
	(1003, 'Opala', 245),
	(1004, 'Balinga-Lindja', 245),
	(1005, 'Lye', 245),
	(1006, 'Kembe', 245),
	(1007, 'Lobale', 245),
	(1008, 'Mongo', 245),
	(1009, 'Tooli', 245),
	(1010, 'Yalingo', 245),
	(1011, 'Yamale', 245),
	(1012, 'Yapandu', 245),
	(1013, 'Yaende-Loolo', 245),
	(1014, 'Yeyango', 245),
	(1015, 'Ubundu', 246),
	(1016, 'Bakumu Obiatuku', 246),
	(1017, 'Bakumu-Kilinga', 246),
	(1018, 'Bakumu-Mandombe', 246),
	(1019, 'Bakumu-Mangongo', 246),
	(1020, 'Kirundu', 246),
	(1021, 'Mituku-Bamoya', 246),
	(1022, 'Mituku-Basikate', 246),
	(1023, 'Walengola-Babira', 246),
	(1024, 'Walengola-Baleka', 246),
	(1025, 'Walengola-Lilo', 246),
	(1026, 'Walengola-Lowa', 246),
	(1027, 'Yahuma', 247),
	(1028, 'Bolinga', 247),
	(1029, 'Bosoku', 247),
	(1030, 'Buma', 247),
	(1031, 'Mombesa', 247),
	(1032, 'Befale', 248),
	(1033, 'Befumbo', 248),
	(1034, 'Duali', 248),
	(1035, 'Lomako', 248),
	(1036, 'Boende', 249),
	(1037, 'Tshuapa', 249),
	(1038, 'Bolua', 250),
	(1039, 'Djera', 250),
	(1040, 'Lofoy', 250),
	(1041, 'Wini', 250),
	(1042, 'Bokungu', 251),
	(1043, 'Lulaka', 251),
	(1044, 'Loombo', 251),
	(1045, 'Luando', 251),
	(1046, 'Luay', 251),
	(1047, 'Nkole', 251),
	(1048, 'Djolu', 252),
	(1049, 'Ikela', 253),
	(1050, 'Lofome', 253),
	(1051, 'Loile', 253),
	(1052, 'Lokima', 253),
	(1053, 'Tshuapa', 253),
	(1054, 'Tumbenga', 253),
	(1055, 'Monkoto', 254),
	(1056, 'Bianga', 254),
	(1057, 'Nongo', 254),
	(1058, 'Lingomo', 252),
	(1059, 'Luo', 252),
	(1060, 'Yala', 252);

-- Listage de la structure de table isp_gombe. sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom_s` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table isp_gombe.sessions : ~2 rows (environ)
INSERT INTO `sessions` (`id`, `nom_s`) VALUES
	(1, 'PREMIERE SESSION'),
	(2, 'DEUXIEME SESSION');

-- Listage de la structure de table isp_gombe. support
CREATE TABLE IF NOT EXISTS `support` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fichier` text,
  `description` text,
  `prix` float DEFAULT '0',
  `promotion` int DEFAULT NULL,
  `prof` int DEFAULT NULL,
  `cours` int DEFAULT NULL,
  `types` varchar(255) DEFAULT NULL,
  `annee` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table isp_gombe.support : ~3 rows (environ)
INSERT INTO `support` (`id`, `fichier`, `description`, `prix`, `promotion`, `prof`, `cours`, `types`, `annee`) VALUES
	(5, 'D', 'DESCRIPT', 10, 3, 2, 9, 'Support', 2022),
	(6, 'D', 'DESCRIPT', 15, 3, 1, 11, 'Support', 2022),
	(7, 'D', 'DESCRIPT', 0, 1, 2, 6, 'Support', 2022);

-- Listage de la structure de table isp_gombe. territoires
CREATE TABLE IF NOT EXISTS `territoires` (
  `id_tr` int NOT NULL AUTO_INCREMENT,
  `nom_tr` varchar(50) DEFAULT NULL,
  `id_p` int DEFAULT NULL,
  `changer` int DEFAULT '0',
  PRIMARY KEY (`id_tr`)
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=utf8mb3;

-- Listage des données de la table isp_gombe.territoires : ~181 rows (environ)
INSERT INTO `territoires` (`id_tr`, `nom_tr`, `id_p`, `changer`) VALUES
	(1, 'AKETI ', 1, 1),
	(2, 'ANGO ', 1, 1),
	(3, 'BAMBESA ', 1, 1),
	(4, 'BONDO', 1, 1),
	(5, 'BUTA VILLE', 1, 1),
	(6, 'BUTA', 1, 1),
	(7, 'POKO', 1, 1),
	(8, 'BASANKUSU', 2, 1),
	(9, 'BIKORO', 2, 1),
	(10, 'BOLOMBA', 2, 1),
	(11, 'BOMONGO', 2, 1),
	(12, 'INGENDE', 2, 1),
	(13, 'LUKOLELA', 2, 1),
	(14, 'MANKANZA', 2, 1),
	(15, 'MBANDAKA VILLE', 2, 1),
	(16, 'KAMBOVE', 4, 1),
	(17, 'KASENGA', 4, 1),
	(18, 'KIPUSHI', 4, 1),
	(19, 'LIKASI VILLE', 4, 1),
	(20, 'LUBUMBASHI VILLE', 4, 1),
	(21, 'MITWABA', 4, 1),
	(22, 'PWETO', 4, 1),
	(23, 'SAKANIA', 4, 1),
	(24, 'BUKAMA', 3, 1),
	(25, 'KABONGO', 3, 1),
	(26, 'KAMINA VILLE', 3, 1),
	(27, 'KAMINA', 3, 1),
	(28, 'KANIAMA', 3, 1),
	(29, 'MALEMBA-NKULU', 3, 1),
	(30, 'DUNGU', 6, 1),
	(32, 'ISIRO VILLE', 6, 0),
	(33, 'NIANGARA', 6, 0),
	(34, 'RUNGU', 6, 0),
	(35, 'WAMBA', 6, 0),
	(36, 'WATSA', 6, 0),
	(37, 'ARU', 7, 0),
	(38, 'BUNIA VILLE', 7, 0),
	(39, 'DJUGU', 7, 0),
	(40, 'IRUMU', 7, 0),
	(41, 'MAHAGI', 7, 0),
	(42, 'MAMBASA', 7, 0),
	(43, 'DEKESE', 8, 0),
	(44, 'ILEBO', 8, 0),
	(45, 'TSHIKAPA', 8, 0),
	(46, 'LUEBO', 8, 0),
	(47, 'MWEKA', 8, 0),
	(48, 'TSHIKAPA VILLE', 8, 0),
	(49, 'DEMBA', 9, 0),
	(50, 'DIBAYA', 9, 0),
	(51, 'DIMBELENGE', 9, 0),
	(52, 'KANANGA-VILLE', 9, 0),
	(53, 'KAZUMBA', 9, 0),
	(54, 'LUIZA', 9, 0),
	(55, 'KABEYA-KAMWANGA', 10, 0),
	(56, 'KATANDA', 10, 0),
	(57, 'LUPATAPATA', 10, 0),
	(58, 'MBUJI-MAYI VILLE', 10, 0),
	(59, 'MIABI', 10, 0),
	(60, 'TSHILENGE', 10, 0),
	(61, 'KINSHASA I (LUKUNGA)', 5, 1),
	(62, 'KINSHASA II (FUNA)', 5, 1),
	(63, 'KINSHASA III (MONT-AMBA)', 5, 1),
	(64, 'KINSHASA IV (TSHANGU)', 5, 1),
	(65, 'BOMA VILLE', 11, 0),
	(66, 'KASANGULU', 11, 0),
	(67, 'KIMVULA', 11, 0),
	(68, 'LUKULA', 11, 0),
	(69, 'LUOZI', 11, 0),
	(70, 'MADIMBA', 11, 0),
	(71, 'MATADI VILLE', 11, 0),
	(72, 'MBANZA-NGUNGU', 11, 0),
	(73, 'MOANDA', 11, 0),
	(74, 'SEKE-BANZA', 11, 0),
	(75, 'SONGOLOLO', 11, 0),
	(76, 'TSHELA', 11, 0),
	(78, 'KAHEMBA', 12, 0),
	(79, 'KASONGO-LUNDA', 12, 0),
	(80, 'KENGE', 12, 0),
	(81, 'KENGE VILLE', 12, 0),
	(82, 'POPOKABAKA', 12, 0),
	(163, 'FARADJE', 6, 0),
	(164, 'FESHI', 12, 1),
	(167, 'KABINDA VILLE', 14, 0),
	(168, 'DILOLO', 15, 0),
	(169, 'KAPANGA', 15, 0),
	(170, 'KOLWEZI VILLE', 15, 0),
	(171, 'LUBUDI', 15, 0),
	(172, 'MUTSHATSHA', 15, 0),
	(173, 'SANDOA', 15, 0),
	(175, 'INONGO', 16, 1),
	(176, 'INONGO VILLE', 16, 0),
	(177, 'KIRI', 16, 0),
	(178, 'KUTU', 16, 0),
	(179, 'KWAMOUTH', 16, 0),
	(180, 'MUSHIE', 16, 0),
	(181, 'OSHWE', 16, 0),
	(182, 'YUMBI', 16, 0),
	(184, 'KAILO', 17, 0),
	(185, 'KASONGO', 17, 0),
	(186, 'KIBOMBO', 17, 0),
	(187, 'KINDU VILLE', 17, 0),
	(190, 'BOLOBO', 16, 0),
	(191, 'KABAMBARE', 17, 0),
	(192, 'LUBUTU', 17, 0),
	(193, 'BONGANDANGA', 18, 0),
	(194, 'BUMBA', 18, 0),
	(195, 'LISALA VILLE', 18, 0),
	(196, 'LISALA', 18, 0),
	(197, 'BENI', 19, 0),
	(198, 'BENI VILLE', 19, 0),
	(199, 'BUTEMBO VILLE', 19, 0),
	(200, 'GOMA VILLE', 19, 0),
	(202, 'MASISI', 19, 0),
	(203, 'NYIRAGONGO', 19, 0),
	(204, 'RUTSHURU', 19, 0),
	(205, 'WALIKALE', 19, 0),
	(206, 'BOSOBOLO', 20, 0),
	(207, 'BUSINGA', 20, 0),
	(208, 'GBADOLITE VILLE', 20, 0),
	(209, 'MOBAYI-MBONGO', 20, 0),
	(210, 'YAKOMA', 20, 0),
	(211, 'KATAKO-KOMBE', 21, 0),
	(212, 'KOLE', 21, 0),
	(213, 'LODJA', 21, 0),
	(214, 'LOMELA', 21, 0),
	(215, 'LUBEFU', 21, 0),
	(216, 'LUSAMBO VILLE', 21, 0),
	(217, 'LUSAMBO', 21, 0),
	(218, 'BUKAVU VILLE', 22, 0),
	(219, 'FIZI', 22, 0),
	(220, 'IDJWI', 22, 0),
	(221, 'KABARE', 22, 0),
	(222, 'KALEHE', 22, 0),
	(223, 'MWENGA', 22, 0),
	(224, 'SHABUNDA', 22, 0),
	(225, 'UVIRA', 22, 0),
	(226, 'WALUNGU', 22, 0),
	(227, 'BUDJALA', 23, 0),
	(228, 'GEMENA VILLE', 23, 0),
	(229, 'GEMENA', 23, 0),
	(230, 'KUNGU', 23, 0),
	(231, 'LIBENGE', 23, 0),
	(232, 'ZONGO VILE', 23, 0),
	(233, 'KABALO', 24, 1),
	(234, 'KALEMIE VILLE', 24, 1),
	(235, 'KALEMIE', 24, 1),
	(236, 'KONGOLO', 24, 1),
	(237, 'MANONO', 24, 1),
	(238, 'MOBA', 24, 1),
	(239, 'NYUNZU', 24, 1),
	(240, 'BAFWASENDE', 25, 1),
	(241, 'BANALIA', 25, 1),
	(242, 'BASOKO', 25, 1),
	(243, 'ISANGI', 25, 1),
	(244, 'KISANGANI VILLE', 25, 1),
	(245, 'OPALA', 25, 1),
	(246, 'UBUNDU', 25, 1),
	(247, 'YAHUMA', 25, 1),
	(248, 'BEFALE', 26, 1),
	(249, 'BOENDE VILLE', 26, 1),
	(250, 'BOENDE', 26, 1),
	(251, 'BOKUNGU', 26, 1),
	(252, 'DJOLU', 26, 1),
	(253, 'IKELA', 26, 1),
	(254, 'MONKOTO', 26, 1),
	(255, 'BAGATA', 13, 1),
	(256, 'BANDUNDU VILLE', 13, 1),
	(257, 'BULUNGU', 13, 1),
	(258, 'GUNGU', 13, 0),
	(259, 'IDIOFA', 13, 0),
	(260, 'KIKWIT VILLE', 13, 0),
	(261, 'MASI-MANIMBA', 13, 0),
	(263, 'KABINDA', 14, 0),
	(264, 'KAMIJI', 14, 0),
	(265, 'LUBAO', 14, 0),
	(266, 'LUILU', 14, 0),
	(267, 'MWENE-DITU VILLE', 14, 0),
	(268, 'NGANDAJIKA', 14, 0),
	(269, 'PANGI', 17, 0),
	(270, 'PUNIA', 17, 0),
	(271, 'LUBERO', 19, 0);

-- Listage de la structure de table isp_gombe. types_of_studies
CREATE TABLE IF NOT EXISTS `types_of_studies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.types_of_studies : ~2 rows (environ)
INSERT INTO `types_of_studies` (`id`, `name`, `color`, `created_at`, `updated_at`) VALUES
	(1, 'Type A', '#af3c3c', '2024-06-03 02:27:08', '2024-06-03 02:27:08'),
	(2, 'Type B', '#0e0101', '2024-06-03 02:27:24', '2024-06-03 02:27:24');

-- Listage de la structure de table isp_gombe. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table isp_gombe.user : ~3 rows (environ)
INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
	(2, 'admin@onem.cd', '["ROLE_USER","ROLE_ADMIN"]', '$2y$13$vqwbfE.uMkREI9JNg5e85OUjd8hLU9v/7qTISzXJdD9GiGbo0QZJ.'),
	(3, 'ushindimupikano@gmail.com', '[]', '$2y$13$qHQFSeYh7XNYucRiwQQk1Ol2hkbFzWjWny7gJQxIF53cU9SF7bEJi'),
	(6, 'test@onem.cd', '["ROLE_ADMIN","ROLE_USER"]', '$2y$13$VVATO/4dcX0/1CEI4C.YGu27M4GhODhVUkTXvr3Tx5B2bg6bwq7kS');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
