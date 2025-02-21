-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 27 avr. 2023 à 22:51
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `resto`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `phoneAdmin` varchar(15) NOT NULL,
  `adresseAdmin` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `priv` int(11) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`idAdmin`, `nom`, `phoneAdmin`, `adresseAdmin`, `username`, `password`, `priv`, `statut`) VALUES
(10, 'DAN IRAGI ', '9746328', '', 'admin', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 1, 1),
(11, 'DIDI', '0984783', 'Bukavu', 'didi1', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `boisson`
--

CREATE TABLE `boisson` (
  `idProd` int(11) NOT NULL,
  `nomProd` varchar(50) NOT NULL,
  `prixProd` float NOT NULL,
  `quanProd` int(11) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `idCat` int(11) NOT NULL,
  `nomCat` varchar(50) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`idCat`, `nomCat`, `statut`) VALUES
(1, 'Mousse', 1),
(2, 'Recette', 1),
(3, 'Liqueur', 1);

-- --------------------------------------------------------

--
-- Structure de la table `detailfacture`
--

CREATE TABLE `detailfacture` (
  `idDetFac` int(11) NOT NULL,
  `idFac` int(11) NOT NULL,
  `idProd` int(11) NOT NULL,
  `nomProd` varchar(50) NOT NULL,
  `prix` float NOT NULL,
  `quanProd` float NOT NULL,
  `devise` varchar(11) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `detailfacture`
--

INSERT INTO `detailfacture` (`idDetFac`, `idFac`, `idProd`, `nomProd`, `prix`, `quanProd`, `devise`, `statut`) VALUES
(114, 111, 10, 'POULET', 5, 1, '$', 1),
(115, 111, 8, 'VIN DE MONTAGNE', 20, 1, '$', 1),
(116, 111, 9, 'JUS AFYA', 4000, 0, 'FC', 1),
(117, 112, 9, 'JUS AFYA', 4000, 1, 'FC', 1),
(118, 113, 9, 'JUS AFYA', 4000, 1, 'FC', 1),
(119, 114, 10, 'POULET', 5, 2, '$', 1),
(120, 114, 9, 'JUS AFYA', 4000, 3, 'FC', 1),
(121, 115, 10, 'POULET', 5, 5, '$', 1),
(122, 115, 8, 'VIN DE MONTAGNE', 20, 2, '$', 1);

-- --------------------------------------------------------

--
-- Structure de la table `dettes`
--

CREATE TABLE `dettes` (
  `idDette` int(11) NOT NULL,
  `fac` int(11) NOT NULL,
  `somme` varchar(20) NOT NULL,
  `devise` varchar(10) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `dettes`
--

INSERT INTO `dettes` (`idDette`, `fac`, `somme`, `devise`, `statut`) VALUES
(15, 111, '25', '$', 1),
(16, 112, '4000', 'FC', 1),
(17, 113, '4000', 'FC', 1),
(18, 114, '12010', '$', 1);

-- --------------------------------------------------------

--
-- Structure de la table `facmbeg`
--

CREATE TABLE `facmbeg` (
  `idFM` int(11) NOT NULL,
  `idFac` int(11) NOT NULL,
  `idMbeg` int(11) NOT NULL,
  `qtt` int(11) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE `factures` (
  `idFac` int(11) NOT NULL,
  `nomCl` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `dateFac` varchar(10) NOT NULL,
  `heureFac` varchar(5) NOT NULL,
  `nomserver` varchar(50) NOT NULL,
  `etat` int(11) NOT NULL,
  `paie` varchar(50) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`idFac`, `nomCl`, `dateFac`, `heureFac`, `nomserver`, `etat`, `paie`, `statut`) VALUES
(111, 'PHILE', '26/04/2023', '', 'SERVEUR 1', 1, 'Cash', 1),
(112, 'DEO', '26/04/2023', '17:06', 'SERVEUR 1', 1, 'Cash', 1),
(113, 'PAULIN', '26/04/2023', '16:41', 'SERVEUR 1', 1, 'Dette', 1),
(114, 'STEEV', '26/04/2023', '16:44', 'SERVEUR 1', 1, 'Cash', 1),
(115, 'CIKU', '27/04/2023', '22:24', 'SERVEUR 1', 1, 'Cash', 1);

-- --------------------------------------------------------

--
-- Structure de la table `mbegeti`
--

CREATE TABLE `mbegeti` (
  `idMbeg` int(11) NOT NULL,
  `nomMbeg` varchar(50) NOT NULL,
  `prixMbeg` float NOT NULL,
  `produit` int(11) NOT NULL,
  `bouteilles` int(11) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mbegeti`
--

INSERT INTO `mbegeti` (`idMbeg`, `nomMbeg`, `prixMbeg`, `produit`, `bouteilles`, `statut`) VALUES
(1, 'Primus 12', 15, 1, 10, 1),
(2, 'Heneken 20', 40, 1, 20, 1),
(3, 'Saut Primus', 10, 1, 9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `idProd` int(11) NOT NULL,
  `nomProd` varchar(50) NOT NULL,
  `prix` double NOT NULL,
  `quantite` double NOT NULL,
  `devise` varchar(3) NOT NULL,
  `categorie` varchar(20) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`idProd`, `nomProd`, `prix`, `quantite`, `devise`, `categorie`, `statut`) VALUES
(8, 'VIN DE MONTAGNE', 20, 60, '$', 'Liqueur', 1),
(9, 'JUS AFYA', 4000, 235, 'FC', 'Mousse', 1),
(10, 'POULET', 5, 0, '$', 'Recette', 1);

-- --------------------------------------------------------

--
-- Structure de la table `rapports`
--

CREATE TABLE `rapports` (
  `idRap` int(11) NOT NULL,
  `jourRap` varchar(10) NOT NULL,
  `somme` double NOT NULL,
  `sommeD` double NOT NULL,
  `dette` double NOT NULL,
  `detteD` double NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rapports`
--

INSERT INTO `rapports` (`idRap`, `jourRap`, `somme`, `sommeD`, `dette`, `detteD`, `statut`) VALUES
(7, '26/04/2023', 16000, 35, 4000, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `idRec` int(11) NOT NULL,
  `nomRec` varchar(100) NOT NULL,
  `prixRec` double NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `serveurs`
--

CREATE TABLE `serveurs` (
  `idServ` int(11) NOT NULL,
  `nomServ` varchar(50) NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `serveurs`
--

INSERT INTO `serveurs` (`idServ`, `nomServ`, `statut`) VALUES
(5, 'SERVEUR 1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `idSt` int(11) NOT NULL,
  `produit` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `quantite` float NOT NULL,
  `statut` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`idSt`, `produit`, `day`, `quantite`, `statut`) VALUES
(2, 9, '27/04/2023', 240, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Index pour la table `boisson`
--
ALTER TABLE `boisson`
  ADD PRIMARY KEY (`idProd`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idCat`);

--
-- Index pour la table `detailfacture`
--
ALTER TABLE `detailfacture`
  ADD PRIMARY KEY (`idDetFac`);

--
-- Index pour la table `dettes`
--
ALTER TABLE `dettes`
  ADD PRIMARY KEY (`idDette`);

--
-- Index pour la table `facmbeg`
--
ALTER TABLE `facmbeg`
  ADD PRIMARY KEY (`idFM`);

--
-- Index pour la table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`idFac`);

--
-- Index pour la table `mbegeti`
--
ALTER TABLE `mbegeti`
  ADD PRIMARY KEY (`idMbeg`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`idProd`);

--
-- Index pour la table `rapports`
--
ALTER TABLE `rapports`
  ADD PRIMARY KEY (`idRap`);

--
-- Index pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`idRec`);

--
-- Index pour la table `serveurs`
--
ALTER TABLE `serveurs`
  ADD PRIMARY KEY (`idServ`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idSt`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `boisson`
--
ALTER TABLE `boisson`
  MODIFY `idProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `idCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `detailfacture`
--
ALTER TABLE `detailfacture`
  MODIFY `idDetFac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT pour la table `dettes`
--
ALTER TABLE `dettes`
  MODIFY `idDette` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `facmbeg`
--
ALTER TABLE `facmbeg`
  MODIFY `idFM` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `factures`
--
ALTER TABLE `factures`
  MODIFY `idFac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT pour la table `mbegeti`
--
ALTER TABLE `mbegeti`
  MODIFY `idMbeg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `idProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `rapports`
--
ALTER TABLE `rapports`
  MODIFY `idRap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `idRec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `serveurs`
--
ALTER TABLE `serveurs`
  MODIFY `idServ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `idSt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
