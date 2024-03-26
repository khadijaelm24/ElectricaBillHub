-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : jeu. 07 mars 2024 à 19:55
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `electricabillhub`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `ID_Client` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `ID_Login` int(11) DEFAULT NULL,
  `ID_Fournisseur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`ID_Client`, `email`, `pwd`, `nom`, `prenom`, `adresse`, `ID_Login`, `ID_Fournisseur`) VALUES
(1, 'khadijaa.elmadani@gmail.com', '$2y$10$V3QQKIAl1beyYl/VdPSNMeS3iRxb4l/nxN5LPFUVbjsDxOylGrXea', 'EL MADANI', 'Khadija', 'WILAYA, TETOUAN', 1, 1),
(2, 'omar.elmadani@gmail.com', '$2y$10$5u5WyeLMzU1NTU9v5rNIXuhOfJQFQP8K0RTyo8/IXHOQMgYnO22cm', 'EL MADANI', 'OMAR', 'MIRAMAR, MARTIL', 2, 1),
(3, 'younes@gmail.com', '$2y$10$sxgn8o1OBC9QfO90Cx/QYeCPXju79gv1pjIBWBGzv3aHGY54S58/q', 'El Madani', 'younes', 'CHBAR, Martil', 7, 1),
(5, 'khadija.elyousfy@gmail.com', '$2y$10$LNE82Iif8SWsfgX/CVzMlO44vGcCC9EXW60rVvKuKzSW/O9nA1X8G', 'El Youssfy', 'Khadija', 'al bayt al atiq, martil', 9, 1),
(6, 'khadijaelmadani24@gmail.com', '$2y$10$IJIBhK10.Jf2JjNV.56EkuX4lSUPmjWLmoRmZBpLlFwUODlnCSYBS', 'El Madani', 'Khadija', 'AZLA, tetouan', 10, 1),
(7, 'alia@gmail.com', '$2y$10$CqRwwiUukuRxadXdwh2nX.7yhjMbruezGM4d3BSCyH.UP351EVXXC', 'El Madani', 'alia', 'mdiq', 11, 1),
(8, 'k@gmail.com', '$2y$10$qid45vTn6m7tFQzwgJuxBOX6/rPIlBnejXr1LBC93VjyloRIoacTG', 'El Madani', 'Khadija', 'WILAYA, TETOUAN', 12, 1),
(10, 'yassin.elyoussfy@gmail.com', '$2y$10$NCtcULEhmfjUMshQ8gh1YOs0R/GWxzf76Uvwpy4wbGr7wGHzAQxVe', 'El Youssfy', 'Yassine', 'BARIO, TETOUAN', 14, 1),
(11, 'naima@gmail.com', '$2y$10$E4gRP5saI/wmxbF8dA08X.3FuGn/kbhUZ9dMPkQaU8y49RXGgXY9C', 'Elmadany', 'Naeima', '...', 15, 1),
(12, 'nom.prenom@gmail.com', '$2y$10$/yBEcfoEEXxqf.ODQmzG9OGDg6B1QIQVKvZTN.zs5dU/4TTWydiYK', 'Nom', 'Prenom', 'Adresse', 16, 1),
(13, 'nomprenom@mail.com', '$2y$10$oQ6cA71/UgIZdWPXAy29VunXhC50yKa/Vrjcgea74TVoZPFpxPNZy', 'nom ', 'Prenom', 'test', 17, 1),
(14, 'test@test.com', '$2y$10$7q43KATbzeNPT3IHSc.5m.Gcnd5vpOgDQJVY7E60tNdxn6c3NrSAC', 'test', 'test', 'test', 18, 1),
(15, 'test@gmail.com', '$2y$10$/Q11EuJRO9PnZ1jsrGnXf.KYZpuvT8YjIfTxALeTW93f2pxdXaPaO', 'El Madani', 'Khadija ', 'martil', 19, 1),
(16, 'test@mail.com', '$2y$10$Ef.eFZRnmk3tFubZw/.dTeHb0Xqa/UaDXaMmZpFeyfoUGsrGXi9ki', 'test', 'new', 'address', 20, 1),
(17, 'test@test.test', '$2y$10$9pK8QxM1Q100Sga5yEzxgOJlminzBBMKe9bFHeF7zi.7lXmiwksDa', 'test', 'test2', 'test', 21, 1),
(18, 'testt@test.com', '$2y$10$/x6CsI0tIOwUeDNbRIRAeOCBzkuC1CYGLq6AEopOv2jjI3Qc2GmDi', 'testt', 'testt', 'testt', 22, 1),
(19, 'prenomnom@example.com', '$2y$10$P6tXwMnq6OvhFBV8HKoLx.K3cqVlBLAkzLxmcQcKwpuH23fIGBddu', 'prenom nom', '.', 'address', 23, 1),
(20, 'EMAIL@EMAIL.EMAIL', '$2y$10$GKJGLfd98NmzDTcgNLukDe1k1GSBTFIcptTI9Pc1FN8d5Q96a6fma', 'NOM', 'PRENOM', 'ADRESSE', 24, 1),
(22, 'testt@gmail.com', '$2y$10$AXfaKvw0.ENJiALV54MZ3.8X6dM/9DGlAAYUIgiXg2v4WbyHHkJMC', 'testt', 'testt', 'testt', 26, 1),
(23, 'test1@gmail.com', '$2y$10$vStTiRvM8bLLBhmzPu/MJuUYgLm8mKgBMHodS2OyQqKyAXDDbuDPS', 'test1', 'test1', 'test1', 27, 1);

-- --------------------------------------------------------

--
-- Structure de la table `consommation_annuelle`
--

CREATE TABLE `consommation_annuelle` (
  `ID_Consom_An` int(11) NOT NULL,
  `Consommation` decimal(8,2) DEFAULT NULL,
  `Annee` int(11) DEFAULT NULL,
  `Date_Saisie` date DEFAULT NULL,
  `ID_Fournisseur` int(11) DEFAULT NULL,
  `ID_Client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `consommation_annuelle`
