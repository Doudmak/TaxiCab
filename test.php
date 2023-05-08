<?php 
    require_once 'config.php';

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
        var_dump($url);
        $response = file_get_contents($url);
        var_dump($response);
        $data = json_decode($response, true);
        $distance = $data['routes'][0]['distance'] / 1000; // Convertir la distance en kilomètres
        return $distance;

    }

    // Exemple d'utilisation : calculer la distance entre deux adresses
    $address1 = "7 Allée du jura, Sevran 93270";
    $address2 = "7 Rue Aimé Laperruque, Drancy 93700";
    $coords1 = getCoordinates($address1);
    $coords2 = getCoordinates($address2);
    $distance = getDistance($coords1['lat'], $coords1['lon'], $coords2['lat'], $coords2['lon']);
    //$distance = getDistance($coords1['lat'], $coords1['lon'], $coords2['lat'], $coords2['lon']);
    echo "La distance entre $address1 et $address2 est de $distance km.";

$nombreAleatoire = rand(1, 361);

// Vérifier si le nombre existe déjà dans la base de données

$stmt = $bdd->prepare("SELECT COUNT(*) FROM trajet WHERE num_trajet = ?");
$stmt->execute([$nombreAleatoire]);
$nombreDeResultats = $stmt->fetchColumn();

// Tant que le nombre existe déjà, en générer un nouveau
while ($nombreDeResultats > 0) {
    $nombreAleatoire = rand(1, 361);
    $stmt->execute([$nombreAleatoire]);
    $nombreDeResultats = $stmt->fetchColumn();
}
echo ($nombreAleatoire);
?>