-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 20 Avril 2018 à 08:50
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
-- Structure de la table `article_bde`
--

CREATE TABLE `article_bde` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  `Image` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `article_bde`
--

INSERT INTO `article_bde` (`ID`, `Nom`, `Description`, `Image`) VALUES
(4, 'Notre deuxième article', 'Et oui, c\'est déjà notre deuxième article, on est grave rapide, non ?', '5ad4af536b05c.jpg'),
(3, 'Création du site internet', 'Après tant d\'attentes, notre site internet est enfin en ligne!\r\nN\'hésitez plus à le parcourir de fond en comble, et à regarder les différents événements.\r\nNous passerons dorénavant par ce site afin de vous prévenir de ces derniers.\r\nUne boutique est aussi disponible pour ceux qui n\'ont pas encore tous leurs goodies à l\'effigie du CESI.', '5ad4af06b3028.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `categories_goodies`
--

CREATE TABLE `categories_goodies` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `categories_goodies`
--

INSERT INTO `categories_goodies` (`Id`, `Nom`) VALUES
(1, 'Vêtements'),
(2, 'Accessoires');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `Id` int(11) NOT NULL,
  `Id_photo` int(11) NOT NULL,
  `Id_utilisateur` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `Commentaire` text NOT NULL,
  `Report` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`Id`, `Id_photo`, `Id_utilisateur`, `Date`, `Commentaire`, `Report`) VALUES
(67, 6, 29, '2018-04-20 10:47:33', 'C\'était vraiment très sympa!', 0);

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
(26, 'Visite d\'entreprise', 'Vous êtes-vous déjà demandé à quoi ressemble une entreprise prospère? \r\nVous pouvez en savoir plus sur notre voyage à l\'une des installations d\'IBM dans les Alpes. En une semaine, vous apprendrez toutes les informations dont vous avez besoin pour devenir votre propre entreprise rentable et stable.', '5ad9a62c0c793.jpg', 1, '2018-05-08', 0, 1, ''),
(27, 'Bières et chopes de pornichet', 'En soutiens à l\'équipe de raids humanitaires du CESI, nous organisons une levée de fonds', '5ad9a6a2e7900.jpg', 3, '2018-05-16', 0, 1, '29'),
(28, 'Manifestation contre les violences aux femmes', 'Nous organisons une marche pour défendre les droits des femmes, nous vous attendons nombreux en ce jour! ', '5ad9a7187c0c6.png', 4, '2018-04-14', 1, 1, '29'),
(25, 'Javathlon', 'Le Javathlon revient pour sa 19eme édition!\r\nL\'événement dure 5 jours, il consiste  programmer un jeu vidéo en JAVA seulement, par groupe de 5 personnes maximum!\r\nN\'attendez plus et foncez vous inscrire!', '5ad9a5cc12166.png', 4, '2018-04-30', 0, 1, '');

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
  `QuantCom` int(255) DEFAULT '0',
  `Image` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `goodies`
--

INSERT INTO `goodies` (`Id`, `Nom`, `Description`, `Prix`, `Categorie`, `QuantCom`, `Image`) VALUES
(45, 'Bracelet', 'Un bracelet tendance.', 13, 2, 0, '5ad9a17eaf699.jpg'),
(44, 'Sacoche', 'Une sacoche très grande, avec 4 poches dont une intérieure.', 25, 1, 0, '5ad9a16cdd730.jpg'),
(43, 'SweatShirt R&B', 'Un super sweatshirt au style indémodable.', 43, 1, 0, '5ad9a145632ac.jpg'),
(42, 'Casquette R&B', 'Une casquette aux couleurs de l\'EXIA!', 16, 1, 0, '5ad9a122b7b88.jpg'),
(46, 'Clé usb', 'Une clé USB de 32GB !', 26, 2, 0, '5ad9a19504aa3.jpg'),
(47, 'Écouteurs', 'Une très belle paire d\'écouteurs', 7, 2, 0, '5ad9a1a905cf9.png'),
(48, 'Porte clés', 'Une porte clés rond, très discret.', 5, 2, 0, '5ad9a1bbf1b28.jpg'),
(49, 'Tapis de souris', 'Tapis de souris moelleux, d\'une longueur de 32 cm.', 17, 2, 0, '5ad9a1d317600.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `idees`
--

CREATE TABLE `idees` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Votes` smallint(6) DEFAULT NULL,
  `Votes_utilisateurs` text,
  `Email_envoyeur` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `idees`
--

INSERT INTO `idees` (`Id`, `Nom`, `Description`, `Votes`, `Votes_utilisateurs`, `Email_envoyeur`) VALUES
(7, 'Venue du DJ Twonot', 'Le DJ Twonot revient dans la région, on pourrait organiser une soirée avec lui ?', NULL, NULL, 'hugo.plissonneau@viacesi.Fr'),
(8, 'Fêter la fin d\'année', 'On pourrait fêter la fin d\'année en faisant une sortie en kart ou en jetski vous en pensez quoi ?', NULL, NULL, 'victor.gourbiliere@viacesi.Fr');

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
(41, 'Pasquet', 'Vincent', 'Vice-Président', '5ad34a01d712c.jpg'),
(51, 'Gourbiliere', 'Victor', 'Trésorier', '5ad9a8de8b46b.jpg'),
(29, 'Olivier', 'Nathan', 'Président', 'nathan.jpg'),
(50, 'Spataro', 'Flavien', 'Mascotte', '5ad9a89070898.jpg'),
(44, 'Gallet', 'Jérémy', 'DJ', '5ad5f0ad41cc2.png');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `Id` int(255) NOT NULL,
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
  `Likes` text NOT NULL,
  `Report` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `photos`
--

INSERT INTO `photos` (`Id`, `Id_utilisateur`, `Id_evenement`, `Nom`, `Image`, `Likes`, `Report`) VALUES
(6, 29, 28, 'Réunion avant la marche', '5ad9a7edeada4.jpg', '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(15) NOT NULL,
  `Prenom` varchar(15) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Mdp` text NOT NULL,
  `Type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`Id`, `Nom`, `Prenom`, `Email`, `Mdp`, `Type`) VALUES
(28, 'Gallet', 'Jeremy', 'membrecesi@viacesi.fr', '$2y$10$FaV6mnBjVThFyK8NTzXb3OwXHFUNQeRZnPd7Cx9dxwWNQPpFSaEDS', 3),
(29, 'Gourbiliere', 'Victor', 'membrebde@viacesi.fr', '$2y$10$2N4LeojbOf6MXiKGg9rBGuHA0ATYdZNwigCkwomPnG1iUdWDycavS', 2),
(31, 'Legay', 'Loick', 'etudiant@viacesi.fr', '$2y$10$0jI98zgTCYiPHW0LjttTR.tRZeSaDbFQF/vlIms2nB3Cl8cb1/O7S', 1);

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
-- Index pour la table `article_bde`
--
ALTER TABLE `article_bde`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `categories_goodies`
--
ALTER TABLE `categories_goodies`
  ADD PRIMARY KEY (`Id`);

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
-- AUTO_INCREMENT pour la table `article_bde`
--
ALTER TABLE `article_bde`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `categories_goodies`
--
ALTER TABLE `categories_goodies`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT pour la table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `goodies`
--
ALTER TABLE `goodies`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT pour la table `idees`
--
ALTER TABLE `idees`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `membre_bde`
--
ALTER TABLE `membre_bde`
  MODIFY `ID_membre` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `vote_idees`
--
ALTER TABLE `vote_idees`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
