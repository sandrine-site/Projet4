<header>
    <nav>
        <h1>Accés rapides</h1>
        <?php
        if ($title =='Administration des chapitres')
        {?>
        <button type="button" type="submit" role="submit" class="btn btn-primary" data-toggle="modal" data-target="#chapter">

            <h5>Chapitre</h5> <i class="far fa-edit"></i>
        </button>
        <div class="modal" id="chapter" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="./index.php?action=save&&from=<?='ButtonEditChapter'?>" method="post" value="save" class="chapitre">
                            <?=$from=='ButtonEditChapter'?>
                            <p>Voulez-vous enregistrer votre document avant de quitter<br />
                                <button class="btn btn-primary chapitre">Enregistrer<br /><i class="far fa-save"></i></button>
                                <a class="btn btn-primary" type="button" href="./index.php?action=AdminChapter">Non<br /><i class="fas fa-times"></i></a></p>
                        </form>
                    </div>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler <i class="fas fa-times"></i> </button>
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#comment">
            <h5>Commentaires</h5><i class="fas fa-list-ul"></i>
        </button>
        <div class="modal" id="comment" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="./index.php?action=save&&from=<?='Commentaire'?>" method="post" value="save" class="chapitre">
                            <p>Voulez-vous enregistrer votre document avant de quitter<br />
                                <button class="btn btn-primary" type="submit" role="submit">Enregistrer<br /><i class="far fa-save"></i></button>
                                <a class="btn btn-primary" type="button" href="./index.php?action=AllComments">Non<br /><i class="fas fa-times"></i></a></p>
                        </form>
                    </div>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler </button>

                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#password">
            <h5> Mot de passe</h5><i class="fas fa-key"></i>
        </button>
        <div class="modal" id="password" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="./index.php?action=save&&from=<?='password'?>" method="post" value="save" class="chapitre">
                            <p>Voulez-vous enregistrer votre document avant de quitter<br />
                                <button class="btn btn-primary" type="submit" role="submit" action="./index.php?action=save&&from=<?='exit'?>">Enregistrer<br /><i class="far fa-save"></i></button>
                                <a class="btn btn-primary" type="button" href="./index.php?action=AllComments">Non<br /><i class="fas fa-times"></i></a></p>
                        </form>
                    </div>

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler </button>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#chapter">
            <h5>Quiter</h5> <i class="fas fa-sign-out-alt"></i>
        </button>
        <div class="modal" id="chapter" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="./index.php?action=save&&from=<?='exit'?>" method="post" value="save" class="chapitre">
                            <p>Voulez-vous enregistrer votre document avant de quitter<br />
                                <button class="btn btn-primary" type="submit" role="submit" action="./index.php?action=save&&from=<?='exit'?>">Enregistrer<br /><i class="far fa-save"></i></button>
                                <a class="btn btn-primary" type="button" href="./index.php?action=AdminChapter">Non<br /><i class="fas fa-times"></i></a></p>
                        </form>
                    </div>

                </div>

                <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler </button>
            </div>
        </div>
        </form>

        <?php
        }
        else {
    ?>

        <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=<?='AdminChapter'?>" role="button">
            <h5>Chapitre</h5> <i class="far fa-edit"></i>
        </a>
        <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=<?='AllComments'?>&&message=" role="button">
            <h5>Commentaires</h5><i class="fas fa-list-ul"></i>
        </a>
        <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=<?='Adminpw'?>&&message=" role="button">
            <h5> Mot de passe</h5><i class="fas fa-key"></i>
        </a>
        <a class="btn btn-primary" href="http://localhost/Projet4/index.php" role="button">
            <h5>Quiter</h5> <i class="fas fa-sign-out-alt"></i>
        </a>
        <?php
        }?>
        <div class="warning">
            <?php   
        if (isset($message)){
            echo ($message);
        }
        ?>
        </div>
    </nav>

</header>
