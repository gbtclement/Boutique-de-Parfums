<?php
// Inclusion des fichiers nécessaires
include __DIR__ . '../database/database.php';
include __DIR__ . '../models/categorieModel.php';
include __DIR__ . '../models/produitModel.php';

// Récupérer toutes les catégories
$categories = Categorie::getAll($pdo);

// Récupérer les produits d'une catégorie sélectionnée
$selectedCategoryId = $_GET['categorie'] ?? null;
$produits = $selectedCategoryId ? Produit::getAllByCategory($pdo, $selectedCategoryId) : [];

// Récupérer le produit sélectionné pour modification
$selectedProductId = $_GET['produit'] ?? null;
$selectedProduct = $selectedProductId ? Produit::read($pdo, $selectedProductId) : null;

// Ajouter un produit
if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];
    $id_categorie = $_POST['id_categorie'];

    $produit = new Produit(null, $nom, $description, $prix, $stock, $id_categorie);

    if ($produit->create($pdo)) {
        echo "<p>Produit ajouté avec succès.</p>";
        header("Location: gestion_produit.php?categorie=$id_categorie");
        exit();
    } else {
        echo "<p>Erreur lors de l'ajout du produit.</p>";
    }
}

// Modifier un produit
if (isset($_POST['update'])) {
    $id = $_POST['id_produit'];
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];
    $id_categorie = $_POST['id_categorie'];

    $produit = new Produit($id, $nom, $description, $prix, $stock, $id_categorie);

    if ($produit->update($pdo)) {
        echo "<p>Produit mis à jour avec succès.</p>";
        header("Location: gestion_produit.php?categorie=$id_categorie");
        exit();
    } else {
        echo "<p>Erreur lors de la mise à jour du produit.</p>";
    }
}

// Supprimer un produit
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if (Produit::delete($pdo, $id)) {
        echo "<p>Produit supprimé avec succès.</p>";
        header("Location: gestion_produit.php?categorie=$selectedCategoryId");
        exit();
    } else {
        echo "<p>Erreur lors de la suppression du produit.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Produits</title>
    <script>
        // Confirmation avant suppression
        function confirmDelete() {
            return confirm("Êtes-vous sûr de vouloir supprimer ce produit ?");
        }
    </script>
</head>
<body>
    <h1>Gestion des Produits</h1>

    <!-- Liste des catégories -->
    <h2>Catégories</h2>
    <ul>
        <?php foreach ($categories as $categorie): ?>
            <li>
                <a href="?test=<?= $categorie->getId(); ?>">
                    <?= htmlspecialchars($categorie->getNom()); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php if ($selectedCategoryId): ?>
        <!-- Liste des produits -->
        <h2>Produits dans la catégorie : <?= htmlspecialchars(Categorie::read($pdo, $selectedCategoryId)->getNom()); ?></h2>
        <ul>
            <?php if (count($produits) > 0): ?>
                <?php foreach ($produits as $produit): ?>
                    <li>
                        <?= htmlspecialchars($produit->getNom()); ?> - <?= htmlspecialchars($produit->getPrix()); ?> €
                        <a href="?categorie=<?= $selectedCategoryId; ?>&produit=<?= $produit->getId(); ?>">Modifier</a>
                        <a href="?categorie=<?= $selectedCategoryId; ?>&delete=<?= $produit->getId(); ?>" onclick="return confirmDelete();">Supprimer</a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Aucun produit dans cette catégorie.</li>
            <?php endif; ?>
        </ul>

        <!-- Formulaire d'ajout -->
        <h2>Ajouter un produit</h2>
        <form method="POST">
            <input type="hidden" name="id_categorie" value="<?= htmlspecialchars($selectedCategoryId); ?>">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required><br>
            <label for="description">Description :</label>
            <textarea name="description" id="description" required></textarea><br>
            <label for="prix">Prix :</label>
            <input type="number" step="0.01" name="prix" id="prix" required><br>
            <label for="stock">Stock :</label>
            <input type="number" name="stock" id="stock" required><br>
            <button type="submit" name="submit">Ajouter</button>
        </form>

        <!-- Formulaire de modification -->
        <?php if ($selectedProduct): ?>
            <h2>Modifier le produit : <?= htmlspecialchars($selectedProduct->getNom()); ?></h2>
            <form method="POST">
                <input type="hidden" name="id_produit" value="<?= htmlspecialchars($selectedProduct->getId()); ?>">
                <input type="hidden" name="id_categorie" value="<?= htmlspecialchars($selectedCategoryId); ?>">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($selectedProduct->getNom()); ?>" required><br>
                <label for="description">Description :</label>
                <textarea name="description" id="description" required><?= htmlspecialchars($selectedProduct->getDescription()); ?></textarea><br>
                <label for="prix">Prix :</label>
                <input type="number" step="0.01" name="prix" id="prix" value="<?= htmlspecialchars($selectedProduct->getPrix()); ?>" required><br>
                <label for="stock">Stock :</label>
                <input type="number" name="stock" id="stock" value="<?= htmlspecialchars($selectedProduct->getStock()); ?>" required><br>
                <button type="submit" name="update">Modifier</button>
            </form>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
