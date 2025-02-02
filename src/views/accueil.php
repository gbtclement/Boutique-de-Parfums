<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/css/styleHome.css">
    <title>Boutique de Parfums</title>
</head>

<body>
    <div class="header">
        <a href="../../public/index.php?action=connexionUtilisateur" class="compte-link">Connexion</a>
    </div>
    <div class="accueil">
        <div class="container">

            <div class="sweep"></div>

            <div class="ambient-circle" style="width: 300px; height: 300px; top: 20%; left: 30%;"></div>
            <div class="ambient-circle" style="width: 200px; height: 200px; top: 60%; left: 70%;"></div>
            <div class="ambient-circle" style="width: 250px; height: 250px; top: 40%; left: 50%;"></div>

            <div class="logo-container">
                <div class="logo-shine"></div>
                <div class="logo-circle"></div>
                <span class="logo-text">Essences</span>
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
                    </br>
                    </br>
                    </br>
                    <a class="button" href="../../public/index.php?action=catalogue">Explorer</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>