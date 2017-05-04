-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 04 Mai 2017 à 17:14
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
CREATE DATABASE IF NOT EXISTS `mission411` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mission411`;


-- --------------------------------------------------------

--
-- Structure de la table `element_formation`
--

CREATE TABLE `Element_formation` (
  `id` int(11) NOT NULL,
  `sigle` varchar(10) NOT NULL,
  `utt` tinyint(1) NOT NULL,
  `categorie` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `Etudiant` (
  `numCarteEtu` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `admission` varchar(2) NOT NULL,
  `filiere` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `relalisation_formation`
--

CREATE TABLE `Realisation_formation` (
  `num_carte_etu` int(11) NOT NULL,
  `id_element_formation` int(11) NOT NULL,
  `affectation` varchar(10) NOT NULL,
  `sem_label` varchar(10) NOT NULL,
  `sem_seq` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `resultat` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `element_formation`
--
ALTER TABLE `Element_formation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `Etudiant`
  ADD PRIMARY KEY (`numCarteEtu`),
  ADD KEY `numCarteEtu` (`numCarteEtu`);

--
-- Index pour la table `relalisation_formation`
--
ALTER TABLE `Realisation_formation`
  ADD PRIMARY KEY (`num_carte_etu`,`id_element_formation`),
  ADD KEY `num_carte_etu` (`num_carte_etu`),
  ADD KEY `id_element_formation` (`id_element_formation`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `element_formation`
--
ALTER TABLE `Element_formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `Etudiant`
  ADD CONSTRAINT `fk_numetu` FOREIGN KEY (`numCarteEtu`) REFERENCES `Realisation_formation` (`num_carte_etu`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
