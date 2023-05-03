<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
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
       <h1><a href ="index.html" class = "logo">TaxCAB</a></h1>
        <div class="bx bx-menu" id="menu-icon"></div>
        <nav>
            <ul>
                <li><a href="#Home" class="menu_hover">Home</a></li>
                <li><a href="#Information" class="menu_hover">Informations</a></li>
                <li><a href="#Client" class="menu_hover">Client</a></li>
                <li><a href="#Chauffeur" class="menu_hover">Chauffeur</a></li>
                <li><a href="MonCompte/MonCompte.php" class="menu_hover">Mon compte</a></li>
                <?php 
                            if(isset($_SESSION['user'])) { ?>
                                <li><form action="deconnexion.php"><button type="submit" class="deco"><div class="bx bx-power-off" class="deroulant" id="user-icon"></div></button></form></li> <?php
                            } else {
                                ?>
                                <li><a href="connexion/connexionMain.php"><div class="bx bx-user" class="deroulant" id="user-icon"></div></a></li>
                                <?php
                            }
                ?>
            </ul>
        </nav>
    </header>

    <section class="Home" id="Home">
        
        <div class="box-travel">
            <div class="box-travel-div-title">
                <h2>Ou allons-nous ?</h2>
            </div>
            <div class="box-travel-div">
                <div class="box-travel-div-p">
                    <h3>Votre position</h3>
                    <input type="text" name="position">
                </div>
                <div class=" bx bx-shuffle" id="fleche"></div>
                <div class="box-travel-div-p">
                    <h3>Votre destination</h3>
                    <input type="text" name="position">
                </div>
            </div>
            <div class="div-type">
                <div class="type-vehicule">
                    <div class="type-vehicule-title">
                        <h3>Type de véhicule</h3>
                    </div>
                    <div class="type-vehicule-image">
                        <div class="bx bxs-car icon" id ="icon-car"></div>
                        <div class="bx bxs-truck icon" id ="icon-truck"></div>
                    </div>
                </div>
                <div class="type-vehicule">
                    <div class="type-vehicule-title">
                        <h3>Type de Chauffeur</h3>
                    </div>
                    <div class="type-vehicule-image">
                        <div class="bx bx-female icon" id ="icon-female"></div>
                        <div class="bx bx-male icon" id ="icon-male"></div>
                    </div>
                </div>
            </div>
                <div class="flex">
                    <button class="button-go" type="button"><p>On y va !</p></button>
                </div>
        </div>

        <div class="maps">
            <img src="Image/Carte.png">
        </div>

    </section>

    <section id="Information">
        
        <div class="informations" >
            
            <div class="informations_title">
                <h2><br>Qui sommes-nous ?</h2>
            </div>
            <div class="informations_container">
                <div class="informations_text">
                    <p>TaxCab est une entreprise de taxi indépendante qui s'engage à offrir un service de qualité à des prix abordables tout en respectant les valeurs de l'écologie et de la parité des sexes.</p>

                    <br>

                    <p>Nous croyons fermement à la protection de notre environnement et à la préservation de nos ressources naturelles pour les générations futures. C'est pourquoi nous avons choisi de faire rouler une flotte de véhicules écologiques et économes en énergie. Nous encourageons également nos clients à opter pour des trajets partagés pour réduire l'empreinte carbone.</p>

                    <br>

                    <p>En ce qui concerne la parité des sexes, nous croyons à l'égalité des opportunités pour tous. C'est pourquoi notre personnel comprend un nombre équitable de conductrices et de conducteurs, offrant ainsi un choix équitable aux clients. Nous travaillons également à promouvoir une culture de respect et de soutien pour nos employées et employés, quel que soit leur genre.</p>

                    <br>

                    <p>Enfin, nous sommes fiers de fournir un service de taxi abordable à nos clients, sans sacrifier la qualité. Nous croyons que tout le monde mérite d'avoir accès à un transport fiable et sûr sans se ruiner. C'est pourquoi nous avons fixé nos tarifs à des niveaux raisonnables, offrant ainsi une option abordable pour vos déplacements.</p>
                </div>

                <div class="informations_img">
                    <div class="row">
                        <div class="box_img">
                            
                            <div class='bx bx-male-female icon_informations'></div>

                            <p class="description">Parité</p>                            
                        </div>

                        <div class="box_img">
                            <div class='bx bxs-tree icon_informations'></div>
                            <p class="description">Ecologie</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="box_img">
                            <div class='bx bx-euro icon_informations' ></div>
                            <p class="description">Prix Bas</p>
                        </div>

                        <div class="box_img">
                            <div class='bx bx-star icon_informations'></div>
                            <p class="description">Qualité</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section id="Client">
       <div class="chauffeur">
           
            <div class="flex_text_chauffeur">
                <div class="row">
                    <div class="transparent-box">
                        <div class="title_chauffeur">
                            <h2>Client Chez nous ?</h2>
                        </div>

                        <div class="description_chauffeur">
                            <p>En choisissant de devenir client chez TaxCab, vous contribuez à la protection de l'environnement grâce à notre flotte de véhicules écologiques et en choisissant des trajets partagés. De plus, vous soutenez une entreprise qui valorise l'égalité des sexes et offre des opportunités équitables à tous les employés. Enfin, vous bénéficiez d'un service de taxi abordable sans sacrifier la qualité. Choisir TaxCab, c'est choisir un transport responsable, inclusif et accessible.</p> 
                        </div>   
                    </div>
                    <div class="transparent-box">
                        <div class="title_chauffeur">
                            <h2>Des avis ?</h2>
                        </div>

                        <div class="description_chauffeur">
                            <div class="description_chauffeur-img">
                                <img class="description-image-chauffeur" src="Image/marhez.png">
                            </div>
                            <div>
                                  <h3>Rachid Badouri, 28 - Sevran, IDF</h3>
                                  <p>" Service de taxi écolo, prix abordables, parité des sexes, recommandé ! "</p>   
                            </div>
                        </div>   
                    </div>
                </div>
                <div class="row">
                    <div class="transparent-box">
                        <div class="title_chauffeur">
                            <h2>Comment s'inscrire ?</h2>
                        </div>
                        <div class="description_chauffeur">
                            <div>
                                  <p>Il est très facile de nous rejoindre pour celà, il faudra seulement créer un compte sur notre site web, puis être agréer par nos services. Félicitaions, après cette procédure, vous faites parti de la TaxiCAB !</p>   
                            </div>
                            <div class="description_chauffeur-img">
                                <a href="Connexionchauffeur/chauffeur.html"><img class="description-image-chauffeur" id= "img3"src="Image/inscription.png"></a>
                            </div>
                        </div> 
                    </div>
                    <div class="transparent-box">
                        <div class="title_chauffeur">
                            <h2>F.A.Q</h2>
                        </div>

                        <div class="description_chauffeur">
                            <div class="faq">
                                <div class="flex-center" id="row-ligne">
                                    <div class="description_chauffeur-img">
                                        <img class="description-image-chauffeur" src="Image/marhez.png">
                                    </div>
                                    <div>
                                          <h3>Rachid Badouri, 30 - Sevran, IDF</h3>
                                          <p>"En combien de temps nous recevons la carte ? "</p>   
                                    </div>
                                </div>
                                <div class="flex-center">
                                    <div class="description_chauffeur-img">
                                        <img class="description-image-chauffeur" src="Image/faq.jpg">
                                    </div>
                                    <div>
                                          <h3>Sylvie Cheng, 27 - Paris, IDF</h3>
                                          <p>"En combien de temps nous recevons la carte ? "</p>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>    
    <section id="Chauffeur">
       <div class="chauffeur">
           
            <div class="flex_text_chauffeur">
                <div class="row">
                    <div class="transparent-box">
                        <div class="title_chauffeur">
                            <h2>Chauffeur chez nous ?</h2>
                        </div>

                        <div class="description_chauffeur">
                            <p>Travailler pour TaxCab est idéal si vous êtes passionné par la protection de l'environnement, l'égalité des sexes et la qualité de service abordable. TaxCab utilise une flotte de véhicules écologiques, promeut la parité entre les sexes et offre des services abordables de qualité. En travaillant pour TaxCab, vous pouvez contribuer à protéger l'environnement, vous sentir soutenu et valorisé, et améliorer la mobilité et l'accessibilité des clients.</p> 
                        </div>   
                    </div>
                    <div class="transparent-box">
                        <div class="title_chauffeur">
                            <h2>Des avis ?</h2>
                        </div>

                        <div class="description_chauffeur">
                            <div class="description_chauffeur-img">
                                <img class="description-image-chauffeur" src="Image/avis1.jpg">
                            </div>
                            <div>
                                  <h3>Lena Mafoueté, 26 - Paris, IDF</h3>
                                  <p>" Être chauffeur de taxi, c'est comme être un GPS humain avec un sens de l'humour. "</p>   
                            </div>
                        </div>   
                    </div>
                </div>
                <div class="row">
                    <div class="transparent-box">
                        <div class="title_chauffeur">
                            <h2>Comment postuler ?</h2>
                        </div>
                        <div class="description_chauffeur">
                            <div>
                                  <p>Il est très facile de nous rejoindre pour celà, il faudra seulement créer un compte sur notre site web, puis être agréer par nos services. Enfin après cette procédure, vous recevrez votre carte TaxiCAB qui vous permettra d'être authentifier !</p>   
                            </div>
                            <div class="description_chauffeur-img">
                                <a href="Connexionchauffeur/chauffeur.html"><img class="description-image-chauffeur" id= "img2"src="Image/rejoinsnous.jpg"></a>
                            </div>
                        </div> 
                    </div>
                    <div class="transparent-box">
                        <div class="title_chauffeur">
                            <h2>F.A.Q</h2>
                        </div>

                        <div class="description_chauffeur">
                            <div class="faq">
                                <div class="flex-center" id="row-ligne">
                                    <div class="description_chauffeur-img">
                                        <img class="description-image-chauffeur" src="Image/avis1.jpg">
                                    </div>
                                    <div>
                                          <h3>Lena Mafoueté, 26 - Paris, IDF</h3>
                                          <p>"En combien de temps nous recevons la carte ? "</p>   
                                    </div>
                                </div>
                                <div class="flex-center">
                                    <div class="description_chauffeur-img">
                                        <img class="description-image-chauffeur" src="Image/faq.jpg">
                                    </div>
                                    <div>
                                          <h3>Lena Mafoueté, 27 - Paris, IDF</h3>
                                          <p>"En combien de temps nous recevons la carte ? "</p>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>
    <script type="text/javascript" src="script.js"></script>

</body>
</html>