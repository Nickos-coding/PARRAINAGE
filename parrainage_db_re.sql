-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 11 déc. 2024 à 20:48
-- Version du serveur : 8.0.31
-- Version de PHP : 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `parrainage_db`
--
CREATE DATABASE IF NOT EXISTS `parrainage_db` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `parrainage_db`;

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

DROP TABLE IF EXISTS `activites`;
CREATE TABLE IF NOT EXISTS `activites` (
  `idact` int NOT NULL AUTO_INCREMENT,
  `filleul_id` int NOT NULL,
  `nom_activite` varchar(255) NOT NULL,
  `date_activite` datetime NOT NULL,
  `description_activite` text,
  PRIMARY KEY (`idact`),
  KEY `fk_activites_filleul` (`filleul_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `chef_equipe`
--

DROP TABLE IF EXISTS `chef_equipe`;
CREATE TABLE IF NOT EXISTS `chef_equipe` (
  `chef_equipe_id` int NOT NULL AUTO_INCREMENT,
  `idact` int NOT NULL,
  `idpar` int NOT NULL,
  PRIMARY KEY (`chef_equipe_id`),
  KEY `fk_chef_activite` (`idact`),
  KEY `fk_chef_parrainage` (`idpar`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `idetu` int NOT NULL AUTO_INCREMENT,
  `matricule` varchar(15) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `type_parrainage` enum('parrain','filleul') DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `filiere_id` int DEFAULT NULL,
  `niveau_id` int DEFAULT NULL,
  `photo_profil` varchar(255) DEFAULT 'image/profil.jpg',
  PRIMARY KEY (`idetu`),
  UNIQUE KEY `matricule` (`matricule`),
  UNIQUE KEY `email` (`email`),
  KEY `fk_etudiants_filiere` (`filiere_id`),
  KEY `fk_etudiants_niveau` (`niveau_id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`idetu`, `matricule`, `nom`, `prenom`, `email`, `mot_de_passe`, `type_parrainage`, `contact`, `filiere_id`, `niveau_id`, `photo_profil`) VALUES
(5, 'ET1003', 'Lemoine', 'Jacques', 'issa@gmail.com', '$2y$10$drNeXub9zZJapaw1ApFoNeFHYgqDXqqcoGGdeMBR2oBqVaH3pDk0.', NULL, '0987654321', 3, 1, 'image/profil.jpg'),
(3, 'ET1001', 'Dupont', 'Pierre', NULL, '', NULL, '0612345678', 1, 1, 'image/profil.jpg'),
(4, 'ET1002', 'Martin', 'Paul', NULL, '', NULL, '0623456789', 2, 2, 'image/profil.jpg'),
(6, 'ET1004', 'Lefevre', 'Marie', NULL, '', NULL, '0645678901', 4, 3, 'image/profil.jpg'),
(7, 'ET1005', 'Moreau', 'Sophie', 'tina12@gmail.com', '$2y$10$33WH8oRPHGd8NQsnornOL.ufCMV72T0uhjlRvguRiY0wGcAOZk.4.', NULL, '0576550388', 1, 2, 'image/profil.jpg'),
(8, 'ET1006', 'Tremblay', 'Claire', NULL, '', NULL, '0667890123', 2, 1, 'image/profil.jpg'),
(9, 'ET1007', 'Gautier', 'Luc', NULL, '', NULL, '0678901234', 3, 3, 'image/profil.jpg'),
(10, 'ET1008', 'Dufresne', 'Henri', NULL, '', NULL, '0689012345', 4, 2, 'image/profil.jpg'),
(11, 'ET1009', 'Lemoine', 'Élodie', NULL, '', NULL, '0690123456', 5, 1, 'image/profil.jpg'),
(12, 'ET1010', 'Dupont', 'Chloé', 'ahou@gmail.com', '$2y$10$L9Uij1wyLO1uXKzuY8w.4uHF3UOzASXFn1Ap714CJjfXZrmzWDWMu', NULL, '0098765456', 5, 3, 'image/profil.jpg'),
(13, 'M0001', 'Dupont', 'Jean', 'tiebi@gmail.com', '$2y$10$NESv2GrJkIHOx0lOTAjAIOVNblwjoMBbQ6M4pQRguL17.kmjIjOsi', NULL, '0939838938', 1, 1, 'image/profil.jpg'),
(14, 'M0002', 'Durand', 'Marie', 'adrina@gmail.com', '$2y$10$P15gEy4xeugqq/d//NYXsu7PugHAkP.YaO4oD7Mcouzgh1CyaeAW.', NULL, '0928389282', 2, 1, 'image/profil.jpg'),
(15, 'M0003', 'Lemoine', 'Paul', NULL, '', NULL, NULL, 3, 2, 'image/profil.jpg'),
(16, 'M0004', 'Martin', 'Claire', NULL, '', NULL, NULL, 4, 2, 'image/profil.jpg'),
(17, 'M0005', 'Lemoine', 'Sophie', 'marie@gmail.com', '$2y$10$u/cVlG50rMhNZnpy.VoPQe/JJEUQ08FxzMpyk7JyE3N2hUMjKY2x2', NULL, '0029383923', 5, 3, 'image/profil.jpg'),
(18, 'M0006', 'Lambert', 'David', 'david@gm', '$2y$10$IHEwvjLSbZbiXbWy6icsxOsx013n1gkksyh0iDQrAT921.pVjTWsC', NULL, '0192102910', 1, 3, 'image/profil.jpg'),
(19, 'M0007', 'Sanchez', 'Lucie', NULL, '', NULL, NULL, 2, 2, 'image/profil.jpg'),
(20, 'M0008', 'Benoit', 'Louis', NULL, '', NULL, NULL, 3, 1, 'image/profil.jpg'),
(21, 'M0009', 'Guerin', 'Elise', 'tyuaea@gmail.com', '$2y$10$i9V/Yez.aEHc5BohBKY5t.1adyjq6MK.2u.Uwl5NJVcmsMHN31Mq2', NULL, '0928989383', 4, 1, 'image/profil.jpg'),
(22, 'M0010', 'Petit', 'Franck', NULL, '', NULL, NULL, 5, 2, 'image/profil.jpg'),
(23, 'M0011', 'Moreau', 'Isabelle', NULL, '', NULL, NULL, 1, 2, 'image/profil.jpg'),
(24, 'M0012', 'Robert', 'Michel', NULL, '', NULL, NULL, 2, 3, 'image/profil.jpg'),
(25, 'M0013', 'Michel', 'Amandine', 'estheer@gmail.com', '$2y$10$aZQgYRZyAXcv7JRJuj7uHeBArFMOJp9l8eA30bUOrIYCDNaeP5u4y', NULL, '0123434243', 3, 3, 'image/profil.jpg'),
(26, 'M0014', 'David', 'Alice', NULL, '', NULL, NULL, 4, 1, 'image/profil.jpg'),
(27, 'M0015', 'Lemoine', 'Thomas', NULL, '', NULL, NULL, 5, 1, 'image/profil.jpg'),
(28, 'M0016', 'Thomas', 'Sébastien', NULL, '', NULL, NULL, 1, 2, 'image/profil.jpg'),
(29, 'M0017', 'Lemoine', 'Nathalie', NULL, '', NULL, NULL, 2, 1, 'image/profil.jpg'),
(30, 'M0018', 'Pires', 'Antoine', NULL, '', NULL, NULL, 3, 1, 'image/profil.jpg'),
(31, 'M0019', 'Leclerc', 'Sophie', NULL, '', NULL, NULL, 4, 3, 'image/profil.jpg'),
(32, 'M0020', 'Robert', 'Jérôme', NULL, '', NULL, NULL, 5, 3, 'image/profil.jpg'),
(33, 'M0021', 'Valentin', 'Pierre', NULL, '', NULL, NULL, 1, 1, 'image/profil.jpg'),
(34, 'M0022', 'Martel', 'Julie', NULL, '', NULL, NULL, 2, 2, 'image/profil.jpg'),
(35, 'M0023', 'Dumas', 'Claude', NULL, '', NULL, NULL, 3, 3, 'image/profil.jpg'),
(36, 'M0024', 'Benoit', 'Geraldine', NULL, '', NULL, NULL, 4, 2, 'image/profil.jpg'),
(37, 'M0025', 'Petit', 'Michaël', NULL, '', NULL, NULL, 5, 1, 'image/profil.jpg'),
(38, 'M0026', 'Guillaume', 'Céline', NULL, '', NULL, NULL, 1, 3, 'image/profil.jpg'),
(39, 'M0027', 'Leclerc', 'David', NULL, '', NULL, NULL, 2, 1, 'image/profil.jpg'),
(40, 'M0028', 'Morin', 'Pauline', NULL, '', NULL, NULL, 3, 2, 'image/profil.jpg'),
(41, 'M0029', 'Mathieu', 'François', NULL, '', NULL, NULL, 4, 3, 'image/profil.jpg'),
(42, 'M0030', 'Francois', 'Camille', NULL, '', NULL, NULL, 5, 2, 'image/profil.jpg'),
(43, 'M0031', 'Blanc', 'Géraldine', NULL, '', NULL, NULL, 1, 2, 'image/profil.jpg'),
(44, 'M0032', 'Lemoine', 'Xavier', NULL, '', NULL, NULL, 2, 3, 'image/profil.jpg'),
(45, 'M0033', 'Giraud', 'Luc', NULL, '', NULL, NULL, 3, 1, 'image/profil.jpg'),
(46, 'M0034', 'Roux', 'Yves', NULL, '', NULL, NULL, 4, 1, 'image/profil.jpg'),
(47, 'M0035', 'Delaroche', 'Christine', NULL, '', NULL, NULL, 5, 3, 'image/profil.jpg'),
(48, 'M0036', 'Henry', 'Julien', NULL, '', NULL, NULL, 1, 1, 'image/profil.jpg'),
(49, 'M0037', 'Fournier', 'Nadine', NULL, '', NULL, NULL, 2, 2, 'image/profil.jpg'),
(50, 'M0038', 'Lemoine', 'Martine', NULL, '', NULL, NULL, 3, 2, 'image/profil.jpg'),
(51, 'M0039', 'Bertrand', 'Olivier', NULL, '', NULL, NULL, 4, 3, 'image/profil.jpg'),
(52, 'M0040', 'Leclerc', 'Alain', NULL, '', NULL, NULL, 5, 1, 'image/profil.jpg'),
(53, 'M0041', 'Hughes', 'Lucien', NULL, '', NULL, NULL, 1, 2, 'image/profil.jpg'),
(54, 'M0042', 'Roussel', 'Valérie', NULL, '', NULL, NULL, 2, 3, 'image/profil.jpg'),
(55, 'M0043', 'Petit', 'Jacqueline', NULL, '', NULL, NULL, 3, 1, 'image/profil.jpg'),
(56, 'M0044', 'Thomas', 'Sophie', NULL, '', NULL, NULL, 4, 2, 'image/profil.jpg'),
(57, 'M0045', 'Benoit', 'Brigitte', NULL, '', NULL, NULL, 5, 2, 'image/profil.jpg'),
(58, 'M0046', 'Dumont', 'Jean-Pierre', NULL, '', NULL, NULL, 1, 3, 'image/profil.jpg'),
(59, 'M0047', 'Blanc', 'Léa', NULL, '', NULL, NULL, 2, 1, 'image/profil.jpg'),
(60, 'M0048', 'Delgado', 'Mathieu', NULL, '', NULL, NULL, 3, 3, 'image/profil.jpg'),
(61, 'M0049', 'Vidal', 'Andréa', NULL, '', NULL, NULL, 4, 1, 'image/profil.jpg'),
(62, 'M0050', 'Dupuis', 'Sabrina', NULL, '', NULL, NULL, 5, 3, 'image/profil.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `filieres`
--

DROP TABLE IF EXISTS `filieres`;
CREATE TABLE IF NOT EXISTS `filieres` (
  `idfil` int NOT NULL AUTO_INCREMENT,
  `nom_filiere` varchar(100) NOT NULL,
  PRIMARY KEY (`idfil`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `filieres`
--

INSERT INTO `filieres` (`idfil`, `nom_filiere`) VALUES
(1, 'Informatique Option Genie Logiciel'),
(2, 'Science Economie et Gestion'),
(3, 'Anglais'),
(4, 'Communication'),
(5, 'Droit');

-- --------------------------------------------------------

--
-- Structure de la table `niveaux`
--

DROP TABLE IF EXISTS `niveaux`;
CREATE TABLE IF NOT EXISTS `niveaux` (
  `idniv` int NOT NULL AUTO_INCREMENT,
  `nom_niveau` varchar(50) NOT NULL,
  PRIMARY KEY (`idniv`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `niveaux`
--

INSERT INTO `niveaux` (`idniv`, `nom_niveau`) VALUES
(1, 'licence 1'),
(2, 'licence 2'),
(3, 'licence 3');

-- --------------------------------------------------------

--
-- Structure de la table `parrainages`
--

DROP TABLE IF EXISTS `parrainages`;
CREATE TABLE IF NOT EXISTS `parrainages` (
  `idpar` int NOT NULL AUTO_INCREMENT,
  `parrain_id` int DEFAULT NULL,
  `filleul_id` int DEFAULT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idpar`),
  KEY `idx_parrain` (`parrain_id`),
  KEY `idx_filleul` (`filleul_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `parrainages`
--

INSERT INTO `parrainages` (`idpar`, `parrain_id`, `filleul_id`, `date_creation`) VALUES
(50, 58, 28, '2024-12-09 09:56:53'),
(49, 18, 43, '2024-12-09 09:56:53'),
(48, 18, 23, '2024-12-09 09:56:53'),
(47, 58, 53, '2024-12-09 09:56:53'),
(46, 38, 7, '2024-12-09 09:56:53');

-- --------------------------------------------------------

--
-- Structure de la table `rencontres`
--

DROP TABLE IF EXISTS `rencontres`;
CREATE TABLE IF NOT EXISTS `rencontres` (
  `idren` int NOT NULL AUTO_INCREMENT,
  `filleul_id` int NOT NULL,
  `parrain_id` int NOT NULL,
  `date_rencontre` datetime NOT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `heure_debut` time DEFAULT NULL,
  `heure_fin` time DEFAULT NULL,
  `intitule_activite` varchar(255) DEFAULT NULL,
  `description_activite` text,
  PRIMARY KEY (`idren`),
  KEY `fk_rencontres_filleul` (`filleul_id`),
  KEY `fk_rencontres_parrain` (`parrain_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `idutil` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `identifiant` varchar(50) NOT NULL,
  PRIMARY KEY (`idutil`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `identifiant` (`identifiant`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idutil`, `email`, `mot_de_passe`, `identifiant`) VALUES
(1, 'admin2024@gmail.com', '$2y$10$x5QIFPrszxJlrRbgQr6HbeXAjW8GuGQPUmHu2IE6dDpwe7myTIeQ.', 'S2UPER024');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
