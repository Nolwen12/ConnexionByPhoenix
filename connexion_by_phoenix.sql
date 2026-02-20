-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 20 fév. 2026 à 22:26
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `connexion_by_phoenix`
--

-- --------------------------------------------------------

--
-- Structure de la table `appel`
--

CREATE TABLE `appel` (
  `id` int NOT NULL,
  `duree` time NOT NULL,
  `created_at` datetime NOT NULL,
  `collaboration_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `banque`
--

CREATE TABLE `banque` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `cp` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `banque`
--

INSERT INTO `banque` (`id`, `nom`, `adresse`, `cp`, `ville`) VALUES
(1, 'banque1', '14 rue Jean Jaurès', '94110', 'Arcueil'),
(2, 'banque2', '18 rue de la paix', '94230', 'Cachan'),
(3, 'banque3', '12 rue vaugirard', '94250', 'Gentilly');

-- --------------------------------------------------------

--
-- Structure de la table `collaboration`
--

CREATE TABLE `collaboration` (
  `id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `entreprise1_id` int NOT NULL,
  `entreprise2_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `collaboration`
--

INSERT INTO `collaboration` (`id`, `created_at`, `entreprise1_id`, `entreprise2_id`) VALUES
(1, '2026-02-20 21:41:15', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

CREATE TABLE `competence` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `demandeur_competence`
--

CREATE TABLE `demandeur_competence` (
  `id` int NOT NULL,
  `demandeur_emploie_id` int NOT NULL,
  `competence_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `demandeur_emploie`
--

CREATE TABLE `demandeur_emploie` (
  `id` int NOT NULL,
  `cv` varchar(255) NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `demande_offre`
--

CREATE TABLE `demande_offre` (
  `id` int NOT NULL,
  `demandeur_emploie_id` int NOT NULL,
  `offre_emploie_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20260218144452', '2026-02-18 14:45:20', 200),
('DoctrineMigrations\\Version20260218150249', '2026-02-18 15:03:06', 57),
('DoctrineMigrations\\Version20260218152814', '2026-02-18 15:28:28', 210),
('DoctrineMigrations\\Version20260219141554', '2026-02-19 14:16:04', 228),
('DoctrineMigrations\\Version20260219142334', '2026-02-19 14:23:42', 104),
('DoctrineMigrations\\Version20260219152605', '2026-02-19 15:26:14', 114),
('DoctrineMigrations\\Version20260219155122', '2026-02-19 15:51:37', 284),
('DoctrineMigrations\\Version20260219165830', '2026-02-19 16:58:38', 522),
('DoctrineMigrations\\Version20260219172740', '2026-02-19 17:27:46', 100),
('DoctrineMigrations\\Version20260219173101', '2026-02-19 17:31:06', 219),
('DoctrineMigrations\\Version20260219175016', '2026-02-19 17:50:26', 59),
('DoctrineMigrations\\Version20260220095306', '2026-02-20 09:53:18', 294),
('DoctrineMigrations\\Version20260220213928', '2026-02-20 21:39:46', 109);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `nationalite` varchar(255) NOT NULL,
  `activite` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `champs_action` varchar(255) NOT NULL,
  `statut_id` int NOT NULL,
  `taille_id` int NOT NULL,
  `secteur_activite_id` int NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `nom`, `nationalite`, `activite`, `type`, `champs_action`, `statut_id`, `taille_id`, `secteur_activite_id`, `user_id`) VALUES
(1, 'Connexion by Phoenix', 'Française', 'Création de licence et prestation de service.', 'entreprise', 'Mondiale', 5, 1, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `experience`
--

CREATE TABLE `experience` (
  `id` int NOT NULL,
  `nom_poste` varchar(255) NOT NULL,
  `nom_entreprise` varchar(255) NOT NULL,
  `date_debut` datetime DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL,
  `adresse` varchar(255) NOT NULL,
  `cp` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `type_emploie_id` int NOT NULL,
  `demandeur_emploie_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `finalite`
--

CREATE TABLE `finalite` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `entreprise_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `id` int NOT NULL,
  `nom_ecole` varchar(255) NOT NULL,
  `diplome` varchar(255) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `cp` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `demandeur_emploie_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE `lieu` (
  `id` int NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `cp` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `type_lieu_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `contenue` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `collaboration_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `offre_emploie`
--

CREATE TABLE `offre_emploie` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `mission` varchar(255) NOT NULL,
  `profil_rechercher` varchar(255) NOT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL,
  `type_emploie_id` int DEFAULT NULL,
  `entreprise_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `proposition_banque`
--

CREATE TABLE `proposition_banque` (
  `id` int NOT NULL,
  `date` datetime NOT NULL,
  `collaboration_id` int NOT NULL,
  `banque_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `rencontre`
--

CREATE TABLE `rencontre` (
  `id` int NOT NULL,
  `date` datetime NOT NULL,
  `collaboration_id` int NOT NULL,
  `lieu_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `ressource`
--

CREATE TABLE `ressource` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `entreprise_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

CREATE TABLE `secteur` (
  `id` int NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `entreprise_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `secteur_activite`
--

CREATE TABLE `secteur_activite` (
  `id` int NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `secteur_activite`
--

INSERT INTO `secteur_activite` (`id`, `libelle`) VALUES
(1, 'Primaire'),
(2, 'Secondaire'),
(3, 'Tertiaire');

-- --------------------------------------------------------

--
-- Structure de la table `statut_entreprise`
--

CREATE TABLE `statut_entreprise` (
  `id` int NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `statut_entreprise`
--

INSERT INTO `statut_entreprise` (`id`, `libelle`) VALUES
(1, 'Entrepreneur individuel (EI)'),
(2, 'Entreprise unipersonnelle à responsabilité limitée (EURL)'),
(3, 'Société à responsabilité limitée (SARL)'),
(4, 'Société par actions simplifiée unipersonnelle (SASU)'),
(5, 'Société par actions simplifiée (SAS)'),
(6, 'Société anonyme (SA)'),
(7, 'Société en nom collectif (SNC)'),
(8, 'Société en commandite simple (SCS)'),
(9, 'Société en commandite par actions (SCA)');

-- --------------------------------------------------------

--
-- Structure de la table `taille_entreprise`
--

CREATE TABLE `taille_entreprise` (
  `id` int NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `taille_entreprise`
--

INSERT INTO `taille_entreprise` (`id`, `libelle`) VALUES
(1, 'TPE'),
(2, 'PME'),
(3, 'ETI'),
(4, 'GE');

-- --------------------------------------------------------

--
-- Structure de la table `tarif`
--

CREATE TABLE `tarif` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tarif`
--

INSERT INTO `tarif` (`id`, `nom`, `description`, `prix`) VALUES
(1, 'Offre Demandeurs d\'emploi', 'C\'est gratuit', 0),
(2, 'Offre standard', '30 nouveaux contacts mensuels', 100),
(3, 'Offre pro', '100 nouveaux contacts mensuels', 300),
(4, 'Offre admin', 'Pas à payer', 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_emploie`
--

CREATE TABLE `type_emploie` (
  `id` int NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `type_lieu`
--

CREATE TABLE `type_lieu` (
  `id` int NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `tarif_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `roles`, `password`, `username`, `tarif_id`) VALUES
(1, 'admin@admin.com', '[\"ROLE_ADMIN\"]', '$2y$13$y2x79627PlAIeRHbOU/lXe6SKEc7RxtgtrS.L2UoP.auUGoeakhvG', 'Admin', 4),
(2, 'entrepreneur@entreprise.com', '[\"ROLE_ENTREPRISE\"]', '$2y$13$3CD0SQTUqf8mkBQlM8Ysp.K2gS5l3EAxiIZ1/bbKtHsmRzUtNorE2', 'Entrepreneur', 2),
(3, 'user@user.com', '[\"ROLE_DEMANDEUR\"]', '$2y$13$G/eN3qmZXdEBZ1mVOwbVY.2GUaMxIqt/N29PwTe4IVy/Ke7CDtOMe', 'User', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appel`
--
ALTER TABLE `appel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_130D3BDEF1544CE` (`collaboration_id`);

--
-- Index pour la table `banque`
--
ALTER TABLE `banque`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `collaboration`
--
ALTER TABLE `collaboration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DA3AE3239617885A` (`entreprise1_id`),
  ADD KEY `IDX_DA3AE32384A227B4` (`entreprise2_id`);

--
-- Index pour la table `competence`
--
ALTER TABLE `competence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `demandeur_competence`
--
ALTER TABLE `demandeur_competence`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F1544F464D6E229` (`demandeur_emploie_id`),
  ADD KEY `IDX_F1544F4615761DAB` (`competence_id`);

--
-- Index pour la table `demandeur_emploie`
--
ALTER TABLE `demandeur_emploie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B6A369CDA76ED395` (`user_id`);

--
-- Index pour la table `demande_offre`
--
ALTER TABLE `demande_offre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_595805464D6E229` (`demandeur_emploie_id`),
  ADD KEY `IDX_595805464C08A235` (`offre_emploie_id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D19FA60A76ED395` (`user_id`),
  ADD KEY `IDX_D19FA60F6203804` (`statut_id`),
  ADD KEY `IDX_D19FA60FF25611A` (`taille_id`),
  ADD KEY `IDX_D19FA605233A7FC` (`secteur_activite_id`);

--
-- Index pour la table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_590C1037C551335` (`type_emploie_id`),
  ADD KEY `IDX_590C1034D6E229` (`demandeur_emploie_id`);

--
-- Index pour la table `finalite`
--
ALTER TABLE `finalite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BB59DE85A4AEAFEA` (`entreprise_id`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_404021BF4D6E229` (`demandeur_emploie_id`);

--
-- Index pour la table `lieu`
--
ALTER TABLE `lieu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2F577D5942937C39` (`type_lieu_id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B6BD307FEF1544CE` (`collaboration_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750` (`queue_name`,`available_at`,`delivered_at`,`id`);

--
-- Index pour la table `offre_emploie`
--
ALTER TABLE `offre_emploie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1E1DB2C87C551335` (`type_emploie_id`),
  ADD KEY `IDX_1E1DB2C8A4AEAFEA` (`entreprise_id`);

--
-- Index pour la table `proposition_banque`
--
ALTER TABLE `proposition_banque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_379B495AEF1544CE` (`collaboration_id`),
  ADD KEY `IDX_379B495A37E080D9` (`banque_id`);

--
-- Index pour la table `rencontre`
--
ALTER TABLE `rencontre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_460C35EDEF1544CE` (`collaboration_id`),
  ADD KEY `IDX_460C35ED6AB213CC` (`lieu_id`);

--
-- Index pour la table `ressource`
--
ALTER TABLE `ressource`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_939F4544A4AEAFEA` (`entreprise_id`);

--
-- Index pour la table `secteur`
--
ALTER TABLE `secteur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8045251FA4AEAFEA` (`entreprise_id`);

--
-- Index pour la table `secteur_activite`
--
ALTER TABLE `secteur_activite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `statut_entreprise`
--
ALTER TABLE `statut_entreprise`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `taille_entreprise`
--
ALTER TABLE `taille_entreprise`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_emploie`
--
ALTER TABLE `type_emploie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_lieu`
--
ALTER TABLE `type_lieu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`),
  ADD KEY `IDX_1483A5E9357C0A59` (`tarif_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appel`
--
ALTER TABLE `appel`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `banque`
--
ALTER TABLE `banque`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `collaboration`
--
ALTER TABLE `collaboration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `competence`
--
ALTER TABLE `competence`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demandeur_competence`
--
ALTER TABLE `demandeur_competence`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demandeur_emploie`
--
ALTER TABLE `demandeur_emploie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demande_offre`
--
ALTER TABLE `demande_offre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `experience`
--
ALTER TABLE `experience`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `finalite`
--
ALTER TABLE `finalite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lieu`
--
ALTER TABLE `lieu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `offre_emploie`
--
ALTER TABLE `offre_emploie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `proposition_banque`
--
ALTER TABLE `proposition_banque`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rencontre`
--
ALTER TABLE `rencontre`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ressource`
--
ALTER TABLE `ressource`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `secteur`
--
ALTER TABLE `secteur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `secteur_activite`
--
ALTER TABLE `secteur_activite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `statut_entreprise`
--
ALTER TABLE `statut_entreprise`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `taille_entreprise`
--
ALTER TABLE `taille_entreprise`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_emploie`
--
ALTER TABLE `type_emploie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_lieu`
--
ALTER TABLE `type_lieu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appel`
--
ALTER TABLE `appel`
  ADD CONSTRAINT `FK_130D3BDEF1544CE` FOREIGN KEY (`collaboration_id`) REFERENCES `collaboration` (`id`);

--
-- Contraintes pour la table `collaboration`
--
ALTER TABLE `collaboration`
  ADD CONSTRAINT `FK_DA3AE32384A227B4` FOREIGN KEY (`entreprise2_id`) REFERENCES `entreprise` (`id`),
  ADD CONSTRAINT `FK_DA3AE3239617885A` FOREIGN KEY (`entreprise1_id`) REFERENCES `entreprise` (`id`);

--
-- Contraintes pour la table `demandeur_competence`
--
ALTER TABLE `demandeur_competence`
  ADD CONSTRAINT `FK_F1544F4615761DAB` FOREIGN KEY (`competence_id`) REFERENCES `competence` (`id`),
  ADD CONSTRAINT `FK_F1544F464D6E229` FOREIGN KEY (`demandeur_emploie_id`) REFERENCES `demandeur_emploie` (`id`);

--
-- Contraintes pour la table `demandeur_emploie`
--
ALTER TABLE `demandeur_emploie`
  ADD CONSTRAINT `FK_B6A369CDA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `demande_offre`
--
ALTER TABLE `demande_offre`
  ADD CONSTRAINT `FK_595805464C08A235` FOREIGN KEY (`offre_emploie_id`) REFERENCES `offre_emploie` (`id`),
  ADD CONSTRAINT `FK_595805464D6E229` FOREIGN KEY (`demandeur_emploie_id`) REFERENCES `demandeur_emploie` (`id`);

--
-- Contraintes pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD CONSTRAINT `FK_D19FA605233A7FC` FOREIGN KEY (`secteur_activite_id`) REFERENCES `secteur_activite` (`id`),
  ADD CONSTRAINT `FK_D19FA60A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_D19FA60F6203804` FOREIGN KEY (`statut_id`) REFERENCES `statut_entreprise` (`id`),
  ADD CONSTRAINT `FK_D19FA60FF25611A` FOREIGN KEY (`taille_id`) REFERENCES `taille_entreprise` (`id`);

--
-- Contraintes pour la table `experience`
--
ALTER TABLE `experience`
  ADD CONSTRAINT `FK_590C1034D6E229` FOREIGN KEY (`demandeur_emploie_id`) REFERENCES `demandeur_emploie` (`id`),
  ADD CONSTRAINT `FK_590C1037C551335` FOREIGN KEY (`type_emploie_id`) REFERENCES `type_emploie` (`id`);

--
-- Contraintes pour la table `finalite`
--
ALTER TABLE `finalite`
  ADD CONSTRAINT `FK_BB59DE85A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`);

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `FK_404021BF4D6E229` FOREIGN KEY (`demandeur_emploie_id`) REFERENCES `demandeur_emploie` (`id`);

--
-- Contraintes pour la table `lieu`
--
ALTER TABLE `lieu`
  ADD CONSTRAINT `FK_2F577D5942937C39` FOREIGN KEY (`type_lieu_id`) REFERENCES `type_lieu` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_B6BD307FEF1544CE` FOREIGN KEY (`collaboration_id`) REFERENCES `collaboration` (`id`);

--
-- Contraintes pour la table `offre_emploie`
--
ALTER TABLE `offre_emploie`
  ADD CONSTRAINT `FK_1E1DB2C87C551335` FOREIGN KEY (`type_emploie_id`) REFERENCES `type_emploie` (`id`),
  ADD CONSTRAINT `FK_1E1DB2C8A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`);

--
-- Contraintes pour la table `proposition_banque`
--
ALTER TABLE `proposition_banque`
  ADD CONSTRAINT `FK_379B495A37E080D9` FOREIGN KEY (`banque_id`) REFERENCES `banque` (`id`),
  ADD CONSTRAINT `FK_379B495AEF1544CE` FOREIGN KEY (`collaboration_id`) REFERENCES `collaboration` (`id`);

--
-- Contraintes pour la table `rencontre`
--
ALTER TABLE `rencontre`
  ADD CONSTRAINT `FK_460C35ED6AB213CC` FOREIGN KEY (`lieu_id`) REFERENCES `lieu` (`id`),
  ADD CONSTRAINT `FK_460C35EDEF1544CE` FOREIGN KEY (`collaboration_id`) REFERENCES `collaboration` (`id`);

--
-- Contraintes pour la table `ressource`
--
ALTER TABLE `ressource`
  ADD CONSTRAINT `FK_939F4544A4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`);

--
-- Contraintes pour la table `secteur`
--
ALTER TABLE `secteur`
  ADD CONSTRAINT `FK_8045251FA4AEAFEA` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprise` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_1483A5E9357C0A59` FOREIGN KEY (`tarif_id`) REFERENCES `tarif` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
