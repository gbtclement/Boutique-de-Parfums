<?php

class Utilisateur
{
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $mot_de_passe;
    public $role;

    public function __construct($id = null, $nom = null, $prenom = null, $email = null, $mot_de_passe = null, $role = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mot_de_passe = $mot_de_passe;
        $this->role = $role;
    }
}

?>