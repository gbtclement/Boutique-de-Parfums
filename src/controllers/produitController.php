<?php

include __DIR__ . '/../database/database.php';
include __DIR__ . '/../models/produitModel.php';
include_once __DIR__ . '/../models/categorieModel.php';
$success = null;
$error = null;

// Ajouter un produit
function createProduct($pdo) {
    global $error; 
    if (isset($_POST['submit'])) {
        $nom = $_POST['nom'] ?? null;
        $description = $_POST['description'] ?? null;
        $prix = $_POST['prix'] ?? null;
        $stock = $_POST['stock'] ?? null;
        $id_categorie = $_POST['id_categorie'] ?? null;

        if ($nom && $description && $prix && $stock && $id_categorie) {
            $produit = new Produit(null, $nom, $description, $prix, $stock, $id_categorie);
            if ($produit->createProduct($pdo)) {
                header('Location: index.php?action=listProduit&categorie=' . $id_categorie);
                exit();
            } else {
                $error = "Une erreur est survenue lors de l'ajout du produit.";
            }
        } else {
            $error = "Tous les champs sont obligatoires.";
        }
    }
}

// Modifier un produit
function updateProduct($pdo) {
    global $error; 
    if (isset($_POST['update'])) {
        $id = $_POST['id'] ?? null;
        $nom = $_POST['nom'] ?? null;
        $description = $_POST['description'] ?? null;
        $prix = $_POST['prix'] ?? null;
        $stock = $_POST['stock'] ?? null;
        $id_categorie = $_POST['id_categorie'] ?? null;

        if ($id && $nom && $description && $prix && $stock && $id_categorie) {
            $produit = new Produit($id, $nom, $description, $prix, $stock, $id_categorie);
            if ($produit->updateProduct($pdo)) {
                header('Location: index.php?action=listProduit&categorie=' . $id_categorie);
                exit();
            } else {
                $error = "Une erreur est survenue lors de la mise à jour du produit.";
            }
        } else {
            $error = "Tous les champs sont obligatoires.";
        }
    }
}

// Supprimer des produits
function deleteProduct($pdo) {
    global $error; 
    if (isset($_POST['delete'])) {
        $productsToDelete = $_POST['products'] ?? [];
        if (!empty($productsToDelete)) {
            foreach ($productsToDelete as $productId) {
                Produit::deleteProduct($pdo, $productId);
            }
            header('Location: index.php?action=listProduit&categorie=' . ($_GET['categorie'] ?? ''));
            exit();
        } else {
            $error = "Veuillez sélectionner au moins un produit à supprimer.";
        }
    }
}

// Récupérer tous les produits pour l'affichage
function listProduct($pdo) {
    global $success, $error; 
    $id_categorie = isset($_GET['categorie']) ? $_GET['categorie'] : null;
    $products = $id_categorie ? Produit::getAllByCategory($pdo, $id_categorie) : Produit::getAllProduct($pdo);
    $categories = Categorie::getAllCategory($pdo); // Ajout de la récupération des catégories
    include __DIR__ . '/../views/produitView.php';
}

?>
