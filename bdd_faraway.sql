-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 07 Mars 2018 à 17:45
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `travel` (
  `travel_ID` int(11) NOT NULL,
  `travel_destination` char(25) NOT NULL,
  `travel_depart_date` varchar(20) DEFAULT NULL,
  `travel_remain_places` int(11) NOT NULL,
  `travelpres_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `travel`
--

INSERT INTO `travel` (`travel_ID`, `travel_destination`, `travel_depart_date`, `travel_remain_places`, `travelpres_ID`) VALUES
(13, 'Venus', '2018-03-24', 1250, 8);

-- --------------------------------------------------------

--
-- Structure de la table `travelpres`
--

CREATE TABLE `travelpres` (
  `travelpres_ID` int(11) NOT NULL,
  `travelpres_destination` char(25) DEFAULT NULL,
  `travelpres_img_url` varchar(255) DEFAULT NULL,
  `travelpres_description` varchar(255) DEFAULT NULL,
  `travelpres_days` int(11) NOT NULL,
  `travelpres_price_adult` int(11) NOT NULL,
  `travelpres_price_child` int(11) NOT NULL,
  `travelpres_total_places` int(11) NOT NULL DEFAULT '1250'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `travelpres`
--

INSERT INTO `travelpres` (`travelpres_ID`, `travelpres_destination`, `travelpres_img_url`, `travelpres_description`, `travelpres_days`, `travelpres_price_adult`, `travelpres_price_child`, `travelpres_total_places`) VALUES
(1, 'Moon', 'img/moon.png', 'Tintin objectif lune', 2, 1057, 1215, 1250),
(2, 'Uranus', 'img/uranusG.png', 'The coaster planete', 32, 3286, 3788, 1250),
(3, 'Saturn', 'img/saturnG.png', 'The planete that do hula hoop', 25, 2800, 3220, 1250),
(4, 'Neptune', 'img/neptuneG.png', 'You want to escape from this daily routine. Choose the deep blue planet et meet extraordinary droids. Give you a new start on this incredible planet.', 43, 4689, 5392, 1250),
(5, 'Pluto', 'img/plutoG.png', 'The exo-planete where live the violent queen Anne Florette', 47, 750, 862, 1250),
(6, 'Mars', 'img/marsG.png', 'The red planete', 10, 1793, 2061, 1250),
(7, 'Jupiter', 'img/jupiterG.png', 'You can see Jupiter !', 17, 3710, 4266, 1250),
(8, 'Venus', 'img/venusG.png', 'It\'s Venus ? incredible isn\'t ?', 11, 1934, 2213, 1250);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `user_first_name` char(40) DEFAULT NULL,
  `user_last_name` char(40) DEFAULT NULL,
  `user_mail` varchar(64) DEFAULT NULL,
  `user_password` varchar(64) DEFAULT NULL,
  `user_admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_ID`, `user_first_name`, `user_last_name`, `user_mail`, `user_password`, `user_admin`) VALUES
(11, 'Bradley', 'Pirates', 'bradley@pirate.net', '68a1c5e1f006fad0c16aeeaec2cb594e0667d9d3fb4efdf97096a447d63b01f9', 0),
(12, 'Admin', 'Admin', 'admin@gmail.com', '9329d3275ac3f97c64b8678e80aba5398c796f66134b5a27457cd2abf35c7220', 1);

-- --------------------------------------------------------

--
-- Structure de la table `usersbooking`
--

CREATE TABLE `usersbooking` (
  `userbooking_ID` int(11) NOT NULL,
  `userbooking_booking_date` date NOT NULL,
  `userbooking_nbr_places` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `travel_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`travel_ID`),
  ADD KEY `FK_TRAVEL_travelpres_ID` (`travelpres_ID`);

--
-- Index pour la table `travelpres`
--
ALTER TABLE `travelpres`
  ADD PRIMARY KEY (`travelpres_ID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- Index pour la table `usersbooking`
--
ALTER TABLE `usersbooking`
  ADD PRIMARY KEY (`userbooking_ID`),
  ADD KEY `FK_USERSBOOKING_user_ID` (`user_ID`),
  ADD KEY `FK_USERSBOOKING_travel_ID` (`travel_ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `travel`
--
ALTER TABLE `travel`
  MODIFY `travel_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `travelpres`
--
ALTER TABLE `travelpres`
  MODIFY `travelpres_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `usersbooking`
--
ALTER TABLE `usersbooking`
  MODIFY `userbooking_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
