<?php
session_start();

// Inclure les dépendances
require_once '../src/controllers/categorieController.php';
require_once '../src/controllers/produitController.php';
require_once '../src/controllers/utilisateurController.php';
require_once '../src/controllers/articleController.php';
require_once '../src/controllers/catalogueController.php';
require_once '../src/controllers/compteController.php';

//new ArticleController();

//use src\controllers\MongoController;

// Récupérer l'action depuis l'URL
$action = $_GET['action'] ?? 'home';

if (isset($_SESSION['user_id'])) {
    $utilisateur = Utilisateur::readUtilisateur($pdo, $_SESSION['user_id']);
    if ($utilisateur->getRole() === 'client') {
        switch ($action) {
            case 'listCategorie':
            case 'createCategorie':
            case 'updateCategorie':
            case 'deleteCategorie':
            case 'listProduit':
            case 'createProduit':
            case 'updateProduit':
            case 'deleteProduit':
            case 'listArticle':
            case 'createArticle':
            case 'updateArticle':
            case 'deleteArticle':
                header("Location: ../src/views/accueil.php");
                exit();
                break;
        }
    }
}

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

        /*case 'listArticle':
        listArticles($pdo);
        break;
    
    case 'createArticle':
        createArticle($pdo);
        break;
    
    case 'updateArticle':
        updateArticle($pdo);
        break;
    
    case 'deleteArticle':
        deleteArticle($pdo);
        break;*/

    case 'connexionUtilisateur':
        if (isset($_SESSION['user_id'])) {
            header("Location: index.php?action=compte");
            exit(); // Assurez-vous de quitter après la redirection
        } else {
            loginUser($pdo);
        }
        break;


    case 'inscriptionUtilisateur':
        registerUser($pdo);
        break;

    case 'compte':
        showAccount($pdo);
        break;

    case 'catalogue':
        connectCatalogue($pdo);
        break;

    default:
        echo "Action inconnue.";
        break;
}
