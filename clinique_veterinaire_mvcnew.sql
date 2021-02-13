-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 11 fév. 2021 à 14:12
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `clinique_veterinaire_mvc`
--

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

DROP TABLE IF EXISTS `animal`;
CREATE TABLE IF NOT EXISTS `animal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `dateNaissance` date NOT NULL,
  `dateDeces` date NOT NULL,
  `photo` varchar(255) NOT NULL,
  `idProprietaire` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_animal_proprietaire1_idx` (`idProprietaire`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`id`, `nom`, `dateNaissance`, `dateDeces`, `photo`, `idProprietaire`) VALUES
(1, 'Lennie', '2017-02-08', '0000-00-00', 'Lennie_resultat.jpg', 2),
(2, 'Max', '2015-05-08', '0000-00-00', 'Max_resultat.jpg', 4),
(3, 'Ben', '2013-01-03', '2020-02-17', 'Ben_resultat.jpg', 5),
(4, 'Poppy', '2019-05-03', '0000-00-00', 'bengal_resultat.jpg', 3),
(5, 'Pebble', '2018-07-08', '2020-11-17', 'rabbit_resultat.jpg', 5),
(6, 'Betsy', '2019-01-03', '0000-00-00', 'Congo-African-grey_resultat.jpg', 1);

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `idAnimal` int NOT NULL AUTO_INCREMENT,
  `idRace` int NOT NULL,
  PRIMARY KEY (`idAnimal`),
  KEY `fk_chat_race_chat1_idx` (`idRace`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `chat`
--

INSERT INTO `chat` (`idAnimal`, `idRace`) VALUES
(4, 45),
(2, 36);

-- --------------------------------------------------------

--
-- Structure de la table `chien`
--

DROP TABLE IF EXISTS `chien`;
CREATE TABLE IF NOT EXISTS `chien` (
  `idAnimal` int NOT NULL AUTO_INCREMENT,
  `taille` int NOT NULL,
  `poids` int NOT NULL,
  `idRace` int NOT NULL,
  PRIMARY KEY (`idAnimal`),
  KEY `fk_chien_race_chien_idx` (`idRace`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `chien`
--

INSERT INTO `chien` (`idAnimal`, `taille`, `poids`, `idRace`) VALUES
(3, 35, 15, 3),
(1, 48, 20, 1),
(5, 40, 24, 2);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `post_id` int NOT NULL,
  `date` datetime NOT NULL,
  `seen` tinyint NOT NULL DEFAULT '0',
  `signals` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `comment`, `post_id`, `date`, `seen`, `signals`) VALUES
(98, 16, 'Magnifique, j\'adore Grogu et oui il est la plus mignonne', 40, '2021-02-06 20:42:45', 1, 0),
(97, 14, 'Interessante !', 40, '2021-02-06 20:07:57', 1, 0),
(99, 16, 'Note 1002 1020', 1, '2021-02-10 20:10:20', 0, 0),
(100, 16, 'testest', 1, '2021-02-10 21:04:46', 0, 0),
(104, 16, 'here is a commnet', 1, '2021-02-10 21:53:59', 0, 0),
(106, 16, 'azerty', 2, '2021-02-10 22:15:23', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `dossier`
--

DROP TABLE IF EXISTS `dossier`;
CREATE TABLE IF NOT EXISTS `dossier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `antecedents` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `dossier`
--

INSERT INTO `dossier` (`id`, `antecedents`) VALUES
(1, ''),
(2, '');

-- --------------------------------------------------------

--
-- Structure de la table `effectuer`
--

DROP TABLE IF EXISTS `effectuer`;
CREATE TABLE IF NOT EXISTS `effectuer` (
  `idGarde` int NOT NULL AUTO_INCREMENT,
  `idVeterinaire` int NOT NULL,
  PRIMARY KEY (`idGarde`),
  KEY `fk_effectuer_veterinaire1_idx` (`idVeterinaire`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `effectuer`
--

INSERT INTO `effectuer` (`idGarde`, `idVeterinaire`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `garde`
--

DROP TABLE IF EXISTS `garde`;
CREATE TABLE IF NOT EXISTS `garde` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `garde`
--

INSERT INTO `garde` (`id`, `date`, `heure_debut`, `heure_fin`) VALUES
(1, '2020-01-13', '10:30:00', '14:30:00'),
(2, '2021-04-15', '09:15:00', '11:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `horaire`
--

DROP TABLE IF EXISTS `horaire`;
CREATE TABLE IF NOT EXISTS `horaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jour` date NOT NULL,
  `heureDebut` time NOT NULL,
  `heureFin` time NOT NULL,
  `idVeterinaire` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_horaire_veterinaire1_idx` (`idVeterinaire`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `horaire`
--

INSERT INTO `horaire` (`id`, `jour`, `heureDebut`, `heureFin`, `idVeterinaire`) VALUES
(1, '2021-01-12', '16:20:00', '17:05:00', 2),
(2, '2020-12-07', '09:30:00', '09:45:00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

DROP TABLE IF EXISTS `medicament`;
CREATE TABLE IF NOT EXISTS `medicament` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `dosage` varchar(255) NOT NULL,
  `indications` varchar(255) NOT NULL,
  `effetsSecondaires` varchar(255) NOT NULL,
  `laboratoire` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `medicament`
--

INSERT INTO `medicament` (`id`, `nom`, `dosage`, `indications`, `effetsSecondaires`, `laboratoire`) VALUES
(1, 'Metronidazole', '10mg', '2 fois par jour', 'très légers', 'P2'),
(2, 'Ketoconazole', '20ml', 'administration avec syringe 1 fois par jour', 'somnolence', 'M5');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `body` longtext NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'post.png',
  `image2` varchar(255) NOT NULL,
  `createdDate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `image`, `image2`, `createdDate`) VALUES
(11, 'Chiens', '', 'dogs.jpg', '', '2021-02-03 16:08:55'),
(24, 'Autres', '', 'parrots_resultat.jpg', '', '2021-02-01 18:33:05'),
(40, 'Chats', '', 'cats_resultat.jpg ', '', '2021-02-07 13:41:04'),
(45, 'Furets', '', 'ferrets_resultat.jpg', '', '2021-02-04 20:22:57');

-- --------------------------------------------------------

--
-- Structure de la table `prescrire`
--

DROP TABLE IF EXISTS `prescrire`;
CREATE TABLE IF NOT EXISTS `prescrire` (
  `idVisite` int NOT NULL AUTO_INCREMENT,
  `idMedicament` int NOT NULL,
  `posologie` varchar(255) NOT NULL,
  PRIMARY KEY (`idVisite`)
) ENGINE=MyISAM AUTO_INCREMENT=443 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `prescrire`
--

INSERT INTO `prescrire` (`idVisite`, `idMedicament`, `posologie`) VALUES
(325, 785467, '10ml'),
(442, 982732, '20mg');

-- --------------------------------------------------------

--
-- Structure de la table `proprietaire`
--

DROP TABLE IF EXISTS `proprietaire`;
CREATE TABLE IF NOT EXISTS `proprietaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `codePostal` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `telephoneMobile` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `proprietaire`
--

INSERT INTO `proprietaire` (`id`, `nom`, `prenom`, `rue`, `codePostal`, `ville`, `telephone`, `telephoneMobile`) VALUES
(1, 'Thompson', 'Richard', '12', '29880', 'Plouguerneau', '01 39 79 39 90', '07 71 27 75 23'),
(2, 'Ghuma', 'Ranya', '235', '91800', 'Brunoy', '09 84 47 64 43', '07 62 35 75 28');

-- --------------------------------------------------------

--
-- Structure de la table `race_chat`
--

DROP TABLE IF EXISTS `race_chat`;
CREATE TABLE IF NOT EXISTS `race_chat` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `race_chat`
--

INSERT INTO `race_chat` (`id`, `nom`) VALUES
(36, 'Ragdoll'),
(37, 'Maine Coon'),
(45, 'Bengal');

-- --------------------------------------------------------

--
-- Structure de la table `race_chien`
--

DROP TABLE IF EXISTS `race_chien`;
CREATE TABLE IF NOT EXISTS `race_chien` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `race_chien`
--

INSERT INTO `race_chien` (`id`, `nom`) VALUES
(1, 'Terrier'),
(2, 'Berger Allemand'),
(3, 'Border Collie');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(120) NOT NULL,
  `password` char(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `admin` int DEFAULT NULL,
  `pseudo` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `admin`, `pseudo`) VALUES
(8, 'test@test.com', '21e57080434c1cb6c2fb4753c4f8a28f', 0, 'Romain'),
(14, 'tom@gmail.com', '21e57080434c1cb6c2fb4753c4f8a28f', 0, 'Tom'),
(15, 'fleur@gmail.com', '21e57080434c1cb6c2fb4753c4f8a28f', 0, 'Fleur2021'),
(16, 'yodafan@gmail.com', 'b75386a936120a3eba7ee7ce12d8c4e4', 0, 'YodaFan');

-- --------------------------------------------------------

--
-- Structure de la table `veterinaire`
--

DROP TABLE IF EXISTS `veterinaire`;
CREATE TABLE IF NOT EXISTS `veterinaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `telephoneMobile` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `veterinaire`
--

INSERT INTO `veterinaire` (`id`, `nom`, `prenom`, `telephone`, `telephoneMobile`) VALUES
(1, 'Taillieu', 'Martin', '01 39 11 73 15', '06 39 17 80 32'),
(2, 'Duveau', 'Patricia', '01 39 70 88 90', '07 39 77 54 13');

-- --------------------------------------------------------

--
-- Structure de la table `visite`
--

DROP TABLE IF EXISTS `visite`;
CREATE TABLE IF NOT EXISTS `visite` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dateVisite` date NOT NULL,
  `heureVisite` time NOT NULL,
  `raison` varchar(255) NOT NULL,
  `idDossier` int NOT NULL,
  `idAnimal` int NOT NULL,
  `idVeterinaire` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_visite_veterinaire1_idx` (`idVeterinaire`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `visite`
--

INSERT INTO `visite` (`id`, `dateVisite`, `heureVisite`, `raison`, `idDossier`, `idAnimal`, `idVeterinaire`) VALUES
(1, '2020-03-14', '09:30:00', 'douleur jambe droite', 34, 1, 2),
(2, '2019-06-24', '16:15:00', 'genou gonflé', 57, 4, 1),
(3, '2021-01-05', '11:00:00', 'animal ne mange pas', 12, 4, 2);

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

DROP TABLE IF EXISTS `votes`;
CREATE TABLE IF NOT EXISTS `votes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comment_id` int NOT NULL,
  `user_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `post_id` int NOT NULL,
  `vote` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=136 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
