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
    public function setImage(?bool $imageUtilisateur): void{
        $this->image_utilisateur = $imageUtilisateur;
    }
    public function getRole(): ?Roles{
        return $this->role;
    }
    public function setRole(?Roles $role): void{
        $this->role = $role;
    }
}
?>