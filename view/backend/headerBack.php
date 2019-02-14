<header>
    <nav>
        <h1>Accés rapides</h1>
        <?php
        $config=include('config/config.php');
        $url=$config['url'];
        $active1=$active2=$active3=$active4='';
        switch( $title ){
            case 'Création des chapitres': $active1='active';
                break;
            case 'Edition des Chapitres':$active2='active';
                break;
            case 'Administration des commentaires':$active3='active';
                break;
            case 'Gerer le mot de Passe':$active4='active';
                break;}
        ?>
        <div class="btn-group btn-group-justified" role="group" aria-label="...">

            <a class="btn btn-primary <?= $active1?> " href="<?=$url?>?action=<?='CreeNewChapter'?>" role="button">
                <h5>Créer un chapitre</h5> <i class="fas fa-pen-nib"></i>
            </a>
            <a class="btn btn-primary <?= $active2?>" href="<?=$url?>?action=<?='ListOfChapter'?>" role="button">
                <h5>Editer un chapitre</h5> <i class="far fa-edit"></i>
            </a>
            <a class="btn btn-primary <?= $active3?>" href=<?=$url?>?action=<?='AllComments'?> role="button">
                <h5>Commentaires</h5><i class="fas fa-list-ul"></i>
            </a>
            <a class="btn btn-primary <?= $active4?>" href="<?=$url?>?action=<?='Adminpw'?>" role="button">
                <h5> Mot de passe</h5><i class="fas fa-key"></i>
            </a>
            <a class="btn btn-primary" href="<?=$url?>" role="button">
                <h5>Quitter</h5> <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>

        <?php
        if (isset($_SESSION["delete comment"])&& $_SESSION["delete comment"]==true)
        {
            ?>
            <div class="warning">
                <?=$_SESSION["delete comment"]?>
            </div>

            <?php

        }
        elseif (isset($_SESSION['newPwerror'])&&$_SESSION['newPwerror']==true )
        {
            ?>
            <div class="warning">
                Attention le nouveau mot de passe et sa confirmation ne correspondent pas !
            </div>

            <?php
        }
        elseif (isset( $_SESSION['newPwless'])&& $_SESSION['newPwless']==true )
        {
            ?>
            <div class="warning">
                Attention tous les champs doivent être remplis !
            </div>

            <?php
        }
        elseif (isset( $_SESSION["message new Pw"])&& $_SESSION["message new Pw"]=='ko' )
        {
            ?>
            <div class="warning">
                Attention l'ancien mot de passe ne correspond pas !
            </div>

            <?php
        }
        elseif (isset( $_SESSION["message new Pw"])&& $_SESSION["message new Pw"]=='ok'){
            ?>
            <div class="thank">
                Le mot de passe a bien été modifié !
            </div>
            <?php
        }
        elseif (isset( $_SESSION['doublons'])&& $_SESSION['doublons']==true ){
        ?>

        <div class="warning">
            attention vous avez deux fois le même numéro de chapitre
        </div>
        <?php
        }
        elseif (isset( $_SESSION['save chapter'])&& $_SESSION['save chapter']==true){
            ?>
            <div class="thank">
                Le chapitre a bien été sauvegardé
            </div>
            <?php
        }
        elseif (isset( $_SESSION["exist"])&& $_SESSION["exist"]==true&& $_SESSION['save chapter']==false )
        {
            ?>
            <div class="warning">
                Attention ce chapitre existe déjà.
            </div>

            <?php
        }
            ?>
    </nav>
</header>
