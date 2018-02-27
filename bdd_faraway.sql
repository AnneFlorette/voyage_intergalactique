-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 27 Février 2018 à 10:37
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
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `user_ID` int(11) NOT NULL,
  `userbooking_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `relation2`
--

CREATE TABLE `relation2` (
  `userbooking_ID` int(11) NOT NULL,
  `travel_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `travel_spaceship_type` char(25) NOT NULL
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
  `travelpres_destination_time` int(11) DEFAULT NULL,
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
(5, 'Pluto', 'img/plutoG.png', 'The exo-planete where live the violent queen Anne Florette', 168, 100),
(6, 'Mars', 'img/marsG.png', 'The red planete', 78, 200);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `user_first_name` char(25) DEFAULT NULL,
  `user_last_name` char(25) DEFAULT NULL,
  `user_mail` varchar(25) DEFAULT NULL,
  `user_password` varchar(64) DEFAULT NULL,
  `user_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_ID`, `user_first_name`, `user_last_name`, `user_mail`, `user_password`, `user_admin`) VALUES
(3, 'Bradley', 'Pirate', 'bradley@pirate.net', 'fafc3808dc42fb43186af445629a806f25baab5dc4f76e9a648525a4bb095156', NULL),
(4, 'Bertille', 'Crochu', 'Bertillecrochu@gmail.com', '15697ac8af6ad06ccc7b92a69f681c8341f8e6805c4f212489a15767886547f3', NULL),
(5, 'hugo', 'mouchel', 'azyuiop@gmail.com', '632a5f25a7702e48b8eb53c26f6b738d1673e661ed73a07fb2cf994326295d4f', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `usersbooking`
--

CREATE TABLE `usersbooking` (
  `userbooking_ID` int(11) NOT NULL,
  `userbooking_booking_date` date NOT NULL,
  `userbooking_nbr_places` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`user_ID`,`userbooking_ID`),
  ADD KEY `FK_book_userbooking_ID` (`userbooking_ID`);

--
-- Index pour la table `relation2`
--
ALTER TABLE `relation2`
  ADD PRIMARY KEY (`userbooking_ID`,`travel_ID`),
  ADD KEY `FK_relation2_travel_ID` (`travel_ID`);

--
-- Index pour la table `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`travel_ID`);

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
  ADD PRIMARY KEY (`userbooking_ID`);

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
  MODIFY `travelpres_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `usersbooking`
--
ALTER TABLE `usersbooking`
  MODIFY `userbooking_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `FK_book_user_ID` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`),
  ADD CONSTRAINT `FK_book_userbooking_ID` FOREIGN KEY (`userbooking_ID`) REFERENCES `usersbooking` (`userbooking_ID`);

--
-- Contraintes pour la table `relation2`
--
ALTER TABLE `relation2`
  ADD CONSTRAINT `FK_relation2_travel_ID` FOREIGN KEY (`travel_ID`) REFERENCES `travel` (`travel_ID`),
  ADD CONSTRAINT `FK_relation2_userbooking_ID` FOREIGN KEY (`userbooking_ID`) REFERENCES `usersbooking` (`userbooking_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
