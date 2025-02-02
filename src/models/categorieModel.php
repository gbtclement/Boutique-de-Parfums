<?php

class Categorie
{
    private $id;
    private $nom;

    // Constructeur
    public function __construct($id = null, $nom = null)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    // Getter pour l'id
    public function getId()
    {
        return $this->id;
    }

    // Setter pour l'id
    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter pour le nom
    public function getNom()
    {
        return $this->nom;
    }

    // Setter pour le nom
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    // CRUD Methods

    // Create
    public function createCategory(PDO $pdo)
    {
        $sql = "INSERT INTO categorie (nom) VALUES (:nom)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $this->nom);
        return $stmt->execute();
    }

    // Read
    public static function readCategory(PDO $pdo, $id)
    {
        $sql = "SELECT * FROM categorie WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new self($row['id'], $row['nom']);
        }
        return null;
    }

    // Update
    public function updateCategory(PDO $pdo)
    {
        $sql = "UPDATE categorie SET nom = :nom WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':nom', $this->nom);
        return $stmt->execute();
    }

    // Delete
    public static function deleteCategory(PDO $pdo, $id)
    {
        $sql = "DELETE FROM categorie WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Static Method to Get All Categories
    public static function getAllCategory(PDO $pdo)
    {
        $sql = "SELECT * FROM categorie";
        $stmt = $pdo->query($sql);
        $categories = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = new self($row['id'], $row['nom']);
        }

        return $categories;
    }

}
