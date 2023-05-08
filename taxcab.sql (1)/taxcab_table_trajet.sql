
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `trajet`
--

INSERT INTO `trajet` (`adressedep`, `villedep`, `codepdep`, `adressearr`, `villear`, `codeparr`, `prix`, `num_trajet`, `mail`, `km`) VALUES
('5 allée du square', 'Le Perreux sur marne', 94170, '7 rue de la seine', 'Orly', '94500', 17, 1, 'ulric.sieys@gmail.com', 8),
('7 rue des lilas', 'La Courneuve', 93000, '18 rue du général leclerc', 'Noisy-le-sec', '93700', 24, 2, 'ulric.sieys@gmail.com', 22),
('8 allée de la marne', 'Nogent sur Marne', 94120, '18 rue du général de gaulle', 'Le Perreux sur Marne', '94170', 12, 3, 'ulric.sieys@gmail.com', 5),
('8 route des sans culottes', 'Le Raincy', 94000, '8 avenue des choux', 'Villiers-sur-Marne', '93700', 24, 4, 'yanis.mkd@gmail.com', 13),
('56 rue de 11 juillet 1789', 'Livry', 93500, '8 avenue des carottes', 'Livry', '93500', 14, 5, 'yanis.mkd@gmail.com', 2),
('78 avenue des lapins', 'Sevran', 94270, '90 rue de la bergerie', 'Ile aux loups', '94180', 38, 6, 'yanis.mkd@gmail.com', 17),
('70 rue de genral de gaulle matinale', 'Herblay et loire', 63890, 'Lip balm', 'Marseille', '13000', 40, 7, 'yanis.mkd@gmail.com', 5),
('Place du theron', 'Fayet', 12300, 'Place de la pétanque', 'Camares', '12360', 30, 8, 'ulric.sieys@gmail.com', 14);
