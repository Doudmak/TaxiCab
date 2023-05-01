<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="connexion2.css" type="text/css">
    <script src="script.js"></script>
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
                 <li><a href="../index.php#Home" class="menu_hover">Home</a></li>
                 <li><a href="../index.php#Information" class="menu_hover">Informations</a></li>
                 <li><a href="../index.php#Client" class="menu_hover">Client</a></li>
                 <li><a href="../index.php#Chauffeur" class="menu_hover">Chauffeur</a></li>
                 <li><a href="../MonCompte/MonCompte.php" class="menu_hover">Mon Compte</a></li>
                 <li><a href=""><div class="bx bx-user" id="user-icon"></div></a></li>
             </ul>
         </nav>
     </header>
     <div class="container">        
        <div id="formulaire2">
            <div class="form-container log-in-container">
                <form action="connexion.php" method="post">
                    <h1 id="inscription">Se connecter</h1>
                    <div class="social-container">
                        <a href="https://www.instagram.com" target="_blank" class="icons"><div class="bx bxl-instagram" id="icons"></div></a>
                        <a href="https://fr.linkedin.com/" target="_blank" class="icons"><div class="bx bxl-linkedin" id="icons"></div></a>
                        <a href="https://twitter.com/?lang=fr" target="_blank" class="icons"><div class="bx bxl-twitter" id="icons"></div></a>
                    </div>
                    
                    <input type="email" placeholder="Identifiant (mail)"  id="mailco" name="mailco">
                    <input type="password" placeholder="Mot de passe"  id="mdpco" name="mdpco"> 
                    <p><a href="../Connexionchauffeur/chauffeurMain.php" class="connexionChauffeur">Vous êtes chauffeur ?</a></p>
                    <button type="submit">Connexion</button>
                    <?php
                    if(isset($_GET['login_err'])){
                        $erreur = htmlspecialchars($_GET['login_err']);
                        switch($erreur) {
                            case 'password' : 
                                ?>
                                <div>
                                    <p style="margin-bottom : 10px">Erreur : Mot de passe incorrect</p>
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
                            case 'already' : 
                                ?>
                                <div>
                                    <p style="margin-bottom : 10px">Erreur : Veuillez-vous inscrire !</p>
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
                            
                        }
                    }
                    ?>
                </form>
            </div>    
            <div class="overlay-panel overlay-right">
                <h1 class="accroche">Bienvenue !</h1>
                <p>Créer un compte et rejoindre notre communauté.</p>
                <a href="inscriptionMain.php" class="intbutton"><button class="ghost" id="login"> Créer un compte </button></a>
            </div>      
        </div>      
     </div>
</body>
</html>