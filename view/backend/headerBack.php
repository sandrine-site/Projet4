<header>
    <nav>
        <h1>Accés rapides</h1>
        <?php
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
            <a class="btn btn-primary <?= $active1?> " href="http://localhost/Projet4/index.php?action=<?='CreeNewChapter'?>" role="button">
                <h5>Créer un chapitre</h5> <i class="fas fa-pen-nib"></i>
            </a>
            <a class="btn btn-primary <?= $active2?>" href="http://localhost/Projet4/index.php?action=<?='ListOfChapter'?>" role="button">
                <h5>Editer un chapitre</h5> <i class="far fa-edit"></i>
            </a>
            <a class="btn btn-primary <?= $active3?>" href="http://localhost/Projet4/index.php?action=<?='AllComments'?>&&message=" role="button">
                <h5>Commentaires</h5><i class="fas fa-list-ul"></i>
            </a>
            <a class="btn btn-primary <?= $active4?>" href="http://localhost/Projet4/index.php?action=<?='Adminpw'?>&&message=" role="button">
                <h5> Mot de passe</h5><i class="fas fa-key"></i>
            </a>
            <a class="btn btn-primary" href="http://localhost/Projet4/index.php" role="button">
                <h5>Quitter</h5> <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
        <div class="warning">
            <?php
    if (isset($message)){
        echo ($message);
    }
        ?>
        </div>
    </nav>
</header>
