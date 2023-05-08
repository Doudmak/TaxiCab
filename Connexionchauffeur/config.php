<?php
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=taxicab;charset=utf8', 'root' , '');
    } catch(Exception $e)
    {
        die('Erreur'.$e->getMessage());
    }