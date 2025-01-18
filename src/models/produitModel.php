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

    // CRUD Methods
    // Create
    public function createProduct(PDO $pdo)
    {
        $sql = "INSERT INTO produit (nom, description, prix, stock, id_categorie) VALUES (:nom, :description, :prix, :stock, :id_categorie)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':prix', $this->prix);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':id_categorie', $this->id_categorie);
        return $stmt->execute();
    }

    // Read
    public static function readProduct(PDO $pdo, $id)
    {
        $sql = "SELECT * FROM produit WHERE id = :id";
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
    public function updateProduct(PDO $pdo)
    {
        $sql = "UPDATE produit SET nom = :nom, description = :description, prix = :prix, stock = :stock, id_categorie = :id_categorie WHERE id = :id";
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
    public static function deleteProduct(PDO $pdo, $id)
    {
        $sql = "DELETE FROM produit WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Static Method to Get All Products
    public static function getAllProduct(PDO $pdo)
    {
        $sql = "SELECT * FROM produit";
        $stmt = $pdo->query($sql);
        $produits = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $produits[] = new self($row['id'], $row['nom'], $row['description'], $row['prix'], $row['stock'], $row['id_categorie']);
        }

        return $produits;
    }

    public static function getAllByCategory(PDO $pdo, $id_categorie)
    {
        $sql = "SELECT * FROM produit WHERE id_categorie = :id_categorie";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_categorie', $id_categorie);
        $stmt->execute();
        $produits = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $produits[] = new self($row['id'], $row['nom'], $row['description'], $row['prix'], $row['stock'], $row['id_categorie']);
        }

        return $produits;
    }
}
