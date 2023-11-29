-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 28 nov. 2023 à 22:52
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gym`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

CREATE TABLE `abonnement` (
  `idAbonement` int(50) NOT NULL,
  `dateAbonnement` date NOT NULL,
  `typeAbon` int(50) NOT NULL,
  `idUser` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

CREATE TABLE `activites` (
  `code` int(11) NOT NULL,
  `categorie` varchar(255) DEFAULT NULL,
  `date_deb` datetime(6) DEFAULT NULL,
  `date_fin` datetime(6) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `id_user` int(10) NOT NULL,
  `salle` varchar(255) DEFAULT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `idCategorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `IdCategorie` int(30) NOT NULL,
  `NomCategorie` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `DescriptionCategorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorieactivite`
--

CREATE TABLE `categorieactivite` (
  `id` int(11) NOT NULL,
  `categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_magasin`
--

CREATE TABLE `categorie_magasin` (
  `id` int(11) NOT NULL,
  `categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `adresse` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `idC` int(11) NOT NULL,
  `idPost` int(11) NOT NULL,
  `content` varchar(150) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE `equipement` (
  `IdEquipement` int(11) NOT NULL,
  `NomEquipement` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci NOT NULL,
  `Quantite` int(30) NOT NULL,
  `DateAchat` date NOT NULL,
  `PrixAchat` float NOT NULL,
  `IdCategorie` int(30) DEFAULT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `idEvent` int(11) NOT NULL,
  `titreEvent` varchar(150) NOT NULL,
  `nomCoach` varchar(150) NOT NULL,
  `typeEvent` varchar(150) NOT NULL,
  `adresseEvent` varchar(150) NOT NULL,
  `prixEvent` double NOT NULL,
  `dateEvent` date NOT NULL,
  `imgEvent` varchar(150) NOT NULL,
  `nombrePlacesReservees` int(11) NOT NULL,
  `nombrePlacesTotal` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idtype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offer`
--

CREATE TABLE `offer` (
  `idOffer` int(50) NOT NULL,
  `titleOffer` varchar(255) NOT NULL,
  `descriptionOffer` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  `dateDebOffer` date NOT NULL,
  `dateFinOffer` date NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `idPart` int(11) NOT NULL,
  `idEvent` int(11) NOT NULL,
  `Nom` varchar(150) NOT NULL,
  `Prenom` varchar(150) NOT NULL,
  `Ntel` varchar(150) NOT NULL,
  `DatePart` date NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `idPost` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `image` varchar(150) NOT NULL,
  `id_User` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_prd` int(255) NOT NULL,
  `idAdmin` int(11) DEFAULT NULL,
  `titre` varchar(255) NOT NULL,
  `image` varchar(250) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(250) NOT NULL,
  `categorie` varchar(250) NOT NULL,
  `idCategorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit_commande`
--

CREATE TABLE `produit_commande` (
  `id_prd` int(11) NOT NULL,
  `id_cmd` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE `reclamation` (
  `Id` int(11) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `IdUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation_cours`
--

CREATE TABLE `reservation_cours` (
  `id` int(11) NOT NULL,
  `code` int(255) DEFAULT NULL,
  `date_res` datetime(6) DEFAULT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservation_offer`
--

CREATE TABLE `reservation_offer` (
  `idReservation` int(50) NOT NULL,
  `dateReservation` date NOT NULL,
  `idUser` int(50) NOT NULL,
  `idOffer` int(50) NOT NULL,
  `codePromo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_abonn`
--

CREATE TABLE `type_abonn` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_event`
--

CREATE TABLE `type_event` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`Id`, `nom`, `prenom`, `mdp`, `role`, `email`, `img`, `age`) VALUES
(79, 'Ghorbel', 'Hssan', '$2y$10$j.F2BbrIrrIUk/6DCV14geLVVLr0ROVGZF6CQZOYJe2a53WftUyke', 'User', 'hssan.ghorbel@esprit.tn', '0091c535cdf1d0087f08ef9ae66808ce.jpg', 22),
(82, 'njeh', 'yossri', '$2y$10$j.F2BbrIrrIUk/6DCV14geLVVLr0ROVGZF6CQZOYJe2a53WftUyke', 'Admin', 'yossri@gmail.com', '8dc816271cbd27b6481a33b17fc5ab80.png', 300),
(87, 'yossri', 'njeh', '$2y$10$INdPBzfYuy4ZW288HiOBEu8dfNeLUZFMJrAvdGukJGC92/e0ORH6C', 'User', 'yossri@gmail.comm', 'd759531259166cb411a56b8441cbcc0c.png', 1234);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD PRIMARY KEY (`idAbonement`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `abonnement_ibfk_2` (`typeAbon`);

--
-- Index pour la table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`code`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `idCategorie` (`idCategorie`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`IdCategorie`);

--
-- Index pour la table `categorieactivite`
--
ALTER TABLE `categorieactivite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie_magasin`
--
ALTER TABLE `categorie_magasin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`idC`),
  ADD KEY `idPost` (`idPost`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD PRIMARY KEY (`IdEquipement`),
  ADD KEY `forgin key` (`IdCategorie`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`idEvent`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idtype` (`idtype`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`idOffer`);

--
-- Index pour la table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`idPart`),
  ADD KEY `participation_ibfk_1` (`idEvent`),
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idPost`),
  ADD KEY `id_User` (`id_User`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_prd`),
  ADD KEY `idCategorie` (`idCategorie`);

--
-- Index pour la table `produit_commande`
--
ALTER TABLE `produit_commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cmd` (`id_cmd`),
  ADD KEY `id_prd` (`id_prd`);

--
-- Index pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdUser` (`IdUser`);

--
-- Index pour la table `reservation_cours`
--
ALTER TABLE `reservation_cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_cours_ibfk_2` (`code`);

--
-- Index pour la table `reservation_offer`
--
ALTER TABLE `reservation_offer`
  ADD PRIMARY KEY (`idReservation`),
  ADD KEY `idOffer` (`idOffer`) USING BTREE,
  ADD KEY `idUser` (`idUser`);

--
-- Index pour la table `type_abonn`
--
ALTER TABLE `type_abonn`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_event`
--
ALTER TABLE `type_event`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
