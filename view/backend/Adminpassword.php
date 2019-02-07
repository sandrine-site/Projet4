<?php $title = 'Gerer le mot de Passe';?>

<?php ob_start(); ?>

<div class="adminPW">
    <h5>Pour changer votre mot de passe :
        <ul>
            <li>Saisissez votre mot de passe actuel ;</li>
            <li>Saisissez le nouveau mot de passe de votre choix et confirmer ;</li>
        </ul>
    </h5>
    <form action="./index.php?action=AdminPW" method="post" class="adminPW">
        <div>
            <label for="Name">
                <p>Nom :</p>
            </label>
            <input title="texte" name="Name" value="<?=$post['logins']?>" />
        </div>
        <div>
            <label for="PasswordActuel">
                <p>Mot de passe actuel :</p>
            </label>
            <input type="password" name="Password" />
        </div>
        <div>
            <label for="Password1">
                <p>Nouveau mot de passe :</p>
            </label>
            <input type="password" name="Password1" /></div>
        <div>
            <label for="Password1">
                <p>Confirmer le mot de passe :</p>
            </label>
            <input type="password" name="Password2" /></div>
        <input type="submit" value="Envoyer" />
    </form>
</div>
<?php $content=ob_get_clean(); ?>
<?php require('templateBack.php'); ?>
