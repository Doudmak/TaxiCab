<?php 
    require_once 'config.php'; // On inclu la connexion à la bdd
    
    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST['nomChauffeur']) && !empty($_POST['prenomChauffeur']) && !empty($_POST['numPermis']) && !empty($_POST['dateObtentionPermis']) && !empty($_POST['adresseChauffeur'])  && !empty($_POST['numeroImmatriculation']) && !empty($_POST['villeChauffeur']) && !empty($_POST['cpChauffeur']) && !empty($_POST['mailChauffeur'])&& !empty($_POST['mdpChauffeur'])) {
        // Patch XSS
        $nom = htmlspecialchars($_POST['nomChauffeur']);
        $prenom = htmlspecialchars($_POST['prenomChauffeur']);
        $numPermis = htmlspecialchars($_POST['numPermis']);
        $dateObt = htmlspecialchars($_POST['dateObtentionPermis']);
        $adresse= htmlspecialchars($_POST['adresseChauffeur']);
        $numImmat = htmlspecialchars($_POST['numeroImmatriculation']);
        $ville = htmlspecialchars($_POST['villeChauffeur']);
        $cp = htmlspecialchars($_POST['cpChauffeur']);
        $mail = htmlspecialchars($_POST['mailChauffeur']);
        $mdp = htmlspecialchars($_POST['mdpChauffeur']);
        $vehicule = htmlspecialchars($_POST['vehicule']);
        $mdp = hash('sha256',$mdp);
    

        // On vérifie si l'utilisateur existe
        $check = $bdd->prepare('SELECT nom, prenom, numPermis, dateObtention, adresse, numImmat, ville, codeP, mdp, mail FROM conducteur WHERE mail = ?');
        $check->execute(array($mail));
        $data = $check->fetch();
        $row = $check->rowCount();

        $mail = strtolower($mail); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents ..
        // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
        if($row == 0){ 
            if(strlen($nom) <= 100){ // On verifie que la longueur du nom <= 100
                if(strlen($prenom) <= 100){
                    if(strlen($adresse) <= 100){
                        if(strlen($dateObt) <= 100){
                            if(strlen($ville) <= 100){
                                if(strlen($mail) <= 100){
                                    if(strlen($mdp) <= 100){ // On verifie que la longueur du mail <= 100
                                      // On insère dans la base de données
                                        $insert = $bdd->prepare('INSERT INTO conducteur(nom, prenom, numPermis, dateObtention, adresse, numImmat, ville, codeP, mdp, mail, duree, nb_trajet, vehicule) VALUES(:nom, :prenom, :numPermis, :dateObt, :adress, :numImmat, :ville, :cp, :mdp, :mail, 0, 0, :vehicule)');
                                        $insert->execute(array(
                                            'nom' => $nom,
                                            'prenom' => $prenom,
                                            'numPermis' => $numPermis,
                                            'dateObt' => $dateObt,
                                            'adress' => $adresse,
                                            'numImmat' => $numImmat,
                                            'ville' => $ville,
                                            'cp' => $cp,
                                            'mail' => $mail,
                                            'mdp' => $mdp,
                                            'vehicule' => $vehicule,
                                        ));
                                        // On redirige avec le message de succès
                                        header('Location:chauffeurMain2.php?reg_err=success');
                                        die();
                                    } else { header('Location: chauffeurMain2.php?reg_err=mdp'); die();}
                                } else { header('Location: chauffeurMain2.php?reg_err=mail'); die();}
                            } else { header('Location: chauffeurMain2.php?reg_err=ville'); die();}
                        } else { header('Location: chauffeurMain2.php?reg_err=dateObt'); die();}
                    } else { header('Location: chauffeurMain2.php?reg_err=adresse'); die();}
                }  else { header('Location: chauffeurMain2.php?reg_err=prenom'); die();} 
            }else { header('Location: chauffeurMain2.php?reg_err=nom'); die();}
        } else { header('Location: chauffeurMain2.php?reg_err=exist'); die();}
    } else { header('Location: chauffeurMain2.php?reg_err=champs_incomplets'); die();}
?> 