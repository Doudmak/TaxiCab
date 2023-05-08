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

    <title>TaxCAB</title>
</head>
<?php
    session_start();
    require_once '../config.php'; // On inclut la connexion à la bdd

    // Vérifier si address-input est vide
    
    if(empty($_POST['address-input'])) {
        echo "L'adresse de départ est manquante.";
        exit(); // Arrêter le script
    }

    // Récupérer les données du formulaire

    $adresseDep = $_POST['address-input'];
    $elementsDep = explode(", ", $adresseDep);
    $rueDep = $elementsDep[0];
    $villeCodePostalDep = $elementsDep[1];
    $villeDep = explode(" ", $villeCodePostalDep)[0];
    $codePostalDep = explode(" ", $villeCodePostalDep)[1];

    $adresseArr = $_POST['address-input-1'];
    $elementsArr = explode(", ", $adresseArr);
    $rueArr = $elementsArr[0];
    $villeCodePostalArr = $elementsArr[1];
    $villeArr = explode(" ", $villeCodePostalArr)[0];
    $codePostalArr = explode(" ", $villeCodePostalArr)[1];

    //Calculer le nombre de Km
    // Fonction pour récupérer les coordonnées d'une adresse
    function getCoordinates($address) {
        $apiKey = 'pk.3c25a2f96c2f5abe1a062d5e13e1152a';
        $url = "https://eu1.locationiq.com/v1/search.php?key=$apiKey&q=$address&format=json";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return [
            'lat' => $data[0]['lat'],
            'lon' => $data[0]['lon']
        ];
    }

    // Fonction pour calculer la distance entre deux coordonnées
    function getDistance($lat1, $lon1, $lat2, $lon2) {
        $apiKey = 'pk.3c25a2f96c2f5abe1a062d5e13e1152a';
        $url = "https://eu1.locationiq.com/v1/directions/driving/$lon1,$lat1;$lon2,$lat2?key=$apiKey";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        $distance = $data['routes'][0]['distance'] / 1000; // Convertir la distance en kilomètres
        return $distance;

    }

    // Exemple d'utilisation : calculer la distance entre deux adresses
    $address1 = $adresseDep;
    $address2 = $adresseArr;
    $coords1 = getCoordinates($address1);
    $coords2 = getCoordinates($address2);
    $distance = getDistance($coords1['lat'], $coords1['lon'], $coords2['lat'], $coords2['lon']);
    //$distance = getDistance($coords1['lat'], $coords1['lon'], $coords2['lat'], $coords2['lon']);

    $distancearr = floor($distance);

    //Calcul du prix du trajet

    $prix = $distancearr * 1.3;


    //numero trajet 

    $num_trajet = rand(1, 361);

    // Vérifier si le nombre existe déjà dans la base de données

    $stmt = $bdd->prepare("SELECT COUNT(*) FROM trajet WHERE num_trajet = ?");
    $stmt->execute([$num_trajet]);
    $nombreDeResultats = $stmt->fetchColumn();

    // Tant que le nombre existe déjà, en générer un nouveau
    while ($nombreDeResultats > 0) {
        $num_trajet = rand(1, 361);
        $stmt->execute([$num_trajet]);
        $nombreDeResultats = $stmt->fetchColumn();
    }
    //Recuperer le mail

    $mail = $_SESSION['user']["mail"];

    $sql3 = "SELECT MAX(num_trajet) AS max_valeu FROM trajet where mail = ?";
        $stmt2 = $bdd->prepare($sql3);
        $stmt2->execute([$mail]);
        $res2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $max_valeur = $res2['max_valeu'];


    // Préparer la requête SQL
    $sql = "INSERT INTO trajet (adressedep, villedep, codepdep, adressearr, villear, codeparr, prix, num_trajet, mail, km) VALUES (:rueDep, :villeDep, :codePostalDep, :rueArr, :villeArr, :codePostalArr, :prix, :num_trajet, :mail, :distance)";
    $stmt = $bdd->prepare($sql);

    // Exécuter la requête avec les paramètres
    $stmt->execute([
        'rueDep' => $rueDep,
        'villeDep' => $villeDep,
        'codePostalDep' => $codePostalDep,
        'rueArr' => $rueArr,
        'villeArr' => $villeArr,
        'codePostalArr' => $codePostalArr,
        'prix' => $prix,
        'num_trajet' => $max_valeur+1,
        'mail' => $mail,
        'distance' => $distance

    ]);

    // Vérifier si l'insertion a réussi
    if ($stmt->rowCount() > 0) {
        echo "Les adresses ont été ajoutées avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'ajout des adresses.";
    }


?>


