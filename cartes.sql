-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 02 mars 2022 à 04:03
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mtg_helper`
--

-- --------------------------------------------------------

--
-- Structure de la table `cartes`
--

DROP TABLE IF EXISTS `cartes`;
CREATE TABLE IF NOT EXISTS `cartes` (
  `idCarte` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(120) NOT NULL,
  `codeExtension` varchar(8) NOT NULL,
  `couleur` varchar(20) NOT NULL,
  `type` varchar(50) NOT NULL,
  `estTerrainBase` tinyint(1) NOT NULL,
  `rarete` varchar(10) NOT NULL,
  `coutConvertiMana` int(11) DEFAULT NULL,
  `coutManaTexte` varchar(30) NOT NULL,
  `forceCreature` int(11) DEFAULT NULL,
  `enduranceCreature` int(11) DEFAULT NULL,
  `texte` varchar(800) DEFAULT NULL,
  `urlImage` varchar(300) NOT NULL,
  PRIMARY KEY (`idCarte`),
  UNIQUE KEY `idCarte` (`idCarte`),
  KEY `idCarte_2` (`idCarte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
