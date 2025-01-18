<?php require_once __DIR__ . '/../controllers/categorieController.php'; ?>

<?php include 'header.php'; ?>

<div class="container">
    <div class="marginPage">
        <div class="gestionCateg">
            <h1>Gestion des Catégories</h1>

            <!-- Formulaire d'ajout -->
            <div class="creationCateg">
                <h2>Créer une catégorie</h2>
                <form action="index.php?action=createCategorie" method="POST"> <!-- Action mise à jour -->
                    <label for="nom">Nom de la catégorie :</label>
                    <input type="text" name="nom" id="nom" required>
                    <button type="submit" name="submit">Créer la catégorie</button>
                </form>
            </div>

            <!-- Liste des catégories avec option de suppression -->
            <div class="listCateg">
                <h2>Supprimer ou modifier des catégories</h2>
                <form action="index.php?action=deleteCategorie" method="POST" id="deleteForm"> <!-- Action mise à jour -->
                    <table>
                        <thead>
                            <tr>
                                <th>Sélectionner</th>
                                <th>Nom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $categorie): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox"
                                            name="categories[]"
                                            value="<?= $categorie->getId(); ?>"
                                            data-nom="<?= htmlspecialchars($categorie->getNom()); ?>"
                                            onclick="handleSelection(this)">
                                    </td>
                                    <td><?= htmlspecialchars($categorie->getNom()); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button type="submit" name="delete">
                        <img src="../public/assets/image/trash.svg" alt="Supprimer" style="width: 24px; height: 24px;">
                    </button>
                </form>
            </div>

            <!-- Formulaire de modification -->
            <div class="modifCateg" id="modifCateg" style="display: none;">
                <h2>Modifier une catégorie</h2>
                <form action="index.php?action=updateCategorie" method="POST"> <!-- Action mise à jour -->
                    <label for="editNom">Nouveau nom :</label>
                    <input type="text" id="editNom" name="nom" required>
                    <input type="hidden" id="editId" name="id">
                    <button type="submit" name="update">
                        <img src="../public/assets/image/pencil.svg" alt="Modifier" style="width: 24px; height: 24px;">
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    /**
     * Gère l'affichage de la section de modification.
     * Remplit les champs lorsque seulement une catégorie est sélectionnée.
     */
    function handleSelection(checkbox) {
        const checkboxes = document.querySelectorAll('input[type="checkbox"][name="categories[]"]');
        const selected = Array.from(checkboxes).filter(cb => cb.checked);

        const modifSection = document.getElementById('modifCateg');
        const inputNom = document.getElementById('editNom');
        const inputId = document.getElementById('editId');

        if (selected.length === 1) {
            const selectedCheckbox = selected[0];
            modifSection.style.display = 'block';
            inputNom.value = selectedCheckbox.dataset.nom;
            inputId.value = selectedCheckbox.value;
        } else {
            modifSection.style.display = 'none';
            inputNom.value = '';
            inputId.value = '';
        }
    }
</script>

<?php include 'footer.php'; ?>