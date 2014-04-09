-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 08 Avril 2014 à 19:49
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `wonderpicture`
--
CREATE DATABASE IF NOT EXISTS `wonderpicture` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `wonderpicture`;

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `date_create` datetime NOT NULL,
  `thumb` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `album`
--

INSERT INTO `album` (`id`, `name`, `description`, `public`, `date_create`, `thumb`) VALUES
(9, 'City', 'City', 1, '2014-04-04 20:44:27', 'Uploads/thumbs/albums/City.jpg'),
(10, 'Nature', 'Nature', 1, '2014-04-04 20:48:20', 'Uploads/thumbs/albums/Nature.jpg'),
(11, 'Couleur', 'Couleur', 1, '2014-04-04 20:49:15', 'Uploads/thumbs/albums/Couleur.jpg'),
(12, 'Chicago', 'Chicago', 0, '2014-04-04 20:57:58', 'Uploads/thumbs/albums/Chicago.JPG');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_publish` datetime NOT NULL,
  `date_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_picture_id` (`picture_id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `picture_id`, `user_id`, `comment`, `date_publish`, `date_update`) VALUES
(1, 13, 11, 'Sublime', '2014-04-05 16:32:22', NULL),
(2, 13, 9, 'TrÃ¨s belle photo !', '2014-04-05 16:38:04', NULL),
(3, 13, 10, '+1', '2014-04-05 16:38:56', NULL),
(4, 13, 12, '+1', '2014-04-05 16:39:13', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `picture_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk2_picture_id` (`picture_id`),
  KEY `fk2_user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`id`, `note`, `user_id`, `picture_id`) VALUES
(1, 4, 11, 13),
(2, 5, 9, 13),
(3, 2, 10, 13),
(4, 5, 12, 13);

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `url` varchar(40) NOT NULL,
  `urlmin` varchar(40) NOT NULL,
  `type` varchar(20) NOT NULL,
  `size` int(11) NOT NULL,
  `width` smallint(6) NOT NULL,
  `height` smallint(6) NOT NULL,
  `date_import` datetime NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `album_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_album_id` (`album_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `picture`
--

INSERT INTO `picture` (`id`, `name`, `description`, `url`, `urlmin`, `type`, `size`, `width`, `height`, `date_import`, `public`, `album_id`) VALUES
(10, 'New_York', 'New York', 'Uploads/pictures/New York.jpg', 'Uploads/thumbs/pictures/New York.jpg', 'jpg', 421, 1680, 1050, '2014-04-04 20:44:40', 1, 9),
(11, 'Cloud_Gate', 'Cloud Gate', 'Uploads/pictures/Cloud Gate.jpg', 'Uploads/thumbs/pictures/Cloud Gate.jpg', 'jpg', 903, 2560, 1600, '2014-04-04 20:44:51', 1, 9),
(12, 'Chicago', 'Chicago', 'Uploads/pictures/Chicago.jpg', 'Uploads/thumbs/pictures/Chicago.jpg', 'jpg', 496, 1920, 1080, '2014-04-04 20:45:02', 1, 9),
(13, 'Golden_Gate', 'Golden Gate', 'Uploads/pictures/Golden Gate.jpg', 'Uploads/thumbs/pictures/Golden Gate.jpg', 'jpg', 259, 1600, 1200, '2014-04-04 20:46:20', 1, 9),
(14, 'Fleur', 'Fleur', 'Uploads/pictures/Fleur.jpg', 'Uploads/thumbs/pictures/Fleur.jpg', 'jpg', 98, 1280, 800, '2014-04-04 20:48:30', 1, 10),
(15, 'Montagne', 'Montagne', 'Uploads/pictures/Montagne.jpg', 'Uploads/thumbs/pictures/Montagne.jpg', 'jpg', 1880, 1920, 1200, '2014-04-04 20:48:39', 1, 10),
(16, 'Eau', 'Eau', 'Uploads/pictures/Eau.jpg', 'Uploads/thumbs/pictures/Eau.jpg', 'jpg', 615, 1600, 1200, '2014-04-04 20:48:49', 1, 10),
(17, 'It', 'It', 'Uploads/pictures/It.jpg', 'Uploads/thumbs/pictures/It.jpg', 'jpg', 808, 1920, 1080, '2014-04-04 20:49:37', 1, 11),
(18, 'Your', 'Your', 'Uploads/pictures/Your.jpg', 'Uploads/thumbs/pictures/Your.jpg', 'jpg', 737, 3000, 2000, '2014-04-04 20:49:49', 1, 11),
(20, 'DownTown', 'Downtown', 'Uploads/pictures/DownTown.JPG', 'Uploads/thumbs/pictures/DownTown.JPG', 'JPG', 517, 1900, 1272, '2014-04-04 21:00:55', 0, 12),
(21, 'Navy_Pier', 'Navy Pier', 'Uploads/pictures/Navy Pier.JPG', 'Uploads/thumbs/pictures/Navy Pier.JPG', 'JPG', 570, 1900, 1272, '2014-04-04 21:04:25', 0, 12);

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thumb_size` smallint(6) NOT NULL DEFAULT '400',
  `thumb_quality` tinyint(4) NOT NULL DEFAULT '75',
  `order_picture` varchar(50) NOT NULL DEFAULT 'date',
  `order_album` varchar(50) NOT NULL DEFAULT 'date',
  `nombre` tinyint(4) NOT NULL DEFAULT '20',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `settings`
--

INSERT INTO `settings` (`id`, `thumb_size`, `thumb_quality`, `order_picture`, `order_album`, `nombre`) VALUES
(1, 400, 75, 'date', 'date', 20);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `statut` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `avatar`, `statut`) VALUES
(8, 'admin', 'admin@admi.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', '/Uploads/avatar/admin.png', 2),
(9, 'Thibault', 'contact@thibaultpatois.com', '55cbe7fd00627a28668d1d7c9899bdb602dad69d', '/Uploads/avatar/thib.png', 1),
(10, 'Hong Ngoc', 'contact@hongngoc.com', '55cbe7fd00627a28668d1d7c9899bdb602dad69d', '/Uploads/avatar/ngocky.png', 1),
(11, 'Mathieu', 'contact@mathieu.com', '55cbe7fd00627a28668d1d7c9899bdb602dad69d', '/Uploads/avatar/mathieu.png', 1),
(12, 'Quentin', 'contact@quentin.com', '55cbe7fd00627a28668d1d7c9899bdb602dad69d', '/Uploads/avatar/quentin.png', 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_picture_id` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `fk2_picture_id` FOREIGN KEY (`picture_id`) REFERENCES `picture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk2_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `fk_album_id` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
