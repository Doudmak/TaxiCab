<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="connexion2.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https : //fonts.googleapis.com/css2?family= Paytone+One & family =Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,800 & display= swap" rel="feuille de style">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <title>Connexion</title>
</head>
<body>
    <header>
        <h1><a href ="../index.html" class = "logo">TaxCAB</a></h1>
         <div class="bx bx-menu" id="menu-icon"></div>
         <nav>
             <ul>
                 <li><a href="../index.html#Home" class="menu_hover">Home</a></li>
                 <li><a href="../index.html#Information" class="menu_hover">Informations</a></li>
                 <li><a href="../index.html#Client" class="menu_hover">Client</a></li>
                 <li><a href="../index.html#Chauffeur" class="menu_hover">Chauffeur</a></li>
                 <li><a href="../MonCompte/MonCompte.html" class="menu_hover">Mon Compte</a></li>
                 <li><a href=""><div class="bx bx-user" id="user-icon"></div></a></li>
             </ul>
         </nav>
     </header>
     <div class="container">
        <div id="formulaire1">
            <div class="form-container sign-up-container">
                <form action="inscription.php" method="post">
                    <h1 id="inscription">Inscription</h1>
                    <div class="nom-prenom">
                        <input type="text" placeholder="Nom" class="np"  id="nom" name ="nom"> 
                        <input type="text" placeholder="Prenom" class="np"  id="prenom" name="prenom">
                    </div>
                    <input type="text" placeholder="Numero rue et nom rue"  id="adresse" name ="adresse"> 
                    <div class="nom-prenom">
                        <input type="text" placeholder="Ville" class="np" id="ville" name="ville">
                        <input type="text" placeholder="Code Postal" class="np" id="cp" name ="cp">
                    </div>
                    <input type="email" placeholder="Identifiant (mail)"  id="mail" name="mail">
                    <input type="password" placeholder="Mot de passe"  id="mdp" name="mdp">
                    <button type="submit">Créer le compte</button>
                    <?php
                if(isset($_GET['reg_err'])){
                    $erreur = htmlspecialchars($_GET['reg_err']);
                    switch($erreur) {
                        case 'mdp' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 10px">Erreur : Mot de passe invalide</p>
                            </div>
                        <?php
                        break;
                        case 'email' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 10px">Erreur : Format de mail incorrect</p>
                            </div>
                            <?php
                        break;
                        case 'ville_length' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 10px">Erreur : Format de ville invalide</p>
                            </div>
                            <?php
                        break;
                        case 'adr_length' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 10px">Erreur : Format d'adresse invalide</p>
                            </div>
                            <?php
                        break;
                        case 'prenom_length' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 10px">Erreur : Format de prénom invalide</p>
                            </div>
                            <?php
                        break;
                        case 'nom_invalide' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 10px">Erreur : Format de nom invalide</p>
                            </div>
                            <?php
                        break;
                        case 'already_registered' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 10px">Erreur : Vous avez déjà un compte</p>
                            </div>
                            <?php
                        break;
                        case 'empty' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 10px">Erreur : Veuillez remplir tous les champs</p>
                            </div>
                            <?php
                        break;
                        case 'success' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 10px">Compte crée avec succès</p>
                            </div>
                            <?php
                        break;
                    }
                }
                ?>
                </form>
            </div>
            <div class="overlay-panel overlay-left">
                <h1 class="accroche">Heureux de vous revoir !</h1>
                <p>Si vous disposez d'un compte cliquez ci-dessous</p>
                <a href="connexionMain.php" class="intbutton"><button class="ghost" id="login">Se connecter</button></a>
            </div>
        </div> 
     </div>
</body>
</html>