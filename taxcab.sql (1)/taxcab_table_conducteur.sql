
-- --------------------------------------------------------

--
-- Structure de la table `conducteur`
--

DROP TABLE IF EXISTS `conducteur`;
CREATE TABLE IF NOT EXISTS `conducteur` (
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `vehicule` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `numPermis` int NOT NULL,
  `dateObtention` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `numImmat` int NOT NULL,
  `ville` varchar(100) NOT NULL,
  `codeP` int NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `duree` int NOT NULL DEFAULT '0',
  `nb_trajet` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `conducteur`
--

INSERT INTO `conducteur` (`nom`, `prenom`, `vehicule`, `mail`, `numPermis`, `dateObtention`, `adresse`, `numImmat`, `ville`, `codeP`, `mdp`, `duree`, `nb_trajet`) VALUES
('Sieys', 'Jean', 'Toyota Prius', 'jean.sieys@gmail.com', 8766789, '987654', '7 rue des lilas', 987654, 'fayet', 12000, 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0, 0),
('Martin', 'Garix', 'Mercedes GLA', 'martin.garix@gmail.com', 2147483647, '12/09/2004', 'Rue du mixage', 0, 'Le Turn up', 67890, 'afecc68639e597c91e26e29561acf505f05784f7102aba2b893dced5e66b28da', 0, 0),
('Rachelle', 'Hakimi', 'Renault Clio', 'rachelle.hakimi@gmail.com', 2147483647, '19/02/1999', '6 rue des lys', 0, 'La courneuve', 75019, 'afecc68639e597c91e26e29561acf505f05784f7102aba2b893dced5e66b28da', 0, 0),
('Sieys', 'Ulric', 'Audi RS6', 'ulric.sieys@gmail.com', 876545678, '18.02/290', '5 allée du square', 876789, 'Le Perreux sur Marne', 94170, '99e18ad5f74dfcedaa4978253993bcdbf9187ee4bf1321d94109c67097f9be26', 0, 0),
('Zizou', 'Zinedine', 'Mercedes Maybach', 'zizou@gmail.com', 5678765, '567890', 'Rue de la coupe du monde', 987654, 'Aller les bleus', 75000, '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 0, 0);
