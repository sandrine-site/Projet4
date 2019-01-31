<!--titre de la page -->
<?php $title = 'Administration des commentaires';?>

<?php ob_start(); ?>


<article id="fast" class="row">
    <h4>Les commentaires</h4>

    <table class="table table-striped comments">
        <thead>
            <tr>
                <th scope="col">Chapitre n°</th>
                <th scope="col">par</th>
                <th scope="col">le</th>
                <th scope="col">nb de signalement</th>
                <th scope="col">Résumé</th>
                <th scope="col">Garder</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
    while ($comment = $resumecomments->fetch()){
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
                    <?= htmlspecialchars($comment['author'])?>
                </th>
                <th>
                    <?= htmlspecialchars($comment['dateComment'])?>
                </th>
                <th>
                    <div id='<?=$_id?>'>
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
                                        <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=delete&&id_comment=<?=$comment['id_comment']?>&&from=Accueil" role="button"> <i class="fas fa-check"></i> oui</a></p>
                                </div>

                                <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fas fa-times"></i> annuler</button>
                            </div>
                        </div>
                    </div>
                </td>

            </tr>
            <?php };
            $resumecomments->closeCursor();

                ?>
        </tbody>
    </table>

</article>
<?php $content=ob_get_clean(); ?>
<?php require('templateBack.php'); ?>
