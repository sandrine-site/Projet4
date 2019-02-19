<header>
<?php
$config=include('././config/config.php');

$url=$config['url'];

?>
    <div class="menu">
        <input type="checkbox" name="menuburger" id="menuburger">
        <label for="menuburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </label>
        <nav>
            <a href=<?=$url?>>Accueil</a><br />
            <a href="<?=$url?>?action=others&&id_chapter=<?=1 ?>">Billet simple pour l'Alaska</a>
            <hr />
            <a href="<?=$url?>?action=interfaceAdmin">Administration</a>
        </nav>
    </div>
    <?php
       if (isset($_SESSION['error add comment'])&&$_SESSION['error add comment']==true ){
           ?>
            <article class="warning">
        <div class="warning">
            Désolé, nous n'avons pas pu enregistrer votre message.
        </div>
    </article>
                    <?php
       }
       elseif ($_SESSION['signal comment']==true){
           ?>
<article class="thank">
    Merci de nous avoir signalé ce message, nous allons l'examiner avec attention.
</article>
       <?php }
       elseif ((isset($_SESSION['password message'])&&$_SESSION['password message']==true)||(isset($_SESSION['verifyPwsMessage'])&&$_SESSION['verifyPwsMessage']=='no')){

           ?>
           <article class="warning">
               attention! vous devez remplir le nom et le mot de passe.
           </article>
       <?php }
       elseif (isset($_SESSION['verifyPwsMessage'])&&$_SESSION['verifyPwsMessage']=='ko'){
           ?>
           <article class="warning">
              Le nom et le mot de passe ne correspondent pas !
           </article>
       <?php }
        else{
                   ?>
    <?php

    }

    ?>
</header>
