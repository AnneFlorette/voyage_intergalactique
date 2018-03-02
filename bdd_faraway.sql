-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 02 mars 2018 à 08:34
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdd_faraway`
--

-- --------------------------------------------------------

--
-- Structure de la table `travel`
--

DROP TABLE IF EXISTS `travel`;
CREATE TABLE IF NOT EXISTS `travel` (
  `travel_ID` int(11) NOT NULL AUTO_INCREMENT,
  `travel_destination` char(25) NOT NULL,
  `travel_depart_date` varchar(20) DEFAULT NULL,
  `travel_total_time` int(12) NOT NULL,
  `travel_total_places` int(11) NOT NULL,
  `travel_remain_places` int(11) NOT NULL,
  `travel_spaceship_type` char(25) NOT NULL,
  `travelpres_ID` int(11) NOT NULL,
  PRIMARY KEY (`travel_ID`),
  KEY `FK_TRAVEL_travelpres_ID` (`travelpres_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `travel`
--

INSERT INTO `travel` (`travel_ID`, `travel_destination`, `travel_depart_date`, `travel_total_time`, `travel_total_places`, `travel_remain_places`, `travel_spaceship_type`, `travelpres_ID`) VALUES
(1, 'Uranus', '2018-03-07', 15, 54, 54, 'aze', 2),
(2, 'Uranus', '2018-03-07', 15, 54, 54, 'aze', 2),
(3, 'Saturn', '2018-03-17', 15, 84, 84, 'coucou', 3);

-- --------------------------------------------------------

--
-- Structure de la table `travelpres`
--

DROP TABLE IF EXISTS `travelpres`;
CREATE TABLE IF NOT EXISTS `travelpres` (
  `travelpres_ID` int(11) NOT NULL AUTO_INCREMENT,
  `travelpres_destination` char(25) DEFAULT NULL,
  `travelpres_img_url` varchar(255) DEFAULT NULL,
  `travelpres_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`travelpres_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `travelpres`
--

INSERT INTO `travelpres` (`travelpres_ID`, `travelpres_destination`, `travelpres_img_url`, `travelpres_description`) VALUES
(1, 'Moon', 'img/moon.png', 'Tintin objectif lune'),
(2, 'Uranus', 'img/uranusG.png', 'The coaster planete'),
(3, 'Saturn', 'img/saturnG.png', 'The planete that do hula hoop'),
(4, 'Neptune', 'img/neptuneG.png', 'The deep blue planete'),
(5, 'Pluto', 'img/plutoG.png', 'The exo-planete where live the violent queen Anne Florette'),
(6, 'Mars', 'img/marsG.png', 'The red planete'),
(10, 'Jupiter', 'img/jupiterG.png', 'Test test test'),
(11, 'Jupiter', 'img/jupiterG.png', 'Test test test');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_first_name` char(40) DEFAULT NULL,
  `user_last_name` char(40) DEFAULT NULL,
  `user_mail` varchar(64) DEFAULT NULL,
  `user_password` varchar(64) DEFAULT NULL,
  `user_admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_ID`, `user_first_name`, `user_last_name`, `user_mail`, `user_password`, `user_admin`) VALUES
(2, 'Admin', 'Admin', 'admin@gmail.com', '9329d3275ac3f97c64b8678e80aba5398c796f66134b5a27457cd2abf35c7220', 1);

-- --------------------------------------------------------

--
-- Structure de la table `usersbooking`
--

DROP TABLE IF EXISTS `usersbooking`;
CREATE TABLE IF NOT EXISTS `usersbooking` (
  `userbooking_ID` int(11) NOT NULL AUTO_INCREMENT,
  `userbooking_booking_date` date NOT NULL,
  `userbooking_nbr_places` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `travel_ID` int(11) NOT NULL,
  PRIMARY KEY (`userbooking_ID`),
  KEY `FK_USERSBOOKING_user_ID` (`user_ID`),
  KEY `FK_USERSBOOKING_travel_ID` (`travel_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `travel`
--
ALTER TABLE `travel`
  ADD CONSTRAINT `FK_TRAVEL_travelpres_ID` FOREIGN KEY (`travelpres_ID`) REFERENCES `travelpres` (`travelpres_ID`);

--
-- Contraintes pour la table `usersbooking`
--
ALTER TABLE `usersbooking`
  ADD CONSTRAINT `FK_USERSBOOKING_travel_ID` FOREIGN KEY (`travel_ID`) REFERENCES `travel` (`travel_ID`),
  ADD CONSTRAINT `FK_USERSBOOKING_user_ID` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
