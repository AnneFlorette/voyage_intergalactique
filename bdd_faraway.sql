-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 07 Mars 2018 à 17:40
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

--
-- Index pour les tables exportées
--

--
-- Index pour la table `travelpres`
--
ALTER TABLE `travelpres`
  ADD PRIMARY KEY (`travelpres_ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `travelpres`
--
ALTER TABLE `travelpres`
  MODIFY `travelpres_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
