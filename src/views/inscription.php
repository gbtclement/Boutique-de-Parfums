<?php
include '../database/database.php';
include '../models/categorieModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connexion à la base de données (exemple PDO)

    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Convertir le mot de passe en MD5
    $mot_de_passe_md5 = md5($mot_de_passe);

    // Insérer l'utilisateur dans la base de données
    $stmt = $pdo->prepare("INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, role) VALUES (:nom, :prenom, :email, :mot_de_passe, :role)");
    $role = 'client'; // Par défaut, le rôle est 'client'
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mot_de_passe', $mot_de_passe_md5);
    $stmt->bindParam(':role', $role);
    
    if ($stmt->execute()) {
        echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
    } else {
        echo "Erreur lors de l'inscription.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h2>S'inscrire</h2>

    <!-- Formulaire d'inscription -->
    <form method="POST" action="inscription.php">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>
        <br><br>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" required>
        <br><br>

        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
        <br><br>

        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" name="mot_de_passe" id="mot_de_passe" required>
        <br><br>

        <button type="submit">S'inscrire</button>
    </form>

    <!-- Lien vers la page de connexion -->
    <br>
    <button onclick="window.location.href='connexion.php';">Se connecter</button>
</body>
</html>
