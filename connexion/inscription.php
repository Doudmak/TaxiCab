<?php 
    require_once 'config.php'; // On inclu la connexion à la bdd
    
    // Si les variables existent et qu'elles ne sont pas vides
    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['adresse']) && isset($_POST['ville']) && isset($_POST['cp'])  && isset($_POST['mail']) && isset($_POST['mdp'])) {
        // Patch XSS
        echo(30);

        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $ville = htmlspecialchars($_POST['ville']);
        $adresse = htmlspecialchars($_POST['adresse']);
        $cp= htmlspecialchars($_POST['cp']);
        $mail = htmlspecialchars($_POST['mail']);
        $mdp = htmlspecialchars($_POST['mdp']);
        echo(31);

        // On vérifie si l'utilisateur existe
        $check = $bdd->prepare('SELECT nom, prenom, adresse, ville, codePostal, mail, mdp FROM user WHERE mail = ?');
        $check->execute(array($mail));
        $data = $check->fetch();
        $row = $check->rowCount();

        $mail = strtolower($mail); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents ..
        
        // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
        if($row == 0){ 
            if(strlen($nom) <= 100){ // On verifie que la longueur du nom <= 100
                if(strlen($prenom) <= 100){
                    if(strlen($adresse) <= 100){
                        if(strlen($ville) <= 100){
                            if(strlen($mail) <= 100){
                                if(strlen($mdp) <= 100){ // On verifie que la longueur du mail <= 100
                                    // On insère dans la base de données
                                    $insert = $bdd->prepare('INSERT INTO user(nom, prenom, adresse, ville, codePostal, mail, mdp) VALUES(:nom, :prenom, :adresse, :ville, :cp, :mail, :mdp)');
                                    $insert->execute(array(
                                        'nom' => $nom,
                                        'prenom' => $prenom,
                                        'adresse' => $adresse,
                                        'ville' => $ville,
                                        'cp' => $cp,
                                        'mail' => $mail,
                                        'mdp' => $mdp,
                                    ));
                                    // On redirige avec le message de succès
                                    header('Location:connexion2.html?reg_err=success');
                                    die();
                                } else { header('Location: connexion2.html?reg_err=ville'); die();}
                            } else { header('Location: connexion2.html?reg_err=prenom'); die();}
                        } else { header('Location: connexion2.html?reg_err=prenom_length'); die();}
                    } else { header('Location: connexion2.html?reg_err=nom_length'); die();}
                } else { header('Location: connexion2.html?reg_err=already'); die();}
            }
        }  
    }
?> 