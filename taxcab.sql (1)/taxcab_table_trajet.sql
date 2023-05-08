
-- --------------------------------------------------------

--
-- Structure de la table `trajet`
--

DROP TABLE IF EXISTS `trajet`;
CREATE TABLE IF NOT EXISTS `trajet` (
  `adressedep` varchar(100) NOT NULL,
  `villedep` varchar(100) NOT NULL,
  `codepdep` int NOT NULL,
  `adressearr` varchar(100) NOT NULL,
  `villear` varchar(100) NOT NULL,
  `codeparr` varchar(100) NOT NULL,
  `prix` int NOT NULL,
  `num_trajet` int NOT NULL AUTO_INCREMENT,
  `mail` varchar(100) DEFAULT NULL,
  `km` int DEFAULT NULL,
  PRIMARY KEY (`num_trajet`),
  KEY `fk_mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `trajet`
--

INSERT INTO `trajet` (`adressedep`, `villedep`, `codepdep`, `adressearr`, `villear`, `codeparr`, `prix`, `num_trajet`, `mail`, `km`) VALUES
('Allée du Jura', 'Sevran', 93270, 'Chemin du Marais du Souci', 'Sevran', '93270', 0, 1, 'yanis.mkd@gmail.com', 0),
('Allée du Jura', 'Sevran', 93270, 'Chemin du Marais du Souci', 'Sevran', '93270', 0, 2, 'yanis.mkd@gmail.com', 0),
('Allée du Jura', 'Sevran', 93270, 'Chemin du Marais du Souci', 'Sevran', '93270', 0, 3, 'yanis.mkd@gmail.com', 0),
('Allée du Jura', 'Sevran', 93270, 'Chemin du Marais du Souci', 'Sevran', '93270', 11, 4, 'yanis.mkd@gmail.com', 4),
('Allée du Jura', 'Sevran', 93270, 'Chemin du Marais du Souci', 'Sevran', '93270', 0, 5, 'yanis.mkd@gmail.com', 0),
('Allée du Jura', 'Sevran', 93270, 'Chemin du Marais du Souci', 'Sevran', '93270', 0, 6, 'yanis.mkd@gmail.com', 0),
('Allée du Jura', 'Sevran', 93270, 'Chemin du Marais du Souci', 'Sevran', '93270', 0, 7, 'yanis.mkd@gmail.com', 0),
('Allée du Jura', 'Sevran', 93270, 'Chemin du Marais du Souci', 'Sevran', '93270', 0, 8, 'yanis.mkd@gmail.com', 0),
('Allée du Jura', 'Sevran', 93270, 'Chemin du Marais du Souci', 'Sevran', '93270', 0, 9, 'yanis.mkd@gmail.com', 0),
('Allée du Jura', 'Sevran', 93270, 'Chemin du Marais du Souci', 'Sevran', '93270', 0, 10, 'yanis.mkd@gmail.com', 0),
('Allée du Jura', 'Sevran', 93270, 'Chemin du Marais du Souci', 'Sevran', '93270', 0, 11, 'yanis.mkd@gmail.com', 0),
('Allée du Jura', 'Sevran', 93270, 'Chemin du Marais du Souci', 'Sevran', '93270', 0, 12, 'yanis.mkd@gmail.com', 0),
('Allée du Jura', 'Sevran', 93270, 'Chemin du Marais du Souci', 'Sevran', '93270', 0, 13, 'yanis.mkd@gmail.com', 0),
('Allée du Jura', 'Sevran', 93270, 'Chemin du Marais du Souci', 'Sevran', '93270', 0, 14, 'yanis.mkd@gmail.com', 0),
('Rue de Lannoy', 'Roubaix', 59100, 'allée du jura', 'Sevran', '93270', 0, 15, 'yanis.mkd@gmail.com', 0),
('Allée du Jura', 'Auxerre', 89000, 'Allée du Jura', 'Sevran', '93270', 0, 16, 'yanis.mkd@gmail.com', 0),
('Allée du Jura', 'Auxerre', 89000, 'Allée du Jura', 'Sevran', '93270', 0, 17, 'yanis.mkd@gmail.com', 0),
('Allée du Jura', 'Sevran', 93270, 'Allée du jura', 'Auxerre', '81000', 0, 18, 'yanis.mkd@gmail.com', 0),
('Allée du jura', 'Sevran', 93270, 'Allée du Bocage', 'Pau', '64000', 0, 19, 'yanis.mkd@gmail.com', 0),
('Allée du jura', 'Sevran', 93270, 'Allée du Bocage', 'Pau', '64000', 0, 20, 'yanis.mkd@gmail.com', 0),
('Allée du jura', 'Sevran', 93270, 'Allée du Bocage', 'Pau', '64000', 2979, 21, 'yanis.mkd@gmail.com', 805),
('Allée du jura', 'Sevran', 93270, 'Allée du Bocage', 'Pau', '64000', 2979, 22, 'yanis.mkd@gmail.com', 805),
('Allée du jura', 'Sevran', 93270, 'Allée du Bocage', 'Pau', '64000', 0, 23, 'yanis.mkd@gmail.com', 0),
('Allée du jura', 'Sevran', 93270, 'Allée du Bocage', 'Pau', '64000', 0, 24, 'yanis.mkd@gmail.com', 0),
('allée du jure', 'sevran', 93270, 'Chemin du marais du souci', 'Sevran', '93270', 0, 25, 'yanis.mkd@gmail.com', 0),
('allée du jure', 'sevran', 93270, 'Chemin du marais du souci', 'Sevran', '93270', 0, 26, 'yanis.mkd@gmail.com', 0),
('allée du jure', 'sevran', 93270, 'Chemin du marais du souci', 'Sevran', '93270', 0, 27, 'yanis.mkd@gmail.com', 0),
('allée du jure', 'sevran', 93270, 'Chemin du marais du souci', 'Sevran', '93270', 0, 28, 'yanis.mkd@gmail.com', 0),
('allée du jure', 'sevran', 93270, 'Chemin du marais du souci', 'Sevran', '93270', 0, 29, 'yanis.mkd@gmail.com', 0);
