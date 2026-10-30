-- Base complète ISP-GOMBE — restauration initiale
-- Générée à partir de l’export fourni, avec les réglages du CMS ajoutés.
-- À exécuter UNE SEULE FOIS dans MySQL/MariaDB, dans une installation vide.
-- Cette restauration contient les données personnelles et comptes présents dans l’export d’origine.
CREATE DATABASE IF NOT EXISTS `ispgombe` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `ispgombe`;
-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 28 oct. 2026 à 03:32
-- Version du serveur : 11.4.10-MariaDB-cll-lve
-- Version de PHP : 8.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données locale : `ispgombe`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

CREATE TABLE `activite` (
  `id_act` int(11) NOT NULL,
  `titre` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `categorie` int(11) DEFAULT NULL,
  `id_adm` int(11) DEFAULT NULL,
  `date_pub` datetime DEFAULT NULL,
  `etat_depot` int(11) DEFAULT 0,
  `etat_modifier` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `activite`
--

INSERT INTO `activite` (`id_act`, `titre`, `description`, `photo`, `categorie`, `id_adm`, `date_pub`, `etat_depot`, `etat_modifier`) VALUES
(1, 'ISP-GOMBE : Un Pool d’Intelligence au Rayonnement national et International en RDC. L’acte se lie à la Parole, Et la Professeure Emilienne AKONGA EDUMBE se distingue.', 'L’organisation des Enseignements\r\nActuellement les unités d’enseignement à l’ISP-GOMBE s’articulent autour des grandes sections. On peut citer la Section Lettres et Sciences Humaines avec Quatre Départements ; la Section Sciences Exactes avec deux Départements ; la Section Sciences Commerciales et Administratives et informatique avec deux Départements ; la Section Sciences et Techniques d’Accueil avec également ses deux Départements ; on y adjoint la Bibliothèque et le Centre de Recherche Scientifique, d’Edition et de Diffusion des Documents Pédagogique (CRESEDIP).\r\n\r\nIl convient de préciser que l’ISP-GOMBE met chaque année sur le marché d’emploi plus de deux mille diplômés dont les futurs enseignants, les Administrateurs, les Gestionnaires, les informaticiens et les gestionnaires des entreprises touristiques et\r\nHôtelières, bien formés car c’est ici l’occasion de le souligner, l’ISP-GOMBE est compté parmi les rares institutions publiques d’enseignement supérieur où les valeurs ont encore leur place.\r\n\r\nDans le même ordre d’idée et pour mettre en évidence la marque de distinction de l’actuel comité de gestion, l’ISP-GOMBE a été choisi depuis février 2014, parmi toutes les institutions d’enseignement supérieur de la RD Congo pour abriter le centre d’enseignement à distance et en ligne de l’Université Virtuelle Africaine (e-Learning UVA). Ce centre facilite l’accès à l’enseignement supérieur de haute portée et à la formation continue en Afrique touchant un nombre importants d’étudiants et professionnels. Il facilite également l’accès à des ressources de Formation Ouverte\r\nà Distance et d’Elearning (FOADeL) qui sont utiles à l’Afrique et encore plus à la RDC. En outre ce Centre permet d’Améliorer les capacités de l’ISP-GOMBE en enseignement supérieur, d’effectuer des activités de recherche sans peine, d’augmenter le nombre d’enseignants maîtrisant les TIC et de promouvoir la mobilité des enseignants au niveau régional.\r\n\r\nLes Réalisations et Innovations du Comité Emilienne AKONGA\r\nAprès sa nomination à la tête de l’ISP-GOMBE, Akonga Emilienne, Directrice Générale de cet établissement public d’enseignement supérieur a mis sur pieds un plan stratégique d’urgence pour faire de l’ISP un pool d’intelligence au rayonnement national et international. Ce plan contient plus de 16 ambitieux projets pour installer la culture de l’excellence car dit-', 'avs_0_act.jpg', NULL, 1, '2025-02-24 20:27:04', 0, 1),
(2, 'ISP-GOMBE : Un Pool d’Intelligence au Rayonnement national et International en RDC. L’acte se lie à la Parole, Et la Professeure Emilienne AKONGA EDUMBE se distingue.', '« Nous pensons que la formation de l’excellence ne peut être possible que par un changement des comportements et des mentalités, ainsi qu’une mobilisation d’ensemble pour un travail de qualité ». Elle a pour ce faire institué 8 commissions permanentes et une Direction d’audit interne pour s’assurer de l’aboutissement et de la réussite de tous ces projets.\r\n\r\nLa bonne nouvelle à ce stade c’est que bon nombre de ces projets sont passés de l’abstrait au concret. Il s’agit de :\r\n- La maîtrise de l’état des lieux de l’Institution, au terme des consultations générales ; - La mise en place d’une Direction de l’Audit Interne ; - La mise en place de nouvelles autorités décanales qui a permis de donner une nouvelle ligne de conduite et un nouveau dynamisme; - La mise en place de la commission chargée de l’élaboration du plan stratégique de l’ISP-GOMBE ; - L’acquisition d’un équipement approprié pour l’Informatisation de la gestion administrative; - L’achat et l’installation, pour la première fois, depuis des décennies, des citernes qui permettent la desserte en eau des douches et des toilettes des pensionnaires du Home Sebyera;\r\nle rafraîchissement des murs du Home Détienne et du Centre de Santé ; - La réfection et le remplacement des portes de l’amphithéâtre; - L’aménagement d’une salle de travail pour le Personnel académique; - L’aménagement de la Bibliothèque; - La réparation des toitures de deux laboratoires de chimie et de biologie; - L’embellissement de la Clôture de l’ISP/Gombe; - L’aménagement d’une salle d’attente.\r\n\r\nIl faut également noter que dans le cadre de l’ouverture au monde extérieur, plusieurs partenariats ont été signés entre l’ISP d’Emilienne Akonga et plusieurs universités dans le monde où elle est maître de plusieurs conférences. L’ISP-GOMBE par l’entremise de la professeure Akonga Edumbe vend valablement auprès des tierces partout dans le monde, l’image de l’université congolaise sur plusieurs plates-formes régionales et internationales.\r\nConsidérant sa situation géographique, l’ISP-GOMBE sert aujourd’hui comme l’avait prédit sa Directrice Générale, de vitrine et de modèle de modernisation\r\ninstitutions publiques de l’Enseignement Supérieur et Universitaire, conformément à la vision salvatrice du Chef de l’Etat.\r\n\r\nPar ailleurs, quelques défis demeurent présents pour concrétiser à 100% le rêve d’Emilienne Akonga. Elle tient à court et à moyen terme à rendre opérationnel le centre entrepreneurial, incubateur d’emplois par excellence ; Disposer de son laboratoire d’analyse biomédicale ; Disposer de ses unités de transformation et conservation des aliments ainsi que de fabrication de vins ; Augmenter son potentiel logistique et ses infrastructures tant d’enseignements que d’appui à l’enseignement, conformément aux standards internationaux ; Poursuivre l’ouverture de l’institution au monde tant scientifique que professionnel par la signature des partenariats avec d’autres institutions, des entreprises et organismes de développement ; Finaliser le dossier de réouverture du troisième cycle ; S’inscrire dans la démarche du gouvernement pour la réforme du système éducatif et le pari sera totalement gagné.', 'avs_1_act.jpg', NULL, 1, '2025-02-24 20:28:36', 0, 1),
(3, 'En réalité ce que nous sommes est plus éloquent que ce que nous clamons, Et nos œuvres constituent le meilleur reflet de nos valeurs intrinsèques ;', 'En réalité ce que nous sommes est plus éloquent que ce que nous clamons, Et nos œuvres constituent le meilleur reflet de nos valeurs intrinsèques ; il est donc certain d\'affirmer que toute institution est généralement une expression de ce qu\'est en réalité son animateur car dit-on, la plus belle fille du monde ne donne que ce qu\'elle a. Cette logique nous amène de prime abord à nous appesantir tant soit peu sur la professeure AKONGA EDUMBE Emilienne, l\'actuelle Directrice Générale qui préside à la destinée de l\'ISP-GOMBE, dans le but de nous faire une idée claire et distincte sur les arcanes qui sous-tendent sa distinction, bien avant de creuser le vif.\r\n\r\nSon Profil\r\nEmilienne AKONGA EDUMBE,\r\nDocteur en philosophie et lettres option langues et littératures des Facultés de Saint Louis de Bruxelles avec une thèse sur l\'écrivain belge Henry Bauchau.\r\nDirectrice Générale de l\'Institut Supérieur Pédagogique de la Gombe à Kinshasa (RDC)\r\nProfesseur des questions spéciales de littératures francophones, de la Méthodologie Spéciale du Français et de techniques et méthodes de recherche en littérature.\r\n\r\nEn collaboration avec les Archives et Musée de la Littérature (de Bruxelles), elle coordonne en RDC le projet intitulé « Pour la constitution de la mémoire historique de l’Afrique Centrale à partir de la Littérature » dont la première anthologie des Grands lacs est sous presse.\r\n\r\nSon profil de dirigeante caractérisée par l’esprit d’innovation, de la réforme et de créativité en vue de l’intégration de l’Institution au Standard international se lit à travers les projets de développement de l’ISP/Gombe qu’elle a initié pour les 4 années à venir.\r\n\r\nPetite Historique sur l’ISP-GOMBE\r\nL’Institut Supérieur Pédagogique de la Gombe (ISP-GOMBE) est un établissement d’Enseignement Supérieur et Universitaire, installé en pleine Capitale de la RDC dont la création remonte à 1961, fondée par la Sœur Marie de Terwagne de la congrégation des Religieuses du Sacré-Cœur pour l’éducation de la jeune fille Congolaise, sous la dénomination d’Ecole Normale Moyenne (ENM).\r\n\r\nTrois ans après soit en 1963 les premiers finalistes obtinrent leurs diplômes d’agrégation. Au départ cet établissement fonctionnait dans les bâtiments du Lycée Sacré-Cœur jusqu’en 1972, l’année où, grâce au financement du Fonds Européen de Développement l’actuelle Union Européenne, il a acquis les actuelles installations sises au N°2, Avenue Père BOKA, Commune de la GOMBE, à KINSHASA en RDC. L’ENM avait ouvert ses portes avec une seule section de Régendat qui devint par la suite le Graduat de Français-histoire, et en suite plusieurs autres options telles que l’actuelle Géographie et sciences naturelles, Français-Histoire, et Histoire-Culture Africaine.\r\n\r\nL’option Coupe et Couture a été également ouverte mais au regard de nombre d’étudiantes qui y affluaient, en 1972, elle fut détachée de l’ENM pour créer l’actuel Institut Supérieur des Arts et des Métiers (ISAM) qui est considérait comme la fille ainée de l’ISP-GOMBE. Depuis les années 70 l’ISP-GOMBE formait déjà des enseignants et des hauts cadres du Pays dans les 5 Départements suivants : Français-Linguistique Africaine, Anglais Culture Africaine, Histoire-Sciences Sociales, Géographie Sciences Naturelles et Biologie-Chimie.\r\nVoilà pour la petite histoire.', 'avs_2_act.jpg', NULL, 1, '2025-02-24 20:29:35', 0, 1),
(4, 'Formation du Personnel Académique, Scientifique et Administratif de l&#039;ISP/GOMBE en prévision de l&#039;arrimage au Système LMD', 'En prévision de l’arrimage au Système LMD : les Membres du Personnel Académique, Scientifique et Administratif de l’ISP/GOMBE outillés en Nouvelles Technologies de l’Information et de la Communication.\r\n\r\nDès la rentrée académique 2019-2020, les filières des Sciences Exactes de l’Institut Supérieur Pédagogique de la Gombe basculeront vers le Système LMD (Licence-Maitrise-Doctorat), point de chute du processus amorcé par le PEQPESU (Projet d’Education pour la Qualité et la Pertinence des Enseignements aux Niveaux Secondaire et Universitaire).\r\nAnnonce faite par la Directrice Générale de l’ISP/GOMBE, Professeure Emilienne AKONGA EDUMBE, à l’occasion de la double cérémonie de Collation des grades académiques et de Clôture de l’année académique 2018-2019 tenue le mercredi 31 juillet 2019 à l’amphithéâtre de cet Etablissement d’Enseignement Supérieur et Universitaire.\r\n\r\nEn prévision de cet arrimage au Système LMD, plusieurs Membres des Corps Académique, Scientifique et Administratif de l’ISP/GOMBE sont outillés en Nouvelles Technologies de l’Information et de la Communication (NTIC), à travers une session de formation dispensée à l’Université Virtuelle Africaine (UVA/ISP-GOMBE).\r\n\r\nDébutée le lundi 12 août 2019, ladite formation est assurée par le Professeur MUNDALA de l’Université de Kinshasa. Ce dernier est assisté par monsieur Yves BIKUNDI, Expert de l’UVA (Université Virtuelle Africaine) et 4 membres du Département de l’Informatique de l’Institut Supérieur Pédagogique de la Gombe.', 'avs_3_act.jpg', NULL, 1, '2025-02-24 20:30:46', 0, 1),
(5, 'ISP-GOMBE d’Emilienne AKONGA EDUMBE, ETABLISSEMENT PILOTE DES INSTITUTS', 'Du pôle d’excellence, au centre de rayonnement et d’amélioration du système éducatif national, Professeure Emilienne AKONGA EDUMBE poursuit à l’ISP/Gombe la concrétisation d’un programme salutaire au secteur de l’enseignement supérieur et universitaire de la République Démocratique du Congo, conformément à la stratégie sectorielle de l’éducation de la formation 2016-2025 du Gouvernement de la République. Selon cette stratégie, le Gouvernement de la RDC s’est engagé de faire du pays un pool d’excellence d’ici l’horizon 2030. Il revient donc à chaque acteur et responsable du secteur d’assumer sa responsabilité.\r\nNotre livraison précédente a communiqué sa vision et quelques réalisations à son actif au terme de sa seconde année d’un mandat prolifique.\r\nLe rayonnement de l’ISP/Gombe au niveau tant national qu’international, justifié par les projets de développement dans tous les aspects du fonctionnement d’un Etablissement d’enseignement et les commissions permanentes qui accompagnent sa mise en œuvre, continue à susciter l’attention de notre rédaction et de tout celui qui s’intéresse de plus près au développement et la réforme du système éducatif de la RDC.\r\nCap sur le renversement du RATIO d’encadrement scientifique.\r\nL’UNESCO a fixé un seuil de 18 à 20 apprenants à encadrer par un personnel académique. Compte tenu des difficultés d’organisation de la formation du cycle, cette pyramide est toujours renversée.\r\n\r\nDans le cadre de la Stratégie Sectorielle de l’Education et la formation (SSEF), p.13 dans l’axe de l’amélioration de la qualité des apprentissages, en ce qui concerne l’enseignement supérieur et universitaire, le Gouvernement préconise que les « objectifs visés portent sur la promotion de l’Excellence, le renforcement des capacités de pilotage, le recours au partenariat impliquant l’administration centrale, les entités administratives décentralisées, le secteur privé et les partenaires techniques et financiers. L’ouverture au monde et aux technologies modernes et l’adhésion et la participation des bénéficiaires et des acteurs du changement. Ceci se fera par l’amélioration de la gouvernance du sous-secteur [entendez l’Enseignement Supérieur], de la qualité de la formation, d’une meilleure adéquation de l’offre avec les besoins, de la mise au point des plans stratégiques annuels dans les établissements, le recours aux TIC, à l’enseignement ouverts à distance, à la mise en œuvre progressive du système LMD, du renforcement de la recherche, du renforcement des liens, les facultés de sciences de l’éducation, les Instituts Supérieurs Pédagogiques, les Instituts Supérieurs\r\n\r\nPédagogiques Techniques et les Ministères impliqués … ».\r\n\r\nDepuis sa création, l’ISP/Gombe n’a pas accompli sa noble mission de mener des recherches approfondies en pédagogie appliquée afin de proposer des réformes et produire des manuels scolaires adaptés aux réalités du pays et à l’évolution du monde.', 'avs_4_act.jpg', NULL, 1, '2025-02-24 20:32:14', 0, 1),
(6, 'EN BEAUTE, L’ISP-GOMBE A RESERVE UNE FIN HEUREUSE A L’ANNEE ACADEMIQUE 2017-2018', 'Après avoir déjoué avec dextérité et de fort belle manière tous les pronostics qui présageaient insurrections et autres soulèvements de tout bord avec susceptibilité d’imposer une éventuelle année blanche, la Professeure Emilienne AKONGA EDUMBE, Directrice Générale de l’Institut Supérieur Pédagogique de la Gombe (ISP-Gombe) et son Comité de Gestion ont clôturé ce mardi 31 juillet 2018 dans une cérémonie haute en couleur de collation des grades académiques, la très agitée année académique susmentionnée.\r\nDans son discours statutaire de clôture de l’année académique, la Directrice Générale de l’ISP-Gombe procède par paliers pour passer en revue l’année académique 2017-2018 et faire des projections pour l’année académique prochaine.\r\n\r\nAu chapitre des félicitations, elle stipule : « Pour tant d’efforts fournis et sacrifices consentis pour non seulement terminer, mais aussi et surtout réussir en 1ère session, les voix des membres du comité de gestion se joignent à la mienne pour dire bravo et Coup de chapeau à ceux qui se sont distingués ;\r\nTous nos encouragements à ceux qui ont encore des épreuves à présenter en septembre.\r\nS’agissant de l’aboutissement heureux de cette année Académique, la Directrice Générale de l’ISP de la Gombe précise, « La réussite de cette année est due : au respect du calendrier académique (ouverture le 15 octobre 2017 et fermeture le 31 juillet 2018); à l’engagement et la détermination du Comité de Gestion pour un travail de qualité et d’excellence; au résultat d’une parfaite collaboration entre autorités académiques, décanales, enseignants, administratifs et collaborateurs ; ainsi qu’à la franche et permanente collaboration au sein de l’établissement ».', 'avs_5_act.jpg', NULL, 1, '2025-02-24 20:33:14', 0, 1),
(7, 'ESU : présentation officielle de la ministre Marie- Thérèse SOMBO à la communauté de l&#039;ESU, ce mardi 09 juillet à l&#039;amphithéâtre de l&#039;ISP/GOMBE', 'Nommée le 28 mai 2024 par ordonnance présidentielle, la ministre de l\'Enseignement supérieur et universitaire, Professeure Docteur, Marie - Thérèse SOMBO a été présentée officiellement ce mardi 09 juillet, à la communauté de l\'ESU, dans l\'amphithéâtre de l\'isp Gombe, présentation faite par le Secrétaire général de l\'esu, Monsieur, ILOSYO IMONANO Pacifique en présence des différents directeurs centraux, directeurs généraux et recteurs des établissements de l\'esu, Membres Comités de gestion, ainsi les différents présidents des coordinations estudiantines de Kinshasa.\r\n\r\nPrenant la parole en premier lieu, la directrice générale de l\'Institut supérieur pédagogique de la Gombe, ISP Gombe, professeure GERTRUDE EKOMBE EKOFO, félicite le Président de la République Félix Antoine TSHISEKEDI, champion de la masculinité positive, d\'avoir nommer pour la première fois une femme à la tête de grand ministre, qui cadre avec sa vision, celle d\'investir dans l\'homme pour un développement intégral du pays, avant d\'assurer à la ministre de l\'ESU, leur tutelle de mettre en application toutes ses instructions et orientations.\r\n\r\n\" Je remercie le chef de l\'Etat et la première d\'avoir porté leur choix à ma modeste personne comme ministre de l\'ESU du gouvernement SUMINWA, j\'évite les chefs d\'établissement au respect des instructions académiques, harmonisation des frais académiques, aux mesures d\'encadrement d\'un système LMD, à l\'autoévaluation, à l\'assurance maladie des agents et cadres.\r\n\r\nJ\'interpelle tous les chefs d\'établissement qui cèdent les portions de leurs concessions à la location de cesser avec cette pratique car j\'y serai catégorique. \" insiste la ministre de l\'ESU.\r\n\r\nC\'est dans une ambiance bon enfant que les chefs d\'établissement et les directeurs centraux de l\'ESU ont accueilli leur cheffe directe.', 'avs_6_act.jpg', NULL, 1, '2025-02-24 20:34:14', 0, 1),
(8, 'Tête à tête entre la ministre de l&#039;ESU et la DG de ISP - Gombe', 'A l\'occasion de la toute première apparition de la nouvelle patronne de l\'Enseignement Supérieur et Universitaire en République Démocratique de Congo à l\'amphithéâtre de l\'Institut Supérieur Pédagogique de la Gombe, La ministre de l\'ESU a eu un tête avec la DG de l\'ISP - Gombe', 'avs_7_act.jpeg', NULL, 1, '2025-02-24 20:35:19', 0, 1),
(9, 'La nouvelle patronne de l&#039;ESU félicite l&#039;Administrateur de Budget de l&#039;ISP - Gombe', 'La nouvelle patronne de l\'Enseignement Supérieur et Universitaire en République Démocratique de Congo, la professeure Docteur, Marie - Thérèse SOMBO a tenu à féliciter l\'Administrateur de budget de l\'ISP - Gombe, le Chef de travaux Célestin TONDI pour le sérieux et travail abattu à l\'Institut Supérieur Pédagogique de la Gombe.', 'avs_8_act.jpeg', NULL, 1, '2025-02-24 20:36:20', 0, 1),
(10, 'Cérémonie solennelle d&#039;hommages en mémoire, de Mademoiselle Marie-Thérèse KNAPEN', 'Le Comité de gestion de l&#039;ISP/ GOMBE que dirige la Professeure GERTRUDE EKOMBE  EKOFO, en présence du Directeur de cabinet adjoint de la Ministre de l&#039;ESU, a organisé dans le cadre du mois de la femme, une cérémonie solennelle d&#039;hommages en mémoire, de Mademoiselle Marie-Thérèse KNAPEN , la 2 -ème Directrice Générale de cet alma mater, décédée en février 2025 en Belgique, sous le thème : &quot; La femme au centre de toutes les ambitions &quot;, cérémonie ponctuée par une messe d&#039;action de grâce, agrémentée par l&#039;Orchestre&quot; Marie mère du Rédempteur &quot;, du président Célestin Tondi.\r\n\r\nUne visite des différents stands des œuvres des femmes a clôturé cette cérémonie.', 'avs_9_act.jpg', NULL, 1, '2025-04-05 19:59:48', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_adm` int(11) NOT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `niveau` int(11) DEFAULT 7,
  `confirmer` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_adm`, `pseudo`, `mail`, `password`, `niveau`, `confirmer`) VALUES
(1, 'sys-top', 'mcben0088@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `agent_dep`
--

CREATE TABLE `agent_dep` (
  `id` int(10) NOT NULL,
  `noms` varchar(150) DEFAULT NULL,
  `telephone` varchar(150) DEFAULT NULL,
  `grade` varchar(150) DEFAULT NULL,
  `domaine` varchar(150) DEFAULT NULL,
  `mail` varchar(150) DEFAULT NULL,
  `photo` varchar(150) DEFAULT NULL,
  `departement` int(10) DEFAULT NULL,
  `valider` int(10) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `agent_dep`
--

INSERT INTO `agent_dep` (`id`, `noms`, `telephone`, `grade`, `domaine`, `mail`, `photo`, `departement`, `valider`) VALUES
(2, 'MBIYA MPOYI Guy-Patient', '+243 (82) 2 358 732', 'Dr.', 'Internet des Objets (IdO)', 'pambiya@gmail.com', 'MBIYA MPOYI Guy_0.png', 11, 1),
(4, 'MWINKEU KAT Christelle', '+243 (82) 2 358 732', 'CT', 'Conception de système d‘information ', 'contact@ispgombe.ac.cd', 'CT MWINKEU KAT Christelle_1.jpg', 11, 1),
(5, 'MUTAPAY Remy', '+243 (82) 2 358 732', 'Dr.', 'X', 'contact@ispgombe.ac.cd', 'MUTAPAY Remy_2.jpg', 11, 1),
(6, 'FERAZA Élysée ', '+243 (82) 2 358 732', 'CT', 'Conception de système d‘information ', 'contact@ispgombe.ac.cd', 'FERAZA Élysée _3.jpg', 11, 1),
(7, 'EKOTO Yanniv ', '+243 (82) 2 358 732', 'ASS', 'Conception de système d‘information ', 'contact@ispgombe.ac.cd', 'EKOTO Yanniv _4.jpg', 11, 1),
(8, 'KINDUKULU Rucien', '+243 (82) 2 358 732', 'ASS', 'Conception de système d‘information ', 'contact@ispgombe.ac.cd', 'KINDUKULU Rucien_5.jpg', 11, 1),
(9, 'KABAMBA NTUMBA David ', '+243 (82) 2 358 732', 'ASS', 'Conception de système d‘information ', 'contact@ispgombe.ac.cd', 'KABAMBA NTUMBA David _6.jpg', 11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `annee`
--

CREATE TABLE `annee` (
  `id` int(11) NOT NULL,
  `intitule` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `id` int(11) NOT NULL,
  `resumer` text DEFAULT NULL,
  `faculte` int(11) DEFAULT NULL,
  `departement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id`, `resumer`, `faculte`, `departement`) VALUES
(2, 'Il est demandé à toutes les mamans du Département d&#039;Informatique de se présenter ce SAMEDI 22 MARS 2025 à l&#039;ISP/GOMBE à 08H habillée en MPAGNE DU 08 MARS. N.B: - La présence de toutes les femmes est obligatoire - Les hommes sont également invités mais leur présence n&#039;est pas obligatoire. merci', NULL, 11);

-- --------------------------------------------------------

--
-- Structure de la table `campus`
--

CREATE TABLE `campus` (
  `id_act` int(11) NOT NULL,
  `titre` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `categorie` int(11) DEFAULT NULL,
  `id_adm` int(11) DEFAULT NULL,
  `date_pub` datetime DEFAULT NULL,
  `etat_depot` int(11) DEFAULT 0,
  `etat_modifier` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `communique`
--

CREATE TABLE `communique` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `contenu` text DEFAULT NULL,
  `datepub` datetime DEFAULT NULL,
  `promotion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` longtext NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  KEY `idx_contact_read_state_id` (`is_read`, `id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'Qui-vive Kusakana', 'contact@usakin.ac.cd', 'SALUTATION', 'Tu dois utiliser PHP avec PDO et la fonction mail() ou une bibliothèque comme PHPMailer pour envoyer des emails depuis ton serveur. Voici comment modifier ton code pour envoyer l&#039;email en PHP au lieu d&#039;utiliser mailto:.<br />\r\n<br />\r\nÉtapes :<br />\r\nModifier ton formulaire pour envoyer les données via POST à un script PHP (send_email.php).<br />\r\nCréer le fichier send_email.php pour envoyer l&#039;email en utilisant PHP et PDO.'),
(2, 'Erick', 'erick25bukasa@gmail.com', 'Frais', 'Bonjour <br />\r\nJe me permets de vous contacter afin d’obtenir des informations concernant les frais de ma fille  Plamedie kamuanya malengela en L1pour la section Accueil Protocole et Relations Publiques pour l’année 2025.<br />\r\n<br />\r\nÉtant actuellement à l’étranger, je souhaiterais également connaître les modalités de paiement disponibles pour régler ces frais à distance. Pourriez-vous m’indiquer les options de paiement acceptées (virement bancaire international, carte de crédit, plateformes en ligne, etc.) ainsi que les éventuelles références nécessaires pour effectuer le paiement correctement ?<br />\r\n<br />\r\nJe vous remercie par avance pour votre aide et reste disponible pour toute information complémentaire.<br />\r\n<br />\r\nDans l’attente de votre retour, veuillez agréer, [Madame/Monsieur], mes salutations distinguées.'),
(3, 'BAZOLO', 'valeurtrois@gmail.com', 'Demande d&#039;informations', 'Bonsoir. Je suis à Brazzaville et j&#039;aimerais avoir des informations sur votre institut si vous formez des étudiants en physiologie de l&#039;effort. Si c&#039;est le cas alors quelles sont les conditions d&#039;admission, le montant des frais académiques, la période d&#039;inscription ou de concours'),
(4, 'Céline Mbombo', 'eilonga7@gmail.com', 'Demande de duplicata', 'Demande de duplicata'),
(5, 'Kévin', 'kevintshimankinda02@gmail.com', 'Demande d&#039;information concernant le troisième cycle', 'Bonjour,<br />\r\nJe suis le Chef de Travaux Kévin Mukenge, en poste à l&#039;ISC Tshikapa. Par ce message, je souhaite obtenir des informations sur l&#039;organisation du troisième cycle.<br />\r\nPourriez-vous me préciser les conditions générales ?'),
(6, 'Kévin', 'kevintshimankinda02@gmail.com', 'Demande d&#039;information concernant le troisième cycle', 'Bonjour,<br />\r\nJe suis le Chef de Travaux Kévin Mukenge, en poste à l&#039;ISC Tshikapa. Par ce message, je souhaite obtenir des informations sur l&#039;organisation du troisième cycle.<br />\r\nPourriez-vous me préciser les conditions générales ?'),
(7, 'NZITA FREDDY', 'freddynzita5@gmail.com', 'Demande de renseignement', 'Bonjour ISP/Gombe j&#039;aimerais me renseigner sur le Diplôme d&#039;Études Approfondies si vous organisez aussi cela, le montant de frais, période d&#039;inscription, et le vacation. Merci'),
(8, 'Damian Haight', 'haight.damian@yahoo.com', 'Embrace Change, Sustain Success!', 'Success today isn’t just about hard work—it’s about adaptability. Are you ready to thrive in a changing world?<br />\r\n<br />\r\n?? Sustaining Success in a Changing World: The Power of Adaptability is your guide to navigating uncertainty with confidence.<br />\r\n<br />\r\n?? Master adaptability to stay ahead<br />\r\n?? Build resilience to turn obstacles into opportunities<br />\r\n?? Gain actionable strategies for lasting success<br />\r\n<br />\r\nEquip yourself with the tools to turn change into growth.<br />\r\n<br />\r\n?? Get your copy now: https://rebrand.ly/qojm397<br />\r\n<br />\r\nBest,<br />\r\nTemmy'),
(9, 'Murielle', 'muriellemasengu@gmail.com', 'Comment s’inscrire', 'Comment s’inscrire'),
(10, 'Baelongani aombe héritier', 'baelonganiheritier@gmail.com', 'Pour devenir Utile dans la société. La performance à l&#039;informatique', 'Bonsoir cher professeur.vient à votre haute personnalité.je voulais connaître comment fonctionne isp Gombe ? Suis un nouveau étudiants pour la vacation soir faculté informatique de gestion.la date fixée pour le recrutement c&#039;est quand ?'),
(11, 'Baelongani aombe héritier', 'baelonganiheritier@gmail.com', 'Pour devenir Utile dans la société. La performance à l&#039;informatique', 'Bonsoir cher professeur.vient à votre haute personnalité.je voulais connaître comment fonctionne isp Gombe ? Suis un nouveau étudiants pour la vacation soir faculté informatique de gestion.la date fixée pour le recrutement c&#039;est quand ?'),
(12, 'Baelongani aombe héritier', 'baelonganiheritier@gmail.com', 'Pour devenir Utile dans la société. La performance à l&#039;informatique', 'Bonsoir cher professeur.vient à votre haute personnalité.je voulais connaître comment fonctionne isp Gombe ? Suis un nouveau étudiants pour la vacation soir faculté informatique de gestion.la date fixée pour le recrutement c&#039;est quand ?'),
(13, 'Baelongani aombe héritier', 'baelonganiheritier@gmail.com', 'Pour devenir Utile dans la société. La performance à l&#039;informatique', 'Bonsoir cher professeur je viens Au près de votre haute autorité pour solliciter un place pour parcours mon mode de vie universitaire'),
(14, 'Baelongani aombe héritier', 'baelonganiheritier@gmail.com', 'Pour devenir Utile dans la société. La performance à l&#039;informatique', 'Bonsoir cher professeur.vient à votre haute personnalité.je voulais connaître comment fonctionne isp Gombe ? Suis un nouveau étudiants pour la vacation soir faculté informatique de gestion.la date fixée pour le recrutement c&#039;est quand ?'),
(15, 'Lofongo', 'lofongob@hotmail.com', 'Demande des documents', 'Bonjour,<br />\r\nJe suis une ancienne de l’ISP/Gombe.Je cherche mes relevés de notes ainsi que mon rapport de stage.J’ai obtenu mon diplôme  en 1986 en lettres et sciences humaines et je me demande si je pourrais obtenir ces documents.Merci!'),
(16, 'Samy mbala', 'samymbala42@gmail.com', 'Savoir la date précise pour la rentrée académique 2025', 'Bonsoir.<br />\r\nNous voulons savoir la date de rentrée académique 2025'),
(17, 'Raissa  Tshisekedi', 'raycbak8496@gmail.com', 'Demande d’informations sur la non-publication des palmarès depuis 2018', 'Bonjour ISP Gombe,<br />\r\n<br />\r\nMadame, Monsieur,<br />\r\n<br />\r\nJe me permets de vous écrire afin de solliciter des informations concernant la publication des palmarès académiques de l’ISP Gombe. Il semble en effet qu’aucune publication officielle des résultats ou palmarès des étudiants n’ait été mise à disposition depuis l’année académique 2017–2018.<br />\r\n<br />\r\nPourriez-vous, s’il vous plaît, nous indiquer les raisons de ce retard et s’il est prévu une mise à jour ou une publication prochaine des résultats des années concernées ?<br />\r\n<br />\r\nEn vous remerciant par avance pour votre réponse et votre disponibilité.<br />\r\n<br />\r\nVeuillez recevoir, Madame, Monsieur, l’expression de mes salutations distinguées.'),
(18, 'MENDENGE NZAU PAPYTSHO', 'nevillenzau931@gmail.com', 'Système numérique', 'Je viens de passer au secrétariat général académique de l&#039;isp-gombe, ils ont d&#039;accord, deux lettres pour madame la directrice générale la professeure GERTRUDE ekombe ekofo et le secrétaire général académique le professeur Simon KATENDE KANUMUANGI. merci'),
(19, 'John', 'oevpapcp@formtest.guru', 'Hello', 'QFUKHg zLvol FHKIEkV HUxuxI irmf'),
(20, 'Kidiamboko mbuku', 'laurkiekidiamboko@gmail.com', 'Salutations, renseignements', 'Bonjour, je voudrais savoir combien coûte le duplicata, je voudrais référé le mien du graduat de 2009, et de la licence de 2013'),
(21, 'Katende', 'eliekatende@icloud.com', 'Inscription', 'Les inscriptions sont toujours en cours ?'),
(22, 'Katende', 'eliekatende@icloud.com', 'Inscription', 'Les inscriptions sont toujours en cours ?'),
(23, 'TestUser', 'sookintr@formtest.guru', 'John', 'cnOhlvy NGnwOsf dPPA GGlvnCJH vWYDI DQtG'),
(24, 'Omenu', 'Omenuokandjo41@gmail.com', 'Idée', 'problème vérification'),
(25, 'Damaris Kennedy', 'kennedy.damaris@hotmail.com', 'Change Mastery', 'Success today goes beyond hard work—it&#039;s about mastering adaptability. Sustaining Success in a Changing World: The Power of Adaptability offers practical strategies to help you thrive, build resilience, and turn uncertainty into opportunity. ?? Get your copy now: https://rebrand.ly/qojm397'),
(26, 'Muteba', 'chadrackmuteba067@gmail.com', 'Comment vous faisais pour l&#039;inscription de la G2', 'Bonjours comment vous faisais pour l&#039;inscription de la L2'),
(27, 'Kabedi', 'laurainekabedi21@icloud.com', 'Demande de contact – Professeur Gaston Piema Mikobi', 'Bonjour,<br />\r\n<br />\r\nJe suis une ancienne étudiante  de l’ISP Gombe, inscrite en Sciences commerciales et administratives, promotion 2020–2021.<br />\r\n<br />\r\nJe souhaiterais reprendre contact avec Monsieur Gaston Piema Mikobi, qui nous enseignait le cours d’éducation à la citoyenneté cette année-là.<br />\r\n<br />\r\nEst-ce possible d’obtenir ses coordonnées (téléphone ou email) ou de lui transmettre ma demande de contact ?<br />\r\n<br />\r\nJe vous remercie d’avance pour votre compréhension et votre aide ????<br />\r\n<br />\r\nCordialement,<br />\r\nLauraine KABEDI <br />\r\n0812992096'),
(28, 'Kabedi', 'laurainekabedi21@icloud.com', 'Demande de contact – Professeur Gaston Piema Mikobi', 'Bonjour,<br />\r\n<br />\r\nJe suis une ancienne étudiante  de l’ISP Gombe, inscrite en Sciences commerciales et administratives, promotion 2020–2021.<br />\r\n<br />\r\nJe souhaiterais reprendre contact avec Monsieur Gaston Piema Mikobi, qui nous enseignait le cours d’éducation à la citoyenneté cette année-là.<br />\r\n<br />\r\nEst-ce possible d’obtenir ses coordonnées (téléphone ou email) ou de lui transmettre ma demande de contact ?<br />\r\n<br />\r\nJe vous remercie d’avance pour votre compréhension et votre aide ????<br />\r\n<br />\r\nCordialement,<br />\r\nLauraine KABEDI <br />\r\n0812992096'),
(29, 'Lutumba Mbala', 'buvanelut03@gmail.com', 'Renseignement pour s’inscrire pour la vacation soir', 'Bonjour j’aimerais me renseigner pour s’inscrire pour la vacation soir, les modalités, les facultés etc'),
(30, 'Mbuyi Mputu Esther', 'bukasaesther09@gmail.com', 'Pour l&#039;inscription', 'Pour l&#039;inscription'),
(31, 'Nino Ntantu', 'Ntantu2601@gmail.com', 'Demande d&#039;inscription', 'Bonjour <br />\r\nVous allez bien <br />\r\nje voulais juste vous dire pour l&#039;inscription Comment je peux faire pour m&#039;inscrire et quel document je peux avoir pour m&#039;inscrire'),
(32, 'Joyrich olenga', 'joyricholenga02@gmail.com', 'Inscription', 'Je souhaite m&#039;inscrire pour l&#039;année 2026-2027 mais je ne trouve pas le site officiel d&#039;inscription'),
(33, 'Melvin Sumalbag', 'melvin.sumalbag@avvanz.com', '[Institut Supérieur de la Gombe – DR Congo] Contact Inquiry', 'Greetings!<br />\r\n <br />\r\n<br />\r\nI am Melvin Sumalbag from Avvanz - A Gold Medal awarded HRTech + FinTech company offering Background checks, new employee on boarding and Digital Economy centric training solutions.<br />\r\n<br />\r\n <br />\r\n<br />\r\nCurrently, we are conducting a pre-employment check for your former student as part of our client’s requirement.<br />\r\n<br />\r\n <br />\r\n<br />\r\nIn this regard, we would like to ask the contact details and/or email address of the Registrar’s Office / Student Records Department to whom we will be sending the verification request.<br />\r\n<br />\r\n <br />\r\n<br />\r\nYour response to this matter will be very much appreciated.'),
(34, 'Kholoma kilabi Huguette', 'huguettekilabi3@gmail.com', 'Demande de relevés de notes ou d&#039;attestation de réussite de G3', 'Bonjour cher Membres de l&#039;administration <br />\r\nJe suis madame kholoma kilabi Huguette,  finaliste en hôtellerie de l&#039;année 2023 section du soir , ayant payé tous mes frais académiques;<br />\r\nCependant je souhaite recevoir mes relevés de cotes  ou au mieux mon attestation de réussite de la dernière année. <br />\r\nCordialement'),
(35, 'Joanna Riggs', 'joannariggs3@gmail.com', 'Boosting engagement on ispgombe.ac.cd', 'Hi,<br />\r\n<br />\r\nI just visited ispgombe.ac.cd and wondered if you&#039;ve ever considered an impactful video to advertise your business? Our videos can generate impressive results on both your website and across social media.<br />\r\n<br />\r\nOur prices start from just $195 (USD).<br />\r\n<br />\r\nLet me know if you&#039;re interested in seeing samples of our previous work.<br />\r\n<br />\r\nRegards,<br />\r\nJoanna'),
(36, 'Jenovic kashala', 'kashalajenovic26@gmail.com', 'La rentrée académique ce quand', 'La rentrée académique ce quand?'),
(37, 'David Pavel', 'david@domainlions.net', 'jmmlab.com', 'Hello jmmlab.org Team,<br />\r\n<br />\r\nI am reaching out to inform the owners of jmmlab.org that the domain jmmlab.com is now available for purchase. If you are interested in acquiring this domain, please follow the link below to get more information and express your interest.<br />\r\n<br />\r\nhttps://domainlions.net/domains/jmmlab.com?id=1rpq<br />\r\n<br />\r\nYou can find more information about this domain on our website, and if you have any questions or need assistance, please don&#039;t hesitate to reply to this email.<br />\r\n<br />\r\nBest regards,<br />\r\nDavid Pavel<br />\r\n<br />\r\n--<br />\r\nDomain Lions LLC<br />\r\nT: +1 559 316 5695'),
(38, 'Melvin Sumalbag', 'melvin.sumalbag@avvanz.com', '[Institut Supérieur de la Gombe – DR Congo] Contact Inquiry for Education Verification', 'Greetings!<br />\r\n <br />\r\n<br />\r\nI am Melvin Sumalbag from Avvanz - A Gold Medal awarded HRTech + FinTech company offering Background checks, new employee on boarding and Digital Economy centric training solutions.<br />\r\n<br />\r\n <br />\r\n<br />\r\nCurrently, we are conducting a pre-employment check for your former student as part of our client’s requirement.<br />\r\n<br />\r\n <br />\r\n<br />\r\nIn this regard, we would like to ask the contact details and/or email address of the Registrar’s Office / Student Records Department to whom we will be sending the verification request.<br />\r\n<br />\r\n <br />\r\n<br />\r\nYour response to this matter will be very much appreciated.<br />\r\n<br />\r\n<br />\r\n<br />\r\n<br />\r\n--<br />\r\nThank You.<br />\r\nBest Regards,<br />\r\n<br />\r\n<br />\r\nMELVIN SUMALBAG (He/Him), VERIFICATION ASSOCIATE I<br />\r\n<br />\r\nGlobal Locations : Bengaluru • London • New York • Philippines • Singapore • Sydney<br />\r\n<br />\r\nEmail  : melvin.sumalbag@avvanz.com <br />\r\nWeb    : www.avvanz.com <br />\r\n<br />\r\nPhone : +639458151065'),
(39, 'Jake Rover', 'k2za.unsworn423@passmail.com', 'jmmlab.com', 'Hey do you want to buy the domain name jmmlab.com?'),
(40, 'Kasende', 'siloverkasende35@gmail.com', 'Demande d&#039;inscription si ouvert', 'Bonjour, je souhaite m&#039;inscrire en première année de licence à l&#039;Université isp pour l&#039;année académique 2026-2027.<br />\r\n<br />\r\nJe voudrais connaître :<br />\r\n<br />\r\n1. Les filières disponibles en administration et gestion.<br />\r\n2. Le montant total des frais académiques pour la première année.<br />\r\n3. Si le port d&#039;une veste et d&#039;une cravate est obligatoire pour les étudiants.<br />\r\n4. Les conditions d&#039;admission et les documents nécessaires.<br />\r\nFrais d&#039;inscription :<br />\r\n<br />\r\nMerci pour votre réponse.'),
(41, 'Kasende', 'siloverkasende35@gmail.com', 'Demande d&#039;inscription si ouvert', 'Bonjour, je souhaite m&#039;inscrire en première année de licence à l&#039;Université isp pour l&#039;année académique 2026-2027.<br />\r\n<br />\r\nJe voudrais connaître :<br />\r\n<br />\r\n1. Les filières disponibles en administration et gestion.<br />\r\n2. Le montant total des frais académiques pour la première année.<br />\r\n3. Si le port d&#039;une veste et d&#039;une cravate est obligatoire pour les étudiants.<br />\r\n4. Les conditions d&#039;admission et les documents nécessaires.<br />\r\nFrais d&#039;inscription :<br />\r\n<br />\r\nMerci pour votre réponse.');

-- --------------------------------------------------------

--
-- Structure de la table `couverture`
--

CREATE TABLE `couverture` (
  `id_cv` int(11) NOT NULL,
  `photo_cv` varchar(50) DEFAULT NULL,
  `faculte` int(11) DEFAULT NULL,
  `departement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `couverture`
--

INSERT INTO `couverture` (`id_cv`, `photo_cv`, `faculte`, `departement`) VALUES
(2, 'Qcode_1.jpeg', 1, NULL),
(3, 'Qcode_2.jpeg', 1, NULL),
(4, 'Qcode_3.jpeg', 1, NULL),
(5, 'Qcode_4.jpg', 2, NULL),
(6, 'Qcode_5.jpg', 2, NULL),
(7, 'Qcode_6.jpg', 2, NULL),
(8, 'Qcode_7.jpg', 2, NULL),
(9, 'Qcode_8.jpg', 3, NULL),
(10, 'Qcode_9.jpg', 3, NULL),
(11, 'Qcode_10.jpg', 3, NULL),
(12, 'Qcode_11.jpg', 3, NULL),
(13, 'Qcode_12.jpeg', NULL, 11),
(14, 'Qcode_13.jpeg', NULL, 11),
(15, 'Qcode_14.jpeg', NULL, 11),
(16, 'Qcode_15.jpg', NULL, 11),
(17, 'Qcode_16.jpeg', NULL, 11);

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `faculte` int(11) NOT NULL,
  `resume` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id`, `titre`, `faculte`, `resume`) VALUES
(2, 'ANGLAIS CULTURE AFRICAINE', 1, 'X'),
(3, 'FRANCAIS LANGUES AFRICAINES', 1, 'X'),
(4, 'HISTOIRE, SCIENCE SOCIALE ET GESTION DU PATRIMOINE', 1, 'X'),
(5, 'GESTION ET ADMINISTRATION DES EINSTITUTIONS SCOLAIRES ET DE FORMATION', 1, 'X'),
(6, 'ORIENTATION SCOLAIRE ET ¨ROFESSIONNELLE', 1, 'X'),
(7, 'BIOLOGIE TECHNIQUES APPLIQUES ', 2, 'X'),
(8, 'SCIENCES', 2, 'X'),
(9, 'GEOGRAPHIE ET GESTION DE L&#039;ENVIRONNEMENT', 2, 'X'),
(10, 'GESTION COMMERCIALE ET FINANCIERE', 3, 'X'),
(11, 'INFORMATIQUE DE GESTION', 3, 'Dans le département d\'informatique, nous formons des informaticiens et informaticiennes qui sont des personnes qui exercent un métier dans l\'étude, la conception, la production, la gestion et la maintenance des systèmes de traitement de l\'information (Analyste programmeur).\n\nDans ce département, les différentes tâches sont enseignées :\n\nAnalyser un système d´information existant ;\nDégager les failles et trouver les solutions nécessaires basées sur un programme informatique traité par ordinateur ;\nÉlaborer un programme de gestion automatisée\nApporter un appui conseil dans le processus d´approvisionnement en matériels et équipements informatiques et appuyer les projets de développement ;\nAdministrer et gérer un réseau informatique ;\nEntretenir les équipements informatiques.\nProfil des candidats\n\n'),
(12, 'GESTION DES ENTREPRISES', 3, 'X'),
(13, 'HOTELLERIE ET RESTAURATION', 4, 'X'),
(14, 'ACCUEIL ET TOURISME', 4, 'X');

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(11) NOT NULL,
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
  `province` int(11) NOT NULL DEFAULT 0,
  `district` int(11) NOT NULL DEFAULT 0,
  `territoire` int(11) NOT NULL DEFAULT 0,
  `adresseDuCandidat` text NOT NULL,
  `personnePrevenir` varchar(50) NOT NULL DEFAULT '',
  `telephonePersonnePrevenir` varchar(50) NOT NULL DEFAULT '',
  `nomDeEcoleDeFreq` varchar(255) NOT NULL DEFAULT '',
  `adresseDeEcoleProvince` text NOT NULL,
  `sectionSuiviAuxHum` varchar(50) NOT NULL DEFAULT '0',
  `nomDuCentreDeExetat` varchar(255) NOT NULL DEFAULT '',
  `anneeObtentionDuDiplome` varchar(255) NOT NULL DEFAULT '',
  `pourcentageDuDiplome` int(11) NOT NULL DEFAULT 0,
  `numeroDuDiplomeEtat` int(11) NOT NULL DEFAULT 0,
  `activiteProfessionelles` varchar(255) NOT NULL DEFAULT '0',
  `etudesPostSecondaireEntreprise` varchar(255) NOT NULL DEFAULT '0',
  `promotion` int(11) NOT NULL,
  `facChoix1` int(11) NOT NULL,
  `depChoix1` int(11) NOT NULL,
  `facChoix2` int(11) NOT NULL,
  `depChoix2` int(11) NOT NULL,
  `cycle` varchar(50) NOT NULL DEFAULT '',
  `diplomeAttest` text NOT NULL,
  `certificat` text NOT NULL,
  `bulletin` text NOT NULL,
  `carteIdentite` text NOT NULL,
  `attestNaissance` text NOT NULL,
  `mdp` text NOT NULL,
  `defaut` int(11) DEFAULT NULL,
  `date_inscrit` date DEFAULT NULL,
  `qrcode` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `etat` int(11) NOT NULL DEFAULT 0,
  `cp` int(11) NOT NULL DEFAULT 0,
  `departement` int(11) NOT NULL DEFAULT 0,
  `faculte` int(11) NOT NULL DEFAULT 0,
  `optioner` int(11) NOT NULL DEFAULT 0,
  `confirmer` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `faculte`
--

CREATE TABLE `faculte` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `resume` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `faculte`
--

INSERT INTO `faculte` (`id`, `titre`, `resume`) VALUES
(1, 'LETTRES ET SCIENCES HUMAINES', '\n\nPlusieurs programmes d\'études répartis dans différents départements à l\'obtention d’un diplôme d\'enseignement. À la section des lettres et des sciences humaines, nous formons de jeunes étudiantes et étudiants au métier d’enseignantes et enseignants. Entre cours spécialisés en didactique, gestion de classe, utilisation des TICs et les stages prévus par le programme, la formation est plus que complète!\nPour celles et ceux ayant déjà un diplôme, les maîtrises qualifiantes offrent une belle opportunité pour se réorienter dans l\'enseignement.  \nLa campagne Enseigner pour transformer la société met en valeur le métier d\'enseignante et d\'enseignant et les formations proposées par l\'Institut Supérieur Pédagogique de la Gombe qui répondent aux enjeux de cette profession. \n.\n\n'),
(2, 'SCIENCES EXACTES', 'Ce cursus en quatre ans vise à transmettre au candidat un enseignement de qualité et pluridisciplinaire axé notamment sur l’acquisition de la physique, de la chimie et des mathématiques.'),
(3, 'SCIENCES COMMERCIALES ET INFORMATIQUE', 'Le commercial informatique analyse et comprend les problèmes ou les besoins des clients et leur propose une solution informatique adaptée à leur demande.'),
(4, 'SCIENCES ET TECHNIQUES D’ACCUEIL', 'Nous offrons des connaissances fondamentales sur les sciences de gestions, du management hôtelier aux étudiants');

-- --------------------------------------------------------

--
-- Structure de la table `horaire`
--

CREATE TABLE `horaire` (
  `id` int(11) NOT NULL,
  `jour` int(11) DEFAULT NULL,
  `prof` int(11) DEFAULT NULL,
  `affectcours` int(11) DEFAULT NULL,
  `matin` int(11) DEFAULT NULL,
  `midi` int(11) DEFAULT NULL,
  `soir` int(11) DEFAULT NULL,
  `annee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_mbr` int(11) NOT NULL,
  `noms_mbr` varchar(150) DEFAULT NULL,
  `photo_mbr` varchar(150) DEFAULT NULL,
  `desc_mbr` text DEFAULT NULL,
  `valider` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE `niveau` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `optioner`
--

CREATE TABLE `optioner` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `departement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `optioner`
--

INSERT INTO `optioner` (`id`, `titre`, `departement`) VALUES
(1, 'Conception de Système d&#039;Information (LCSI)', 11);

-- --------------------------------------------------------

--
-- Structure de la table `palmaresetudiant`
--

CREATE TABLE `palmaresetudiant` (
  `id_pe` int(11) NOT NULL,
  `noms` varchar(50) DEFAULT NULL,
  `anne` varchar(50) DEFAULT NULL,
  `session` int(11) NOT NULL,
  `departement` int(11) NOT NULL,
  `niveau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE `personnel` (
  `id` int(11) NOT NULL,
  `noms` varchar(25) DEFAULT NULL,
  `telephone` varchar(25) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `fonction` varchar(100) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `faculte` int(11) NOT NULL DEFAULT 0,
  `departement` int(11) NOT NULL DEFAULT 0,
  `valider` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id`, `noms`, `telephone`, `mail`, `fonction`, `photo`, `faculte`, `departement`, `valider`) VALUES
(1, 'Prof TOKUNDA H.', '+243 ', 'P@gmail.com', 'CHEF DE SECTION', 'Prof TOKUNDA H._0.png', 1, 0, 1),
(2, 'Prof KIKOMBA M.', '+243 (82) 2 358 732', 'contact@ispgombe.ac.cd', 'CHEF DE SECTION', 'Prof KIKOMBA M._1.png', 2, 0, 1),
(3, 'Prof EKINA B. J.', '+243 (82) 2 358 732', 'contact@ispgombe.ac.cd', 'CHEF DE SECTION', 'Prof EKINA B. J._2.png', 3, 0, 1),
(4, 'Prof NSIMBA', '+243 (82) 2 358 732', 'contact@ispgombe.ac.cd', 'CHEF DE SECTION', '1742968218_herve.jpeg', 4, 0, 1),
(9, 'Ass KABAMBA NTUMBA David', '+243 (82) 2 358 732', 'contact@ispgombe.ac.cd', 'CHARGE DE RECHERCHE', 'KABAMBA NTUMBA David _6.jpg', 0, 11, 1),
(17, 'CT MWINKEU KAT Christelle', '+243 (82) 2 358 732', 'contact@ispgombe.ac.cd', 'S. CHARGE DE L\'ENSEIGNEMENT', 'CT MWINKEU KAT Christelle_1.jpg', 0, 11, 1),
(18, 'Dr. MBIYA MPOYI Guy', '+243 (82) 2 358 732', 'contact@ispgombe.ac.cd', 'CHEF DE DEPARTEMENT', 'Dr. MBIYA MPOYI Guy_6.jpg', 0, 11, 1);

-- --------------------------------------------------------

--
-- Structure de la table `prof`
--

CREATE TABLE `prof` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `postnom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `mdp` text NOT NULL,
  `list_faculte` varchar(255) NOT NULL,
  `list_departement` varchar(255) NOT NULL,
  `faculte` int(11) NOT NULL,
  `departement` int(11) NOT NULL,
  `optioner` int(11) NOT NULL,
  `promotion` int(11) NOT NULL,
  `etudiant` int(11) NOT NULL,
  `cours` int(11) NOT NULL,
  `prof` int(11) NOT NULL,
  `lmd` int(11) NOT NULL,
  `list_lmd` varchar(255) NOT NULL,
  `delibe` int(11) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `fonction` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `optioner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `province`
--

CREATE TABLE `province` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `color` varchar(7) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `provinces`
--

CREATE TABLE `provinces` (
  `id_p` int(11) NOT NULL,
  `nom_p` varchar(50) DEFAULT NULL,
  `lettre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `repartition`
--

CREATE TABLE `repartition` (
  `id` int(11) NOT NULL,
  `motif` varchar(100) NOT NULL,
  `service` double NOT NULL,
  `faculte` double NOT NULL,
  `departement` double NOT NULL,
  `comite` double NOT NULL,
  `prof` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `secteurs`
--

CREATE TABLE `secteurs` (
  `id_sec` int(11) NOT NULL,
  `nom_sec` varchar(50) DEFAULT NULL,
  `id_tr` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(10) NOT NULL,
  `nom_s` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `territoires`
--

CREATE TABLE `territoires` (
  `id_tr` int(11) NOT NULL,
  `nom_tr` varchar(50) DEFAULT NULL,
  `id_p` int(11) DEFAULT NULL,
  `changer` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) DEFAULT NULL,
  `roles` text DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activite`
--
ALTER TABLE `activite`
  ADD PRIMARY KEY (`id_act`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_adm`);

--
-- Index pour la table `agent_dep`
--
ALTER TABLE `agent_dep`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Index pour la table `annee`
--
ALTER TABLE `annee`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`id_act`);

--
-- Index pour la table `communique`
--
ALTER TABLE `communique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `couverture`
--
ALTER TABLE `couverture`
  ADD PRIMARY KEY (`id_cv`);

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `faculte`
--
ALTER TABLE `faculte`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_mbr`);

--
-- Index pour la table `niveau`
--
ALTER TABLE `niveau`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `optioner`
--
ALTER TABLE `optioner`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `palmaresetudiant`
--
ALTER TABLE `palmaresetudiant`
  ADD PRIMARY KEY (`id_pe`),
  ADD KEY `FK_palmaresetudiant_sessions` (`session`),
  ADD KEY `FK_palmaresetudiant_departement` (`departement`);

--
-- Index pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prof`
--
ALTER TABLE `prof`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id_p`);

--
-- Index pour la table `repartition`
--
ALTER TABLE `repartition`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `secteurs`
--
ALTER TABLE `secteurs`
  ADD PRIMARY KEY (`id_sec`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Index pour la table `territoires`
--
ALTER TABLE `territoires`
  ADD PRIMARY KEY (`id_tr`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activite`
--
ALTER TABLE `activite`
  MODIFY `id_act` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_adm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `agent_dep`
--
ALTER TABLE `agent_dep`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `annee`
--
ALTER TABLE `annee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `campus`
--
ALTER TABLE `campus`
  MODIFY `id_act` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `communique`
--
ALTER TABLE `communique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `couverture`
--
ALTER TABLE `couverture`
  MODIFY `id_cv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `faculte`
--
ALTER TABLE `faculte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `horaire`
--
ALTER TABLE `horaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_mbr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `niveau`
--
ALTER TABLE `niveau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `optioner`
--
ALTER TABLE `optioner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `palmaresetudiant`
--
ALTER TABLE `palmaresetudiant`
  MODIFY `id_pe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `prof`
--
ALTER TABLE `prof`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `province`
--
ALTER TABLE `province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `repartition`
--
ALTER TABLE `repartition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `secteurs`
--
ALTER TABLE `secteurs`
  MODIFY `id_sec` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `territoires`
--
ALTER TABLE `territoires`
  MODIFY `id_tr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `palmaresetudiant`
--
ALTER TABLE `palmaresetudiant`
  ADD CONSTRAINT `FK_palmaresetudiant_departement` FOREIGN KEY (`departement`) REFERENCES `departement` (`id`),
  ADD CONSTRAINT `FK_palmaresetudiant_sessions` FOREIGN KEY (`session`) REFERENCES `sessions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- Réglages éditoriaux ajoutés pour le panneau d’administration.
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

CREATE TABLE `admin_action_log` (
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

-- Carrousel d’accueil : contenu public, images et légendes gérés par l’administration.
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

-- Comité de gestion : portraits et fonctions gérés depuis l’administration.
CREATE TABLE IF NOT EXISTS `committee_member` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(160) NOT NULL,
  `fonction` varchar(160) NOT NULL,
  `description` longtext NOT NULL,
  `photo` varchar(80) NOT NULL,
  `sort_order` int NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_committee_member_active_order` (`is_active`, `sort_order`, `id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
