<?php
class Commande
{
    private $id;
    private $id_utilisateur;
    private $date_commande;
    private $statut;

    // Constructeur
    public function __construct($id = null, $id_utilisateur = null, $date_commande = null, $statut = null)
    {
        $this->id = $id;
        $this->id_utilisateur = $id_utilisateur;
        $this->date_commande = $date_commande;
        $this->statut = $statut;
    }

        // Getter pour l'id
        public function getId()
        {
            return $this->id;
        }
    
        // Setter pour l'id
        public function setId($id)
        {
            $this->id = $id;
        }
    
        // Getter pour l'id_utilisateur
        public function getIdUtilisateur()
        {
            return $this->id_utilisateur;
        }
    
        // Setter pour l'id_utilisateur
        public function setIdUtilisateur($id_utilisateur)
        {
            $this->id_utilisateur = $id_utilisateur;
        }
    
        // Getter pour la date_commande
        public function getDateCommande()
        {
            return $this->date_commande;
        }
    
        // Setter pour la date_commande
        public function setDateCommande($date_commande)
        {
            $this->date_commande = $date_commande;
        }
    
        // Getter pour le statut
        public function getStatut()
        {
            return $this->statut;
        }
    
        // Setter pour le statut
        public function setStatut($statut)
        {
            $this->statut = $statut;
        }

    // CRUD Methods
    // Create
    public function create(PDO $pdo)
    {
        $sql = "INSERT INTO commande (id_utilisateur, date_commande, statut) VALUES (:id_utilisateur, :date_commande, :statut)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_utilisateur', $this->id_utilisateur);
        $stmt->bindParam(':date_commande', $this->date_commande);
        $stmt->bindParam(':statut', $this->statut);
        return $stmt->execute();
    }

    // Read
    public static function read(PDO $pdo, $id)
    {
        $sql = "SELECT * FROM commande WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new self($row['id'], $row['id_utilisateur'], $row['date_commande'], $row['statut']);
        }
        return null;
    }

    // Update
    public function update(PDO $pdo)
    {
        $sql = "UPDATE commande SET id_utilisateur = :id_utilisateur, date_commande = :date_commande, statut = :statut WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':id_utilisateur', $this->id_utilisateur);
        $stmt->bindParam(':date_commande', $this->date_commande);
        $stmt->bindParam(':statut', $this->statut);
        return $stmt->execute();
    }

    // Delete
    public static function delete(PDO $pdo, $id)
    {
        $sql = "DELETE FROM commande WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Static Method to Get All Orders
    public static function getAll(PDO $pdo)
    {
        $sql = "SELECT * FROM commande";
        $stmt = $pdo->query($sql);
        $commandes = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $commandes[] = new self($row['id'], $row['id_utilisateur'], $row['date_commande'], $row['statut']);
        }

        return $commandes;
    }
}
?>
