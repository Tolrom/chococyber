<?php
namespace App\Controller;
use App\Model\Utilisateur;
use App\Utils\Utilitaire;
use App\Vue\Template;
class UtilisateurController extends Utilisateur{
    //                  Méthodes                    //
    public function addUtilisateur(): void{
        $error = "";
        // Test bouton
        if(isset($_POST["submit"])){
            // Test champs remplis
            if(!empty($_POST["nom_utilisateur"]) AND 
            !empty($_POST["prenom_utilisateur"]) AND 
            !empty($_POST["email_utilisateur"]) AND 
            !empty($_POST["pass_utilisateur"]) AND 
            !empty($_POST["pass_confirm"])){
                // Tester les correspondances des mdp   //
                if($_POST["pass_utilisateur"] === $_POST["pass_utilisateur"]){
                    $email = Utilitaire::cleanInput($_POST["email_utilisateur"]);
                //      Tester existence du compte      //
                    if(!($this->getUtilisateurByMail())){
                    //      Hasher le mdp       //
                        $hash = password_hash(Utilitaire::cleanInput($_POST["pass_utilisateur"]),PASSWORD_DEFAULT);
                    //      Clean les entrées   //
                        $nom = Utilitaire::cleanInput($_POST["nom_utilisateur"]);
                        $prenom = Utilitaire::cleanInput($_POST["prenom_utilisateur"]);
                        $image = './public/asset/images/default.png';
                    //      Test si import de fichier   //
                        if(!empty($_FILES["image_utilisateur"]["tmp_name"])){
                    //          Récupérer extension du fichier
                            $ext = Utilitaire::getFileExtension($_FILES["image_utilisateur"]["name"]);
                    //          Renommer le fichier
                            $name_image = uniqid().".".$ext;
                            $image = "./Public/asset/images/".$name_image;
                    //      Déplacer le fichier     //
                            move_uploaded_file($_FILES["image_utilisateur"]["tmp_name"], $image);
                        }
                    //      Setter les valeurs  //
                        $this->setNom($nom);
                        $this->setPrenom($prenom);
                        $this->setEmail($email);
                        $this->setPass($hash);
                        $this->setImage($image);
                        $this->getRole()->setId(1);
                    //      Ajout en BDD        //
                        $this->insertUtilisateur();
                        $error = "Le compte a bien été ajouté à la BDD";
                    }
                    else {
                        $error = "Impossible d'ajouter l'utilisateur à la BDD";
                    }
                }
                else {
                    $error = "Mots de passes différents!";
                }
            }
            else{
                $error = "Veuillez remplir tous les champs du formulaire";
            }
        }
        Template::render('navbar.php', 'Inscription', 'vueAddUser.php', 'footer.php', $error, ['script.js'], ['style.css']);
    }
    public function connexionUtilisateur(): void{
        $error = '';
    //      Test si le bouton est cliqué
        if(isset($_POST['submit'])){
            if(!empty($_POST['email_utilisateur']) AND !empty($_POST['pass_utilisateur'])){
                $email = Utilitaire::cleanInput($_POST["email_utilisateur"]);
                $this->setEmail($email);
                $recup = $this->getUtilisateurByMail();
                if ($recup) {
                //      Pass de la base de donnée       //
                    $hash = $recup->getPass();
                //      Pass du formulaire              //
                    $pass = Utilitaire::cleanInput($_POST["pass_utilisateur"]);
                    if(password_verify($pass, $hash)){
                //          Créer une session           //
                        $_SESSION["connected"] = true;
                        $_SESSION["nom"] = $recup->getNom();
                        $_SESSION["prenom"] = $recup->getPrenom();
                        $_SESSION["image"] = $recup->getImage();
                        $error = "Bienvenue ".$_SESSION["prenom"]." ".$_SESSION["nom"];
                    }
                    else {
                        $error = "Cette combinaison mail / mot de passe n'existe pas dans notre base de données.";
                    }
                }
                else {
                    $error = "Cette combinaison mail / mot de passe n'existe pas dans notre base de données.";
                }
            }
            else {
                $error = "Veuillez tout remplir";
            }
        }
        Template::render('navbar.php', 'Inscription', 'vueConnexion.php', 'footer.php', $error, ['script.js'], ['style.css']);
    }
}