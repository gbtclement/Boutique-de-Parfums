<?php
include __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../models/categorieModel.php';
require_once  __DIR__ . '/../models/produitModel.php';
$categories = Categorie::getAllCategory($pdo);
$categorieId = isset($_GET['categorie']) ? (int)$_GET['categorie'] : null;
$produits = $categorieId ? Produit::getAllByCategory($pdo, $categorieId) : Produit::getAllProduct($pdo);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/css/style.css">
    <title>Boutique de Parfums</title>
</head>

<body>
    <header>
        <div class="menu">
            <div class="navigation" id="navigation">
                <a href="../../public/index.php?action=home" class="icon svg">
                    <img src="../../public/assets/image/home.svg" alt="Supprimer" style="width: 30px; height: 30px; display:flex;">
                </a>
                <a href="../../public/index.php?action=catalogue" class="icon svg">
                    <img src="../../public/assets/image/catalogue.svg" alt="Supprimer" style="width: 30px; height: 30px; display:flex;">
                </a>
                <a href="../../public/index.php?action=connexionUtilisateur" class="icon svg">
                    <img src="../../public/assets/image/account.svg" alt="Supprimer" style="width: 30px; height: 30px; display:flex;">
                </a>

            </div>
        </div>
    </header>

    <div class="catalogue">
        <div class="container">
            <div class="marginPage">
                <h1>Catalogue</h1>

                <form method="GET" action="catalogue.php">
                    <label for="categorie">Choisissez une catégorie :</label>
                    <select name="categorie" id="categorie" onchange="this.form.submit()">
                        <option value="">-- Toutes les catégories --</option>
                        <?php foreach ($categories as $categorie): ?>
                            <option value="<?= htmlspecialchars($categorie->getId()) ?>" <?= $categorieId === $categorie->getId() ? 'selected' : '' ?>>
                                <?= htmlspecialchars($categorie->getNom()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>

                <div class="produits">
                    <?php if ($produits): ?>
                        <?php foreach ($produits as $produit): ?>
                            <div class="produit">
                                <h2><?= htmlspecialchars($produit->getNom()) ?></h2>
                                <p><?= htmlspecialchars($produit->getDescription()) ?></p>
                                <p>Prix : <?= number_format($produit->getPrix(), 2) ?> €</p>
                                <p>Stock : <?= htmlspecialchars($produit->getStock()) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Aucun produit trouvé pour cette catégorie.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<footer>
    <div class="copyright">
        <p>&copy; Morgan LUCAS & Clément GAUBERT - CDA 2025.4</p>
    </div>
</footer>