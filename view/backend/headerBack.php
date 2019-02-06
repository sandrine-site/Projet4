<header>

    <nav>
        <h1>Accés rapides</h1>
        <?php
        $active1=$active2=$active3=$active4='';

        switch( $title ){

            case 'Création des chapitres': $active1='active';$active='active1';
                break;
            case 'Edition des Chapitres':$active2='active';$active='active2';

                break;
            case 'Administration des commentaires':$active3='active';$active='active3';
                break;
            case 'Gerer le mot de Passe':$active4='active';
                break;}
        if ($title != 'Création des chapitres'&& $title!='Edition des Chapitres'){
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
        <?php
        }
        else{
        ?>
        <form action="./index.php?action=saveNew&&id_chapter=<?=$chapter['id_chapter']?>&&from=<?=$active?>" method="post" value="save" class="chapitre" id="chapitre <?=$active?>">
            <div class="btn-group btn-group-justified save" role="group" aria-label="...">

                <button type="button" class="btn btn-primary <?= $active1?> " href="./index.php?action=saveNew&&id_chapter=<?=$chapter['id_chapter']?>" data-toggle="modal" data-target="#save">

                    <h5>Créer un chapitre</h5> <i class="fas fa-pen-nib"></i>
                </button>
                <div class="modal" id="save" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p>Voulez vous enregistrer avant de quitter?<br />
                                    <div class="modal-footer">
                                        <input type="checkbox hidden" id="from" name="from" value="active1" />
                                        <button class="btn btn-primary chapitre" id="chapitre <?=$active?>" type="submit" role="submit"> <i class="fas fa-check"></i>oui</button>
                                        <script>document.querySelector('button#chapitre').addEventListener('click', function(e){
	e.preventDefault();})
                    </script>
                                        <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=<?='CreeNewChapter'?>"><i class="fas fa-times"></i> non</a>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"> annuler </button>
                                    </div>
                            </div>


                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary <?= $active2?>" data-toggle="modal" data-target="#edit">
                    <h5>Editer un chapitre</h5> <i class="far fa-edit"></i>
                    <script>$(".<?= $active2?>").click(function(event){
  event.stopPropagation()});
                    </script>
                </button>
                <div class="modal" id="edit" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p>Voulez vous enregistrer avant de quitter?<br />
                                    <div class="modal-footer">
                                        <input type="checkbox hidden" id="from" name="from" value="active2" />
                                        <button class="btn btn-primary chapitre" id="chapitre <?=$active?>" type=" submit" role="submit"><i class="fas fa-check"></i>oui</button>
                                        <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=<?='ListOfChapter'?>"><i class="fas fa-times"></i> non</a>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"> annuler </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary <?= $active3?> " href="./index.php?action=saveNew&&id_chapter=<?=$chapter['id_chapter']?>" data-toggle="modal" data-target="#comments">
                    <h5>Commentaires</h5><i class="fas fa-list-ul"></i>
                </button>
                <div class="modal" id="comments" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p>Voulez vous enregistrer avant de quitter?<br />
                                    <div class="modal-footer">
                                        <input type="checkbox hidden" id="from" name="from" value="active3" />
                                        <button class="btn btn-primary chapitre" id="chapitre" type="submit" role="submit"> <i class="fas fa-check"></i>oui</button>
                                        <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=<?='CreeNewChapter'?>"><i class="fas fa-times"></i> non</a>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"> annuler </button>
                                    </div>
                            </div>

                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary <?= $active4?> " href="./index.php?action=saveNew&&id_chapter=<?=$chapter['id_chapter']?>" data-toggle="modal" data-target="#create">
                    <h5> Mot de passe</h5><i class="fas fa-key"></i>
                </button>
                <div class="modal" id="create" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-body">
                                <p>Voulez vous enregistrer avant de quitter?<br />
                                    <button class="btn btn-primary chapitre" id="chapitre" type="submit" role="submit"> <i class="fas fa-check"></i>oui</button>
                                    <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=<?='CreeNewChapter'?>"><i class="fas fa-times"></i> non</a>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"> annuler </button>
                            </div>


                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" href="./index.php?action=saveNew&&id_chapter=<?=$chapter['id_chapter']?>" data-toggle="modal" data-target="#create">
                    <h5>Quitter</h5> <i class="fas fa-sign-out-alt"></i>
                </button>
                <div class="modal" id="create" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-body">
                                <p>Voulez vous enregistrer avant de quitter?<br />
                                    <button class="btn btn-primary chapitre" id="chapitre" type="submit" role="submit"> <i class="fas fa-check"></i>oui</button>
                                    <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=<?='CreeNewChapter'?>"><i class="fas fa-times"></i> non</a>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"> annuler </button>
                            </div>


                        </div>
                    </div>
                </div>



                <div class="warning">
                    <?php
        }
        if (isset($message)){
            echo ($message);
        }
            ?>
                </div>
            </div>


    </nav>

</header>
