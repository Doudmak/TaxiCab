<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="chauffeur.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https : //fonts.googleapis.com/css2?family= Paytone+One & family =Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,800 & display= swap" rel="feuille de style">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600&display=swap" rel="stylesheet">
    <script src="script.js"></script>

    <title>Chauffeur</title>
</head>
<body>

    <header>
       <h1><a href ="../index.php" class = "logo">TaxCAB</a></h1>
        <div class="bx bx-menu" id="menu-icon"></div>
        <nav>
            <ul>
                <li><a href="../index.php" class="menu_hover">Home</a></li>
                <li><a href="../index.php#Information" class="menu_hover">Informations</a></li>
                <li><a href="../index.php#Client" class="menu_hover">Client</a></li>
                <li><a href="../index.php#Chauffeur" class="menu_hover">Chauffeur</a></li>
                <li><a href="../MonCompte/MonCompte.php" class="menu_hover">Mon Compte</a></li>
                <li><a href="../connexion/connexionMain.php"><div class="bx bx-user" id="user-icon"></div></a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <div id="formulaire1">
            <div class="form2-container sign-up-container ">
                <div class="haut">
                    <div class='bx bx-chevrons-left flecheRetour'></div>
                    <a href="chauffeurMain.php"><p class="retour">Retour</p></a>
                </div>
                <form action="inscriptionChauffeur.php" method="post">
                    <h1 id="inscription">Inscription</h1>
                    
                    <div class="nom-prenom">
                        <input type="text" placeholder="Nom" class="np insc"  name="nomChauffeur" id="nomChauffeur"> 
                        <input type="text" placeholder="Prenom" class="np insc"  name="prenomChauffeur" id="prenomChauffeur">
                    </div>
                    <div class="nom-prenom">
                        <input type="text" placeholder="Numéro de permis de conduire" class="np insc" name="numPermis" id="numPermis">
                        <input type="text" placeholder="Date d'obtention du permis" class="np insc" name="dateObtentionPermis" id="dateObtentionPermis">
                    </div>
                    <div class="nom-prenom">
                        <input type="text" placeholder="Adresse" class="np insc" name="adresseChauffeur" id="adresseChauffeur">
                        <input type="text" placeholder="Numéro d'immatriculation" class="np insc" name="numeroImmatriculation" id="numeroImmatriculation">
                    </div>
                    
                    <div class="nom-prenom">
                        <input type="text" placeholder="Ville" class="np insc" name="villeChauffeur" id="villeChauffeur">
                        <input type="text" placeholder="Code Postal" class="np insc" name="cpChauffeur" id="cpChauffeur">
                    </div>
                    <div class="nom-prenom">
                        <input type="email" placeholder="Identifiant (mail)" class="np insc"  name="mailChauffeur" id="mailChauffeur">
                        <input type="password" placeholder="Mot de passe" class="np insc"  name="mdpChauffeur" id="mdpChauffeur">
                    </div>
                    <?php
                    if(isset($_GET['reg_err'])){
                    $erreur = htmlspecialchars($_GET['reg_err']);
                    switch($erreur) {
                        case 'mdp' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 0px">Erreur : Mot de passe invalide</p>
                            </div>
                        <?php
                        break;
                        case 'mail' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 0px">Erreur : Format de mail incorrect</p>
                            </div>
                            <?php
                        break;
                        case 'ville' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 0px">Erreur : Format de ville invalide</p>
                            </div>
                            <?php
                        break;
                        case 'dateObt' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 0px">Erreur : Format de date invalide</p>
                            </div>
                            <?php
                        break;
                        case 'adresse' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 0px">Erreur : Format d'adresse invalide</p>
                            </div>
                            <?php
                        break;
                        case 'prenom' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 0px">Erreur : Format de prénom invalide</p>
                            </div>
                            <?php
                        break;
                        case 'nom' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 0px">Erreur : Format de nom invalide</p>
                            </div>
                            <?php
                        break;
                        case 'exist' : 
                            ?>
                            <div>
                                <p > Compe déjà existant, veuillez-vous connecter</p>
                            </div>
                            <?php
                        break;
                        
                        case 'champs_incomplets' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 0px"> Compe déjà existant, veuillez-vous connecter</p>
                            </div>
                            <?php
                        break;
                        case 'success' : 
                            ?>
                            <div>
                                <p style="margin-bottom : 0px">Compte crée avec succès</p>
                            </div>
                            <?php
                        break;
                    }
                }
                ?>
                    
                    <div class="bas">
                        <button type="submit">Créer le compte</button>
                    </div>
                </form>
            </div>
        </div>      
     </div>
</body>
</html>