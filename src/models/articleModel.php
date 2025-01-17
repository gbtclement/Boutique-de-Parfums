<?php

require_once __DIR__ . '/../../vendor/autoload.php';

// Se connecter à MongoDB
function connectToMongoDB() {
    try {
        $client = new MongoDB\Client("mongodb://localhost:27017");
        return $client->boutiqueDeParfums; // Accéder à la base de données
    } catch (Exception $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}

// Ajouter un article à la base de données
function addArticleToDB($titre, $contenu, $auteur, $tags) {
    $db = connectToMongoDB();
    $articlesCollection = $db->articles;
    
    $article = [
        'titre' => $titre,
        'contenu' => $contenu,
        'auteur' => $auteur,
        'date_creation' => new MongoDB\BSON\UTCDateTime(),
        'tags' => $tags
    ];

    $articlesCollection->insertOne($article);
}

// Récupérer tous les articles de la base de données
function getAllArticles()
{
    $collection = connectToMongoDB()->articles;
    $articles = $collection->find();

    $articlesArray = [];
    foreach ($articles as $article) {
        $article['tags'] = isset($article['tags']) ? (array)$article['tags'] : [];
        $articlesArray[] = $article;
    }

    return $articlesArray;
}

