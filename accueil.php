<?php include __DIR__ . '/src/views/header.php'; ?>

<div class="accueil">
    <div class="container">

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
            <a href="public/gestion_categ.php">Gestion des catégories</a>
            <a href="public/gestion_produit.php">Gestion des produits</a>
        </div>
    </div>
    
</div>

<?php include __DIR__ . '/src/views/footer.php'; ?>