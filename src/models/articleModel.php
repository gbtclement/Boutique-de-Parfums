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

// Fonction pour lister les articles
function listArticles() {
    $collection = connectToMongoDB()->articles;
    $articles = $collection->find();

    $articlesArray = [];
    foreach ($articles as $article) {
        $article['tags'] = isset($article['tags']) ? (array)$article['tags'] : [];
        $articlesArray[] = $article;
    }

    return $articlesArray;
}

// Fonction pour créer un nouvel article
function createArticle($titre, $contenu, $auteur, $tags) {
    $db = connectToMongoDB();
    $articlesCollection = $db->articles;

    $article = [
        'titre' => $titre,
        'contenu' => $contenu,
        'auteur' => $auteur,
        'date_creation' => new MongoDB\BSON\UTCDateTime(),
        'tags' => $tags
    ];

    try {
        $result = $articlesCollection->insertOne($article);
        echo "Article créé avec succès. ID : " . $result->getInsertedId() . "\n";
    } catch (Exception $e) {
        echo "Erreur lors de la création de l'article : " . $e->getMessage();
    }
}

// Fonction pour mettre à jour un article
function updateArticle($id, $updatedFields) {
    $db = connectToMongoDB();
    $articlesCollection = $db->articles;

    try {
        $result = $articlesCollection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => $updatedFields]
        );

        if ($result->getMatchedCount() > 0) {
            echo "Article mis à jour avec succès.\n";
        } else {
            echo "Aucun article trouvé avec cet ID.\n";
        }
    } catch (Exception $e) {
        echo "Erreur lors de la mise à jour de l'article : " . $e->getMessage();
    }
}

// Fonction pour supprimer un article
function deleteArticle($id) {
    $db = connectToMongoDB();
    $articlesCollection = $db->articles;

    try {
        $result = $articlesCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        
        if ($result->getDeletedCount() > 0) {
            echo "Article supprimé avec succès.\n";
        } else {
            echo "Aucun article trouvé avec cet ID.\n";
        }
    } catch (Exception $e) {
        echo "Erreur lors de la suppression de l'article : " . $e->getMessage();
    }
}

function getAllArticles() {
    try {
        $db = connectToMongoDB(); // Connexion à la base de données
        $articlesCollection = $db->articles; // Accéder à la collection "articles"
        
        // Récupérer tous les articles
        $articles = $articlesCollection->find();
        
        $articlesArray = [];
        foreach ($articles as $article) {
            // Convertir les données BSON en format lisible
            $articlesArray[] = [
                '_id' => (string)$article['_id'], // Convertir ObjectId en chaîne
                'titre' => $article['titre'],
                'contenu' => $article['contenu'],
                'auteur' => $article['auteur'],
                'date_creation' => $article['date_creation']->toDateTime()->format('Y-m-d H:i:s'),
                'tags' => isset($article['tags']) ? (array)$article['tags'] : []
            ];
        }

        return $articlesArray;
    } catch (Exception $e) {
        echo "Erreur lors de la récupération des articles : " . $e->getMessage();
        return [];
    }
}

