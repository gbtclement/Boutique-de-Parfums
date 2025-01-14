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
    }
}
?>

<?php include __DIR__ . '/../src/views/header.php'; ?>

<div class="marginPage">
    <div class="gestionCateg">
        <h1>Gestion des catégories</h1>

        <div class="creationCateg">
            <h2>Créer une catégorie</h2>
            <form action="../public/gestion_categ.php" method="POST">
                <label for="nom">Nom de la catégorie :</label>
                <input type="text" name="nom" id="nom" required>

                <button type="submit" name="submit">Créer la catégorie</button>
            </form>
        </div>


        <div class="listCateg">
            <h2>Liste des catégories</h2>
            <form action="../public/gestion_categ.php" method="POST">
                <table>
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

                <button type="submit" name="delete">
                    <img src="../assets/image/trash.svg" alt="Supprimer" style="width: 24px; height: 24px; display:flex;">
                </button>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../src/views/footer.php'; ?>