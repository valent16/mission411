--
-- Base de données :  `mission411`
--
CREATE DATABASE IF NOT EXISTS `mission411` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mission411`;

-- --------------------------------------------------------

--
-- Structure de la table `cursus`
--

CREATE TABLE `cursus` (
  `id_cursus` int(11) NOT NULL,
  `nom_cursus` int(11) NOT NULL,
  `num_etu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `element_formation`
--

CREATE TABLE `element_formation` (
  `id` int(11) NOT NULL,
  `sigle` varchar(10) NOT NULL,
  `utt` tinyint(1) NOT NULL,
  `categorie` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `element_formation_effectue`
--

CREATE TABLE `element_formation_effectue` (
  `id_cursus` int(11) NOT NULL,
  `id_element_formation` int(11) NOT NULL,
  `affectation` varchar(10) NOT NULL,
  `sem_label` varchar(10) NOT NULL,
  `sem_seq` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `resultat` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `numCarteEtu` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `admission` varchar(2) NOT NULL,
  `filiere` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD KEY `num_carte_etu` (`id_cursus`),
  ADD KEY `id_element_formation` (`id_element_formation`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`numCarteEtu`),
  ADD KEY `numCarteEtu` (`numCarteEtu`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `element_formation`
--
ALTER TABLE `element_formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cursus`
--
ALTER TABLE `cursus`
  ADD CONSTRAINT `fk_id_cursus` FOREIGN KEY (`id_cursus`) REFERENCES `element_formation_effectue` (`id_cursus`) ON DELETE CASCADE;

--
-- Contraintes pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `fk_numetu` FOREIGN KEY (`numCarteEtu`) REFERENCES `cursus` (`num_etu`) ON DELETE CASCADE;