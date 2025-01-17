<?php
// Inclure le modèle pour pouvoir utiliser ses fonctions
require_once __DIR__ .  '/../models/articleModel.php';

class ArticleController {

    public function __construct() {
        // Si l'utilisateur soumet un article
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->addArticle();
        }

        // Récupérer tous les articles
        $this->listArticles();
    }

    // Ajouter un article
    public function addArticle() {
        $titre = $_POST['titre'];
        $contenu = $_POST['contenu'];
        $auteur = $_POST['auteur'];
        $tags = isset($_POST['tags']) ? explode(',', $_POST['tags']) : [];

        // Appeler la méthode du modèle pour insérer l'article
        addArticleToDB($titre, $contenu, $auteur, $tags);
    }

    // Lister tous les articles
    public function listArticles() {
        // Appeler la méthode du modèle pour récupérer les articles
        $articles = getAllArticles();

        // Inclure la vue pour afficher les articles
        require_once __DIR__ . '/../views/article.php';
    }
}
