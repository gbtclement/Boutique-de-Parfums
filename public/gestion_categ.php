<?php
include __DIR__ . '/../src/views/database.php';
include __DIR__ . '/../src/models/categorieModel.php';

// Gestion de la méthode PATCH
if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
    // Récupérer les données brutes de la requête
    $inputData = file_get_contents('php://input');
    $data = json_decode($inputData, true);

    if (isset($data['id']) && isset($data['nom'])) {
        $id = $data['id'];
        $nom = $data['nom'];

        // Mise à jour de la catégorie
        if (Categorie::update($pdo, $id, $nom)) {
            echo json_encode([
                'success' => true,
                'message' => 'Catégorie mise à jour avec succès.',
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la mise à jour de la catégorie.',
            ]);
        }
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Données invalides. Veuillez fournir un ID et un nom.',
        ]);
    }
    exit();
}

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

<h2>Modifier une catégorie (PATCH)</h2>
<form id="patchForm">
    <label for="id">ID de la catégorie :</label>
    <input type="number" id="id" name="id" required><br><br>

    <label for="nom">Nouveau nom :</label>
    <input type="text" id="nom" name="nom" required><br><br>

    <button type="submit">Envoyer la requête PATCH</button>
</form>

<h2>Réponse du serveur :</h2>
<pre id="response"></pre>

<script>
    document.getElementById('patchForm').addEventListener('submit', async (e) => {
        e.preventDefault();

        // Collecter les données du formulaire
        const id = document.getElementById('id').value;
        const nom = document.getElementById('nom').value;

        // Envoyer la requête PATCH
        try {
            const response = await fetch('gestion_categ.php', {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id, nom }),
            });

            const result = await response.json();
            document.getElementById('response').textContent = JSON.stringify(result, null, 2);
        } catch (error) {
            document.getElementById('response').textContent = `Erreur : ${error.message}`;
        }
    });
</script>

<?php include __DIR__ . '/../src/views/footer.php'; ?>