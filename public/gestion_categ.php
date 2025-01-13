<?php
include __DIR__ . '/../src/views/database.php';
include __DIR__ . '/../src/models/categorieModel.php';

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];

    $categorie = new Categorie(null, $nom);

    if ($categorie->create($pdo)) {
        echo "La catégorie a été créée avec succès.";

        header('Location: ../public/gestion_categ.php');
        exit();
    } else {
        echo "Une erreur est survenue lors de la création de la catégorie.";
    }
}

if (isset($_POST['delete'])) {
    if (isset($_POST['categories'])) {
        foreach ($_POST['categories'] as $categoryId) {
            Categorie::delete($pdo, $categoryId);
        }
        echo "Les catégories ont été supprimées avec succès.";
    } else {
        echo "Aucune catégorie sélectionnée pour la suppression.";
    }
}
?>

<?php include __DIR__ . '/../src/views/header.php'; ?>

<div class="testCateg">
    <form action="../public/gestion_categ.php" method="POST">
        <label for="nom">Nom de la catégorie :</label>
        <input type="text" name="nom" id="nom" required>

        <button type="submit" name="submit">Créer la catégorie</button>
    </form>
</div>

<h2>Liste des catégories</h2>
<form action="../public/gestion_categ.php" method="POST">
    <table>
        <thead>
            <tr>
                <th>Choisir</th>
                <th>Nom de la catégorie</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $categories = Categorie::getAll($pdo);
            foreach ($categories as $categorie) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='categories[]' value='" . $categorie->getId() . "'></td>";
                echo "<td>" . htmlspecialchars($categorie->getNom()) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <button type="submit" name="delete">Supprimer les catégories sélectionnées</button>
</form>

<?php include __DIR__ . '/../src/views/footer.php'; ?>