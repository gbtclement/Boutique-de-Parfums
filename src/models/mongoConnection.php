<?php

namespace src\Models;

use MongoDB\Client;
use MongoDB\Exception\Exception;

class MongoConnection
{
    private $client;
    private $database;
    private $uri;
    private $dbName;

    public function __construct(string $uri, string $dbName)
    {
        $this->uri = $uri;
        $this->dbName = $dbName;
    }

    /**
     * Ouvre une connexion à MongoDB.
     *
     * @return void
     * @throws \Exception
     */
    public function connect(): void
    {
        try {
            $this->client = new Client($this->uri);
            $this->database = $this->client->selectDatabase($this->dbName);
        } catch (Exception $e) {
            throw new \Exception("Erreur lors de la connexion à MongoDB : " . $e->getMessage());
        }
    }

    /**
     * Obtient l'instance de la base de données.
     *
     * @return \MongoDB\Database
     * @throws \Exception
     */
    public function getDatabase()
    {
        if (!$this->database) {
            throw new \Exception("Aucune connexion active. Appelez la méthode connect() d'abord.");
        }
        return $this->database;
    }

    /**
     * Ferme la connexion (garbage collector de PHP gère automatiquement cela,
     * mais cette méthode est utile pour un nettoyage explicite si nécessaire).
     */
    public function disconnect(): void
    {
        $this->client = null;
        $this->database = null;
    }
}
