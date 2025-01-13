<?php
include __DIR__ . '/../src/views/database.php';
include __DIR__ . '/../src/models/categorieModel.php';
include __DIR__ . '/../src/models/produitModel.php';

// Récupérer toutes les catégories
$categories = Categorie::getAll($pdo);

// Récupérer les produits d'une catégorie sélectionnée
$selectedCategoryId = $_GET['categorie'] ?? null;
$produits = $selectedCategoryId ? Produit::getAllByCategory($pdo, $selectedCategoryId) : [];

<<<<<<< HEAD
// Gestion de la méthode PATCH
if (isset($_POST['update'])) {
    $id = $_POST['id']; 
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];
    $id_categorie = $_POST['id_categorie'];
   
    if (isset($pdo)) {
        $produit = new Produit($id, $nom, $description, $prix, $stock, $id_categorie);
        
        if ($produit->update($pdo)) {
            echo "Le produit a été mis à jour avec succès.";
        } else {
            echo "Une erreur est survenue lors de la mise à jour du produit.";
        }
    } else {
        echo "veuillez sélectionner un produit";
    }
    
}


=======
>>>>>>> 956d8a6489c533c1ff6940a0c1b96b1a512237b3
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
<<<<<<< HEAD

if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    // Récupérer les données envoyées
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (!$data || !isset($data['id'])) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "ID du produit manquant ou données invalides."]);
        exit;
    }

    $id = filter_var($data['id'], FILTER_VALIDATE_INT);

    // Valider les champs à mettre à jour
    $fieldsToUpdate = [];
    $values = [];
    foreach ($data as $key => $value) {
        if (in_array($key, ['nom', 'description', 'prix', 'stock', 'id_categorie']) && $key !== 'id') {
            $fieldsToUpdate[] = "`$key` = ?";
            $values[] = $value;
        }
    }

    if (empty($fieldsToUpdate)) {
        http_response_code(400); // Bad Request
        echo json_encode(["error" => "Aucun champ valide à mettre à jour."]);
        exit;
    }

    // Ajouter l'ID pour la clause WHERE
    $values[] = $id;

    // Construire la requête SQL
    $sql = "UPDATE produits SET " . implode(", ", $fieldsToUpdate) . " WHERE id = ?";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($values);

        if ($stmt->rowCount() > 0) {
            echo json_encode(["success" => true, "message" => "Produit mis à jour avec succès."]);
        } else {
            echo json_encode(["success" => false, "message" => "Aucun changement détecté ou produit introuvable."]);
        }
    } catch (Exception $e) {
        http_response_code(500); // Internal Server Error
        echo json_encode(["error" => "Erreur lors de la mise à jour : " . $e->getMessage()]);
    }
    exit;
}
=======
>>>>>>> 956d8a6489c533c1ff6940a0c1b96b1a512237b3
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
<<<<<<< HEAD

        <h2>Modifier un produit</h2>
        <form method="POST" action="gestion_produit.php">
            <label for="product_id">Sélectionnez un produit :</label>
            <?php
                $produits = Produit::getAll($pdo); // Assurez-vous que la méthode getAll() est définie pour obtenir tous les produits
                foreach ($produits as $produit) {
                    echo "<tr>";
                    echo "<td><input type='radio' name='id_produit' value='" . $produit->getId() . "' required></td>";
                    echo "<td>" . htmlspecialchars($produit->getNom()) . "</td>";
                    echo "<td>" . htmlspecialchars($produit->getPrix()) . " €</td>"; // Si vous voulez afficher le prix
                    echo "</tr>";
                }
            ?>

            <!-- Champ caché pour l'ID de la catégorie -->
            <input type="hidden" name="id_categorie" value="<?= htmlspecialchars($selectedCategoryId); ?>">

            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required><br>
            <label for="description">Description :</label>
            <textarea name="description" id="description" required></textarea><br>
            <label for="prix">Prix :</label>
            <input type="number" step="0.01" name="prix" id="prix" required><br>
            <label for="stock">Stock :</label>
            <input type="number" name="stock" id="stock" required><br>
            
            <button type="submit" name="update">Modifier le produit</button>
        </form>

        <?php endif; ?>
    
=======
    <?php endif; ?>
>>>>>>> 956d8a6489c533c1ff6940a0c1b96b1a512237b3
</body>
</html>
