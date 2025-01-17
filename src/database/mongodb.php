<?php

require 'D:\xammp\htdocs\Boutique-de-Parfums-main\vendor/autoload.php';  // Assurez-vous que le chemin est correct

$client = new MongoDB\Client("mongodb://admin:admin@127.0.0.1:27017");

// Sélectionner la base de données
$database = $client->boutiqueDeParfums; // Remplacez par le nom de votre base de données

// Accéder à la collection 'articles'
$articlesCollection = $database->articles;
?>



