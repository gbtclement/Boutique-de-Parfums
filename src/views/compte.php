<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: src/views/connexion.php");
    exit(); 
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: src/views/accueil.php");
    exit();
}

echo "Bienvenue sur votre compte, utilisateur ID : " . htmlspecialchars($_SESSION['user_id']);
?>

<form method="POST">
    <button type="submit" name="logout">Se déconnecter</button>
</form>
