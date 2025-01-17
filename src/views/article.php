<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<body>
    <h1>Liste des articles</h1>

    <!-- Formulaire pour ajouter un article -->
    <form action="index.php" method="POST">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" required><br>
        <label for="contenu">Contenu :</label>
        <textarea name="contenu" id="contenu" required></textarea><br>
        <label for="auteur">Auteur :</label>
        <input type="text" name="auteur" id="auteur" required><br>
        <label for="tags">Tags (séparés par des virgules) :</label>
        <input type="text" name="tags" id="tags"><br>
        <button type="submit">Ajouter</button>
    </form>

    <h2>Articles existants</h2>
    <ul>
        <?php foreach ($articles as $article): ?>
            <li>
    <h3><?php echo htmlspecialchars($article['titre']); ?></h3>
    <p><?php echo htmlspecialchars($article['contenu']); ?></p>
    <p><strong>Auteur :</strong> <?php echo htmlspecialchars($article['auteur']); ?></p>
    <p>
        <em>Tags :</em>
        <?= !empty($article['tags']) ? implode(', ', $article['tags']) : 'Aucun tag'; ?>
    </p>
</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
