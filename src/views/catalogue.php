<?php
include '../database/database.php';
include 'header.php';

include '../models/categorieModel.php';
include '../models/produitModel.php';

$categories = Categorie::getAllCategory($pdo);
$categorieId = isset($_GET['categorie']) ? (int)$_GET['categorie'] : null;
$produits = $categorieId ? Produit::getAllByCategory($pdo, $categorieId) : Produit::getAllProduct($pdo);
?>
<div class="container">
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
<?php include 'footer.php'; ?>