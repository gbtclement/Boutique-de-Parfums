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

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    // CRUD Methods
    // Create
    public function create(PDO $pdo)
    {
        $sql = "INSERT INTO categorie (nom) VALUES (:nom)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $this->nom);
        return $stmt->execute();
    }

    // Read
    public static function read(PDO $pdo, $id)
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
    public function update(PDO $pdo)
    {
        $sql = "UPDATE categorie SET nom = :nom WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':nom', $this->nom);
        return $stmt->execute();
    }

    // Delete
    public static function delete(PDO $pdo, $id)
    {
        $sql = "DELETE FROM categorie WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Static Method to Get All Categories
    public static function getAll(PDO $pdo)
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
?>
