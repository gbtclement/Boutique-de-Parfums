<?php
include __DIR__ . '/../src/views/database.php';
include __DIR__ . '/../src/models/categorieModel.php';
include __DIR__ . '/../src/models/produitModel.php';

// Récupérer toutes les catégories
$categories = Categorie::getAll($pdo);

// Récupérer les produits d'une catégorie sélectionnée
$selectedCategoryId = $_GET['categorie'] ?? null;
$produits = $selectedCategoryId ? Produit::getAllByCategory($pdo, $selectedCategoryId) : [];

// Ajouter un produit si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];
    $id_categorie = $_POST['id_categorie'];

    $produit = new Produit(null, $nom, $description, $prix, $stock, $id_categorie);
    if ($produit->create($pdo)) {
        echo "Produit ajouté avec succès.";
        header("Location: gestion_produit.php?categorie=$id_categorie");
        exit();
    } else {
        echo "Erreur lors de l'ajout du produit.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Produits</title>
</head>
<body>
    <h1>Gestion des Produits</h1>

    <!-- Liste des catégories -->
    <h2>Catégories</h2>
    <ul>
        <?php foreach ($categories as $categorie): ?>
            <li>
                <a href="?categorie=<?= $categorie->getId(); ?>">
                    <?= htmlspecialchars($categorie->getNom()); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Produits dans la catégorie sélectionnée -->
    <?php if ($selectedCategoryId): ?>
        <h2>Produits dans la catégorie : <?= htmlspecialchars(Categorie::read($pdo, $selectedCategoryId)->getNom()); ?></h2>
        <ul>
            <?php if (count($produits) > 0): ?>
                <?php foreach ($produits as $produit): ?>
                    <li><?= htmlspecialchars($produit->getNom()); ?> - <?= htmlspecialchars($produit->getPrix()); ?> €</li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Aucun produit dans cette catégorie.</li>
            <?php endif; ?>
        </ul>

        <!-- Formulaire d'ajout de produit -->
        <h2>Ajouter un produit</h2>
        <form method="post">
            <input type="hidden" name="id_categorie" value="<?= htmlspecialchars($selectedCategoryId); ?>">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required><br>
            <label for="description">Description :</label>
            <textarea name="description" id="description" required></textarea><br>
            <label for="prix">Prix :</label>
            <input type="number" step="0.01" name="prix" id="prix" required><br>
            <label for="stock">Stock :</label>
            <input type="number" name="stock" id="stock" required><br>
            <button type="submit">Ajouter</button>
        </form>
    <?php endif; ?>
</body>
</html>
