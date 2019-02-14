
<?php $title = 'Mot de Passe';?>

<?php ob_start(); ?>
<div id="administration">
    <h2>Pour entrer dans l'interface d'administration, veuillez saisir votre nom et votre mot de passe </h2>
    <form action="./index.php?action=interfaceAdmin" method="post">
        <div>
            <label for="Name">
                <p>Nom :</p>
            </label>
            <input title="texte" name="Name" value="<?=$post['logins']?>" />
        </div>
        <div>
            <label for="Password">
                <p>Mot de passe :</p>
            </label>
            <input type="password" name="Password" />
        </div>
        <input type="submit" value="Envoyer" />
    </form>
</div>

<?php $content=ob_get_clean(); ?>
<?php require('template.php'); ?>
