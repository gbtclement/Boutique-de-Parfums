<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit(); 
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: connexion.php");
    exit();
}

echo "Bienvenue sur votre compte, utilisateur ID : " . htmlspecialchars($_SESSION['user_id']);
?>

<form method="POST">
    <button type="submit" name="logout">Se déconnecter</button>
</form>
