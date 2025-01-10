<?php
class Commande
{
    public $id;
    public $id_utilisateur;
    public $date_commande;
    public $statut;

    public function __construct($id = null, $id_utilisateur = null, $date_commande = null, $statut = null)
    {
        $this->id = $id;
        $this->id_utilisateur = $id_utilisateur;
        $this->date_commande = $date_commande;
        $this->statut = $statut;
    }
}

?>