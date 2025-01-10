<?php
include __DIR__ . '/src/views/header.php';
include 'src/views/database.php';
include 'src/models/categorieModel.php';

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];

    $categorie = new Categorie(null, $nom);

    if ($categorie->create($pdo)) {
        echo "La catégorie a été créée avec succès.";
        
        header('Location: accueil.php');
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

<div class="accueil">
    <div class="testCateg">
        <form action="accueil.php" method="POST">
            <label for="nom">Nom de la catégorie :</label>
            <input type="text" name="nom" id="nom" required>

            <button type="submit" name="submit">Créer la catégorie</button>
        </form>
    </div>

    <h2>Liste des catégories</h2>
    <form action="accueil.php" method="POST">
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
</div>

<?php include __DIR__ . '/src/views/footer.php'; ?>





  <!--<div class="container">

    <div class="sweep"></div>

    <div class="ambient-circle" style="width: 300px; height: 300px; top: 20%; left: 30%;"></div>
    <div class="ambient-circle" style="width: 200px; height: 200px; top: 60%; left: 70%;"></div>
    <div class="ambient-circle" style="width: 250px; height: 250px; top: 40%; left: 50%;"></div>

    <div class="logo-container">
      <div class="logo-shine"></div>
      <div class="logo-circle"></div>
      <span class="logo-text">VOTRE LOGO</span>
    </div>

    <div class="content">
      <div class="content-inner">
        <h1 class="title">
          <span>Découvrez</span>
        </h1>
        <div class="subtitle">
          notre collection
        </div>
        <p class="text">
          Des parfums d'exception pour des moments inoubliables
        </p>
        <button class="button">Explorer</button>
      </div>
    </div>
  </div>-->