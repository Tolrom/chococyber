<?php ob_start()?>
<h1>Ajouter un compte utilisateur : </h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="nom_utilisateur">Saisir le nom</label>
        <input type="text" name="nom_utilisateur">
        <label for="prenom_utilisateur">Saisir le prénom</label>
        <input type="text" name="prenom_utilisateur">
        <label for="email_utilisateur">Saisir le mail</label>
        <input type="text" name="email_utilisateur">
        <label for="pass_utilisateur">Saisir le mot de passe</label>
        <input type="password" name="pass_utilisateur">
        <label for="pass_confirm"></label>
        <input type="password" name="pass_confirm">
        <label for="image_utilisateur"></label>
        <input type="file" name="image_utilisateur">
        <input type="submit" value="S'inscrire" name="submit">
    </form>     
    <p><?=$error?></p>
<?php $content = ob_get_clean()?>
