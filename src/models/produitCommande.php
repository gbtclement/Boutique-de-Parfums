<?php

class CommandeProduit
{
    public $id;
    public $id_commande;
    public $id_produit;
    public $quantite;
    public $prix_unitaire;

    public function __construct($id = null, $id_commande = null, $id_produit = null, $quantite = null, $prix_unitaire = null)
    {
        $this->id = $id;
        $this->id_commande = $id_commande;
        $this->id_produit = $id_produit;
        $this->quantite = $quantite;
        $this->prix_unitaire = $prix_unitaire;
    }
}

?>