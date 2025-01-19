<?php
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php?action=connexionUtilisateur");
    exit();
}
include 'header.php';
?>
<div class="compte">
    <div class="compte-container">
        <?php
        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['user_id'])) {
            $utilisateur = Utilisateur::readUtilisateur($pdo, $_SESSION['user_id']);

            if ($utilisateur) {
                // Afficher le compte en fonction du rôle
                if ($utilisateur->getRole() === 'admin') {
                    adminUser(); 
                } else {
                    clientUser(); 
                }
            }
        }
        ?>
        <form method="POST" class="logout-form">
            <button type="submit" name="logout" class="logout-btn">Se déconnecter</button>
        </form>
    </div>
</div>
<?php include 'footer.php' ?>