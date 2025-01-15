<?php
// Redirige vers accueil.php
header("Location: src/views/accueil.php");
exit(); ?>
 <?php
/*
require_once __DIR__ . '/src/controller/gestionCategorieController.php';

$action = $_GET['action'] ?? 'list';

// Appelle la méthode correspondante dans le contrôleur
switch ($action) {
    case 'list':
        listCategories();
        break;
    case 'create':
        createCategory();
        break;
    case 'update':
        updateCategory();
        break;
    case 'delete':
        deleteCategories();
        break;
    default:
        echo "Action inconnue.";
        break;
}
*/
?>

