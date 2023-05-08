<?php
require_once 'config.php';
// Démarrage de la session
session_start();

// Si l'utilisateur est connecté, déconnectez-le
if(isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    session_unset();
    session_destroy();
}

// Redirection vers la page d'accueil
header("Location: ../index.php");
exit();
?>