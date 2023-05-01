<?php 
    require_once 'config.php';   // On inclut la connexion à la base de données

    if(!empty($_POST['mailco']) && !empty($_POST['mdpco'])) // Si il existe les champs email, password et qu'il sont pas vident
    {
        // Patch XSS
        $email = htmlspecialchars($_POST['mailco']); 
        $password = htmlspecialchars($_POST['mdpco']);
        
        $email = strtolower($email); // email transformé en minuscule
        
        //On regarde si l'utilisateur est inscrit dans la table utilisateurs
        $check = $bdd->prepare('SELECT * FROM user WHERE mail = ?');
        $check->execute(array($email)); 
        $data = $check->fetch();
        $row = $check->rowCount();

        //On compte le nombre de trajets
        $check2 = $bdd->prepare("SELECT * FROM trajet WHERE mail = '$email'");
        $check2->execute(array()); 
        $data2 = $check2->fetch();
        $row2 = $check2->rowCount();

        $sql = "SELECT SUM(prix) AS total FROM trajet WHERE mail = ?";
        $stmt = $bdd->prepare($sql);
        $stmt->execute([$email]);

        // Récupération du résultat et affichage de la somme des prix
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        $total = $res['total'];

        $sql2 = "SELECT SUM(km) as totalk FROM trajet WHERE mail = ?";
        $stmt2 = $bdd->prepare($sql2);
        $stmt2->execute([$email]);

        // Récupération du résultat et affichage de la somme des prix
        $res2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $total2 = $res2['totalk'];



        // Requête SQL pour récupérer le maximum de la colonne 'valeur' de la table 'ma_table'
        $sql3 = "SELECT MAX(num_trajet) AS max_valeu FROM trajet where mail = ?";
        $stmt2 = $bdd->prepare($sql3);
        $stmt2->execute([$email]);
        $res2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $max_valeur = $res2['max_valeu'];
        

        if($max_valeur > 3) {
            $nb_max_traj = 3;
        } else {
            $nb_max_traj = $max_valeur;
        }
        
        $tabadressedep = array();
        $tabadressearr = array();
        $tabcpdep = array();
        $tabcparr = array();
        $tabvilledep = array();
        $tabvillearr = array();
        $tabprix = array();

        $tmp = 0;
        $tmp2 = $max_valeur;
        while($tmp != $nb_max_traj) {
                $sql4 = "SELECT mail as mail FROM trajet where num_trajet = '$tmp2'";
                $resultat = $bdd->query($sql4);
                $donnees = $resultat->fetch();
                $mail_res = $donnees['mail'];
                if($mail_res == $email) {
                    $sql4 = "SELECT adressedep as adressedep FROM trajet where num_trajet = '$tmp2'";
                    $resultat = $bdd->query($sql4);
                    $donnees = $resultat->fetch();
                    $adressedep = $donnees['adressedep'];
                    $tabadressedep[$tmp] = $adressedep;

                    $sql4 = "SELECT villedep as adressedep FROM trajet where num_trajet = '$tmp2'";
                    $resultat = $bdd->query($sql4);
                    $donnees = $resultat->fetch();
                    $adressedep = $donnees['adressedep'];
                    $tabvilledep[$tmp] = $adressedep;

                    $sql4 = "SELECT codepdep as adressedep FROM trajet where num_trajet = '$tmp2'";
                    $resultat = $bdd->query($sql4);
                    $donnees = $resultat->fetch();
                    $adressedep = $donnees['adressedep'];
                    $tabcpdep[$tmp] = $adressedep;

                    $sql4 = "SELECT adressearr as adressedep FROM trajet where num_trajet = '$tmp2'";
                    $resultat = $bdd->query($sql4);
                    $donnees = $resultat->fetch();
                    $adressedep = $donnees['adressedep'];
                    $tabadressearr[$tmp] = $adressedep;

                    $sql4 = "SELECT codeparr as adressedep FROM trajet where num_trajet = '$tmp2'";
                    $resultat = $bdd->query($sql4);
                    $donnees = $resultat->fetch();
                    $adressedep = $donnees['adressedep'];
                    $tabcparr[$tmp] = $adressedep;

                    $sql4 = "SELECT villear as adressedep FROM trajet where num_trajet = '$tmp2'";
                    $resultat = $bdd->query($sql4);
                    $donnees = $resultat->fetch();
                    $adressedep = $donnees['adressedep'];
                    $tabvillearr[$tmp] = $adressedep;

                    $sql4 = "SELECT prix as adressedep FROM trajet where num_trajet = '$tmp2'";
                    $resultat = $bdd->query($sql4);
                    $donnees = $resultat->fetch();
                    $adressedep = $donnees['adressedep'];
                    $tabprix[$tmp] = $adressedep;
                    
                    $tmp++;                
            }
            $tmp2--;
            
        }
        

        // Si > à 0 alors l'utilisateur existe
        if($row > 0){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $password = hash('sha256', $password);
                if($data['mdp'] === $password) {
                    session_start(); // Démarrage de la session
                        $_SESSION['user'] = [
                        "mail" => $data['mail'],
                        "nom" => $data['nom'],
                        "prenom" => $data['prenom'],
                        "adresse" => $data['adresse'],
                        "codePostal" => $data['codePostal'],
                        "ville" => $data["ville"],
                        "nb_trajets" => $row2,
                        "total" => (int)$total,
                        "km" => (int)$total2];
                        if(isset($tabadressedep[0])){ 
                        $_SESSION['user'] += [
                        "adressedep1" => $tabadressedep[0],
                        "adressearr1" => $tabadressearr[0],
                        "villedep1" => $tabvilledep[0],
                        "villearr1" => $tabvillearr[0],
                        "codepdep1" => $tabcpdep[0],
                        "codeparr1" => $tabcparr[0],
                        "prix1" => $tabprix[0]];
                        }
                        if(isset($tabadressedep[1])){ 
                        $_SESSION['user'] += [
                        "adressedep2" => $tabadressedep[1],
                        "adressearr2" => $tabadressearr[1],
                        "villedep2" => $tabvilledep[1],
                        "villearr2" => $tabvillearr[1],
                        "codepdep2" => $tabcpdep[1],
                        "codeparr2" => $tabcparr[1],
                        "prix2" => $tabprix[1]];
                        }
                        if(isset($tabadressedep[2])){ 
                        $_SESSION['user'] += [
                        "adressedep3" => $tabadressedep[2],
                        "adressearr3" => $tabadressearr[2],
                        "villedep3" => $tabvilledep[2],
                        "villearr3" => $tabvillearr[2],
                        "codepdep3" => $tabcpdep[2],
                        "codeparr3" => $tabcparr[2],
                        "prix3" => $tabprix[2]];
                        }
                        
                    
                    header('Location:../index.php?login_err=success');
                }else{ 
                    header('Location: connexionMain.php?login_err=password'); die(); }
            } else {
                header('Location:connexionMain.php?login_err=email');}
        }else{
            header('Location: connexionMain.php?login_err=already'); die(); }
    }else{ 
        header('Location:connexionMain.php?login_err=empty'); die(); }
?>
