-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 16 avr. 2018 à 19:56
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

DROP PROCEDURE IF EXISTS `nouveau_membre`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `nouveau_membre` (IN `p_nom` VARCHAR(50), IN `p_prenom` VARCHAR(50), IN `p_role` VARCHAR(20), IN `p_image` TEXT)  NO SQL
INSERT INTO membre_bde 
(Nom, Prenom, Role, Image)
VALUES (p_nom,p_prenom, p_role, p_image)$$

DROP PROCEDURE IF EXISTS `suppr_membre_bde`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `suppr_membre_bde` (IN `nommembre` VARCHAR(50))  NO SQL
DELETE FROM `membre_bde` 
        WHERE `membre_bde`.`nom` = `nommembre`$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `article_bde`
--

DROP TABLE IF EXISTS `article_bde`;
CREATE TABLE IF NOT EXISTS `article_bde` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Image` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article_bde`
--

INSERT INTO `article_bde` (`ID`, `Nom`, `Description`, `Image`) VALUES
(5, 'NOTRE TROISIEME ARTICLE', 'PAR C\'EST NOTRE HISTORISME ARTICLE', '5ad4b0538f354.jpg'),
(4, 'Notre deuxième article', 'Et oui, c\'est déjà notre deuxième article, on est grave rapide, non ?', '5ad4af536b05c.jpg'),
(3, 'Création du site internet', 'Après tant d\'attentes, notre site internet est enfin en ligne!\r\nN\'hésitez plus à le parcourir de fond en comble, et à regarder les différents événements.\r\nNous passerons dorénavant par ce site afin de vous prévenir de ces derniers.\r\nUne boutique est aussi disponible pour ceux qui n\'ont pas encore tous leurs goodies à l\'effigie du CESI.', '5ad4af06b3028.jpg');

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
  `Report` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`Id`, `Id_photo`, `Id_utilisateur`, `Date`, `Commentaire`, `Report`) VALUES
(1, 1, 17, '2018-04-11 07:30:34', 'Ceci est un commentaire', 0),
(2, 1, 16, '2018-04-10 00:00:00', 'Ceci est un autre commentaire', 0),
(40, 2, 17, '2018-04-16 17:46:48', 'Ceci est u', 0),
(13, 3, 19, '2018-04-12 22:05:21', 'Loick', 0),
(14, 3, 19, '2018-04-12 22:05:26', 'Loick', 0),
(16, 3, 19, '2018-04-12 22:06:45', 'rht', 0),
(17, 3, 19, '2018-04-12 22:06:47', 'rhtt', 0),
(18, 3, 19, '2018-04-12 22:07:10', '1', 0),
(19, 3, 19, '2018-04-12 22:07:57', 'dfv', 0),
(20, 3, 19, '2018-04-12 22:09:05', 'dfverg', 0),
(21, 3, 19, '2018-04-12 22:15:36', 'azer', 0),
(22, 3, 19, '2018-04-12 22:15:56', 'teer', 0),
(23, 3, 19, '2018-04-13 08:26:19', 'JADORE CETE IMAGE', 0),
(24, 3, 19, '2018-04-13 08:26:23', 'JADORE CETE IMAGE', 0),
(25, 3, 19, '2018-04-13 08:26:24', 'JADORE CETE IMAGE', 0),
(26, 3, 19, '2018-04-13 08:26:26', 'JADORE CETE IMAGE', 0),
(27, 3, 19, '2018-04-13 08:27:24', 'bhg', 0),
(28, 3, 19, '2018-04-13 08:27:28', 'bhg', 0),
(29, 3, 19, '2018-04-13 08:27:28', 'bhg', 0),
(30, 4, 19, '2018-04-13 08:28:18', 'Je veux commenter', 0),
(31, 4, 19, '2018-04-13 08:29:06', '', 0),
(32, 4, 19, '2018-04-13 08:29:11', '', 0),
(33, 4, 19, '2018-04-13 08:29:12', '', 0),
(38, 2, 20, '2018-04-16 16:46:53', 'Bamlbzal', 1),
(37, 4, 17, '2018-04-16 16:46:01', 'testttttttt', 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`Id`, `Nom`, `Description`, `Image`, `Type`, `Date`, `Statut`, `Visibilite`, `Inscrits`) VALUES
(8, 'erz', 'Comme son nom l\'indique, erz est une représentation de notre monde selon le point de vue d\'un enfant malade.', '5acdebb599ad2.jpg', 0, '2018-04-19', 0, 1, '18'),
(7, 'Test image', 'Ces belles tulipes sont des tulipes, et donc ce ne sont pas des roses.\r\nCar les roses sont roses, les violettes sont bleues, les tulipes sont des tulipes.', '5acdeba6b9f1f.jpg', 0, '2018-05-04', 0, 1, '18'),
(9, 'Koala', 'Ceci est un Koala, les koala sont mignons et mangent des feuilles d\'eucalyptus.\r\nC\'est très bon.', '5acdef4b155d1.jpg', 0, '2018-04-12', 0, 1, '18|17'),
(10, 'Orange', 'Cette fleur est orange, comme la couleur.\r\nLes fleurs sont belles. Comme les roses.\r\nRose est une rosa esa una rosa is a rose.\r\nJe ne sais pas ce que ça veux dire mais ça à l\'air sympa.\r\nÇa me rappelle quand je mangeais des skittles oranges. C\'était top.', '5acdefb123231.jpg', 2, '2018-04-06', 0, 1, '18'),
(11, 'Découvrir les méduses', '', '5acdf08e3260a.jpg', 1, '2018-04-06', 0, 1, ''),
(21, 'Faire un tour de voiture', 'Mon idée serait de créer un circuit tout terrain de voiture, afin de faire des courses et le gagnant volerait les voitures de tous les participants.', '5ace2b9a43603.jpg', 2, '2018-04-13', 0, 1, ''),
(22, 'Sortie en moto !', 'Une sortie en moto, ça vous tente?\r\nSi oui, inscrivez-vous à cet évènement... c\'est gratuit !', '5acf842159ae8.jpg', 1, '2018-04-12', 1, 1, '19|17'),
(23, 'Grosse soirée disco', 'C\'est l\'histoire d\'un chat sur une licorne, ainsi est né le ChatCorne, la plus grosse soirée inexistante du monde.', '5ad4aac0c7cbc.png', 3, '2018-04-20', 0, 1, '');

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
(2, 'Faire un tour de voiture', 'Mon idée serait de créer un circuit tout terrain de voiture', 0, '15|15|14|17|20'),
(3, 'Enore un test', 'Cesi est encore une fois un test d\'idée proposé par quelsu\'un', 0, '31|14|17|20');

