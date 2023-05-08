
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD CONSTRAINT `fk_mail` FOREIGN KEY (`mail`) REFERENCES `user` (`mail`);
