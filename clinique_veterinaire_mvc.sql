-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 06 août 2021 à 07:22
-- Version du serveur :  5.7.32
-- Version de PHP : 7.4.16

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

CREATE TABLE `animal` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `dateNaissance` date NOT NULL,
  `dateDeces` date NOT NULL,
  `photo` varchar(255) NOT NULL,
  `idProprietaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `chat` (
  `idAnimal` int(11) NOT NULL,
  `idRace` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chat`
--

INSERT INTO `chat` (`idAnimal`, `idRace`) VALUES
(2, 36),
(4, 45);

-- --------------------------------------------------------

--
-- Structure de la table `chien`
--

CREATE TABLE `chien` (
  `idAnimal` int(11) NOT NULL,
  `taille` int(11) NOT NULL,
  `poids` int(11) NOT NULL,
  `idRace` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chien`
--

INSERT INTO `chien` (`idAnimal`, `taille`, `poids`, `idRace`) VALUES
(1, 48, 20, 1),
(3, 35, 15, 3),
(5, 40, 24, 2);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `post_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `seen` tinyint(4) NOT NULL DEFAULT '0',
  `signals` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `comment`, `post_id`, `date`, `seen`, `signals`) VALUES
(97, 14, 'Interessante !', 40, '2021-02-06 20:07:57', 1, 0),
(98, 16, 'Magnifique, j\'adore Grogu et oui il est la plus mignonne', 40, '2021-02-06 20:42:45', 1, 0),
(99, 16, 'Note 1002 1020', 1, '2021-02-10 20:10:20', 0, 0),
(100, 16, 'testest', 1, '2021-02-10 21:04:46', 0, 0),
(104, 16, 'here is a commnet', 1, '2021-02-10 21:53:59', 0, 0),
(106, 16, 'azerty', 2, '2021-02-10 22:15:23', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `dossier`
--

CREATE TABLE `dossier` (
  `id` int(11) NOT NULL,
  `antecedents` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `effectuer` (
  `idGarde` int(11) NOT NULL,
  `idVeterinaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `garde` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `horaire` (
  `id` int(11) NOT NULL,
  `jour` date NOT NULL,
  `heureDebut` time NOT NULL,
  `heureFin` time NOT NULL,
  `idVeterinaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `medicament` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `dosage` varchar(255) NOT NULL,
  `indications` varchar(255) NOT NULL,
  `effetsSecondaires` varchar(255) NOT NULL,
  `laboratoire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `body` longtext NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'post.png',
  `image2` varchar(255) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `prescrire` (
  `idVisite` int(11) NOT NULL,
  `idMedicament` int(11) NOT NULL,
  `posologie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `proprietaire` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `rue` varchar(255) NOT NULL,
  `codePostal` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `telephoneMobile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `race_chat` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `race_chien` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` char(60) NOT NULL,
  `admin` int(11) DEFAULT NULL,
  `pseudo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `veterinaire` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `telephoneMobile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `visite` (
  `id` int(11) NOT NULL,
  `dateVisite` date NOT NULL,
  `heureVisite` time NOT NULL,
  `raison` varchar(255) NOT NULL,
  `idDossier` int(11) NOT NULL,
  `idAnimal` int(11) NOT NULL,
  `idVeterinaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `post_id` int(11) NOT NULL,
  `vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_animal_proprietaire1_idx` (`idProprietaire`);

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idAnimal`),
  ADD KEY `fk_chat_race_chat1_idx` (`idRace`);

--
-- Index pour la table `chien`
--
ALTER TABLE `chien`
  ADD PRIMARY KEY (`idAnimal`),
  ADD KEY `fk_chien_race_chien_idx` (`idRace`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `dossier`
--
ALTER TABLE `dossier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `effectuer`
--
ALTER TABLE `effectuer`
  ADD PRIMARY KEY (`idGarde`),
  ADD KEY `fk_effectuer_veterinaire1_idx` (`idVeterinaire`);

--
-- Index pour la table `garde`
--
ALTER TABLE `garde`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_horaire_veterinaire1_idx` (`idVeterinaire`);

--
-- Index pour la table `medicament`
--
ALTER TABLE `medicament`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `prescrire`
--
ALTER TABLE `prescrire`
  ADD PRIMARY KEY (`idVisite`);

--
-- Index pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `race_chat`
--
ALTER TABLE `race_chat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `race_chien`
--
ALTER TABLE `race_chien`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `veterinaire`
--
ALTER TABLE `veterinaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `visite`
--
ALTER TABLE `visite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_visite_veterinaire1_idx` (`idVeterinaire`);

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `animal`
--
ALTER TABLE `animal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `idAnimal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `chien`
--
ALTER TABLE `chien`
  MODIFY `idAnimal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT pour la table `dossier`
--
ALTER TABLE `dossier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `effectuer`
--
ALTER TABLE `effectuer`
  MODIFY `idGarde` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `garde`
--
ALTER TABLE `garde`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `horaire`
--
ALTER TABLE `horaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `medicament`
--
ALTER TABLE `medicament`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `prescrire`
--
ALTER TABLE `prescrire`
  MODIFY `idVisite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;

--
-- AUTO_INCREMENT pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `race_chat`
--
ALTER TABLE `race_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `race_chien`
--
ALTER TABLE `race_chien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `veterinaire`
--
ALTER TABLE `veterinaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `visite`
--
ALTER TABLE `visite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
