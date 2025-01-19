<?php 
include __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../models/utilisateurModel.php';

function showAccount($pdo) {
    include __DIR__ . '/../views/compte.php';
}

function clientUser() {
    echo '<div class="user-info">';
    echo '<h1>Mon Compte</h1>';
    echo '<div class="role-badge client">Client</div>';
    echo '<p class="welcome-message">Bienvenue sur votre espace client</p>';
    echo '</div>';
}

function adminUser() {
    echo '<div class="user-info">';
    echo '<h1>Mon Compte</h1>';
    echo '<div class="role-badge admin">Administrateur</div>';
    echo '<p class="welcome-message">Bienvenue sur votre espace administrateur</p>';
    echo '<div class="admin-links">';
    echo '<a href="index.php?action=listCategorie" class="admin-link">Gérer les catégories</a>';
    echo '<a href="index.php?action=listProduit" class="admin-link">Gérer les produits</a>';
    echo '</div>';
    echo '</div>';
}
?>