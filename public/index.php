
<?php
// Inclure les dépendances
require_once '../src/controllers/categorieController.php';
require_once '../src/controllers/produitController.php';
require_once '../src/controllers/utilisateurController.php';

// Récupérer l'action depuis l'URL
$action = $_GET['action'] ?? 'home';

// Routage des actions
switch ($action) {
    case 'home':
        header("Location: ../src/views/accueil.php");
        exit();
        break;

    case 'listCategorie':
        listCategory($pdo);
        break;

    case 'createCategorie':
        createCategory($pdo);
        break;

    case 'updateCategorie':
        updateCategory($pdo);
        break;

    case 'deleteCategories':
        deleteCategory($pdo);
        break;

    case 'listProduit':
        listProduct($pdo);
        break;

    case 'createProduit':
        createProduct($pdo);
        break;

    case 'updateProduit':
        updateProduct($pdo);
        break;

    case 'deleteProduit':
        deleteProduct($pdo);
        break;

    case 'connexionUtilisateur':
        loginUser($pdo);
        break;

    case 'inscriptionUtilisateur':
        registerUser($pdo);
        break;

    case 'compte':
        break;

    case 'catalogue':
        break;

    default:
        echo "Action inconnue.";
        break;
}
?>


