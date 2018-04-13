-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 12 avr. 2018 à 22:35
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetweb`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `AjouterUtilisateur`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AjouterUtilisateur` (IN `p_Mdp` TEXT, IN `p_Email` TEXT, IN `p_Nom` VARCHAR(20), IN `p_Prenom` VARCHAR(20))  NO SQL
INSERT INTO utilisateurs 
(Mdp, Email, Nom, Prenom, Type)
VALUES (p_Mdp,p_Email, p_Nom,p_Prenom,1)$$

DROP PROCEDURE IF EXISTS `EnvoyerIdee`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `EnvoyerIdee` (IN `p_Nom` VARCHAR(50), IN `p_Message` TEXT)  NO SQL
INSERT INTO idees 
(Nom, Description, Votes)
VALUES (p_Nom,p_Message, 0)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_photo` int(11) NOT NULL,
  `Id_utilisateur` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `Commentaire` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`Id`, `Id_photo`, `Id_utilisateur`, `Date`, `Commentaire`) VALUES
(1, 1, 17, '2018-04-11 07:30:34', 'Ceci est un commentaire'),
(2, 1, 16, '2018-04-10 00:00:00', 'Ceci est un autre commentaire'),
(3, 2, 17, '2018-04-12 00:00:00', 'J\'avoue, j\'étais là c\'était pas mal !'),
(4, 2, 15, '2018-04-12 00:00:00', 'testtt'),
(5, 2, 19, '2018-04-12 00:00:00', 'testtt'),
(6, 2, 19, '2018-04-12 00:00:00', 'rgedrrs'),
(7, 2, 19, '2018-04-12 00:00:00', 'zze'),
(8, 2, 19, '2018-04-12 00:00:00', 'svs'),
(9, 2, 19, '2018-04-12 21:49:35', 'sdvsd'),
(10, 2, 19, '2018-04-12 21:52:46', 'csdcsdc'),
(11, 2, 19, '2018-04-12 22:00:01', 'Ceci est un test'),
(12, 2, 19, '2018-04-12 22:01:02', 'erge'),
(13, 3, 19, '2018-04-12 22:05:21', 'Loick'),
(14, 3, 19, '2018-04-12 22:05:26', 'Loick'),
(15, 2, 19, '2018-04-12 22:05:31', 'Loickdcs'),
(16, 3, 19, '2018-04-12 22:06:45', 'rht'),
(17, 3, 19, '2018-04-12 22:06:47', 'rhtt'),
(18, 3, 19, '2018-04-12 22:07:10', '1'),
(19, 3, 19, '2018-04-12 22:07:57', 'dfv'),
(20, 3, 19, '2018-04-12 22:09:05', 'dfverg'),
(21, 3, 19, '2018-04-12 22:15:36', 'azer'),
(22, 3, 19, '2018-04-12 22:15:56', 'teer');

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Image` text NOT NULL,
  `Type` int(11) NOT NULL COMMENT '1 : sortie, 2 : sport, 3 : soirée, 4 : autres',
  `Date` date NOT NULL,
  `Statut` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 : à venir    1 : passé',
  `Visibilite` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 : invisible    1 : visible',
  `Inscrits` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`Id`, `Nom`, `Description`, `Image`, `Type`, `Date`, `Statut`, `Visibilite`, `Inscrits`) VALUES
(8, 'erz', '', '5acdebb599ad2.jpg', 0, '2018-04-19', 0, 1, '18'),
(7, 'Test image', 'Ces belles tulipes', '5acdeba6b9f1f.jpg', 0, '2018-05-04', 0, 1, '18'),
(9, 'Koala', 'Ceci est un Koala', '5acdef4b155d1.jpg', 0, '2018-04-12', 0, 1, '18'),
(10, 'Orange', 'Orange', '5acdefb123231.jpg', 2, '2018-04-06', 0, 1, '18'),
(11, 'Découvrir les méduses', '', '5acdf08e3260a.jpg', 1, '2018-04-06', 0, 1, ''),
(21, 'Faire un tour de voiture', 'Mon idée serait de créer un circuit tout terrain de voiture', '5ace2b9a43603.jpg', 2, '2018-04-13', 0, 1, ''),
(22, 'Sortie en moto !', 'Une sortie en moto, ça vous tente?\r\nSi oui, inscrivez-vous à cet évènement... c\'est gratuit !', '5acf842159ae8.jpg', 1, '2018-04-12', 1, 1, '19');

-- --------------------------------------------------------

--
-- Structure de la table `goodies`
--

DROP TABLE IF EXISTS `goodies`;
CREATE TABLE IF NOT EXISTS `goodies` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(15) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Prix` int(11) NOT NULL,
  `Categorie` tinyint(4) NOT NULL,
  `QuantCom` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `idees`
--

DROP TABLE IF EXISTS `idees`;
CREATE TABLE IF NOT EXISTS `idees` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Votes` smallint(6) NOT NULL,
  `Votes_utilisateurs` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `idees`
--

INSERT INTO `idees` (`Id`, `Nom`, `Description`, `Votes`, `Votes_utilisateurs`) VALUES
(1, 'test', 'messagetest', 0, '61|15|14|17'),
(2, 'Faire un tour de voiture', 'Mon idée serait de créer un circuit tout terrain de voiture', 0, '15|15|14|17'),
(3, 'Enore un test', 'Cesi est encore une fois un test d\'idée proposé par quelsu\'un', 0, '31|14|17');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_utilisateur` int(11) NOT NULL,
  `Id_Goodie` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_utilisateur` int(11) NOT NULL,
  `Id_evenement` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Image` text NOT NULL,
  `Likes` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`Id`, `Id_utilisateur`, `Id_evenement`, `Nom`, `Image`, `Likes`) VALUES
(1, 19, 13, 'Test poto !', '5acf4c8ab3209.jpg', '0'),
(2, 19, 22, 'Belle sortie', '5acf86e93bd3d.jpg', ''),
(3, 19, 22, 'Des trucs chiant', '5acfd74252f6a.png', '');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(15) NOT NULL,
  `Prenom` varchar(15) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Mdp` varchar(20) NOT NULL,
  `Type` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`Id`, `Nom`, `Prenom`, `Email`, `Mdp`, `Type`) VALUES
(19, 'Loick', 'Legay', 'test@test.com', 'Isisyouka09', 1),
(18, 'Loick', 'Legay', 'azer@o', 'Jean123', 1),
(17, 'Lamarre', 'Jean', 'jean@viacesi.fr', 'Jean123', 2),
(16, 'aze', 'aze', 'aze', 'azeA111', 1),
(15, 'loick', 'lolo', 'test', 'testT56', 1),
(14, 'uytyjt', 'tyutnt', 'loick@orange.froiu', 'azer4SS', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vote_idees`
--

DROP TABLE IF EXISTS `vote_idees`;
CREATE TABLE IF NOT EXISTS `vote_idees` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_utilisateur` smallint(6) NOT NULL,
  `Id_idee` smallint(6) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
