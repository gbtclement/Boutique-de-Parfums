<?php

namespace src\Controllers;

use src\Models\MongoConnection;

class MongoController
{
    private $connection;

    public function __construct()
    {
        $url = "mongodb://admin:admin@localhost:27017/admin";
        $dbName = "boutiqueDeParfums"; 
        $this->connection = new MongoConnection($url, $dbName);
    }

    public function testConnection()
    {
        try {
            $this->connection->connect();
            echo "Connexion réussie à la base MongoDB.<br>";

            // Exemple d'utilisation
            $database = $this->connection->getDatabase();
            echo "Liste des collections dans la base '{$database->getDatabaseName()}':<br>";
            foreach ($database->listCollections() as $collection) {
                echo "- " . $collection->getName() . "<br>";
            }

            // Déconnexion explicite (facultatif)
            $this->connection->disconnect();
        } catch (\Exception $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}
