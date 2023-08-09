-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 09 août 2023 à 08:54
-- Version du serveur : 8.0.33
-- Version de PHP : 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `laclunysoise`
--
CREATE DATABASE IF NOT EXISTS `laclunysoise` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `laclunysoise`;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `roles`, `password`) VALUES
(1, 'admin', '[\"ROLE_ADMIN\"]', '$2y$13$1svqsgA7SFYbaTMGoH7PSOpSXg6An/GvWFBB16K8ckQ6/sMZ4uFBa');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230718092035', '2023-07-18 09:20:43', 36);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `media_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `page` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `title`, `content`, `description`, `media_url`, `created_at`, `updated_at`, `slug`, `visible`, `page`) VALUES
(18, 'Animaux', '<div>Nous sommes heureux d\'annoncer le lancement de notre nouveau service d\'ambulance pour les animaux ! Nous sommes désormais en mesure de transporter vos animaux de compagnie en toute sécurité et confortablement vers et depuis les cliniques vétérinaires et les autres établissements de santé. Notre personnel est formé pour traiter tous les types d\'animaux, de la petite souris au grand chien. Nous nous engageons à fournir un service de qualité à la fois pour vous et pour votre animal de compagnie.<br><br></div><div>Nos ambulances sont équipées de tout le matériel nécessaire pour assurer le confort et la sécurité de votre animal de compagnie pendant le transport. Nous disposons également d\'un personnel qualifié et expérimenté qui est capable de fournir les premiers soins en cas de besoin.<br><br></div><div>Si vous avez besoin de transporter votre animal de compagnie, n\'hésitez pas à nous contacter. Nous serons heureux de vous fournir un devis et de répondre à toutes vos questions.<br><br></div><div>Voici quelques-uns des avantages de notre service d\'ambulance pour les animaux :<br><br></div><ul><li>Nous sommes disponibles 24 heures sur 24, 7 jours sur 7.</li><li>Nous pouvons transporter tous les types d\'animaux, de la petite souris au grand chien.</li><li>Notre personnel est formé pour traiter tous les types d\'animaux.</li><li>Nous disposons d\'un équipement de pointe pour assurer le confort et la sécurité de votre animal de compagnie pendant le transport.</li><li>Nous vous fournissons un devis et répondons à toutes vos questions.</li></ul><div>Nous sommes convaincus que notre service d\'ambulance pour les animaux est la meilleure solution pour transporter votre animal de compagnie vers et depuis les cliniques vétérinaires et les autres établissements de santé. Contactez-nous dès aujourd\'hui pour en savoir plus !<br><br></div>', 'Nouveau service d\'ambulance pour les animaux', 'chienchat-7f985421-889d-4008-8bf5-d807b3cda386.jpg', '2023-08-09 08:04:07', '2023-08-09 08:42:42', 'animaux', 1, 'accueil'),
(19, 'Nouveaux équipements', '<div>Nous avons récemment investi dans de nouveaux équipements pour nos ambulances. Ces équipements nous permettent de fournir une meilleure prise en charge à nos patients. Par exemple, nous disposons désormais d\'un défibrillateur, d\'un moniteur cardiaque et d\'un respirateur artificiel. Ces équipements nous permettent de stabiliser les patients avant leur arrivée à l\'hôpital.<br><br></div><div>Le défibrillateur est un appareil qui peut délivrer un choc électrique au cœur d\'une personne en arrêt cardiaque. Cela peut aider à rétablir un rythme cardiaque normal et à sauver des vies. Le moniteur cardiaque est un appareil qui surveille l\'activité électrique du cœur. Cela permet aux ambulanciers de surveiller l\'état du cœur du patient et de prendre les mesures nécessaires en cas de problème. Le respirateur artificiel est un appareil qui fournit de l\'oxygène aux poumons d\'une personne qui ne peut pas respirer par elle-même. Cela peut aider à maintenir les fonctions vitales du patient jusqu\'à son arrivée à l\'hôpital.<br><br></div><div>Grâce à ces nouveaux équipements, nous sommes en mesure de fournir une meilleure prise en charge à nos patients. Nous pouvons stabiliser les patients avant leur arrivée à l\'hôpital, ce qui augmente leurs chances de survie. Nous sommes également en mesure de fournir une prise en charge plus complète à nos patients, ce qui leur permet de se rétablir plus rapidement.<br><br></div><div>Nous sommes fiers de pouvoir fournir ces nouveaux équipements à nos patients. Nous sommes convaincus qu\'ils feront une différence dans la vie de nos patients et nous sommes heureux de pouvoir leur offrir le meilleur des soins.</div>', 'Nouveaux équipements pour nos ambulances', 'equipements-422da088-5e33-4c76-932c-597de35631c2.jpg', '2023-08-09 08:04:44', '2023-08-09 08:43:19', 'nouveaux-equipements', 1, 'accueil'),
(20, 'Formation', '<div>Nous avons récemment formé une nouvelle équipe d\'ambulanciers. Ces ambulanciers ont suivi une formation complète et sont prêts à intervenir en cas d\'urgence. Ils sont tous titulaires d\'un diplôme d\'état d\'ambulancier et sont expérimentés dans la prise en charge des patients.<br><br></div><div>La formation des ambulanciers a duré 12 mois. Elle a inclus des cours théoriques et pratiques sur les soins d\'urgence, la conduite d\'ambulance, la communication avec les patients et leurs familles, et la gestion du stress. Les ambulanciers ont également effectué des stages dans des hôpitaux et des centres de secours.<br><br></div><div>Les ambulanciers sont maintenant prêts à intervenir en cas d\'urgence. Ils sont équipés de tout le matériel nécessaire pour prodiguer les premiers soins et transporter les patients en sécurité. Ils sont également formés pour gérer les situations stressantes et pour communiquer efficacement avec les patients et leurs familles.<br><br></div><div>Nous sommes fiers de notre nouvelle équipe d\'ambulanciers et nous sommes convaincus qu\'ils fourniront des soins de qualité à nos patients.</div>', 'Nouveaux ambulanciers formés', 'formation-000c2e43-1aba-417a-ad98-7599fd78c8f4.jpg', '2023-08-09 08:06:25', '2023-08-09 08:43:41', 'formation', 1, 'accueil'),
(21, 'Nouveau Service', '<div><strong>Nous proposons désormais un nouveau service de transport médical. Ce service est destiné aux patients qui ont besoin d\'être transportés vers et depuis les établissements de santé, mais qui ne sont pas en état d\'être transportés dans une ambulance.<br></strong><br></div><div>Notre service de transport médical est disponible 24h/24 et 7j/7, y compris les jours fériés. Nous disposons d\'une flotte de véhicules confortables et équipés de tout le matériel nécessaire pour assurer le confort et la sécurité des patients.<br><br></div><div>Nos véhicules sont équipés de :<br><br></div><ul><li>Lits médicalisés</li><li>Fauteuils roulants</li><li>Oxygène</li><li>Defibrillators</li><li>Autres équipements médicaux</li></ul><div>Nos chauffeurs sont des professionnels qualifiés et expérimentés qui sont formés pour transporter des patients en toute sécurité. Ils sont également en mesure d\'aider les patients à monter et à descendre du véhicule, et à les installer dans le lit ou le fauteuil roulant.<br><br></div><div><strong>Si vous avez besoin d\'un transport médical, n\'hésitez pas à nous contacter. Nous vous fournirons un devis gratuit et nous vous aiderons à organiser votre transport.<br></strong><br></div>', 'Nouveau service de transport médical', 'amb1-190d73b0-8d2e-45ac-89bb-cae2567b2980.jpg', '2023-08-09 08:08:07', '2023-08-09 08:44:12', 'nouveau-service', 1, 'accueil'),
(22, 'On s\'engage à', '<div>La Clunysoise est une entreprise de transport sanitaire située à Cluny, en Bourgogne. Nous proposons un service de transport médicalisé pour tous vos besoins et transferts.<br><br></div><div>Nous intervenons 7j/7 et 24h/24, dans différentes situations :<br><br></div><ul><li>Accidents ou hospitalisation urgente</li><li>Transport médical sur rendez-vous</li><li>Transport de personnes à mobilité réduite</li><li>Transport de personnes âgées</li><li>Transport de personnes handicapées</li><li>Transport de personnes en fin de vie</li></ul><div>Nos ambulances sont climatisées, issues de la dernière génération et désinfectées quotidiennement. Nos ambulanciers et chauffeurs sont tous diplômés d’État et mettront leur savoir-faire à votre disposition. Nos véhicules sont équipés d’oxygène ainsi que du matériel de premier secours et de réanimation dernier cri.<br><br></div><div>Nous nous engageons à vous fournir un service de qualité, dans le respect de vos besoins et de votre budget. Nous sommes à votre écoute pour répondre à toutes vos questions et vous accompagner dans vos démarches.<br><br></div><div>Pour plus d\'informations, n\'hésitez pas à nous contacter.<br><br></div><div>La Clunysoise, votre partenaire de confiance pour vos transports sanitaires.<br><br></div>', NULL, 'identite-386dcce6-3f26-4737-a6ee-8e033c53ae49.jpg', '2023-08-09 08:15:48', '2023-08-09 08:16:25', 'nos-engagements', 1, 'notre-identite'),
(23, 'Prise en charge et tarification', '<div><strong>La prise en charge et la tarification des services d\'ambulance varient en fonction de la société d\'ambulance, de l\'état et de la police d\'assurance. En général, les services d\'ambulance sont pris en charge par les assurances maladie, mais il existe des cas où les patients doivent payer eux-mêmes.<br></strong><br></div><div><strong>Voici quelques exemples de services d\'ambulance qui peuvent être pris en charge par l\'assurance maladie :<br></strong><br></div><div>Le transport d\'un patient vers un hôpital ou une autre installation médicale</div><div>Le transport d\'un patient d\'un établissement médical à son domicile</div><div>Le transport d\'un patient d\'un établissement médical à un autre établissement médical</div><div>Le transport d\'un patient d\'un établissement médical à un domicile de convalescence</div><div>Le transport d\'un patient d\'un établissement médical à un centre de dialyse</div><div><strong>Si vous avez besoin d\'un service d\'ambulance, il est important de contacter votre compagnie d\'assurance maladie pour savoir si vos frais seront pris en charge. Vous pouvez également demander un devis à la société d\'ambulance avant d\'utiliser ses services.<br></strong><br></div><div><strong>Voici quelques exemples de cas où les patients doivent payer eux-mêmes les services d\'ambulance :<br></strong><br></div><ul><li>Si le patient n\'a pas d\'assurance maladie</li><li>Si le patient a une police d\'assurance maladie qui ne couvre pas les services d\'ambulance</li><li>Si le patient appelle une ambulance pour une raison non médicale, par exemple pour un transport vers un lieu de rendez-vous</li></ul><div><strong>Si vous devez payer vous-même les services d\'ambulance, vous pouvez demander un devis à la société d\'ambulance avant d\'utiliser ses services. Vous pouvez également demander à la société d\'ambulance de vous facturer les frais par la suite.<br></strong><br></div><div><strong>Voici quelques conseils pour réduire les coûts des services d\'ambulance :<br></strong><br></div><ul><li>Vérifiez si votre police d\'assurance maladie couvre les services d\'ambulance.</li><li>Demandez un devis à la société d\'ambulance avant d\'utiliser ses services.</li><li>Demandez à la société d\'ambulance de vous facturer les frais par la suite.</li><li>Utilisez une ambulance publique ou un service d\'ambulance non lucratif si l\'un est disponible dans votre région.</li><li>Apprenez à administrer les premiers soins afin d\'éviter de devoir appeler une ambulance.</li></ul>', NULL, 'priseencharge-7f01abd1-3adf-44d2-a6e0-cb7d6838d24f.jpg', '2023-08-09 08:21:49', '2023-08-09 08:27:12', 'prise-en-charge-et-tarification', 1, 'prise-en-charge'),
(24, 'Offre d\'emploi', '<div><strong>Responsabilités<br></strong><br></div><ul><li>Transport des patients vers et depuis les établissements de santé</li><li>Fourniture des premiers soins aux patients en cours de route</li><li>Surveillance des patients et maintien de leur confort</li><li>Aide au transfert des patients entre les lits, les fauteuils roulants et les autres appareils</li><li>Entretien et nettoyage de l\'ambulance</li></ul><div><br></div><div><strong>Qualifications<br></strong><br></div><ul><li>Diplôme d\'ambulancier</li><li>Permis de conduire valide</li><li>Expérience dans le transport sanitaire est un atout</li><li>Bonnes compétences en communication</li><li>Esprit d\'équipe</li><li>Être capable de travailler sous pression</li></ul><div><br></div><div><strong>Avantages<br></strong><br></div><ul><li>Salaire compétitif</li><li>Primes</li><li>Horaires flexibles</li><li>Assurance maladie</li><li>Mutuelle</li><li>Retraite</li></ul>', 'Nous recherchons un ambulancier pour rejoindre notre équipe. L\'ambulancier est responsable du transport des patients vers et depuis les établissements de santé, ainsi que de la fourniture des premiers soins aux patients en cours de route.', NULL, '2023-08-09 08:30:43', '2023-08-09 08:32:01', 'offre-d-emploi', 1, 'nous-rejoindre');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_880E0D76F85E0677` (`username`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
