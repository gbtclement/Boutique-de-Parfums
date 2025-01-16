<?php require_once __DIR__ . '/../controllers/produitController.php'; ?>

<?php include 'header.php'; ?>

<div class="marginPage">
    <div class="gestionProduit">
        <h1>Gestion des Produits</h1>

        <!-- Formulaire d'ajout -->
        <div class="creationProduit">
            <h2>Créer un produit</h2>
            <form action="index.php?action=createProduit" method="POST">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" required>

                <label for="description">Description :</label>
                <textarea name="description" id="description" required></textarea>

                <label for="prix">Prix :</label>
                <input type="number" step="0.01" name="prix" id="prix" required>

                <label for="stock">Stock :</label>
                <input type="number" name="stock" id="stock" required>

                <label for="id_categorie">Catégorie :</label>
                <select name="id_categorie" id="id_categorie" required>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?= $categorie->getId(); ?>"><?= htmlspecialchars($categorie->getNom()); ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" name="submit">Créer le produit</button>
            </form>
        </div>

        <!-- Liste des produits avec options de suppression -->
        <div class="listProduit">
            <h2>Supprimer ou modifier des produits</h2>
            <form action="index.php?action=deleteProduit" method="POST" id="deleteForm">
                <table>
                    <thead>
                        <tr>
                            <th>Sélectionner</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Prix</th>
                            <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" 
                                               name="products[]" 
                                               value="<?= $product->getId(); ?>" 
                                               data-nom="<?= htmlspecialchars($product->getNom()); ?>" 
                                               data-description="<?= htmlspecialchars($product->getDescription()); ?>" 
                                               data-prix="<?= htmlspecialchars($product->getPrix()); ?>" 
                                               data-stock="<?= htmlspecialchars($product->getStock()); ?>" 
                                               data-categorie="<?= htmlspecialchars($product->getIdCategorie()); ?>" 
                                               onclick="handleSelection(this)">
                                    </td>
                                    <td><?= htmlspecialchars($product->getNom()); ?></td>
                                    <td><?= htmlspecialchars($product->getDescription()); ?></td>
                                    <td><?= htmlspecialchars($product->getPrix()); ?> €</td>
                                    <td><?= htmlspecialchars($product->getStock()); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5">Aucun produit trouvé.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <button type="submit" name="delete">
                    <img src="../public/assets/image/trash.svg" alt="Supprimer" style="width: 24px; height: 24px;">
                </button>
            </form>
        </div>

        <!-- Formulaire de modification -->
        <div class="modifProduit" id="modifProduit" style="display: none;">
            <h2>Modifier un produit</h2>
            <form action="index.php?action=updateProduit" method="POST">
                <label for="editNom">Nom :</label>
                <input type="text" id="editNom" name="nom" required>

                <label for="editDescription">Description :</label>
                <textarea id="editDescription" name="description" required></textarea>

                <label for="editPrix">Prix :</label>
                <input type="number" step="0.01" id="editPrix" name="prix" required>

                <label for="editStock">Stock :</label>
                <input type="number" id="editStock" name="stock" required>

                <label for="editCategorie">Catégorie :</label>
                <select id="editCategorie" name="id_categorie" required>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?= $categorie->getId(); ?>"><?= htmlspecialchars($categorie->getNom()); ?></option>
                    <?php endforeach; ?>
                </select>

                <input type="hidden" id="editId" name="id">
                <button type="submit" name="update">
                    <img src="../public/assets/image/pencil.svg" alt="Modifier" style="width: 24px; height: 24px;">
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    /**
     * Gère l'affichage de la section de modification.
     * Remplit les champs lorsque seulement un produit est sélectionné.
     */
    function handleSelection(checkbox) {
        const checkboxes = document.querySelectorAll('input[type="checkbox"][name="products[]"]');
        const selected = Array.from(checkboxes).filter(cb => cb.checked);

        const modifSection = document.getElementById('modifProduit');
        const inputNom = document.getElementById('editNom');
        const inputDescription = document.getElementById('editDescription');
        const inputPrix = document.getElementById('editPrix');
        const inputStock = document.getElementById('editStock');
        const inputCategorie = document.getElementById('editCategorie');
        const inputId = document.getElementById('editId');

        if (selected.length === 1) {
            const selectedCheckbox = selected[0];
            modifSection.style.display = 'block';
            inputNom.value = selectedCheckbox.dataset.nom;
            inputDescription.value = selectedCheckbox.dataset.description;
            inputPrix.value = selectedCheckbox.dataset.prix;
            inputStock.value = selectedCheckbox.dataset.stock;
            inputCategorie.value = selectedCheckbox.dataset.categorie;
            inputId.value = selectedCheckbox.value;
        } else {
            modifSection.style.display = 'none';
            inputNom.value = '';
            inputDescription.value = '';
            inputPrix.value = '';
            inputStock.value = '';
            inputCategorie.value = '';
            inputId.value = '';
        }
    }
</script>

<?php include 'footer.php'; ?>
