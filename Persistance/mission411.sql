-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Dim 14 Mai 2017 à 12:22
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mission411`
--

-- --------------------------------------------------------

--
-- Structure de la table `cursus`
--

CREATE TABLE `cursus` (
  `id_cursus` int(11) NOT NULL,
  `nom_cursus` varchar(30) COLLATE utf8_bin NOT NULL,
  `num_etu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Structure de la table `element_formation`
--

CREATE TABLE `element_formation` (
  `id` int(11) NOT NULL,
  `sigle` varchar(4) COLLATE utf8_bin NOT NULL,
  `utt` int(1) NOT NULL,
  `categorie` varchar(5) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Structure de la table `element_formation_effectue`
--

CREATE TABLE `element_formation_effectue` (
  `id_cursus` int(11) NOT NULL,
  `id_element_formation` int(11) NOT NULL,
  `affectation` varchar(10) COLLATE utf8_bin NOT NULL,
  `sem_label` varchar(10) COLLATE utf8_bin NOT NULL,
  `sem_seq` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `resultat` varchar(3) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `numCarteEtu` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(50) COLLATE utf8_bin NOT NULL,
  `admission` varchar(2) COLLATE utf8_bin NOT NULL,
  `filiere` varchar(3) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


--
-- Index pour les tables exportées
--

--
-- Index pour la table `cursus`
--
ALTER TABLE `cursus`
  ADD PRIMARY KEY (`id_cursus`),
  ADD KEY `num_etu` (`num_etu`);

--
-- Index pour la table `element_formation`
--
ALTER TABLE `element_formation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `element_formation_effectue`
--
ALTER TABLE `element_formation_effectue`
  ADD PRIMARY KEY (`id_cursus`,`id_element_formation`),
  ADD KEY `fk_idelementformation` (`id_element_formation`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`numCarteEtu`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cursus`
--
ALTER TABLE `cursus`
  MODIFY `id_cursus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `element_formation`
--
ALTER TABLE `element_formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cursus`
--
ALTER TABLE `cursus`
  ADD CONSTRAINT `fk_numetudiant` FOREIGN KEY (`num_etu`) REFERENCES `etudiant` (`numCarteEtu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `element_formation_effectue`
--
ALTER TABLE `element_formation_effectue`
  ADD CONSTRAINT `fk_idcursus` FOREIGN KEY (`id_cursus`) REFERENCES `cursus` (`id_cursus`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idelementformation` FOREIGN KEY (`id_element_formation`) REFERENCES `element_formation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
