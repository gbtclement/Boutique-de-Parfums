<?php
try {
    $host = '127.0.0.1';
    $dbname = 'boutique_de_parfums';
    $username = 'root';
    $password = '';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie !";

} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>