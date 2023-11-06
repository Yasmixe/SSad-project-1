-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 05 nov. 2023 à 19:04
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cryptotool`
--

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id_message` int(255) NOT NULL,
  `key` int(11) NOT NULL,
  `type_chiffrement` text NOT NULL,
  `message` text NOT NULL,
  `sender` text NOT NULL,
  `receiver` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id_message`, `key`, `type_chiffrement`, `message`, `sender`, `receiver`) VALUES
(96, 5, 'cesar', 'Cgtstzw rfifrj', 'dplqd', 'yassmine'),
(97, 3, 'cesar', 'Ceerqvrlu', 'dplqd', 'yassmine'),
(98, 53, 'affine', 'Amxggv', 'dplqd', 'imene'),
(99, 0, 'miroir', 'ednom el tuot ruojnob', 'bdvvplqh', 'imene'),
(100, 0, 'miroir', 'ednom el tuot ruojnob', 'bdvvplqh', 'imene'),
(101, 4, 'cesar', 'Cfsrnsyv', 'bdvvplqh', 'imene'),
(102, 2, 'cesar', 'Cdqplqwt ocfcog', 'bdvplqh', 'yanis7'),
(103, 4, 'cesar', 'CTPIEWI asvo', 'lphqh', 'yanis8'),
(104, 53, 'affine', 'Amxggv', 'bdvplqh', 'imene'),
(105, 52, 'affine', 'Ahupvuyj kcrckw', 'lphqh', 'yasmine'),
(106, 52, 'affine', 'Ahupvuyj pcmwj uy wot ks zlupw', 'bdvplqh', 'imene'),
(107, 52, 'affine', 'Azfwcow iujaa', 'bdvplqh', 'imene'),
(108, 0, 'miroir', 'TSET', 'lphqh', 'yasmine'),
(109, 4, 'cesar', 'Cfsrnsyvv', 'bdqlv7', 'yasmine'),
(110, 0, 'cesar', 'Cbonjour', 'bdvplqh', 'imene'),
(111, 4, 'cesar', 'Cfsrnsyvv', 'bdqlv7', 'yasmine');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `psw` varchar(255) NOT NULL,
  `loginAttempts` int(255) NOT NULL,
  `lastFailedLoginTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `uname`, `psw`, `loginAttempts`, `lastFailedLoginTime`) VALUES
(22, 'lphqh', 'uhedfkh', 0, '2023-10-29 22:29:21'),
(23, 'bdqlv7', 'bdqlvvr', 0, '2023-10-28 10:26:37'),
(24, 'bdqlv8', 'bdqlvvr', 0, '2023-10-27 23:04:14'),
(25, 'bdvplqh', 'kdqdil', 4, '2023-11-05 18:52:39'),
(28, 'qdgmzd', 'qdgmrx13!', 0, '0000-00-00 00:00:00'),
(29, 'bdqlv0', '011', 0, '2023-10-31 01:19:22'),
(30, 'pdpd', '12345', 0, '2023-10-31 08:09:36'),
(31, 'sdsd', 'dhe1@', 0, '2023-10-31 08:09:45'),
(32, 'udflp', '110', 0, '2023-10-31 08:10:25'),
(33, 'plpl', '77033', 0, '2023-10-31 08:10:34'),
(34, 'bdvplqd', 'ewv<2', 0, '2023-10-31 08:10:42');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
