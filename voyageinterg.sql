-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 31 Janvier 2018 à 13:05
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
-- Structure de la table `travel`
--

CREATE TABLE `travel` (
  `travel_ID` int(11) NOT NULL,
  `travel_destination` char(25) DEFAULT NULL,
  `travel_places` int(11) NOT NULL,
  `travel_img_url` varchar(1000) DEFAULT NULL,
  `travel_description` varchar(255) DEFAULT NULL,
  `travel_distance` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `travel`
--

INSERT INTO `travel` (`travel_ID`, `travel_destination`, `travel_places`, `travel_img_url`, `travel_description`, `travel_distance`) VALUES
(1, 'The moon', 100, 'https://lh3.googleusercontent.com/Q2vV40ffyAu3SPYXLroFp0GfKB8U1qDZ9pYGT68JpsYzhvoNzeukWjnbmn56fB5xIActD4WPgSdqyih-XFLgOS7LXhX-08peUtKfieCBlH8NrEzXpKhtoQy-iQSj2IdJylfAFoPgXMYab8lZguJthQA9lLaFxqwwcMGLNr_WbNTlPkN2xEDF_xDN91ZgMNjmN3OCHoiQFaj1SMNp9HIqF1rMF6_CGg76QOr33r9qH7xVt0SeI3BDAWF_mUZQafj4d5H2NFUSPr8Ncn4qOZYpFHO4dmMVA3j7ahJtGQQIcmVLEg79c--0AKhuE17oNKLw9Hr_2y0TdRZ9UpY6YUpZVU64G2MeBqsnPdepIlK16hzRoWc_JsHHOzcZng-6U-FayRWhlHwP5nmLoSdsSNaqNE8nBlfq4-R2rqd_gbOGZRgd6OMJcxR2G-8pW-ha_DWNn-xk0ajLY-fPlCjaO3pfBPtj9zI-jqEreOHHdnMoFziw2OfjR36G-U4FEWEWklumDOn-kDttdRN_KoZ8_ZOJcMPu6jlumswaBByMzyZ9jg7vQ8jNgGa92OBrhpd6XXtXeCSZORCPBkln1r7Rh8MmG1hdKAGCybm8B_rAAFI=w1366-h463-no', 'Tintin objectif lune', 2),
(2, 'Uranus', 150, 'https://lh3.googleusercontent.com/lIbN805NM4qsJHvo0JtVfek_jdDyPqoM9TRuEyezRoZWteJkwty5cn_ERy0dNRskCLyJ7WmlXbcs4DAd7Rzjcqnr9E9P1pGkGGFJvM2atRLvJYKN5IGPkQF01tpx54egEsoM3Pge-1j4uPJSaRajzYcMd2bcjQP3qnC7LZSWyMCy3cLMQqPLLa1bNg2H2bozFnSbGiQi9PgK7TGRXVaO1e0zuPaqB1_-pqKc26EaNzslqYOy0CDzsuSy7XukZpB2zntuyHhiPYL4GMsPzokhKP6GJAXvCv5nmQYejay0qfXooHuj5Xo743pQkixw4D9DqrWaBfT0THe5fRcHgsr7of6u_OVc2kTq6WWYXnCwSiuYzjGsv252htxqJEmuN9Qh2hJybrlnIPy_SxZXkfRpr_PEFCuqBIdrUIpegBTg3jFletYOExgFEBp1-pUtk2CQgJFOnPWQNM-IU1sYTsfXtgg6kJN3sbOfq01GwzB1y_pCJhD_CEfoXnfvCNCaPPGJwRtfgmfxYVbsgNz4O2lGGKpVmH20rTmIRZIO6M4o09t2MFNYezxYKKzoGPWWU4HhiQh-lJ6kAGY2pdQ3aaFVubf9yfNoKx-r19j5Goc=w1366-h463-no', 'The greend emeral planete', 120),
(3, 'Saturn', 150, 'https://lh3.googleusercontent.com/w6q0Pe5JsANCj-5MIYDEAJkJ5PZuPsg9VU3bbxB0WEtlMldezuWYXQHozv8mmAWtWUMIzCSeZmg-hXCz616QC3wRyvW9iw7oEr20has7R-nBKLKl7mrSobtaHNri4ve2X95EhM7-V7fQ5JStiCmbhkddQvNa1TCA0aOiritW2jtUCS33FbHy6upJtvFj0e-HV9R3fzvximVXqFk6rip50HyQ18CPiG34A97R_ie08lSO9Ukp1aOlOYa3UOGxJxFe646M78n3kVh-s2qhpjMKt-uEJ-SL8lvZPQb1S54LTyGevHAV5PBDukjmGw4SMfP7IKA9rjomRIlvqDxgm2YXgFOcZJ_FZg3TwYX9190GBiPERP_bSsYPrvru-ofjzOJSu1nJLJ6VV2KQsXYJYfK8ayAB8JPETMyvHlQpUPTgV_TYRK8bky7tg3RPaqmFcrDMaUdphegdLY0cGMxoZyNrQhYl7Fh69qx9ZRxWHvc0cc8cM3bFYWDsA-s-0Yl6nM5RFvd8uWZXpghIWhz8LbC48OUvQO26v4fJnhw6437aOBk8MWNVlVb0OIHLfQihCDOeu-E-ShbLUANWDkqEDXYBfYq870_BDj4zHrgE89c=w1366-h463-no', 'the planet that do hula hoop', 96);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`travel_ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `travel`
--
ALTER TABLE `travel`
  MODIFY `travel_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
