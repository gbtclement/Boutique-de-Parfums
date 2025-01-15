<?php
include '../database/database.php';
include '../models/categorieModel.php';
session_start(); // Démarre la session

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer l'email et le mot de passe du formulaire
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Convertir le mot de passe en MD5
    $mot_de_passe_md5 = md5($mot_de_passe);

    // Debugging: afficher les valeurs du mot de passe et du MD5
    echo "Mot de passe : " . $mot_de_passe . "<br>"; // Affiche le mot de passe saisi
    echo "MD5 du mot de passe : " . $mot_de_passe_md5 . "<br>"; // Affiche le mot de passe en MD5

    // Rechercher l'utilisateur dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    // Debugging: afficher les données récupérées de la base de données
    if ($utilisateur) {
        echo "Mot de passe stocké en base (MD5) : " . $utilisateur['mot_de_passe'] . "<br>"; // Affiche le mot de passe stocké en base
    }

    // Vérifier si l'utilisateur existe et si le mot de passe MD5 est correct
    if ($utilisateur && $utilisateur['mot_de_passe'] === $mot_de_passe_md5) {
        // Connexion réussie, enregistrer l'ID de l'utilisateur en session
        $_SESSION['user_id'] = $utilisateur['id'];
        $_SESSION['user_role'] = $utilisateur['role'];
        echo "Connexion réussie !";
        // Rediriger vers la page du compte
        header("Location: compte.php");
        exit();
    } else {
        echo "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h2>Se connecter</h2>

    <!-- Formulaire de connexion -->
    <form method="POST" action="connexion.php">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
        <br><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" required>
        <br><br>

        <button type="submit">Se connecter</button>
    </form>

    <!-- Lien vers la page d'inscription -->
    <br>
    <button onclick="window.location.href='inscription.php';">S'inscrire</button>
</body>
</html>