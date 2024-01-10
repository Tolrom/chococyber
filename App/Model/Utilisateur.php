<?php
namespace App\Model;
use App\Utils\BddConnect;
class Utilisateur extends BddConnect{
//                  Attributs                  //
    private ?int $id_utilisateur;
    private ?string $nom_utilisateur;
    private ?string $prenom_utilisateur;
    private ?string $email_utilisateur;
    private ?string $pass_utilisateur;
    private ?string $image_utilisateur;
    private ?bool $statut_utilisateur;
    private ?Roles $role;
//                  Constructeur                    //
    public function __construct(){
        $this->role = new Roles();
    }
//                  Getters & Setters                  //
    public function getId(): ?int{
        return $this->id_utilisateur;
    }
    public function setId(?int $idUtilisateur): void{
        $this->id_utilisateur = $idUtilisateur;
    }
    public function getNom(): ?string{
        return $this->nom_utilisateur;
    }
    public function setNom(?string $nomUtilisateur): void{
        $this->nom_utilisateur = $nomUtilisateur;
    }
    public function getPrenom(): ?string{
        return $this->prenom_utilisateur;
    }
    public function setPrenom(?string $prenomUtilisateur): void{
        $this->prenom_utilisateur = $prenomUtilisateur;
    }
    public function getEmail(): ?string{
        return $this->email_utilisateur;
    }
    public function setEmail(?string $emailUtilisateur): void{
        $this->email_utilisateur = $emailUtilisateur;
    }
    public function getPass(): ?string{
        return $this->pass_utilisateur;
    }
    public function setPass(?string $passUtilisateur): void{
        $this->pass_utilisateur = $passUtilisateur;
    }
    public function getImage(): ?string{
        return $this->image_utilisateur;
    }
    public function setImage(?string $imageUtilisateur): void{
        $this->image_utilisateur = $imageUtilisateur;
    }
    public function getRole(): ?Roles{
        return $this->role;
    }
    public function setRole(?Roles $role): void{
        $this->role = $role;
    }
//                  Méthodes                    //
    public function insertUtilisateur(): void {
        try {
            // Récupération des données
            $nom = $this->nom_utilisateur;
            $prenom = $this->prenom_utilisateur;
            $email = $this->email_utilisateur;
            $pass = $this->pass_utilisateur;
            $image = $this->image_utilisateur;
            $id_roles = $this->role->getId();
            // Requête SQL
            $requete = $this->connexion()->prepare(
                "INSERT INTO utilisateur(nom_utilisateur,prenom_utilisateur,email_utilisateur,pass_utilisateur,image_utilisateur,id_roles) 
                VALUE(?,?,?,?,?,?)"
            );
            $requete->bindParam(1,$nom,\PDO::PARAM_STR);
            $requete->bindParam(2,$prenom,\PDO::PARAM_STR);
            $requete->bindParam(3,$email,\PDO::PARAM_STR);
            $requete->bindParam(4,$pass,\PDO::PARAM_STR);
            $requete->bindParam(5,$image,\PDO::PARAM_STR);
            $requete->bindParam(6,$id_roles,\PDO::PARAM_INT);
            $requete->execute();
        } catch (\Exception $e) {
            die('Error : '.$e->getMessage());
        }
    }
    public function getUtilisateurByMail(): Utilisateur|Bool{
        try {
            $email = $this->email_utilisateur;
            $requete = $this->connexion()->prepare(
            'SELECT id_utilisateur,nom_utilisateur,prenom_utilisateur,email_utilisateur,pass_utilisateur FROM utilisateur WHERE email_utilisateur = ?'
            );
            $requete->bindParam(1,$email,\PDO::PARAM_STR);
            $requete->execute();
            $requete->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, Utilisateur::class);
            return $requete->fetch();
        } 
        catch (\Exception $e) {
            die('Error : '.$e->getMessage());
        }
    }
    public function __toString(): string {
        return $this->nom_utilisateur;
    }
}
?>