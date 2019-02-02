<header>
    <nav>
        <h1>Accés rapides</h1>
        <?php $active1=$active2=$active3=$active4='';

        switch( $title ){

            case 'Création des chapitres': $active1='active';
                break;
            case 'Edition des Chapitres':$active2='active';

                break;
            case 'Administration des commentaires':$active3='active';
                break;
            case 'Gerer le mot de Passe':$active4='active';
                break;}
        if ($title != 'Création des chapitres'&& $title!='Edition des Chapitres'){?>
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
        </div><?php}
        else{?>
            <a role="button" class="btn btn-light" href="http://localhost/Projet4/index.php?action=keepComment&&id_comment=<?=$comment['id_comment']?>&&from=Accueil" role="button"><i class="fas fa-check-square"></i></a></th>
        <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#delet"><i class="far fa-times-circle"></i></button>
            <div class="modal" id="delet" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>Êtes-vous sûr de vouloir supprimer ce commentaire<br />
                                <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=delete&&id_comment=<?=$comment['id_comment']?>&&from=Accueil" role="button"> <i class="fas fa-check"></i> oui</a></p>
                        </div>

                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fas fa-times"></i> annuler</button>
                    </div>
                </div>
            </div>


        }
       <button type="button" class="btn btn-primary <?= $active1?>" data-toggle="modal" data-target="#input"><i class="far fa-times-circle"></i></button>
            <div class="modal" id="delet" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <p>Êtes-vous sûr de vouloir supprimer ce commentaire<br />
                                <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=delete&&id_comment=<?=$comment['id_comment']?>&&from=Accueil" role="button"> <i class="fas fa-check"></i> oui</a></p>
                        </div>

                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fas fa-times"></i> annuler</button>
                    </div>
                </div>
            </div>

            <div class="warning">
                <?php
    if (isset($message)){echo ($message);
    }
            ?>
            </div>
    </nav>

</header>
