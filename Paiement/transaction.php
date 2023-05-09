<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family= Paytone+One & family =Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,800 & display= swap" rel="stylesheet">
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

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numbercard = $_POST['numero'];
    $dateexp = $_POST['date'];
    $cvc = $_POST['cvc'];

    $sql = "INSERT INTO paiement (nom, prenom, numbercard, dateexp, cvc) VALUES (:nom, :prenom, :numbercard, :dateexp, :cvc)";
    $stmt = $bdd->prepare($sql);

    // Exécuter la requête avec les paramètres
    $stmt->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'numbercard' => $numbercard,
        'dateexp' => $dateexp,
        'cvc' => $cvc

    ]);

    // Vérifier si l'insertion a réussi
    if ($stmt->rowCount() > 0) {
        echo "Les adresses ont été ajoutées avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'ajout des adresses.";
    }



?>