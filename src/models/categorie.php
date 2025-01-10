<?php

class Categorie
{
    public $id;
    public $nom;

    public function __construct($id = null, $nom = null)
    {
        $this->id = $id;
        $this->nom = $nom;
    }
}

?>