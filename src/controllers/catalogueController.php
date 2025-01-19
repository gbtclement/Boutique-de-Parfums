<?php

include __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../models/categorieModel.php';
require_once  __DIR__ . '/../models/produitModel.php';

function connectCatalogue($pdo)
{
    // Récupérer toutes les catégories
    $categories = Categorie::getAllCategory($pdo);
    // Récupérer l'ID de la catégorie depuis l'URL
    $categorieId = isset($_GET['categorie']) ? (int)$_GET['categorie'] : null;
    
    // Si une catégorie est sélectionnée, récupérer les produits de cette catégorie, sinon tous les produits
    $produits = $categorieId ? Produit::getAllByCategory($pdo, $categorieId) : Produit::getAllProduct($pdo);

    // Inclure la vue catalogue avec les données passées en paramètre
    include __DIR__ . '/../views/catalogue.php';
}
?>
