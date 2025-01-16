
<?php
// Inclure les dépendances
require_once '../src/controllers/categorieController.php';
require_once '../src/controllers/produitController.php';

// Récupérer l'action depuis l'URL
$action = $_GET['action'] ?? 'home';

// Routage des actions
switch ($action) {
    case 'home':
        header("Location: ../src/views/accueil.php");
        exit();
        break;

    case 'listCategories':
        listCategories($pdo);
        break;
    
    case 'listProduits':
        listProduits($pdo);
        break;

    case 'createCategorie':
        createCategory($pdo);
        break;

    case 'createProduit':
        createProduit($pdo);
        break;

    case 'updateCategorie':
        updateCategory($pdo);
        break;

    case 'updateProduit':
        updateProduit($pdo);
        break;

    case 'deleteCategories':
        deleteCategories($pdo);
        break;

    case 'deleteProduit':
        deleteProduit($pdo);
        break;

    default:
        echo "Action inconnue.";
        break;
}
?>


