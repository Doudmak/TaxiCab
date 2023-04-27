<?php
$nom = "Ulric";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    Bonjour <?php echo $nom ;?>
    <form action="#" method="post">
        <input type="text" placeholder="email" name="mailco" id="mailco">
        <input type="password" placeholder="Mot de passe" name="mdpco" id="mdpco">
        <input type="submit">
        <?php 
        if (empty($_POST['mailco']) && empty($_POST['mdpco'])){
        echo "Inscription effectuée";
        } 
    
        if (!isset($_POST['mailco']) && !isset($_POST['mdpco'])) {
            echo "Remplir le formulaire";
        } else if(!isset($mail)) {
            echo "Mail non rempli";
        } else if (!isset($mdp)){
            echo "MDP non renseigné";
        }
        ?>
    </form>
    
</body>
</html>