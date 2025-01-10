<?php

class Produit
{
    private $id;
    private $nom;
    private $description;
    private $prix;
    private $stock;
    private $id_categorie;

    // Constructeur
    public function __construct($id = null, $nom = null, $description = null, $prix = null, $stock = null, $id_categorie = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->prix = $prix;
        $this->stock = $stock;
        $this->id_categorie = $id_categorie;
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

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function getIdCategorie()
    {
        return $this->id_categorie;
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

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function setIdCategorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;
    }

    // CRUD Methods
    // Create
    public function create(PDO $pdo)
    {
        $sql = "INSERT INTO produits (nom, description, prix, stock, id_categorie) VALUES (:nom, :description, :prix, :stock, :id_categorie)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':prix', $this->prix);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':id_categorie', $this->id_categorie);
        return $stmt->execute();
    }

    // Read
    public static function read(PDO $pdo, $id)
    {
        $sql = "SELECT * FROM produits WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new self($row['id'], $row['nom'], $row['description'], $row['prix'], $row['stock'], $row['id_categorie']);
        }
        return null;
    }

    // Update
    public function update(PDO $pdo)
    {
        $sql = "UPDATE produits SET nom = :nom, description = :description, prix = :prix, stock = :stock, id_categorie = :id_categorie WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':prix', $this->prix);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':id_categorie', $this->id_categorie);
        return $stmt->execute();
    }

    // Delete
    public static function delete(PDO $pdo, $id)
    {
        $sql = "DELETE FROM produits WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Static Method to Get All Products
    public static function getAll(PDO $pdo)
    {
        $sql = "SELECT * FROM produits";
        $stmt = $pdo->query($sql);
        $produits = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $produits[] = new self($row['id'], $row['nom'], $row['description'], $row['prix'], $row['stock'], $row['id_categorie']);
        }

        return $produits;
    }
}
?>
