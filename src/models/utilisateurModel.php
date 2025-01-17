<?php

class Utilisateur
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $mot_de_passe;
    private $role;

    // Constructeur
    public function __construct($id = null, $nom = null, $prenom = null, $email = null, $mot_de_passe = null, $role = null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mot_de_passe = $mot_de_passe;
        $this->role = $role;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getMotDePasse()
    {
        return $this->mot_de_passe;
    }

    public function getRole()
    {
        return $this->role;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setMotDePasse($mot_de_passe)
    {
        $this->mot_de_passe = $mot_de_passe;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    // CRUD Methods
    // Create
    public function createUtilisateur(PDO $pdo)
    {
        $sql = "INSERT INTO utilisateur (nom, prenom, email, mot_de_passe, role) VALUES (:nom, :prenom, :email, :mot_de_passe, :role)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':prenom', $this->prenom);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':mot_de_passe', $this->mot_de_passe);
        $stmt->bindParam(':role', $this->role);
        return $stmt->execute();
    }

    // Read
    public static function readUtilisateur(PDO $pdo, $id)
    {
        $sql = "SELECT * FROM utilisateur WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new self($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['mot_de_passe'], $row['role']);
        }
        return null;
    }

    // Update
    public function updateUtilisateur(PDO $pdo)
    {
        $sql = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, mot_de_passe = :mot_de_passe, role = :role WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':prenom', $this->prenom);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':mot_de_passe', $this->mot_de_passe);
        $stmt->bindParam(':role', $this->role);
        return $stmt->execute();
    }

    // Delete
    public static function deleteUtilisateur(PDO $pdo, $id)
    {
        $sql = "DELETE FROM utilisateur WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Static Method to Get All Users
    public static function getAllUtilisateur(PDO $pdo)
    {
        $sql = "SELECT * FROM utilisateur";
        $stmt = $pdo->query($sql);
        $utilisateurs = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $utilisateurs[] = new self($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['mot_de_passe'], $row['role']);
        }

        return $utilisateurs;
    }
}
?>
