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

    //Envoyez une requete au server

    function getRequest($lat1, $lon1, $lat2, $lon2) {
        $apiKey = 'pk.3c25a2f96c2f5abe1a062d5e13e1152a';
        $url = "https://eu1.locationiq.com/v1/directions/driving/$lon1,$lat1;$lon2,$lat2?key=$apiKey";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        return $data;
    }

    // Fonction pour calculer la distance entre deux coordonnées
    function getDistance($data) {
        $distance = $data['routes'][0]['distance'] / 1000; // Convertir la distance en kilomètres
        return $distance;
    }
    // Fonction pour calculer la distance entre deux coordonnées
    function getTime($data) {
        $time = $data['routes'][0]['duration'] / 100; // Convertir le temps en minutes
        $time = floor($time);
        $time = $time*2;
        return $time;
    }

    // Exemple d'utilisation : calculer la distance entre deux adresses
    $address1 = $adresseDep;
    $address2 = $adresseArr;
    $coords1 = getCoordinates($address1);
    $coords2 = getCoordinates($address2);
    $data = getRequest($coords1['lat'], $coords1['lon'], $coords2['lat'], $coords2['lon']);
    $distance = getDistance($data);
    $time = getTime($data);

    $distancearr = floor($distance);

    //Calcul du prix du trajet

    $prix = $distancearr * 3.7;

    //

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
   /* if ($stmt->rowCount() > 0) {
        echo "Les adresses ont été ajoutées avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'ajout des adresses.";
    }*/


    // Récupération des conducteur 

    // Requête pour récupérer un utilisateur au hasard
    $stmt1 = $bdd->query("SELECT * FROM conducteur ORDER BY RAND() LIMIT 4");

    // Bouclez sur les résultats et assignez chaque utilisateur à une variable distincte

    $utilisateurs = [];
    foreach ($stmt1 as $row) {
        
        $utilisateur = [
            'nom' => $row['nom'],
            'prenom' => $row['prenom'],
            'vehicule' => $row['vehicule'],
        ];
        
        $utilisateurs[] = $utilisateur;
    }

    // Assignez chaque utilisateur à une variable distincte
    $utilisateur1 = $utilisateurs[0];
    $utilisateur2 = $utilisateurs[1];
    $utilisateur3 = $utilisateurs[2];
    $utilisateur4 = $utilisateurs[3];

    $chiffre_random1 = rand(1, 59);
    $chiffre_random2 = rand(1, 59);
    $chiffre_random3 = rand(1, 59);
    $chiffre_random4 = rand(1, 59);
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

            <div class="choice-car" id="div1">    
                <img src="Image/tete1.jpg" class="main-picture">
                
                <div class="description">
                    
                    <div class="flex-align img-icon">
                        <img src="Image/iconCar.png">
                        <p><?php echo $utilisateur1['vehicule'] ?></p>
                    </div>

                    <div class="flex-align img-icon2" >
                        <img src="Image/femme.png">
                        <p><?php echo $utilisateur1['nom'].' '.$utilisateur1['prenom'] ?></p>
                    </div>
                
                </div>
                
                <div class="time">
                    <p><?php echo $chiffre_random1 ?><span class="time-m">min</span></p>
                </div>
            </div>

            <div class="choice-car"  id="div2">    
                <img src="Image/tete2.jpg"  class="main-picture">
                
                <div class="description">
                    
                    <div class="flex-align img-icon">
                        <img src="Image/iconCar.png">
                        <p><?php echo $utilisateur2['vehicule'] ?></p>
                    </div>

                    <div class="flex-align img-icon2" >
                        <img src="Image/femme.png">
                        <p><?php echo $utilisateur2['nom'].' '.$utilisateur2['prenom'] ?></p>
                    </div>
                
                </div>
                
                <div class="time">
                    <p><?php echo $chiffre_random2 ?><span class="time-m">min</span></p>
                </div>
            </div>
            <div class="choice-car"  id="div3">    
                <img src="Image/tete3.jpg"  class="main-picture">
                
                <div class="description">
                    
                    <div class="flex-align img-icon">
                        <img src="Image/iconCar.png">
                        <p><?php echo $utilisateur3['vehicule'] ?></p>
                    </div>

                    <div class="flex-align img-icon2" >
                        <img src="Image/femme.png">
                        <p><?php echo $utilisateur3['nom'].' '.$utilisateur3['prenom'] ?></p>
                    </div>
                
                </div>
                
                <div class="time">
                    <p><?php echo $chiffre_random3 ?><span class="time-m">min</span></p>
                </div>
            </div>
            <div class="choice-car" id="div4">    
                <img src="Image/therock.webp"  class="main-picture">
                
                <div class="description">
                    
                    <div class="flex-align img-icon">
                        <img src="Image/iconCar.png">
                        <p><?php echo $utilisateur4['vehicule'] ?></p>
                    </div>

                    <div class="flex-align img-icon2" >
                        <img src="Image/femme.png">
                        <p><?php echo $utilisateur4['nom'].' '.$utilisateur4['prenom'] ?></p>
                    </div>
                
                </div>
                
                <div class="time">
                    <p><?php echo $chiffre_random4 ?><span class="time-m">h</span></p>
                </div>
            </div>            
        </div>
        
        <div class="container-right">
            
            <div id="mapid" style="height:50%;">
                

            </div>
            
            <form class="description-right" method="POST" action="../Paiement/paiement.php" >
                
                <div class="ligne1">

                    <div class="box1">
                        
                        <p class="color1"><?php echo $distancearr; ?></p>
                        <p class="color2">Km</p>

                    </div>
                    
                    <div class="box2">
                        
                        <p class="color1"><?php echo $prix ?></p>
                        <p class="color2">€</p>

                    </div>
                    
                    <div class="box3">
                        
                        <div class="box3-1">
                            <p class="color1"><?php echo $time ?></p><p class="color2">Min</p>        
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
                                <p id="voiture">Toyota Prius+</p>
                            </div>

                            <div class="flex-align img-icon2" >
                                <img src="Image/femme.png">
                                <p id="name">Jules pacontent</p>
                            </div>
                        
                        </div> 
                    </div>
                    <input type="hidden" name="distancearr" value="<?php echo($distancearr); ?>">
                    <input type="hidden" name="address1" value="<?php echo($address1); ?>">
                    <input type="hidden" name="address2" value="<?php echo($address2); ?>">
                    <input type="hidden" name="prix" value="<?php echo($prix); ?>">
                    <input type="hidden" name="time" value="<?php echo($time); ?>">
                    
                    <div class="paiement">
                        <button type="submit">Allons-y</button>
                    </div> 
                
                </div>
            </form>
        
        </div>  
    </div>

    <script>
        const AddressDep = "<?php echo $address1 ?>";
        const AddressArr = "<?php echo $address2 ?>";
        const DepLat = "<?php echo $coords1['lat'] ?>";
        const DepLon = "<?php echo $coords1['lon'] ?>";
        const ArrLat = "<?php echo $coords2['lat'] ?>";
        const ArrLon = "<?php echo $coords2['lon'] ?>";

        // Récupérer la clé d'API de LocationIQ
        const API_KEY = "pk.3c25a2f96c2f5abe1a062d5e13e1152a";

        // Créer une carte avec Leaflet
        const mymap = L.map('mapid').setView([51.505, -0.09], 13);

        // Ajouter un fond de carte
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
    }).addTo(mymap);

        // Ajouter un marqueur pour le point de départ
        L.marker([DepLat, DepLon]).addTo(mymap)
            .bindPopup("<b>Départ</b><br>" + AddressDep).openPopup();

        // Ajouter un marqueur pour le point d'arrivée
        L.marker([ArrLat, ArrLon]).addTo(mymap)
            .bindPopup("<b>Arrivée</b><br>"+ AddressArr).openPopup();

        // Ajouter une ligne entre les deux points
        const latlngs = [
            [DepLat, DepLon],
            [ArrLat, ArrLon]
        ];

        const polyline = L.polyline(latlngs, {color: 'violet'}).addTo(mymap);

        // Centrer la carte sur l'itinéraire
        const bounds = polyline.getBounds();
        mymap.fitBounds(bounds);


       var div1 = document.getElementById("div1");
       var div2 = document.getElementById("div2");
       var div3 = document.getElementById("div3");
       var div4 = document.getElementById("div4");
       var chauffeur = document.getElementById("chauffeur");

        div1.addEventListener("click", function() {
          chauffeur.innerHTML = `    
                <img src="Image/tete1.jpg"  class="main-picture">
                
                <div class="description">
                    
                    <div class="flex-align img-icon">
                        <img src="Image/iconCar.png">
                        <p><?php echo $utilisateur1['vehicule'] ?></p>
                    </div>

                    <div class="flex-align img-icon2" >
                        <img src="Image/femme.png">
                        <p><?php echo $utilisateur1['nom'].' '.$utilisateur1['prenom'] ?></p>
                    </div>
                
                </div>`;
        });

        div2.addEventListener("click", function() {
            chauffeur.innerHTML = `    
                <img src="Image/tete2.jpg"  class="main-picture">
                
                <div class="description">
                    
                    <div class="flex-align img-icon">
                        <img src="Image/iconCar.png">
                        <p><?php echo $utilisateur2['vehicule'] ?></p>
                    </div>

                    <div class="flex-align img-icon2" >
                        <img src="Image/femme.png">
                        <p><?php echo $utilisateur2['nom'].' '.$utilisateur2['prenom'] ?></p>
                    </div>
                
                </div>`;
        });

        div3.addEventListener("click", function() {
            chauffeur.innerHTML = `    
                <img src="Image/tete3.jpg"  class="main-picture">
                
                <div class="description">
                    
                    <div class="flex-align img-icon">
                        <img src="Image/iconCar.png">
                        <p><?php echo $utilisateur3['vehicule'] ?></p>
                    </div>

                    <div class="flex-align img-icon2" >
                        <img src="Image/femme.png">
                        <p><?php echo $utilisateur3['nom'].' '.$utilisateur3['prenom'] ?></p>
                    </div>
                
                </div>`;
        });
        div4.addEventListener("click", function() {
            chauffeur.innerHTML = `    
            <img src="Image/therock.webp"  class="main-picture">
            
            <div class="description">
                
                <div class="flex-align img-icon">
                    <img src="Image/iconCar.png">
                    <p><?php echo $utilisateur4['vehicule'] ?></p>
                </div>

                <div class="flex-align img-icon2" >
                    <img src="Image/femme.png">
                    <p><?php echo $utilisateur4['nom'].' '.$utilisateur4['prenom'] ?></p>
                </div>
            
            </div>`;
        });

    </script>

</body>
</html>