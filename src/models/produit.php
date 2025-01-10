<?php

class Produit
{
    public $id;
    public $nom;
    public $description;
    public $prix;
    public $stock;
    public $id_categorie;

    public function __construct($id = null, $nom = null, $description = null, $prix = null, $stock = null, $id_categorie = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->prix = $prix;
        $this->stock = $stock;
        $this->id_categorie = $id_categorie;
    }
}

?>