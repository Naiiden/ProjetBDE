-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 13 Avril 2018 à 13:25
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `AjouterUtilisateur` (IN `p_Mdp` TEXT, IN `p_Email` TEXT, IN `p_Nom` VARCHAR(20), IN `p_Prenom` VARCHAR(20))  NO SQL
INSERT INTO utilisateurs 
(Mdp, Email, Nom, Prenom, Type)
VALUES (p_Mdp,p_Email, p_Nom,p_Prenom,1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `EnvoyerIdee` (IN `p_Nom` VARCHAR(50), IN `p_Message` TEXT)  NO SQL
INSERT INTO idees 
(Nom, Description, Votes)
VALUES (p_Nom,p_Message, 0)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `nouveau_membre` (IN `p_nom` VARCHAR(50), IN `p_prenom` VARCHAR(50), IN `p_role` VARCHAR(20), IN `p_image` TEXT)  NO SQL
INSERT INTO membre_bde 
(Nom, Prenom, Role, Image)
VALUES (p_nom,p_prenom, p_role, p_image)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `suppr_membre_bde` (IN `nommembre` VARCHAR(50))  NO SQL
DELETE FROM `membre_bde` 
        WHERE `membre_bde`.`nom` = `nommembre`$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `Id` int(11) NOT NULL,
  `Id_photo` int(11) NOT NULL,
  `Id_utilisateur` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `Commentaire` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commentaires`
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
(22, 3, 19, '2018-04-12 22:15:56', 'teer'),
(23, 3, 19, '2018-04-13 08:26:19', 'JADORE CETE IMAGE'),
(24, 3, 19, '2018-04-13 08:26:23', 'JADORE CETE IMAGE'),
(25, 3, 19, '2018-04-13 08:26:24', 'JADORE CETE IMAGE'),
(26, 3, 19, '2018-04-13 08:26:26', 'JADORE CETE IMAGE'),
(27, 3, 19, '2018-04-13 08:27:24', 'bhg'),
(28, 3, 19, '2018-04-13 08:27:28', 'bhg'),
(29, 3, 19, '2018-04-13 08:27:28', 'bhg'),
(30, 4, 19, '2018-04-13 08:28:18', 'Je veux commenter'),
(31, 4, 19, '2018-04-13 08:29:06', ''),
(32, 4, 19, '2018-04-13 08:29:11', ''),
(33, 4, 19, '2018-04-13 08:29:12', '');

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE `evenements` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Image` text NOT NULL,
  `Type` int(11) NOT NULL COMMENT '1 : sortie, 2 : sport, 3 : soirée, 4 : autres',
  `Date` date NOT NULL,
  `Statut` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 : à venir    1 : passé',
  `Visibilite` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 : invisible    1 : visible',
  `Inscrits` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `evenements`
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

CREATE TABLE `goodies` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(15) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Prix` int(11) NOT NULL,
  `Categorie` tinyint(4) NOT NULL,
  `QuantCom` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `idees`
--

CREATE TABLE `idees` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Votes` smallint(6) NOT NULL,
  `Votes_utilisateurs` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `idees`
--

INSERT INTO `idees` (`Id`, `Nom`, `Description`, `Votes`, `Votes_utilisateurs`) VALUES
(1, 'test', 'messagetest', 0, '61|15|14|17'),
(2, 'Faire un tour de voiture', 'Mon idée serait de créer un circuit tout terrain de voiture', 0, '15|15|14|17'),
(3, 'Enore un test', 'Cesi est encore une fois un test d\'idée proposé par quelsu\'un', 0, '31|14|17');

-- --------------------------------------------------------

--
-- Structure de la table `membre_bde`
--

CREATE TABLE `membre_bde` (
  `ID_membre` int(50) NOT NULL,
  `Nom` varchar(35) NOT NULL,
  `Prenom` varchar(35) NOT NULL,
  `Role` varchar(50) NOT NULL,
  `Image` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre_bde`
--

INSERT INTO `membre_bde` (`ID_membre`, `Nom`, `Prenom`, `Role`, `Image`) VALUES
(24, 'Guillotin', 'Kylian', 'Président', 'kylian.jpg'),
(25, 'Pasquet', 'Vincent', 'Vice-Président', 'vincent.jpg'),
(26, 'Legay', 'Loick', 'pd', 'loick.jpg'),
(28, 'Gourbiliere', 'Victor', 'Trésorier', 'victor.jpg'),
(29, 'Olivier', 'Nathan', 'Touriste', 'nathan.jpg'),
(37, 'Spataro', 'Flavien', 'BlackJack pro', '5ad0af8c1e604.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `Id` int(11) NOT NULL,
  `Id_utilisateur` int(11) NOT NULL,
  `Id_Goodie` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `Id` int(11) NOT NULL,
  `Id_utilisateur` int(11) NOT NULL,
  `Id_evenement` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Image` text NOT NULL,
  `Likes` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `photos`
--

INSERT INTO `photos` (`Id`, `Id_utilisateur`, `Id_evenement`, `Nom`, `Image`, `Likes`) VALUES
(1, 19, 13, 'Test poto !', '5acf4c8ab3209.jpg', '0'),
(2, 19, 22, 'Belle sortie', '5acf86e93bd3d.jpg', ''),
(3, 19, 22, 'Des trucs chiant', '5acfd74252f6a.png', ''),
(4, 19, 22, 'Je test les photos', '5ad067110399e.png', '');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(15) NOT NULL,
  `Prenom` varchar(15) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Mdp` varchar(20) NOT NULL,
  `Type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`Id`, `Nom`, `Prenom`, `Email`, `Mdp`, `Type`) VALUES
(19, 'Loick', 'Legay', 'test@test.com', 'Isisyouka09', 1),
(18, 'Loick', 'Legay', 'azer@o', 'Jean123', 1),
(17, 'Lamarre', 'Jean', 'jean@viacesi.fr', 'Jean123', 2),
(16, 'aze', 'aze', 'aze', 'azeA111', 1),
(15, 'loick', 'lolo', 'test', 'testT56', 1),
(14, 'uytyjt', 'tyutnt', 'loick@orange.froiu', 'azer4SS', 1),
(20, 'Membre', 'Bde', 'membrebde@viacesi.fr', 'Membre123', 3);

-- --------------------------------------------------------

--
-- Structure de la table `vote_idees`
--

CREATE TABLE `vote_idees` (
  `Id` int(11) NOT NULL,
  `Id_utilisateur` smallint(6) NOT NULL,
  `Id_idee` smallint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `goodies`
--
ALTER TABLE `goodies`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `idees`
--
ALTER TABLE `idees`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `membre_bde`
--
ALTER TABLE `membre_bde`
  ADD PRIMARY KEY (`ID_membre`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `vote_idees`
--
ALTER TABLE `vote_idees`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `goodies`
--
ALTER TABLE `goodies`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `idees`
--
ALTER TABLE `idees`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `membre_bde`
--
ALTER TABLE `membre_bde`
  MODIFY `ID_membre` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `vote_idees`
--
ALTER TABLE `vote_idees`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
