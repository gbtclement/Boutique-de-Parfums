<?php require_once __DIR__ . '/../controllers/utilisateurController.php'; ?>

<?php include 'header.php'; ?>

<div class="marginPage">
    <div class="form-container">
        <h1>Connexion</h1>
        <form action="index.php?action=connexionUtilisateur" method="POST">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" name="mot_de_passe" id="mot_de_passe" required>
            </div>

            <button type="submit">Se connecter</button>
            <a href="index.php?action=inscriptionUtilisateur">S'inscrire</a>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>