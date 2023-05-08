
-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `codePostal` int NOT NULL,
  `mail` varchar(100) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  PRIMARY KEY (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`nom`, `prenom`, `adresse`, `ville`, `codePostal`, `mail`, `mdp`) VALUES
('Zizou', 'Zinedine', 'Rue de la coupe du monde', 'Aller les bleus', 75000, '', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855'),
('adrien', 'delacroix', 'rue du phare', 'paris', 75000, 'adrien.delacroix@gmail.com', '16ee55b1fa7029f512489520eb0beb0eaf0b8469c209d022bb0006f04d0beb6d'),
('Pitt', 'Brad', '31 allée du plus beau', 'Broadway', 56789, 'brad.pitt@star.com', 'bradinou'),
('hola', 'QUETAL', 'rUE DE LA MARNE', 'le perreux', 94170, 'cocou@gmail.com', 'bonjour'),
('Vers', 'Matteo', '128 Avenue Paul Doumer', 'Villeneuve le roi', 94290, 'ihjvihv@gamail.com', 'coucou'),
('El Haddaji', 'Lina', '3 rue des Hiboux', 'Créteil', 94000, 'linalpb@gmail.com', '9d8d7dcb8f6d4d71ffc8277e4a8a4326c93da239cace375d47c4a35830b3e88b'),
('Vers', 'Matteo', '128 Avenue Paul Doumer', 'Villeneuve le roi', 94290, 'mathsyck@gmail.com', 'matteo1609'),
('Pipard', 'Eric', 'youyou', 'IAE', 8765, 'pipard@gmail.com', 'af3e5217c5352b32114ad3c7ea08ce5f91f95e9cb7f09220a239ed8095059de5'),
('SRIJ', 'SALMA', 'RUE DE TA MERE', 'UNE VILLE', 90000, 'ss@gmail.com', 'DIIZJEIDDJ84843030?'),
('Ulric', 'Sieys', '5 allée du square', 'Le Perreux sur Marne', 94170, 'ulric.sieys@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4'),
('Yanis', 'Makdoud', 'Rue de l\'AK47', 'Sevran', 93270, 'yanis.mkd@gmail.com', 'b6301935b19c9440a490ecd64ef2da7a9894fca80f9b00ae8ea714f0ae44019c'),
('Zizou', 'Zinedine', 'Rue de la coupe du monde', 'Aller les bleus', 75000, 'zizou.son.gros.crane@gmail.com', '1816c03d2ba7f6df08c4a98e0e9301724fcc23e9177416304227a125301ebc8c');
