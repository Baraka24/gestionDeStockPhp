-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 07 déc. 2022 à 17:53
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestionproduit`
--

-- --------------------------------------------------------

--
-- Structure de la table `budjet`
--

DROP TABLE IF EXISTS `budjet`;
CREATE TABLE IF NOT EXISTS `budjet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idProduit` int(11) NOT NULL,
  `periode` text NOT NULL,
  `libelle` text NOT NULL,
  `uniteMonetaire` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `budjet`
--

INSERT INTO `budjet` (`id`, `idProduit`, `periode`, `libelle`, `uniteMonetaire`) VALUES
(1, 1, 'Mois prochain', 'Acahter', 100),
(2, 3, 'Janvier 2023', 'Achater', 3000);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `categorie`) VALUES
(1, 'MOTO'),
(2, 'VEHICULE'),
(3, 'TRACTEUR');

-- --------------------------------------------------------

--
-- Structure de la table `entrees`
--

DROP TABLE IF EXISTS `entrees`;
CREATE TABLE IF NOT EXISTS `entrees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dates` date NOT NULL,
  `idProduit` int(11) NOT NULL,
  `quantite` float NOT NULL,
  `prix` float NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entrees`
--

INSERT INTO `entrees` (`id`, `dates`, `idProduit`, `quantite`, `prix`, `description`) VALUES
(1, '2022-11-29', 2, 105, 700, 'Caisses'),
(2, '2022-11-30', 1, 150, 820, 'Caisses'),
(3, '2022-11-29', 1, 150, 850, 'Caisses'),
(4, '2022-11-29', 3, 100, 700, 'Caisses');

-- --------------------------------------------------------

--
-- Structure de la table `inventaire`
--

DROP TABLE IF EXISTS `inventaire`;
CREATE TABLE IF NOT EXISTS `inventaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit` int(11) NOT NULL,
  `dates` date NOT NULL,
  `stockLogique` float NOT NULL,
  `stockReel` float NOT NULL,
  `ecart` float NOT NULL,
  `prix` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `inventaire`
--

INSERT INTO `inventaire` (`id`, `produit`, `dates`, `stockLogique`, `stockReel`, `ecart`, `prix`) VALUES
(2, 1, '2022-12-01', 268, 200, 68, 100),
(3, 2, '2022-12-01', 105, 10, 95, 100);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `designation` text NOT NULL,
  `stockSecurite` float NOT NULL,
  `image` text NOT NULL,
  `idcategorie` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `designation`, `stockSecurite`, `image`, `idcategorie`) VALUES
(1, 'SENKE TEMBO', 5, '9c951bac068242bb8d9a295188004d16.jpg', 1),
(2, 'HAOJUE', 5, 'PXL_20220718_095754802~2.jpg', 1),
(3, 'HAOJIN', 5, 'PXL_20221025_132445262.NIGHT.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `sorties`
--

DROP TABLE IF EXISTS `sorties`;
CREATE TABLE IF NOT EXISTS `sorties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dates` date NOT NULL,
  `idProduit` int(11) NOT NULL,
  `quantite` float NOT NULL,
  `prix` float NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sorties`
--

INSERT INTO `sorties` (`id`, `dates`, `idProduit`, `quantite`, `prix`, `description`) VALUES
(1, '2022-11-29', 1, 10, 820, 'Caisses'),
(2, '2022-11-29', 1, 10, 820, 'Caisses'),
(3, '2022-11-29', 1, 10, 820, 'Caisses'),
(4, '2022-11-29', 1, 1, 820, 'Caisses'),
(6, '2022-11-29', 1, 1, 820, 'Caisse');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `genre` text NOT NULL,
  `pwd` text NOT NULL,
  `photo` text NOT NULL,
  `role` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `genre`, `pwd`, `photo`, `role`) VALUES
(1, 'KAHAMBU', 'AgaÃªl', 'FÃ©minin', '1234', 'Capture.JPG', 'Magazinier'),
(2, 'MORINGA', 'Bienvenu', 'Masculin', '1234', '.trashed-1668491401-PXL_20221004_061311794.PORTRAIT~3.jpg', 'Comptable'),
(3, 'PUDI', 'Helene', 'FÃ©minin', '1234', 'PXL_20220710_041237863.NIGHT.jpg', 'Gerant'),
(4, 'ISHARA', 'Louange', 'FÃ©minin', '1234', 'Hey!..ðŸ§š.jpg', 'Founisseur'),
(5, 'ADMIN', 'Admin', 'Masculin', '1234', '9c951bac068242bb8d9a295188004d16.jpg', 'Magazinier');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
