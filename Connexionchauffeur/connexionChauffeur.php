<?php 
    session_start(); // Démarrage de la session
    require_once 'config.php';   // On inclut la connexion à la base de données

    if(!empty($_POST['mailcoch']) && !empty($_POST['mdpcoch'])) // Si il existe les champs email, password et qu'il sont pas vident
    {
        // Patch XSS
        $email = htmlspecialchars($_POST['mailcoch']); 
        $password = htmlspecialchars($_POST['mdpcoch']);
        
        $email = strtolower($email); // email transformé en minuscule
        
        //On regarde si l'utilisateur est inscrit dans la table utilisateurs
        $check = $bdd->prepare('SELECT nom, prenom, mail, mdp FROM conducteur WHERE mail = ?');
        $check->execute(array($email)); 
        $data = $check->fetch();
        $row = $check->rowCount();

        // Si > à 0 alors l'utilisateur existe
        if($row > 0){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $password = hash('sha256', $password);
                if($data['mdp'] === $password) {
                    $_SESSION['user'] = $data['mail'];
                    header('Location:chauffeur.html?reg_err=success');
                }else{ 
                    $erreur = "Le champs nom n'est pas valide";
                    header('Location: chauffeur.html?login_err=password'); die(); }
            } else {
                $erreur = "Le champs nom n'est pas valide";
                header('Location:chauffeur.html?login_err=email');}
        }else{ 
            $erreur = "Le champs nom n'est pas valide";
            header('Location: chauffeur.html?login_err=already'); die(); }
    }else{ 
        $erreur = "Veuillez replir tous les champs";
        header('Location:chauffeur.html?login_err=empty'); die(); }
?>
