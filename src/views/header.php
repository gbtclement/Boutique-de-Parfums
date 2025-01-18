<?php
session_start(); // Doit être au début
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <title>Boutique de Parfums</title>
</head>

<body>
    <header>
        <div class="menu">
            <div class="navigation" id="navigation">
                <a href="index.php?action=home" class="icon svg">
                <img src="../public/assets/image/home.svg" alt="Supprimer" style="width: 30px; height: 30px; display:flex;">
                </a>
                <a href="index.php?action=catalogue" class="icon svg">
                <img src="../public/assets/image/catalogue.svg" alt="Supprimer" style="width: 30px; height: 30px; display:flex;">
                </a>
                <a href="index.php?action=compte" class="icon svg">
                <img src="../public/assets/image/account.svg" alt="Supprimer" style="width: 30px; height: 30px; display:flex;">
                </a>

            </div>
        </div>
    </header>
</body>

</html>

<script src="../../public/assets/js/script.js"></script>