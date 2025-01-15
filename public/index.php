
<?php
// Inclure les dépendances
require_once '../src/controllers/categorieController.php';

// Récupérer l'action depuis l'URL
$action = $_GET['action'] ?? 'home';

// Routage des actions
switch ($action) {
    case 'home':
        header("Location: ../src/views/accueil.php");
        exit();
        break;

    case 'listCategorie':
        listCategories($pdo);
        break;

    case 'createCategorie':
        createCategory($pdo);
        break;

    case 'updateCategorie':
        updateCategory($pdo);
        break;

    case 'deleteCategories':
        deleteCategories($pdo);
        break;

    default:
        echo "Action inconnue.";
        break;
}
?>