--

INSERT INTO `consommation_annuelle` (`ID_Consom_An`, `Consommation`, `Annee`, `Date_Saisie`, `ID_Fournisseur`, `ID_Client`) VALUES
(76, 2500.00, 2023, '2024-01-02', 1, 1),
(77, 609.00, 2023, '2024-01-03', 1, 2),
(78, 3000.00, 2022, '2023-01-03', 1, 5),
(79, 2500.00, 2023, '2024-01-02', 1, 1),
(80, 609.00, 2023, '2024-01-03', 1, 2),
(81, 3000.00, 2022, '2023-01-03', 1, 5),
(82, 2500.00, 2023, '2024-01-02', 1, 1),
(83, 609.00, 2023, '2024-01-03', 1, 2),
(84, 3000.00, 2022, '2023-01-03', 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `consommation_mensuelle`
--

CREATE TABLE `consommation_mensuelle` (
  `ID_Consommation` int(11) NOT NULL,
  `mois` int(11) DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `photo_compteur` varchar(255) DEFAULT NULL,
  `consom_mensuelle` decimal(8,2) DEFAULT NULL,
  `statut` varchar(255) DEFAULT NULL,
  `etat_consom` varchar(255) DEFAULT NULL,
  `date_saisie` date DEFAULT NULL,
  `ID_Client` int(11) DEFAULT NULL,
  `ID_Fournisseur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `consommation_mensuelle`
--

INSERT INTO `consommation_mensuelle` (`ID_Consommation`, `mois`, `annee`, `photo_compteur`, `consom_mensuelle`, `statut`, `etat_consom`, `date_saisie`, `ID_Client`, `ID_Fournisseur`) VALUES
(1, 2, 2023, '../uploads/compteur.jpg', 124.00, 'paye', 'valide', '2023-02-28', 1, 1),
(2, 3, 2023, '../uploads/compteur.jpg', 238.58, 'paye', 'valide', '2023-03-31', 1, 1),
(3, 2, 2023, '../uploads/compteur.jpg', 37.90, 'paye', 'valide', '2023-02-28', 2, 1),
(4, 3, 2023, '../uploads/compteur.jpg', 67.57, 'paye', 'valide', '2023-03-31', 2, 1),
(5, 2, 2024, '../uploads/compteur.jpg', 80.00, 'non paye', 'valide', '2024-02-25', 1, 1),
(7, 12, 2023, '../uploads/compteur.jpg', 245.00, 'non paye', 'valide', '2024-02-25', 1, 1),
(8, 11, 2024, '../uploads/compteur.jpg', 100.00, 'non paye', 'valide', '2024-02-25', 1, 1),
(9, 10, 2023, '../uploads/compteur.jpg', 24.00, 'non paye', 'valide', '2024-02-25', 1, 1),
(10, 9, 2023, '../uploads/compteur.jpg', 35.00, 'paye', 'valide', '2024-02-25', 1, 1),
(11, 8, 2023, '../uploads/compteur.jpg', 67.00, 'non paye', 'valide', '2024-02-25', 1, 1),
(12, 7, 2023, '../uploads/compteur.jpg', 203.00, 'paye', 'valide', '2024-02-25', 1, 1),
(13, 5, 2023, '../uploads/compteur.jpg', 244.00, 'non paye', 'valide', '2024-02-25', 1, 1),
(14, 4, 2023, '../uploads/compteur.jpg', 83.00, 'non paye', 'valide', '2024-02-25', 1, 1),
(15, 6, 2023, '../uploads/compteur.jpg', 339.00, 'paye', 'valide', '2024-02-25', 1, 1),
(16, 9, 2024, '../uploads/compteur.jpg', 95.00, 'paye', 'valide', '2024-02-26', 1, 1),
(17, 4, 2024, '../uploads/compteur.jpg', 300.09, 'paye', 'valide', '2024-03-02', 1, 1),
(18, 5, 2022, '../uploads/compteur.jpg', 83.00, 'non paye', 'valide', '2024-03-02', 1, 1),
(19, 2, 2022, '../uploads/compteur.jpg', 238.58, 'non paye', 'valide', '2024-03-02', 1, 1),
(20, 10, 2024, '../uploads/compteur.jpg', 130.00, 'non paye', 'non valide', '2024-03-02', 1, 1),
(27, 6, 2023, '../uploads/compteur.jpg', 90.00, 'non paye', 'non valide', '2024-03-03', 2, 1),
(28, 4, 2023, '../uploads/compteur.jpg', 120.00, 'paye', 'valide', '2024-03-03', 2, 1),
(29, 1, 2023, '../uploads/compteur.jpg', 90.00, 'non paye', 'non valide', '2024-03-03', 2, 1),
(30, 5, 2023, '../uploads/compteur.jpg', 202.00, 'non paye', 'valide', '2024-03-03', 2, 1),
(31, 9, 2024, '../uploads/compteur.jpg', 202.50, 'non paye', 'valide', '2024-03-03', 2, 1),
(33, 1, 2022, '../uploads/compteur.jpg', 298.58, 'paye', 'valide', '2024-03-04', 10, 1),
(35, 3, 2024, '../uploads/compteur.jpg', 234.00, 'non paye', 'valide', '2024-03-06', 1, 1),
(36, 11, 2023, '../uploads/compteur.jpg', 456.00, 'non paye', 'valide', '2024-03-06', 1, 1),
(37, 1, 2024, '../uploads/compteur.jpg', 246.00, 'non paye', 'valide', '2024-03-06', 1, 1),
(38, 12, 2023, '../uploads/compteur.jpg', 23.00, 'non paye', 'valide', '2024-03-06', 3, 1),
(39, 1, 2024, '../uploads/compteur.jpg', 120.00, 'non paye', 'valide', '2024-03-06', 3, 1),
(41, 2, 2024, '../uploads/compteur.jpg', 8.00, 'non paye', 'non valide', '2024-03-06', 3, 1),
(42, 3, 2024, '../uploads/compteur.jpg', -9.00, 'non paye', 'valide', '2024-03-06', 3, 1),
(44, 4, 2024, '../uploads/compteur.jpg', 145.00, 'non paye', 'valide', '2024-03-06', 3, 1),
(45, 5, 2024, '../uploads/compteur.jpg', 108.00, 'paye', 'valide', '2024-03-06', 3, 1),
(46, 1, 2022, '../uploads/compteur.jpg', 123.00, 'paye', 'valide', '2024-03-06', 5, 1),
(47, 2, 2022, '../uploads/compteur.jpg', 150.00, 'paye', 'valide', '2024-03-06', 5, 1),
(48, 3, 2022, '../uploads/compteur.jpg', 200.00, 'paye', 'valide', '2024-03-06', 5, 1),
(49, 4, 2022, '../uploads/compteur.jpg', 180.00, 'paye', 'valide', '2024-03-06', 5, 1),
(50, 5, 2022, '../uploads/compteur.jpg', 0.00, 'paye', 'valide', '2024-03-06', 5, 1),
(51, 6, 2022, '../uploads/compteur.jpg', 345.00, 'paye', 'valide', '2024-03-06', 5, 1),
(52, 7, 2022, '../uploads/compteur.jpg', 270.00, 'paye', 'valide', '2024-03-06', 5, 1),
(53, 8, 2022, '../uploads/compteur.jpg', 280.00, 'paye', 'valide', '2024-03-07', 5, 1),
(54, 9, 2022, '../uploads/compteur.jpg', 295.00, 'paye', 'valide', '2024-03-07', 5, 1),
(55, 10, 2022, '../uploads/compteur.jpg', 300.00, 'paye', 'valide', '2024-03-07', 5, 1),
(56, 11, 2022, '../uploads/compteur.jpg', 310.00, 'paye', 'valide', '2024-03-07', 5, 1),
(57, 12, 2022, '../uploads/compteur.jpg', 230.00, 'paye', 'valide', '2024-03-07', 5, 1),
(58, 1, 2023, '../uploads/compteur.jpg', 124.00, 'paye', 'valide', '2024-03-07', 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `ID_Fournisseur` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `ID_Login` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`ID_Fournisseur`, `email`, `pwd`, `nom`, `prenom`, `ID_Login`) VALUES
(1, 'yousra.elmadani@gmail.com', '$2y$10$o/k9dYJ49yJnG7wMAi/gY.3QhVl4m4cSOXVQ9yEAt6Y2/8qTf2nyi', 'EL MADANI', 'Yousra', 3);

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `ID_Login` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`ID_Login`, `email`, `pwd`, `user_type`) VALUES
(1, 'khadijaa.elmadani@gmail.com', '$2y$10$V3QQKIAl1beyYl/VdPSNMeS3iRxb4l/nxN5LPFUVbjsDxOylGrXea', 'client'),
(2, 'omar.elmadani@gmail.com', '$2y$10$5u5WyeLMzU1NTU9v5rNIXuhOfJQFQP8K0RTyo8/IXHOQMgYnO22cm', 'client'),
(3, 'yousra.elmadani@gmail.com', '$2y$10$atERZ824myPxBXyL2wvf/uTu5FNHv1HiODBfhjSc/OQGQuVhuKlu2', 'fournisseur'),
(7, 'younes@gmail.com', '$2y$10$sxgn8o1OBC9QfO90Cx/QYeCPXju79gv1pjIBWBGzv3aHGY54S58/q', 'client'),
(9, 'khadija.elyousfy@gmail.com', '$2y$10$LNE82Iif8SWsfgX/CVzMlO44vGcCC9EXW60rVvKuKzSW/O9nA1X8G', 'client'),
(10, 'khadijaelmadani24@gmail.com', '$2y$10$IJIBhK10.Jf2JjNV.56EkuX4lSUPmjWLmoRmZBpLlFwUODlnCSYBS', 'client'),
(11, 'alia@gmail.com', '$2y$10$CqRwwiUukuRxadXdwh2nX.7yhjMbruezGM4d3BSCyH.UP351EVXXC', 'client'),
(12, 'k@gmail.com', '$2y$10$qid45vTn6m7tFQzwgJuxBOX6/rPIlBnejXr1LBC93VjyloRIoacTG', 'client'),
(14, 'yassin.elyoussfy@gmail.com', '$2y$10$NCtcULEhmfjUMshQ8gh1YOs0R/GWxzf76Uvwpy4wbGr7wGHzAQxVe', 'client'),
(15, 'naima@gmail.com', '$2y$10$E4gRP5saI/wmxbF8dA08X.3FuGn/kbhUZ9dMPkQaU8y49RXGgXY9C', 'client'),
(16, 'nom.prenom@gmail.com', '$2y$10$/yBEcfoEEXxqf.ODQmzG9OGDg6B1QIQVKvZTN.zs5dU/4TTWydiYK', 'client'),
(17, 'nomprenom@mail.com', '$2y$10$oQ6cA71/UgIZdWPXAy29VunXhC50yKa/Vrjcgea74TVoZPFpxPNZy', 'client'),
(18, 'test@test.com', '$2y$10$7q43KATbzeNPT3IHSc.5m.Gcnd5vpOgDQJVY7E60tNdxn6c3NrSAC', 'client'),
(19, 'test@gmail.com', '$2y$10$/Q11EuJRO9PnZ1jsrGnXf.KYZpuvT8YjIfTxALeTW93f2pxdXaPaO', 'client'),
(20, 'test@mail.com', '$2y$10$Ef.eFZRnmk3tFubZw/.dTeHb0Xqa/UaDXaMmZpFeyfoUGsrGXi9ki', 'client'),
(21, 'test@test.test', '$2y$10$9pK8QxM1Q100Sga5yEzxgOJlminzBBMKe9bFHeF7zi.7lXmiwksDa', 'client'),
(22, 'testt@test.com', '$2y$10$/x6CsI0tIOwUeDNbRIRAeOCBzkuC1CYGLq6AEopOv2jjI3Qc2GmDi', 'client'),
(23, 'prenomnom@example.com', '$2y$10$P6tXwMnq6OvhFBV8HKoLx.K3cqVlBLAkzLxmcQcKwpuH23fIGBddu', 'client'),
(24, 'EMAIL@EMAIL.EMAIL', '$2y$10$GKJGLfd98NmzDTcgNLukDe1k1GSBTFIcptTI9Pc1FN8d5Q96a6fma', 'client'),
(26, 'testt@gmail.com', '$2y$10$AXfaKvw0.ENJiALV54MZ3.8X6dM/9DGlAAYUIgiXg2v4WbyHHkJMC', 'client'),
(27, 'test1@gmail.com', '$2y$10$vStTiRvM8bLLBhmzPu/MJuUYgLm8mKgBMHodS2OyQqKyAXDDbuDPS', 'client');

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

CREATE TABLE `reclamation` (
  `ID_Reclamation` int(11) NOT NULL,
  `type_reclamation` varchar(255) DEFAULT NULL,
  `desc_reclamation` varchar(255) DEFAULT NULL,
  `reponse_reclamation` varchar(255) DEFAULT NULL,
  `statut` varchar(255) DEFAULT NULL,
  `ID_Client` int(11) DEFAULT NULL,
  `ID_Fournisseur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reclamation`
--

INSERT INTO `reclamation` (`ID_Reclamation`, `type_reclamation`, `desc_reclamation`, `reponse_reclamation`, `statut`, `ID_Client`, `ID_Fournisseur`) VALUES
(1, 'Facture', 'reponse non encore recue de ce probleme', 'bien recu', 'Traite', 1, 1),
(2, 'Fuite externe', 'coupure d electricite non reparee pour 2j', 'bien reparee maintenant, merci pour votre avertissement de ce prob!', 'Traite', 1, 1),
(3, 'Facture', 'paye mais encore declaree non paye dans ma facture', 'test', 'Traite', 2, 1),
(4, 'Fuite interne', 'bonjour\r\n', 'bonjour, comment pourrons-nous vous aider?', 'Traite', 1, 1),
(5, 'Fuite externe', 'fuite externe s etait etalee pour plus que six heures', 'on va voir la solution le plutot possible', 'Traite', 1, 1),
(6, 'Facture', 'facture non encore recue depuis 1j', 'est-ce que vous avez envoye la consommation?', 'Traite', 1, 1),
(7, 'Autre', 'ou se trouve exactement dans Tetouan?', 'Avenue les F.A.R', 'Traite', 1, 1),
(8, 'Autre', 'je veux savoir ou se situe le nouveau local a Tetouan\r\n', 'c\'est deja repondu', 'Traite', 1, 1),
(9, 'a propos de nouveau local de paiement', 'test\r\n', 'aussi, c\'est deja repondu', 'Traite', 1, 1),
(10, 'Fuite interne', 'testt', 'est-ce que c\'est repare maintenant ou pas encore?', 'Traite', 1, 1),
(11, 'Fuite externe', 'test 2', '?', 'Traite', 1, 1),
(12, 'Facture', 'validation de consommation pas encore recue', 'on va le consulter aujourd\'hui', 'Traite', 1, 1),
(13, 'coupure d\'electricite', 'pendant 2h aucune reparation n\'est faite', 'on va regler le prob', 'Traite', 1, 1),
(14, 'coupure d\'electricite', 'pendant 2h aucune reparation n\'est faite', 'on va regler le prob', 'Traite', 1, 1),
(15, 'coupure d\'electricite', 'pendant 2h aucune reparation n\'est faite', 'on va regler le prob', 'Traite', 1, 1),
(16, 'coupure d\'electricite', 'aucune reparation n\'est faite', 'on va regler le prob', 'Traite', 1, 1),
(17, 'coupure d\'electricite', 'aucune reparation n\'est faite pendant 2h ', 'on va regler le prob', 'Traite', 1, 1),
(18, 'coupure d\'electricite', 'aucune reparation n\'est faite pendant 2h ', 'on va regler le prob', 'Traite', 1, 1),
(19, 'autre apropos de facture', 'date invalide pour le nouveau mois', 'on va corriger cela', 'Traite', 1, 1),
(20, 'Fuite interne', 'hello', 'test', 'Traite', 1, 1),
(21, 'Fuite externe', 'hi', 'test', 'Traite', 1, 1),
(22, 'Facture', 'helloo', 'test response\r\n', 'Traite', 1, 1),
(23, 'autree', 'hii', 'hi', 'Traite', 1, 1),
(24, 'hi', 'hi', 'test', 'Traite', 1, 1),
(25, 'Fuite externe', 'testt', 'test', 'Traite', 1, 1),
(26, 'Fuite externe', 'alimentation electrique absente', 'ca serait reparee apres 15min de l\'arrivee du plombier', 'Traite', 1, 1),
(27, 'Fuite interne', 'test', 'test2', 'Traite', 1, 1),
(28, 'Fuite externe', 'testt', 'test', 'Traite', 1, 1),
(29, 'Facture', 'paid', 'test', 'Traite', 1, 1),
(30, 'test', 'new test', 'test', 'Traite', 1, 1),
(31, 'Fuite interne', 'hi', 'test', 'Traite', 1, 1),
(32, 'Fuite interne', 'test', 'test', 'Traite', 1, 1),
(33, 'other', 'testt', '...', 'Traite', 1, 1),
(34, 'Fuite interne', 'reclamation de fuite interne', 'fuite interne reparee', 'Traite', 2, 1),
(35, 'Fuite externe', 'reclamation de fuite externe', 'fuite externe reparee', 'Traite', 2, 1),
(36, 'Facture', 'reclamation de facture', 'le probleme de facturee reclamee a ete bien resolue', 'Traite', 2, 1),
(37, 'autre', 'autre reclamation', 'autre non specifiee, veuillez specifier le contenu de votre reclamation!', 'Traite', 2, 1),
(38, 'other complaint', 'hi, i have a complaint', 'what is that complaint?', 'Traite', 1, 1),
(39, 'Fuite interne', 'reclamation de fuite interne\r\n', 'quelle fuite interne exactement?', 'Traite', 5, 1),
(40, 'Fuite externe', 'reclamation de fuite externe', 'test', 'Traite', 5, 1),
(41, 'Facture', 'reclamation de facture', 'c\'est maintenant verifie', 'Traite', 5, 1),
(42, 'autre reclamation', 'autre reclamation d\'autre type', 'Pas encore traite', 'En cours', 5, 1),
(43, 'Facture', 'test facture', 'Pas encore traite', 'En cours', 1, 1),
(44, 'Fuite interne', 'test reclam de fuite interne', 'bien reparee maintenant', 'Traite', 5, 1),
(45, 'Fuite externe', 'test reclam de fuite externe', 'Pas encore traite', 'En cours', 5, 1),
(46, 'Facture', 'test reclam de facture', 'bien traite, merci pour l\'envoi', 'Traite', 5, 1),
(47, 'autre reclamation', 'test reclam de autre reclamation', 'Pas encore traite', 'En cours', 5, 1),
(48, 'autre reclamation', 'test', 'testtt', 'Traite', 5, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID_Client`),
  ADD KEY `c2` (`ID_Login`),
  ADD KEY `c3` (`ID_Fournisseur`);

--
-- Index pour la table `consommation_annuelle`
--
ALTER TABLE `consommation_annuelle`
  ADD PRIMARY KEY (`ID_Consom_An`),
  ADD KEY `c8` (`ID_Fournisseur`),
  ADD KEY `c9` (`ID_Client`);

--
-- Index pour la table `consommation_mensuelle`
--
ALTER TABLE `consommation_mensuelle`
  ADD PRIMARY KEY (`ID_Consommation`),
  ADD KEY `c6` (`ID_Fournisseur`),
  ADD KEY `c7` (`ID_Client`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`ID_Fournisseur`),
  ADD KEY `c1` (`ID_Login`);

--
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID_Login`);

--
-- Index pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD PRIMARY KEY (`ID_Reclamation`),
  ADD KEY `c4` (`ID_Fournisseur`),
  ADD KEY `c5` (`ID_Client`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `ID_Client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `consommation_annuelle`
--
ALTER TABLE `consommation_annuelle`
  MODIFY `ID_Consom_An` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT pour la table `consommation_mensuelle`
--
ALTER TABLE `consommation_mensuelle`
  MODIFY `ID_Consommation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `ID_Fournisseur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `ID_Login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `reclamation`
--
ALTER TABLE `reclamation`
  MODIFY `ID_Reclamation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `c2` FOREIGN KEY (`ID_Login`) REFERENCES `login` (`ID_Login`),
  ADD CONSTRAINT `c3` FOREIGN KEY (`ID_Fournisseur`) REFERENCES `fournisseur` (`ID_Fournisseur`);

--
-- Contraintes pour la table `consommation_annuelle`
--
ALTER TABLE `consommation_annuelle`
  ADD CONSTRAINT `c8` FOREIGN KEY (`ID_Fournisseur`) REFERENCES `fournisseur` (`ID_Fournisseur`),
  ADD CONSTRAINT `c9` FOREIGN KEY (`ID_Client`) REFERENCES `client` (`ID_Client`);

--
-- Contraintes pour la table `consommation_mensuelle`
--
ALTER TABLE `consommation_mensuelle`
  ADD CONSTRAINT `c6` FOREIGN KEY (`ID_Fournisseur`) REFERENCES `fournisseur` (`ID_Fournisseur`),
  ADD CONSTRAINT `c7` FOREIGN KEY (`ID_Client`) REFERENCES `client` (`ID_Client`);

--
-- Contraintes pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD CONSTRAINT `c1` FOREIGN KEY (`ID_Login`) REFERENCES `login` (`ID_Login`);

--
-- Contraintes pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `c4` FOREIGN KEY (`ID_Fournisseur`) REFERENCES `fournisseur` (`ID_Fournisseur`),
  ADD CONSTRAINT `c5` FOREIGN KEY (`ID_Client`) REFERENCES `client` (`ID_Client`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
