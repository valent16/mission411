

--
-- Database: `mission411`
--
CREATE DATABASE IF NOT EXISTS `mission411` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `mission411`;

-- --------------------------------------------------------

--
-- Table structure for table `cursus`
--

CREATE TABLE `cursus` (
  `id_cursus` int(11) NOT NULL,
  `nom_cursus` varchar(30) COLLATE utf8_bin NOT NULL,
  `num_etu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `cursus`
--

INSERT INTO `cursus` (`id_cursus`, `nom_cursus`, `num_etu`) VALUES
(1, 'cursus_antoine', 40826),
(2, 'cursus_valentin', 40365),
(3, 'cursus_laporte', 39685),
(4, 'mon_cursus', 485962),
(1139481567, 'lulu', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `element_formation`
--

CREATE TABLE `element_formation` (
  `id` int(11) NOT NULL,
  `sigle` varchar(4) COLLATE utf8_bin NOT NULL,
  `utt` int(1) NOT NULL,
  `categorie` varchar(5) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `element_formation`
--

INSERT INTO `element_formation` (`id`, `sigle`, `utt`, `categorie`) VALUES
(1, 'NF16', 1, 'CS'),
(2, 'LO12', 1, 'CS'),
(3, 'IF03', 1, 'TM'),
(4, 'LO07', 1, 'TM'),
(63988258, 'NF16', 1, 'ST'),
(1001478645, 'np01', 0, 'CS');

-- --------------------------------------------------------

--
-- Table structure for table `element_formation_effectue`
--

CREATE TABLE `element_formation_effectue` (
  `id` int(11) NOT NULL,
  `id_cursus` int(11) NOT NULL,
  `id_element_formation` int(11) NOT NULL,
  `affectation` varchar(10) COLLATE utf8_bin NOT NULL,
  `sem_label` varchar(10) COLLATE utf8_bin NOT NULL,
  `sem_seq` int(11) NOT NULL,
  `credit` int(11) NOT NULL,
  `resultat` varchar(3) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `element_formation_effectue`
--

INSERT INTO `element_formation_effectue` (`id`, `id_cursus`, `id_element_formation`, `affectation`, `sem_label`, `sem_seq`, `credit`, `resultat`) VALUES
(1, 3, 63988258, 'FCBR', 'ISI', 2, 7, 'C'),
(2, 3, 2, 'TCBR', 'ISI1', 1, 6, 'B'),
(3, 3, 3, 'TCBR', 'ISI2', 2, 6, 'B'),
(4, 2, 1, 'TCBR', 'ISI1', 1, 5, 'A'),
(5, 1139481567, 1001478645, 'TC', 'TC', 1, 3, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `num_carte_etu` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(50) COLLATE utf8_bin NOT NULL,
  `admission` varchar(2) COLLATE utf8_bin NOT NULL,
  `filiere` varchar(3) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`num_carte_etu`, `nom`, `prenom`, `admission`, `filiere`) VALUES
(10000, 'lolo', 'lili', 'TC', '?'),
(39685, 'Laporte', 'Antoine', 'TC', 'MPL'),
(40365, 'Gilbert', 'Valentin', 'TC', '?'),
(40826, 'Croisille', 'Antoine', 'BR', '?'),
(485962, 'les amis', 'cc', 'TC', 'MPL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cursus`
--
ALTER TABLE `cursus`
  ADD PRIMARY KEY (`id_cursus`),
  ADD KEY `num_etu` (`num_etu`);

--
-- Indexes for table `element_formation`
--
ALTER TABLE `element_formation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `element_formation_effectue`
--
ALTER TABLE `element_formation_effectue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`num_carte_etu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cursus`
--
ALTER TABLE `cursus`
  MODIFY `id_cursus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1139481568;
--
-- AUTO_INCREMENT for table `element_formation`
--
ALTER TABLE `element_formation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001478646;
--
-- AUTO_INCREMENT for table `element_formation_effectue`
--
ALTER TABLE `element_formation_effectue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cursus`
--
ALTER TABLE `cursus`
  ADD CONSTRAINT `fk_numetudiant` FOREIGN KEY (`num_etu`) REFERENCES `etudiant` (`num_carte_etu`) ON DELETE CASCADE ON UPDATE CASCADE;