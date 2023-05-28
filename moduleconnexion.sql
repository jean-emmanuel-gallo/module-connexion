-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 28 mai 2023 à 19:17
-- Version du serveur : 8.0.32
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `moduleconnexion`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `login`, `firstname`, `lastname`, `password`) VALUES
(1, 'admin', 'admin', 'admin', '$2y$10$GDH/MEvPoiNdeKKWEvRdPegP.y7t63cN/Mo6NjK6yg3vuwfSp4cpi'),
(7, 'le_testé', 'Michotte', 'Tartempion ', '$2y$10$VPinW7pXql5HEtMVnofw9OfeQPhm47apNe2esYIkUb7tIhMt3gbgC'),
(8, 'root', 'bloblo', 'nlonlo', '$2y$10$dRw8K0LoGzYiT7WbQlxHAe2M4xREzFphSFvqGacy756NvLYheZ3oq'),
(9, 'blabla', 'blabla', 'blabla', '$2y$10$PnHBoIi7W/0NXSFOcp7S1OePH7OhHVn4mLsBK6cJvn6obWv6bEvFu');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
