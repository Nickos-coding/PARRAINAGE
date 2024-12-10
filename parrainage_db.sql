-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 02 déc. 2024 à 03:01
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`idetu`, `matricule`, `nom`, `prenom`, `email`, `mot_de_passe`, `type_parrainage`, `contact`, `filiere_id`, `niveau_id`, `photo_profil`) VALUES
(1, '123456789', 'Dupont', 'Jean', 'tradernew005@yahoo.com', '$2y$10$K1kqaoggtq.zWnAolQ/me.GES1CDSJKy2bs3XJ0oNcQdV2./lCybK', NULL, '789909876', NULL, NULL, 'image/profil.jpg'),
(2, '987654321', 'Martin', 'Sophie', 'issa@gmail.com', '$2y$10$JqHTKRrFA4lEXneDTm43SOegjNhi/Z2rV5I2.W2D7/mDGi3kNxcFG', NULL, '0168543656', NULL, NULL, 'image/profil.jpg');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

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
  PRIMARY KEY (`idutil`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`idutil`, `email`, `mot_de_passe`) VALUES
(1, 'admin2024@gmail.com', '$2y$10$x5QIFPrszxJlrRbgQr6HbeXAjW8GuGQPUmHu2IE6dDpwe7myTIeQ.');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