<body>

    <header>
        <h1><a href ="index.html" class = "logo">TaxCAB</a></h1>

        <?php 
            if(isset($_SESSION['user'])) { ?>
                <li><form action="deconnexion.php"><button type="submit" class="deco" style="border:none;background-color: white;"><div class="bx bx-power-off" class="deroulant" id="user-icon" style="font-size:35px"></div></button></form></li> <?php
            } else {
                ?>
                <li><a href="../connexion/connexionMain.php"><div class="bx bx-user" class="deroulant" id="user-icon" style="font-size:35px"></div></a></li>
                <?php
            }
        ?>
    </header>

    <div class="container-search">
        <div class="flex">
            <div class="search">

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
            
            <div class="date-heure">
                
                <div class="date">
                    <h3>Date</h3>
                    <input type="date" name="position">
                </div>

                <div class="heure">
                    <h3>Heure</h3>
                    <input type="time" name="position">
                </div>
            </div>   
        </div>
        
        <div class="flex">
            <div class="type-vehicule-image">

                <div class="bx bxs-car icon" id ="icon-car"></div>
                <div class="bx bxs-truck icon" id ="icon-truck"></div>

            </div>

            <div class="type-vehicule-image">

                <div class="bx bx-female icon" id ="icon-female"></div>
                <div class="bx bx-male icon" id ="icon-male"></div>

            </div>    
        </div>
        
    </div>

    <div class="flex container">
        
        <div class="container-left">

            <div class="choice-car">    
                <img src="Image/tete1.jpg" class="main-picture">
                
                <div class="description">
                    
                    <div class="flex-align img-icon">
                        <img src="Image/iconCar.png">
                        <p>Mercedes GLA</p>
                    </div>

                    <div class="flex-align img-icon2" >
                        <img src="Image/femme.png">
                        <p>Bain Marie</p>
                    </div>
                
                </div>
                
                <div class="time">
                    <p>3<span class="time-m">min</span></p>
                </div>
            </div>

            <div class="choice-car">    
                <img src="Image/tete2.jpg"  class="main-picture">
                
                <div class="description">
                    
                    <div class="flex-align img-icon">
                        <img src="Image/iconCar.png">
                        <p>Toyota Camry</p>
                    </div>

                    <div class="flex-align img-icon2" >
                        <img src="Image/femme.png">
                        <p>Julie Mitraillette</p>
                    </div>
                
                </div>
                
                <div class="time">
                    <p>19<span class="time-m">min</span></p>
                </div>
            </div>
            <div class="choice-car">    
                <img src="Image/tete3.jpg"  class="main-picture">
                
                <div class="description">
                    
                    <div class="flex-align img-icon">
                        <img src="Image/iconCar.png">
                        <p>Toyota Prius+</p>
                    </div>

                    <div class="flex-align img-icon2" >
                        <img src="Image/femme.png">
                        <p>Jules pacontent</p>
                    </div>
                
                </div>
                
                <div class="time">
                    <p>46<span class="time-m">min</span></p>
                </div>
            </div>
            <div class="choice-car">    
                <img src="Image/therock.webp"  class="main-picture">
                
                <div class="description">
                    
                    <div class="flex-align img-icon">
                        <img src="Image/iconCar.png">
                        <p>Mercedes GLA</p>
                    </div>

                    <div class="flex-align img-icon2" >
                        <img src="Image/femme.png">
                        <p>Manuel Neueur</p>
                    </div>
                
                </div>
                
                <div class="time">
                    <p>1<span class="time-m">h</span></p>
                </div>
            </div>            
        </div>
        
        <div class="container-right">
            
            <div class="maps">
                
                <img src="Image/maps.jpg">
            </div>
            
            <div class="description-right">
                
                <div class="left">
                    <div class="text-right">
                        <p>Julien Metayer</p>
                    </div>
                    <img src="Image/tete3.jpg">
                </div>

                <div class="right">
                    
                    <div class="cpt">
                        <div class="border">
                            <p>Nombre de trajet :</p>
                            <p class="text-right-bottom">36</p>
                        </div>
                        <div class="border">
                            <p>Temps de trajet :</p>
                            <p class="text-right-bottom">52<span class="time-m"> h</span></p>
                        </div>
                        <div class="border">
                            <p>Adhérent depuis :</p>
                            <p class="text-right-bottom">3<span class="time-m"> ans</span></p>
                        </div>
                    </div>
                    <div class="star">
                        <img src="Image/etoile.png">
                        <img src="Image/etoile.png">
                        <img src="Image/etoile.png">
                        <img src="Image/etoile.png">
                        <img src="Image/etoile.png">
                    </div>
                </div>
            </div>
        
        </div>  
    </div>
    

</body>
</html>