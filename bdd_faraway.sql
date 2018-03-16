-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Ven 16 Mars 2018 à 09:27
-- Version du serveur :  10.1.26-MariaDB-0+deb9u1
-- Version de PHP :  7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `team6`
--

-- --------------------------------------------------------

--
-- Structure de la table `TRAVEL`
--

CREATE TABLE `TRAVEL` (
  `travel_ID` int(11) NOT NULL,
  `travel_destination` char(25) NOT NULL,
  `travel_depart_date` varchar(20) DEFAULT NULL,
  `travel_remain_places` int(11) NOT NULL,
  `travelpres_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `TRAVEL`
--

INSERT INTO `TRAVEL` (`travel_ID`, `travel_destination`, `travel_depart_date`, `travel_remain_places`, `travelpres_ID`) VALUES
(13, 'Venus', '2018-03-24', 1175, 8),
(14, 'Moon', '2018-05-19', 1244, 1),
(15, 'Jupiter', '2018-03-20', 1250, 7),
(16, 'Venus', '2018-05-03', 1250, 8),
(17, 'Moon', '2018-04-14', 1250, 1),
(18, 'Moon', '2018-05-16', 1250, 1),
(19, 'Uranus', '2018-03-19', 1250, 2),
(20, 'Pluto', '2018-04-04', 1250, 5),
(21, 'Moon', '2018-03-30', 1242, 1),
(22, 'Moon', '2018-05-25', 1250, 1),
(23, 'Moon', '2018-09-13', 1250, 1),
(24, 'Mars', '2018-11-08', 1244, 6),
(25, 'Saturn', '2018-06-22', 1242, 3),
(26, 'Jupiter', '2018-03-21', 1250, 7),
(27, 'Pluto', '2018-08-29', 1250, 5),
(28, 'Venus', '2018-03-26', 1246, 8),
(29, 'Neptune', '2018-03-29', 1247, 4),
(30, 'Mars', '2018-03-12', 1229, 6),
(31, 'Uranus', '2018-03-22', 1246, 2);

-- --------------------------------------------------------

--
-- Structure de la table `TRAVELPRES`
--

CREATE TABLE `TRAVELPRES` (
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
-- Contenu de la table `TRAVELPRES`
--

INSERT INTO `TRAVELPRES` (`travelpres_ID`, `travelpres_destination`, `travelpres_img_url`, `travelpres_description`, `travelpres_days`, `travelpres_price_adult`, `travelpres_price_child`, `travelpres_total_places`) VALUES
(1, 'Moon', 'img/moon.png', 'Are you tired of this long days of trip ? With our innovative Spaceship you can be on the Moon in only two days. Give it a try and book this trip !', 2, 1057, 1215, 1250),
(2, 'Uranus', 'img/uranusG.png', 'Do you want to see all this wonderful iced landscapes ? Uranus will be a break from your usual routine. It\'s as cold as disorienting for the explorer that we\'re certain you are. ', 32, 3286, 3788, 1250),
(3, 'Saturn', 'img/saturnG.png', 'Do you think that you\'ve seen everything on Earth ? The average radius of Saturn is about nine times of Earth. You have so much to see there. Book this trip and break your habits !', 25, 2800, 3220, 1250),
(4, 'Neptune', 'img/neptuneG.png', 'You want to escape from this daily routine. Choose the deep blue planet et meet extraordinary droids. Give you a new start on this incredible planet.', 43, 4689, 5392, 1250),
(5, 'Pluto', 'img/plutoG.png', 'Go on the other side of the galaxy and discover the exotic planet. Pluto is a dwarf planet and its wonderful landscapes will make you lose yourself. ', 47, 750, 862, 1250),
(6, 'Mars', 'img/marsG.png', 'Are you missing heat on Earth ? Far Awar Company offers you a chance to go to Mars and feel the sun on your skin again !', 10, 1793, 2061, 1250),
(7, 'Jupiter', 'img/jupiterG.png', 'Are you an explorer ? Do you love big thrills ? Jupiter is the one for you. With its cyclones you will take a deep breath ! Give it a try and book this trip !', 17, 3710, 4266, 1250),
(8, 'Venus', 'img/venusG.png', 'Do you want te feel a squall of hot air ? Then Venus is the right place for you. Venus is one of the closest planet of the sun ! Book this trip and escape from your daily routine.', 11, 1934, 2213, 1250);

-- --------------------------------------------------------

--
-- Structure de la table `USERS`
--

CREATE TABLE `USERS` (
  `user_ID` int(11) NOT NULL,
  `user_first_name` char(40) DEFAULT NULL,
  `user_last_name` char(40) DEFAULT NULL,
  `user_mail` varchar(64) DEFAULT NULL,
  `user_password` varchar(64) DEFAULT NULL,
  `user_admin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `USERS`
--

INSERT INTO `USERS` (`user_ID`, `user_first_name`, `user_last_name`, `user_mail`, `user_password`, `user_admin`) VALUES
(11, 'Bradley', 'Pirates', 'bradley@pirate.net', '68a1c5e1f006fad0c16aeeaec2cb594e0667d9d3fb4efdf97096a447d63b01f9', 0),
(12, 'Admin', 'Admin', 'admin@gmail.com', '9329d3275ac3f97c64b8678e80aba5398c796f66134b5a27457cd2abf35c7220', 1),
(13, 'Hugo', 'Mouchel', 'azertyuiop@gmail.com', '9e8f98e09a4f78333a3482e7f7a7389f424cc6a281f796e4629a30563275a29d', 0),
(14, 'Alexis', 'cosnard', 'alexiscos@hotmail.fr', 'f292e53f9fbf314f45081589e48fe9fc9aefb78fff6045869f1bc7bbe8cccd09', 0),
(15, 'Jean', 'Bagarre', 'j3anbagarre@gmail.com', '11c331f9e8a3b7c65c5619c207646c208ce66542f07dfb120f7c820e197f7bc4', 0),
(17, 'Maxime', 'Turquetil', 'maturquet@gmail.com', '9c7380b2162fe47dca77ce1672361fbd0e3c10f896a83667db82ed3ae6e97926', 0),
(26, 'Bertille', 'Crochu', 'bebert@gogole.fr', '9e8f98e09a4f78333a3482e7f7a7389f424cc6a281f796e4629a30563275a29d', 0),
(27, 'test', 'test', 'test@test.test', '9e8f98e09a4f78333a3482e7f7a7389f424cc6a281f796e4629a30563275a29d', 0);

-- --------------------------------------------------------

--
-- Structure de la table `USERSBOOKING`
--

CREATE TABLE `USERSBOOKING` (
  `userbooking_ID` int(11) NOT NULL,
  `userbooking_booking_date` date NOT NULL,
  `userbooking_child_places` int(11) NOT NULL,
  `userbooking_adult_places` int(11) NOT NULL,
  `userbooking_total_price` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `travel_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `USERSBOOKING`
--

INSERT INTO `USERSBOOKING` (`userbooking_ID`, `userbooking_booking_date`, `userbooking_child_places`, `userbooking_adult_places`, `userbooking_total_price`, `user_ID`, `travel_ID`) VALUES
(11, '2018-03-15', 0, 3, 3171, 11, 21),
(12, '2018-03-15', 2, 2, 8294, 11, 28);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `TRAVEL`
--
ALTER TABLE `TRAVEL`
  ADD PRIMARY KEY (`travel_ID`),
  ADD KEY `FK_TRAVEL_travelpres_ID` (`travelpres_ID`);

--
-- Index pour la table `TRAVELPRES`
--
ALTER TABLE `TRAVELPRES`
  ADD PRIMARY KEY (`travelpres_ID`);

--
-- Index pour la table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`user_ID`);

--
-- Index pour la table `USERSBOOKING`
--
ALTER TABLE `USERSBOOKING`
  ADD PRIMARY KEY (`userbooking_ID`),
  ADD KEY `FK_USERSBOOKING_user_ID` (`user_ID`),
  ADD KEY `FK_USERSBOOKING_travel_ID` (`travel_ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `TRAVEL`
--
ALTER TABLE `TRAVEL`
  MODIFY `travel_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `TRAVELPRES`
--
ALTER TABLE `TRAVELPRES`
  MODIFY `travelpres_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `USERSBOOKING`
--
ALTER TABLE `USERSBOOKING`
  MODIFY `userbooking_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `TRAVEL`
--
ALTER TABLE `TRAVEL`
  ADD CONSTRAINT `FK_TRAVEL_travelpres_ID` FOREIGN KEY (`travelpres_ID`) REFERENCES `TRAVELPRES` (`travelpres_ID`);

--
-- Contraintes pour la table `USERSBOOKING`
--
ALTER TABLE `USERSBOOKING`
  ADD CONSTRAINT `FK_USERSBOOKING_travel_ID` FOREIGN KEY (`travel_ID`) REFERENCES `TRAVEL` (`travel_ID`),
  ADD CONSTRAINT `FK_USERSBOOKING_user_ID` FOREIGN KEY (`user_ID`) REFERENCES `USERS` (`user_ID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
