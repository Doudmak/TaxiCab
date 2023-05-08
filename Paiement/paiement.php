<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family= Paytone+One & family =Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,800 & display= swap" rel="feuille de style">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />

    <title>TaxCAB</title>
</head>
<?php
    
    session_start();
    require_once '../config.php'; // On inclut la connexion à la bdd

    $distancearr = $_POST['distancearr'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $prix = $_POST['prix'];
    $time = $_POST['time'];
    $voiture = $_POST['voiture'];
    $name = $_POST['name'];


?>

<body>
    <h1>Page de paiement</h1>
    <div class="container">
        <form class="description-right" action="paiement.php" type="POST">
            <div class="ligne1">
                <div class="box1">
                    <p class="color1"><?php echo($distancearr); ?></p>
                    <p class="color2">Km</p>
                </div>
                <div class="box2">
                    <p class="color1"><?php echo($prix); ?></p>
                    <p class="color2">€</p>
                </div>
                <div class="box3">
                    <div class="box3-1">
                        <p class="color1"><?php echo($time); ?></p>
                        <p class="color2">Min</p>        
                    </div>
                    <div class="box3-2">
                        <p><?php echo($address1);?></p>
                        <div class=" bx bx-shuffle" ></div>
                        <p><?php echo($address2);?></p>
                    </div>
                </div>
            </div>
            <div class="ligne2">
                <div class="choice-car chauffeur" id="chauffeur">    
                    <img src="Image/tete3.jpg"  class="main-picture">
                    <div class="description">
                        <div class="flex-align img-icon">
                            <img src="Image/iconCar.png">
                            <p><?php echo($voiture);?></p>
                        </div>
                        <div class="flex-align img-icon2" >
                            <img src="Image/femme.png">
                            <p><?php echo($name);?></p>
                        </div>
                    </div> 
                </div>
                <div class="paiement">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom"><br><br>
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom"><br><br>
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email"><br><br>
                    <label for="numero">Numéro de carte :</label>
                    <input type="text" id="numero" name="numero"><br><br>
                    <label for="date">Date d'expiration :</label>
                    <input type="text" id="date" name="date"><br><br>
                    <label for="cvv">CVV :</label>
                    <input type="text" id="cvv" name="cvv"><br><br>
                    <button type="submit">Allons-y</button>
                </div> 
            </div>
        </form>
    </div>
</body>
</html>