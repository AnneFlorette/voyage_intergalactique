-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 30 jan. 2018 à 13:17
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
-- Base de données :  `voyageinterg`
--

-- --------------------------------------------------------

--
-- Structure de la table `travels`
--

DROP TABLE IF EXISTS `travels`;
CREATE TABLE IF NOT EXISTS `travels` (
  `travel_id` int(11) NOT NULL AUTO_INCREMENT,
  `places` int(11) DEFAULT NULL,
  `travel_name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`travel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` char(25) DEFAULT NULL,
  `first_name` char(25) DEFAULT NULL,
  `mail` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users_history`
--

DROP TABLE IF EXISTS `users_history`;
CREATE TABLE IF NOT EXISTS `users_history` (
  `travel_date` date DEFAULT NULL,
  `reservation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `historic_id` int(11) NOT NULL AUTO_INCREMENT,
  `travel_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`historic_id`),
  KEY `FK_users_history_travel_id` (`travel_id`),
  KEY `FK_users_history_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `users_history`
--
ALTER TABLE `users_history`
  ADD CONSTRAINT `FK_users_history_travel_id` FOREIGN KEY (`travel_id`) REFERENCES `travels` (`travel_id`),
  ADD CONSTRAINT `FK_users_history_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
