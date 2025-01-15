
<?php
// Inclure les dépendances
require_once __DIR__ . '/src/controllers/gestionCategorieController.php';

// Récupérer l'action depuis l'URL
$action = $_GET['action'] ?? 'home';

// Routage des actions
switch ($action) {
    case 'home':
        header("Location: accueil.php");
        exit();
        break;

    case 'list':
        listCategories($pdo);
        break;

    case 'create':
        createCategory($pdo);
        break;

    case 'update':
        updateCategory($pdo);
        break;

    case 'delete':
        deleteCategories($pdo);
        break;

    default:
        echo "Action inconnue.";
        break;
}
?>


