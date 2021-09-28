-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 15 Décembre 2019 à 11:02
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `fredi`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherents`
--

CREATE TABLE IF NOT EXISTS `adherents` (
  `NUMERO_LICENCE` int(3) NOT NULL,
  `NUM_CLUB` int(2) NOT NULL,
  `NOM` char(32) DEFAULT NULL,
  `PRENOM` char(32) DEFAULT NULL,
  PRIMARY KEY (`NUMERO_LICENCE`),
  KEY `I_FK_ADHERENTS_CLUB` (`NUM_CLUB`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `adherents`
--

INSERT INTO `adherents` (`NUMERO_LICENCE`, `NUM_CLUB`, `NOM`, `PRENOM`) VALUES
(443, 1, 'BANDILELLA', 'CLEMENT'),
(340, 1, 'BERBIER', 'LUCILLE');

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

CREATE TABLE IF NOT EXISTS `club` (
  `NUM_CLUB` int(2) NOT NULL AUTO_INCREMENT,
  `NUMERO` int(4) NOT NULL,
  `NOM_CLUB` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`NUM_CLUB`),
  KEY `I_FK_CLUB_LIGUES` (`NUMERO`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `club`
--

INSERT INTO `club` (`NUM_CLUB`, `NUMERO`, `NOM_CLUB`) VALUES
(1, 1, 'Salle Armes de Villers les Nancy');

-- --------------------------------------------------------

--
-- Structure de la table `demandeurs`
--

CREATE TABLE IF NOT EXISTS `demandeurs` (
  `ADRESSE_MAIL` varchar(50) NOT NULL,
  `NOM` varchar(50) DEFAULT NULL,
  `PRENOM` varchar(50) DEFAULT NULL,
  `RUE` varchar(50) DEFAULT NULL,
  `CP` varchar(50) DEFAULT NULL,
  `VILLE` varchar(50) DEFAULT NULL,
  `NUM_RECU` bigint(4) DEFAULT '0',
  `MOT_DE_PASSE` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ADRESSE_MAIL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `demandeurs`
--

INSERT INTO `demandeurs` (`ADRESSE_MAIL`, `NOM`, `PRENOM`, `RUE`, `CP`, `VILLE`, `NUM_RECU`, `MOT_DE_PASSE`) VALUES
('test2@gmail.com', 'pinsolles', 'julien', '9 rue machin', '11111', 'Huns', 1, '12345'),
('12345@gmail.com', 'tyt', 'pmpm', '24 hjrj ', '18296', 'rrhzr', 2, '12345');

-- --------------------------------------------------------

--
-- Structure de la table `lignes_frais`
--

CREATE TABLE IF NOT EXISTS `lignes_frais` (
  `ADRESSE_MAIL` varchar(50) NOT NULL,
  `DATE_FRAIS` varchar(50) NOT NULL,
  `LIBELLE` varchar(50) DEFAULT NULL,
  `TRAJET` varchar(50) DEFAULT NULL,
  `KM` bigint(4) DEFAULT '0',
  `COUT_PEAGE` bigint(4) DEFAULT '0',
  `COUT_REPAS` bigint(4) DEFAULT '0',
  `COUT_HEBERGEMENT` bigint(4) DEFAULT '0',
  `KM_VALIDE` bigint(4) DEFAULT '0',
  `PEAGE_VALIDE` bigint(4) DEFAULT '0',
  `REPAS_VALIDE` bigint(4) DEFAULT '0',
  `HEBERGEMENT_VALIDE` bigint(4) DEFAULT '0',
  PRIMARY KEY (`ADRESSE_MAIL`,`DATE_FRAIS`),
  KEY `I_FK_LIGNES_FRAIS_MOTIFS` (`LIBELLE`),
  KEY `I_FK_LIGNES_FRAIS_DEMANDEURS` (`ADRESSE_MAIL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `lignes_frais`
--

INSERT INTO `lignes_frais` (`ADRESSE_MAIL`, `DATE_FRAIS`, `LIBELLE`, `TRAJET`, `KM`, `COUT_PEAGE`, `COUT_REPAS`, `COUT_HEBERGEMENT`, `KM_VALIDE`, `PEAGE_VALIDE`, `REPAS_VALIDE`, `HEBERGEMENT_VALIDE`) VALUES
('test2@gmail.com', '2019-12-10', 'Compétition nationale', 'Paris', 200, 10, 200, 300, 0, 0, 0, 0),
('test2@gmail.com', '2019-12-04', 'Compétition régionale', 'Paris-Marseille', 150, 89, 74, 13, 0, 0, 0, 0),
('test2@gmail.com', '2019-12-06', 'Réunion', 'Paris-Marseille', 5253, 53, 6, 282, 0, 0, 0, 0),
('test2@gmail.com', '2019-12-03', 'Stage', 'Paris-Marseille', 725, 72, 572, 572752, 0, 0, 0, 0),
('test2@gmail.com', '2019-12-08', 'Réunion', 'Paris-Marseille', 5225, 5525, 52, 11, 0, 0, 0, 0),
('test2@gmail.com', '2020-01-10', 'Réunion', 'Paris-Marseille', 80, 85, 90, 95, 10, 20, 30, 40);

-- --------------------------------------------------------

--
-- Structure de la table `ligues`
--

CREATE TABLE IF NOT EXISTS `ligues` (
  `NUMERO` int(4) NOT NULL,
  `NOM` char(32) DEFAULT NULL,
  `SIGLE` varchar(128) DEFAULT NULL,
  `PRESIDENT` char(32) DEFAULT NULL,
  PRIMARY KEY (`NUMERO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `ligues`
--

INSERT INTO `ligues` (`NUMERO`, `NOM`, `SIGLE`, `PRESIDENT`) VALUES
(1, 'Lorraine', 'L2L', 'Quiche');

-- --------------------------------------------------------

--
-- Structure de la table `motifs`
--

CREATE TABLE IF NOT EXISTS `motifs` (
  `LIBELLE` varchar(50) NOT NULL,
  PRIMARY KEY (`LIBELLE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `motifs`
--

INSERT INTO `motifs` (`LIBELLE`) VALUES
('Compétition internationale'),
('Compétition nationale'),
('Compétition régionale'),
('Réunion'),
('Stage');

-- --------------------------------------------------------

--
-- Structure de la table `rel_1`
--

CREATE TABLE IF NOT EXISTS `rel_1` (
  `ADRESSE_MAIL` varchar(50) NOT NULL,
  `NUMERO_LICENCE` int(3) NOT NULL,
  PRIMARY KEY (`ADRESSE_MAIL`,`NUMERO_LICENCE`),
  KEY `I_FK_REL_1_DEMANDEURS` (`ADRESSE_MAIL`),
  KEY `I_FK_REL_1_ADHERENTS` (`NUMERO_LICENCE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `rel_1`
--

INSERT INTO `rel_1` (`ADRESSE_MAIL`, `NUMERO_LICENCE`) VALUES
('test2@gmail.com', 443);

-- --------------------------------------------------------

--
-- Structure de la table `tresoriers`
--

CREATE TABLE IF NOT EXISTS `tresoriers` (
  `ADRESSE_MAIL` varchar(128) NOT NULL,
  `NOM` varchar(50) NOT NULL,
  `PRENOM` varchar(50) NOT NULL,
  `MOT_DE_PASSE` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ADRESSE_MAIL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tresoriers`
--

INSERT INTO `tresoriers` (`ADRESSE_MAIL`, `NOM`, `PRENOM`, `MOT_DE_PASSE`) VALUES
('test@gmail.com', 'preel', 'tommy', '12345');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
