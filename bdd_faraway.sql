-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 27 Février 2018 à 11:06
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `travel`
--

CREATE TABLE `travel` (
  `travel_ID` int(11) NOT NULL,
  `travel_destination` char(25) NOT NULL,
  `travel_depart_date` date DEFAULT NULL,
  `travel_total_places` int(11) NOT NULL,
  `travel_remain_places` int(11) NOT NULL,
  `travel_spaceship_type` char(25) NOT NULL,
  `travelpres_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `travelpres`
--

CREATE TABLE `travelpres` (
  `travelpres_ID` int(11) NOT NULL,
  `travelpres_destination` char(25) DEFAULT NULL,
  `travelpres_img_url` varchar(255) DEFAULT NULL,
  `travelpres_description` varchar(255) DEFAULT NULL,
  `travelpres_destination_time` time DEFAULT NULL,
  `travelpres_nbr_travel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `travelpres`
--

INSERT INTO `travelpres` (`travelpres_ID`, `travelpres_destination`, `travelpres_img_url`, `travelpres_description`, `travelpres_destination_time`, `travelpres_nbr_travel`) VALUES
(1, 'Moon', 'img/moon.png', 'Tintin objectif lune', 2, 50),
(2, 'Uranus', 'img/uranusG.png', 'The coaster planete', 120, 150),
(3, 'Saturn', 'img/saturnG.png', 'The planete that do hula hoop', 144, 200),
(4, 'Neptune', 'img/neptuneG.png', 'The deep blue planete', 144, 100),
(5, 'Pluto', 'img/plutoG.png', 'The exo-planete where live the violent queen Anne Florette', 144, 100),
(6, 'Mars', 'img/marsG.png', 'The red planete', 144, 200);

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
  `user_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `travel_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `travelpres`
--
ALTER TABLE `travelpres`
  MODIFY `travelpres_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT;
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
