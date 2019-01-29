<!--titre de la page -->
<?php $title = 'Administration';?>

<?php ob_start(); ?>

<article id="fast" class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <h3>Aperçu des chapitres:</h3>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">

        <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=<?='AdminChapter'?>">
            <h5>Nouveau chapitre</h5>

            <i class="fas fa-file"></i>
        </a>
    </div>
    <table class="table table-striped chapters">
        <thead>
            <tr>
                <th scope="col">chapitre n°</th>
                <th scope="col">titre</th>
                <th scope="col">Résumé</th>
                <th scope="col">Date de publication</th>
                <th scope="col">Editer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($res = $resume->fetch())
            { $limit=500;
             if (strlen($res['content'])>=$limit){
                 $res['content']=substr($res['content'],0,$limit);
                 $space=strrpos($res['content'],' ');
                 $res['content']=substr($res['content'],0,$space)."...";}
            ?>
            <tr>
                <th scope="row">
                    <?= htmlspecialchars($res['id_chapter'])?>
                </th>
                <th scope="row">
                    <?= htmlspecialchars($res['title'])?>
                </th>
                <th>
                    <?=nl2br( htmlspecialchars($res['content']))?>
                </th>
                <th>
                    <?= htmlspecialchars($res['publication_date'])?>
                </th>
                <th><a role="button" class="btn btn-light" href="http://localhost/Projet4/index.php?action=edit&&id_chapter=<?=$res['id_chapter']?>" role="button"><i class="far fa-edit"></i></a></th>
            </tr>
            <?php

            }
            $resume->closeCursor();
            ?>

        </tbody>
    </table>
    <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=<?='AdminChapter'?>" role="button">
        <h5>Nouveau chapitre</h5>

        <i class="fas fa-file"></i>
    </a>

</article>
<article id="fast" class="row">
    <div class="col-sm-12 col-md-6 col-lg-6">
        <h3>Les derniers commentaires </h3>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=<?='AllComments'?>&&message=<?=''?>" role="button">
            <h5>Tous les <br />
                commentaires :</h5>

            <i class="fas fa-list-ul"></i>
        </a>
    </div>

    <table class="table table-striped comments">
        <thead>
            <tr>
                <th scope="col">Chapitre n°</th>
                <th scope="col">Commentaire n°</th>
                <th scope="col">nb de signalement</th>
                <th scope="col">Résumé</th>
                <th scope="col">Garder</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
    $i=0;
        while ($comment = $resumecomments->fetch()){
            if ($i<=5){
                if(($comment['signalement'])==0){
                    $_id="no";
                }
                elseif(($comment['signalement'])>=5){
                    $_id="plus";
                }
                else{
                    $_id="moins";
                }?>
            <tr>

                <th>
                    <?= htmlspecialchars($comment['id_chapter'])?>
                </th>
                <th>
                    <?= htmlspecialchars($comment['id_comment'])?>
                </th>
                <th>
                    <div id=<?=$_id?>>
                        <?= htmlspecialchars($comment['signalement'])?>
                    </div>
                </th>
                <th>
                    <?=nl2br( htmlspecialchars($comment['comment']))?>
                </th>
                <th><a role="button" class="btn btn-light" href="http://localhost/Projet4/index.php?action=keepComment&&id_comment=<?=$comment['id_comment']?>&&from=Accueil" role="button"><i class="fas fa-check-square"></i></a></th>
                <td><button type="button" class="btn btn-light" data-toggle="modal" data-target="#delet"><i class="far fa-times-circle"></i></button>
                    <div class="modal" id="delet" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p>Êtes-vous sûr de vouloir supprimer ce commentaire<br />
                                        <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=delete&&id_comment=<?=$comment['id_comment']?>&&from=Accueil" role="button">oui</a></p>
                                </div>

                                <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fas fa-times"></i> annuler</button>
                            </div>
                        </div>
                    </div>
                </td>

            </tr>
            <?php
                    $i++;}

        }
        $resume->closeCursor();

            ?>
        </tbody>
    </table>
    <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=<?='AllComments'?>&&message=<?=''?>" role="button">
        <h5>Tous les <br />
            commentaires :</h5>


        <i class="fas fa-list-ul"></i>
    </a>
</article>
<?php $content=ob_get_clean(); ?>
<?php require('templateBack.php'); ?>
