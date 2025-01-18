<?php require_once __DIR__ . '/../controllers/utilisateurController.php'; ?>

<?php include 'header.php'; ?>

<div class="container">
    <div class="marginPage">
        <div class="form-container">
            <h1>Inscription</h1>
            <form action="index.php?action=inscriptionUtilisateur" method="POST">
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" required>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" name="prenom" id="prenom" required>
                </div>

                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" required>
                </div>

                <div class="form-group">
                    <label for="mot_de_passe">Mot de passe :</label>
                    <input type="password" name="mot_de_passe" id="mot_de_passe" required>
                </div>

                <button type="submit">S'inscrire</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>