-- --------------------------------------------------------

--
-- Structure de la table `membre_bde`
--

DROP TABLE IF EXISTS `membre_bde`;
CREATE TABLE IF NOT EXISTS `membre_bde` (
  `ID_membre` int(50) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(35) NOT NULL,
  `Prenom` varchar(35) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Image` text NOT NULL,
  PRIMARY KEY (`ID_membre`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membre_bde`
--

INSERT INTO `membre_bde` (`ID_membre`, `Nom`, `Prenom`, `Role`, `Image`) VALUES
(24, 'Guillotin', 'Kylian', 'Président', 'kylian.jpg'),
(41, 'Pasquet', 'Vincent', 'Vice-président', '5ad34a01d712c.jpg'),
(28, 'Gourbiliere', 'Victor', 'Trésorier', 'victor.jpg'),
(29, 'Olivier', 'Nathan', 'Touriste', 'nathan.jpg');

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
  `Report` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`Id`, `Id_utilisateur`, `Id_evenement`, `Nom`, `Image`, `Likes`, `Report`) VALUES
(1, 19, 13, 'Test poto !', '5acf4c8ab3209.jpg', '0', 0),
(2, 19, 22, 'Belle sortie', '5acf86e93bd3d.jpg', '', 1),
(5, 17, 22, 'tester', '5ad34940ec415.png', '', 1),
(4, 19, 22, 'Je test les photos', '5ad067110399e.png', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(15) NOT NULL,
  `Prenom` varchar(15) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Mdp` varchar(20) NOT NULL,
  `Type` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`Id`, `Nom`, `Prenom`, `Email`, `Mdp`, `Type`) VALUES
(19, 'Loick', 'Legay', 'test@test.com', 'Isisyouka09', 1),
(18, 'Loick', 'Legay', 'azer@o', 'Jean123', 1),
(17, 'Lamarre', 'Jean', 'membrebde@viacesi.fr', 'Membre123', 2),
(16, 'aze', 'aze', 'aze', 'azeA111', 1),
(15, 'loick', 'lolo', 'test', 'testT56', 1),
(14, 'uytyjt', 'tyutnt', 'loick@orange.froiu', 'azer4SS', 1),
(20, 'Membre', 'Bde', 'membrecesi@viacesi.fr', 'Membre123', 3);

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
