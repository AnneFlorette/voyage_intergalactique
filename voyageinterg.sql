-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 31 Janvier 2018 à 15:01
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Structure de la table `have`
--

CREATE TABLE `have` (
  `travel_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `history_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `travel`
--

CREATE TABLE `travel` (
  `travel_ID` int(11) NOT NULL,
  `travel_destination` char(25) DEFAULT NULL,
  `travel_places` int(11) NOT NULL,
  `travel_img_url` varchar(1000) DEFAULT NULL,
  `travel_description` varchar(255) DEFAULT NULL,
  `travel_distance` int(100) NOT NULL,
  `travel_img` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `travel`
--

INSERT INTO `travel` (`travel_ID`, `travel_destination`, `travel_places`, `travel_img_url`, `travel_description`, `travel_distance`, `travel_img`) VALUES
(1, 'The moon', 100, 'img/moon.png', 'Tintin objectif lune', 2, ''),
(2, 'Uranus', 150, 'img/uranusG.png', 'The greend emeral planete', 120, ''),
(3, 'Saturn', 150, 'img/saturneG.png', 'the planet that do hula hoop', 96, '');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `user_first_name` char(25) DEFAULT NULL,
  `user_last_name` char(25) DEFAULT NULL,
  `user_mail` varchar(25) DEFAULT NULL,
  `user_password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users_history`
--

CREATE TABLE `users_history` (
  `history_ID` int(11) NOT NULL,
  `history_reservation_date` date NOT NULL,
  `history_travel_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `have`
--
ALTER TABLE `have`
  ADD PRIMARY KEY (`user_ID`,`history_ID`),
  ADD KEY `FK_have_history_ID` (`history_ID`);

--
-- Index pour la table `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`travel_ID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- Index pour la table `users_history`
--
ALTER TABLE `users_history`
  ADD PRIMARY KEY (`history_ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `travel`
--
ALTER TABLE `travel`
  MODIFY `travel_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users_history`
--
ALTER TABLE `users_history`
  MODIFY `history_ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `have`
--
ALTER TABLE `have`
  ADD CONSTRAINT `FK_have_history_ID` FOREIGN KEY (`history_ID`) REFERENCES `users_history` (`history_ID`),
  ADD CONSTRAINT `FK_have_user_ID` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
