<?php ob_start()?>
<h1>Se connecter à un compte utilisateur : </h1>
    <form action="" method="post">
        <label for="email_utilisateur">Saisir le mail</label>
        <input type="text" name="email_utilisateur">
        <label for="pass_utilisateur">Saisir le mot de passe</label>
        <input type="password" name="pass_utilisateur">
        <input type="submit" value="Se connecter" name="submit">
    </form>     
    <p><?=$error?></p>
<?php $content = ob_get_clean()?>
