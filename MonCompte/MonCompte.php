<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="MonCompte.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https : //fonts.googleapis.com/css2?family= Paytone+One & family =Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,800 & display= swap" rel="feuille de style">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600&display=swap" rel="stylesheet">

    <title>TaxCAB</title>
</head>
<body>
<?php 
session_start();
require_once 'config.php';
?>
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
                <?php 
                            if(isset($_SESSION['user'])) { ?>
                                <li><form action="deconnexion.php"><button type="submit" class="deco"><div class="bx bx-power-off" class="deroulant" id="user-icon"></div></button></form></li> <?php
                            } else {
                                ?>
                                <li><a href="../connexion/connexionMain.php"><div class="bx bx-user" class="deroulant" id="user-icon"></div></a></li>
                                <?php
                            }
                ?>
            </ul>
        </nav>
    </header>

    <section class="sect1">
        
    </section>

    <section class="monCompte">
        <div class="container">
            <div class="left">
                <div class="infos">
                <?php 
                            if(isset($_SESSION['user'])) { ?>
                                <img src="images/ppman.png" class="img-profile" alt=""> <br> <?php
                            } else {
                                ?>
                                <img src="images/dummy.png" class="img-profile" alt=""> <br> 
                                <?php
                            }
                ?>
                    <?php 
                            if(isset($_SESSION['user'])) { ?>
                                <img src="images/4,5etoiles.png" alt="" id="etoiles">
                            <?php }
                            ?>
                    
                    <p>Nom : <?php 
                            if(isset($_SESSION['user'])) {
                                echo $_SESSION['user']["prenom"];
                            } else {
                                echo "";
                            }
                            ?></p>
                    <div class="ligne"></div>
                    <p>Prenom : <?php 
                            if(isset($_SESSION['user'])) {
                                echo $_SESSION['user']["nom"];
                            } else {
                                echo "";
                            }
                            ?></p>
                    <div class="ligne"></div>
                    <p>Adresse : <?php if(isset($_SESSION['user'])) {
                                echo $_SESSION['user']["adresse"];
                            } else {
                                echo "";
                            }
                            ?> <br> <?php if(isset($_SESSION['user'])) {
                                echo $_SESSION['user']["codePostal"];
                            } else {
                                echo "";
                            } ?> <?php if(isset($_SESSION['user'])) {
                                echo $_SESSION['user']["ville"];
                            } else {
                                echo "";
                            }
                            ?></p>
                    <div class="ligne" ></div>
                    <p id="ligne-spe">Adresse mail :  <br> <?php if(isset($_SESSION['user'])) {
                                echo $_SESSION['user']["mail"];
                            } else {
                                echo "";
                            }
                            ?></p>
                    <button class="modifInfo">Modifier les informations</button>
                </div>
                
            </div>
            <div class="right">
                <div class="recap">
                    <div class="boites" id="boiteG">
                        <h1 class = "logo2">Nombre de courses :</h1>
                        <h1 class="logo2" id="chiffre"><?php if(isset($_SESSION['user'])) {
                                echo $_SESSION['user']["nb_trajets"];
                            } else {
                                echo "";
                            }?></h1>
                    </div>
                    <div class="boites" id="mid">
                        <h1 class = "logo2">Nombre km parcourus</h1>
                        <h1 class="logo2" id="chiffre"><?php
                        if(isset($_SESSION['user'])) {
                                echo $_SESSION['user']["km"]."km";
                            } else {
                                echo "";
                            } ?>
                        </h1>
                    </div>
                    <div class="boites" id="mid2">
                        <h1 class = "logo2">Coût total des courses</h1>
                        <h1 class="logo2" id="chiffre"><?php
                        if(isset($_SESSION['user'])) {
                                echo $_SESSION['user']["total"]."€";
                            } else {
                                echo "";
                            } ?></h1>
                    </div>
                    <div class="boites" id="boiteD">
                        <h1 class = "logo2">Points de fidélité</h1>
                        <h1 class="logo2" id="chiffre"><?php
                        if(isset($_SESSION['user'])) {
                                echo (int)($_SESSION['user']["km"]/7)." Pts";
                            } else {
                                echo "";
                            } 
                            ?></h1>
                    </div>
                </div>
                
                <div class="historique-container">
                    <div class="titre">
                        <h2 id="histo">Trajets récents</h2> 
                    </div>

                    <div class="separation">
                    </div>
                    <?php
                    if (isset($_SESSION['user']['adressedep1'])) {?>
                    <div class="row">
                        <div class="div_img">
                            <img src="images/valide.png" alt="" class="valide">
                        </div>
                        <div class="adresse">
                            <div class="dep">
                                <i class='bx bx-map'></i>
                                <p>Départ : <b><?php echo $_SESSION['user']['adressedep1']?> <?php echo $_SESSION['user']['villedep1']?> <?php echo $_SESSION['user']['codepdep1']?></b></p>
                            </div>
                            <div class="dep">
                                <i class='bx bx-navigation'></i>
                                <p>Arrivée : <b><?php echo $_SESSION['user']['adressearr1']?> <?php echo $_SESSION['user']['villearr1']?> <?php echo $_SESSION['user']['codeparr1']?></b></p> <br>
                            </div>
                        </div>
                        <div class="prixFin">
                            <p><?php echo $_SESSION['user']['prix1']?>€</p> 
                        </div>
                    </div>
                    <?php } else { echo "Pas de trajets";} ?>
                   
                    <?php
                    if(isset($_SESSION['user']['adressedep1'])) { ?>
                    <div class="separation">
                    </div>

                    <div class="row">
                        <div class="div_img">
                            <img src="images/valide.png" alt="" class="valide">
                        </div>
                        <div class="adresse">
                            <div class="dep">
                                <i class='bx bx-map'></i>
                                <p>Départ : <?php echo $_SESSION['user']['adressedep2']?> <?php echo $_SESSION['user']['villedep2']?> <?php echo $_SESSION['user']['codepdep2']?></b> </p>
                            </div>
                            <div class="dep">
                                <i class='bx bx-navigation'></i>
                                <p>Arrivée : <b><?php echo $_SESSION['user']['adressearr2']?> <?php echo $_SESSION['user']['villearr2']?> <?php echo $_SESSION['user']['codeparr2']?></b> </p> <br>
                            </div>
                        </div>
                        <div class="prixFin">
                            <p><?php echo $_SESSION['user']['prix2']?>€</p> 
                        </div>
                    </div>

                    <?php } ?>

                    <?php
                    if(isset($_SESSION['user']['adressedep1'])) { ?>

                    <div class="separation">
                    </div>

                    <div class="row">
                        <div class="div_img">
                            <img src="images/attente.png" alt="" class="valide">
                        </div>
                        <div class="adresse">
                            <div class="dep">
                                <i class='bx bx-map'></i>
                                <p>Départ : <b><?php echo $_SESSION['user']['adressedep3']?> <?php echo $_SESSION['user']['villedep3']?> <?php echo $_SESSION['user']['codepdep3']?></b> </p>
                            </div>
                            <div class="dep">
                                <i class='bx bx-navigation'></i>
                                <p>Arrivée : <b><?php echo $_SESSION['user']['adressearr3']?> <?php echo $_SESSION['user']['villearr3']?> <?php echo $_SESSION['user']['codeparr3']?></b> </p> <br>
                            </div>
                        </div>
                        <div class="prixFin" id="attente">
                            <p><?php echo $_SESSION['user']['prix3']?>€</p> 
                        </div>
                    </div>
                    <?php } ?>
            </div>
        </div>
    </section>
</body>