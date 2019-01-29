-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mar. 29 jan. 2019 à 09:17
-- Version du serveur :  5.7.24
-- Version de PHP :  7.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registrationDate` date NOT NULL,
  `activate` tinyint(1) DEFAULT NULL,
  `confirmKey` varchar(255) NOT NULL,
  `restoreKey` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `mail`, `login`, `password`, `registrationDate`, `activate`, `confirmKey`, `restoreKey`) VALUES
(1, 'Rezgui', 'Malek', 'm.rezgui12@gmail.com', 'marezgui', '$2y$10$kcxBrl5LkNSCR4.Lj/GrT.ORjCCZMHB8G6wSHwF/E3WJSx3Beg5f6', '2019-01-27', 1, '777', NULL),
(3, 'test', 'test', 'test@test.fr', 'test', '$2y$10$QyJmSZK0lJk7Gn4NsxIMIOQNIm1hOuFC2jfWo95LV6vDDJkD7uMEm', '2019-01-29', 1, '362e80d4df43b03ae6d3f8540cd63626', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

