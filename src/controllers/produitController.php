<?php

// Inclusion des fichiers nécessaires
include __DIR__ . '/../database/database.php';
include_once __DIR__ . '/../models/categorieModel.php';
include __DIR__ . '/../models/produitModel.php';


// Récupérer les produits d'une catégorie sélectionnée
$selectedCategoryId = $_GET['categorie'] ?? null;
$produits = $selectedCategoryId ? Produit::getAllByCategory($pdo, $selectedCategoryId) : [];

// Récupérer le produit sélectionné pour modification
$selectedProductId = $_GET['produit'] ?? null;
$selectedProduct = $selectedProductId ? Produit::read($pdo, $selectedProductId) : null;

// Ajouter un produit
function createProduit($pdo) {
    if (isset($_POST['submit'])) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $stock = $_POST['stock'];
        $id_categorie = $_POST['id_categorie'];

        $produit = new Produit(null, $nom, $description, $prix, $stock, $id_categorie);

        if ($produit->create($pdo)) {
            echo "<p>Produit ajouté avec succès.</p>";
            header("Location: gestion_produit.php?categorie=$id_categorie");
            exit();
        } else {
            echo "<p>Erreur lors de l'ajout du produit.</p>";
        }
    }
}

// Modifier un produit
function updateProduit($pdo) {
    if (isset($_POST['update'])) {
        $id = $_POST['id_produit'];
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $stock = $_POST['stock'];
        $id_categorie = $_POST['id_categorie'];

        $produit = new Produit($id, $nom, $description, $prix, $stock, $id_categorie);

        if ($produit->update($pdo)) {
            echo "<p>Produit mis à jour avec succès.</p>";
            header("Location: gestion_produit.php?categorie=$id_categorie");
            exit();
        } else {
            echo "<p>Erreur lors de la mise à jour du produit.</p>";
        }
    }
}

    // Supprimer un produit
function deleteProduit($pdo) {
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        if (Produit::delete($pdo, $id)) {
            echo "<p>Produit supprimé avec succès.</p>";
            header("Location: gestion_produit.php?categorie=$selectedCategoryId");
            exit();
        } else {
            echo "<p>Erreur lors de la suppression du produit.</p>";
        }
    }
}

// Récupérer toutes les catégories pour l'affichage
function listProduits($pdo) {
    global $success, $error;
    $produits = Produit::getAll($pdo);
    $categories = Categorie::getAll($pdo);

    // Récupérer les produits d'une catégorie sélectionnée
    $selectedCategoryId = $_GET['categorie'] ?? null;
    $produits = $selectedCategoryId ? Produit::getAllByCategory($pdo, $selectedCategoryId) : [];

    // Récupérer le produit sélectionné pour modification
    $selectedProductId = $_GET['produit'] ?? null;
    $selectedProduct = $selectedProductId ? Produit::read($pdo, $selectedProductId) : null;

    include __DIR__ . '/../views/produitView.php';
}
?>