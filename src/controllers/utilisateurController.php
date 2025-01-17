<?php

include __DIR__ . '/../database/database.php';
include __DIR__ . '/../models/utilisateurModel.php';

$success = null;
$error = null;

// Inscription d'un utilisateur
function registerUser($pdo)
{
    global $success, $error;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'] ?? null;
        $prenom = $_POST['prenom'] ?? null;
        $email = $_POST['email'] ?? null;
        $mot_de_passe = $_POST['mot_de_passe'] ?? null;

        if ($nom && $prenom && $email && $mot_de_passe) {
            $mot_de_passe_md5 = md5($mot_de_passe);
            $utilisateur = new Utilisateur(null, $nom, $prenom, $email, $mot_de_passe_md5, 'client');

            if ($utilisateur->createUtilisateur($pdo)) {
                $success = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
                header("Location: index.php?action=connexionUtilisateur");
                exit();
            } else {
                $error = "Une erreur est survenue lors de l'inscription.";
            }
        } else {
            $error = "Tous les champs sont requis.";
        }
    }
    include __DIR__ . '/../views/inscriptionView.php';
}

// Connexion d'un utilisateur
function loginUser($pdo)
{
    global $success, $error;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? null;
        $mot_de_passe = $_POST['mot_de_passe'] ?? null;

        if ($email && $mot_de_passe) {
            $mot_de_passe_md5 = md5($mot_de_passe);

            $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($utilisateur && $utilisateur['mot_de_passe'] === $mot_de_passe_md5) {
                session_start();
                $_SESSION['user_id'] = $utilisateur['id'];
                $_SESSION['user_role'] = $utilisateur['role'];

                header("Location: index.php?action=compte");
                exit();
            } else {
                $error = "Email ou mot de passe incorrect.";
            }
        } else {
            $error = "Tous les champs sont requis.";
        }
    }
    include __DIR__ . '/../views/connexionView.php';
}

// Récupérer tous les utilisateurs
function listUsers($pdo)
{
    return Utilisateur::getAllUtilisateur($pdo);
}

// Modifier un utilisateur
function updateUser($pdo)
{
    global $success, $error;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $id = $_POST['id'] ?? null;
        $nom = $_POST['nom'] ?? null;
        $prenom = $_POST['prenom'] ?? null;
        $email = $_POST['email'] ?? null;
        $mot_de_passe = $_POST['mot_de_passe'] ?? null;
        $role = $_POST['role'] ?? 'client';

        if ($id && $nom && $prenom && $email) {
            $mot_de_passe_md5 = $mot_de_passe ? md5($mot_de_passe) : null;

            $utilisateur = new Utilisateur($id, $nom, $prenom, $email, $mot_de_passe_md5, $role);

            if ($utilisateur->updateUtilisateur($pdo)) {
                $success = "Utilisateur mis à jour avec succès.";
                header("Location: admin.php?action=listUsers");
                exit();
            } else {
                $error = "Une erreur est survenue lors de la mise à jour.";
            }
        } else {
            $error = "Tous les champs requis ne sont pas remplis.";
        }
    }
}

// Supprimer un utilisateur
function deleteUser($pdo)
{
    global $success, $error;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
        $id = $_POST['id'] ?? null;

        if ($id) {
            if (Utilisateur::deleteUtilisateur($pdo, $id)) {
                $success = "Utilisateur supprimé avec succès.";
                header("Location: admin.php?action=listUsers");
                exit();
            } else {
                $error = "Une erreur est survenue lors de la suppression.";
            }
        } else {
            $error = "Aucun utilisateur sélectionné pour la suppression.";
        }
    }
}

?>
