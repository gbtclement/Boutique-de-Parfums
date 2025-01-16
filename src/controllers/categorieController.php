<?php 

include __DIR__ . '/../database/database.php';
include __DIR__ . '/../models/categorieModel.php';

$success = null;
$error = null;

// Ajouter une catégorie
function createCategory($pdo) {
    global $error; // Utilisation de la variable globale
    if (isset($_POST['submit'])) {
        $nom = $_POST['nom'] ?? null;

        if ($nom) {
            $categorie = new Categorie(null, $nom);
            if ($categorie->createCategory($pdo)) {
                header('Location: index.php?action=listCategorie');
                exit();
            } else {
                $error = "Une erreur est survenue lors de la création de la catégorie.";
            }
        } else {
            $error = "Le nom de la catégorie est requis.";
        }
    }
}

// Modifier une catégorie
function updateCategory($pdo) {
    global $error; // Utilisation de la variable globale
    if (isset($_POST['update'])) {
        $id = $_POST['id'] ?? null;
        $nom = $_POST['nom'] ?? null;

        if ($id && $nom) {
            $categorie = new Categorie($id, $nom);
            if ($categorie->updateCategory($pdo)) {
                header('Location: index.php?action=listCategorie');
                exit();
            } else {
                $error = "Une erreur est survenue lors de la mise à jour de la catégorie.";
            }
        } else {
            $error = "Veuillez sélectionner une catégorie et fournir un nouveau nom.";
        }
    }
}

// Supprimer des catégories
function deleteCategory($pdo) {
    global $error; // Utilisation de la variable globale
    if (isset($_POST['delete'])) {
        $categoriesToDelete = $_POST['categories'] ?? [];
        if (!empty($categoriesToDelete)) {
            foreach ($categoriesToDelete as $categoryId) {
                Categorie::deleteCategory($pdo, $categoryId);
            }
            header('Location: index.php?action=listCategorie');
            exit();
        } else {
            $error = "Veuillez sélectionner au moins une catégorie à supprimer.";
        }
    }
}

// Récupérer toutes les catégories pour l'affichage
function listCategory($pdo) {
    global $success, $error; // Utilisation des variables globales
    $categories = Categorie::getAllCategory($pdo);
    include __DIR__ . '/../views/categorieView.php';
}

?>
