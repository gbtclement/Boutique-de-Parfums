<?php

class CommandeProduit
{
    private $id;
    private $id_commande;
    private $id_produit;
    private $quantite;
    private $prix_unitaire;

    // Constructeur
    public function __construct($id = null, $id_commande = null, $id_produit = null, $quantite = null, $prix_unitaire = null)
    {
        $this->id = $id;
        $this->id_commande = $id_commande;
        $this->id_produit = $id_produit;
        $this->quantite = $quantite;
        $this->prix_unitaire = $prix_unitaire;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getIdCommande()
    {
        return $this->id_commande;
    }

    public function getIdProduit()
    {
        return $this->id_produit;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }

    public function getPrixUnitaire()
    {
        return $this->prix_unitaire;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setIdCommande($id_commande)
    {
        $this->id_commande = $id_commande;
    }

    public function setIdProduit($id_produit)
    {
        $this->id_produit = $id_produit;
    }

    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    public function setPrixUnitaire($prix_unitaire)
    {
        $this->prix_unitaire = $prix_unitaire;
    }

    // CRUD Methods
    // Create
    public function create(PDO $pdo)
    {
        $sql = "INSERT INTO commande_produits (id_commande, id_produit, quantite, prix_unitaire) VALUES (:id_commande, :id_produit, :quantite, :prix_unitaire)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_commande', $this->id_commande);
        $stmt->bindParam(':id_produit', $this->id_produit);
        $stmt->bindParam(':quantite', $this->quantite);
        $stmt->bindParam(':prix_unitaire', $this->prix_unitaire);
        return $stmt->execute();
    }

    // Read
    public static function read(PDO $pdo, $id)
    {
        $sql = "SELECT * FROM commande_produits WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new self($row['id'], $row['id_commande'], $row['id_produit'], $row['quantite'], $row['prix_unitaire']);
        }
        return null;
    }

    // Update
    public function update(PDO $pdo)
    {
        $sql = "UPDATE commande_produits SET id_commande = :id_commande, id_produit = :id_produit, quantite = :quantite, prix_unitaire = :prix_unitaire WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':id_commande', $this->id_commande);
        $stmt->bindParam(':id_produit', $this->id_produit);
        $stmt->bindParam(':quantite', $this->quantite);
        $stmt->bindParam(':prix_unitaire', $this->prix_unitaire);
        return $stmt->execute();
    }

    // Delete
    public static function delete(PDO $pdo, $id)
    {
        $sql = "DELETE FROM commande_produits WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Static Method to Get All CommandeProduit
    public static function getAll(PDO $pdo)
    {
        $sql = "SELECT * FROM commande_produits";
        $stmt = $pdo->query($sql);
        $commandeProduits = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $commandeProduits[] = new self($row['id'], $row['id_commande'], $row['id_produit'], $row['quantite'], $row['prix_unitaire']);
        }

        return $commandeProduits;
    }
}
?>
