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

    // Getter pour la description
    public function getDescription()
    {
        return $this->description;
    }

    // Setter pour la description
    public function setDescription($description)
    {
        $this->description = $description;
    }

    // Getter pour le prix
    public function getPrix()
    {
        return $this->prix;
    }

    // Setter pour le prix
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    // Getter pour le stock
    public function getStock()
    {
        return $this->stock;
    }

    // Setter pour le stock
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    // Getter pour l'id_categorie
    public function getIdCategorie()
    {
        return $this->id_categorie;
    }

    // Setter pour l'id_categorie
    public function setIdCategorie($id_categorie)
    {
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
        // Utilisation d'une jointure LEFT JOIN pour lier les produits avec les catégories
        $sql = "SELECT p.* 
            FROM produit p
            LEFT JOIN categorie c ON p.id_categorie = c.id 
            WHERE p.id_categorie = :id_categorie";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_categorie', $id_categorie, PDO::PARAM_INT);
        $stmt->execute();

        $produits = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $produits[] = new self($row['id'], $row['nom'], $row['description'], $row['prix'], $row['stock'], $row['id_categorie']);
        }

        return $produits;
    }
}
