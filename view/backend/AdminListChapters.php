<?php $title = 'Edition des Chapitres';?>

<?php ob_start(); ?>

<div id="administrationChapter">
    <!--résumé des chapitres -->
    <article id="fast" class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <h3>Vous pouvez choisir le chapitre à édité dans la liste çi dessous :</h3>
        </div>
        <table class="table table-striped chapters">
            <thead>
                <tr>
                    <th scope="col">chapitre n°</th>
                    <th scope="col">titre</th>
                    <th scope="col">Résumé</th>
                    <th scope="col">Date de publication</th>
                    <th scope="col">Dernière modification</th>
                    <th scope="col">Editer</th>
                </tr>
            </thead>
            <tbody>
                <?php
            while ($res = $resume->fetch())
            {
                $limit=500;
                $res['content']= strip_tags($res['content']);
                if (strlen($res['content'])>=$limit){
                    $res['content']=substr($res['content'],0,$limit);
                    $space=strrpos($res['content'],' ');
                    $res['content']=substr($res['content'],0,$space)."...";
                }
            ?>
                <tr>
                    <th scope="row">
                        <?= ($res['number_chapter'])?>
                    </th>
                    <th scope="row">
                        <?= strip_tags($res['title'])?>
                    </th>
                    <th>
                        <?=strip_tags($res['content'])?>
                    </th>
                    <th>
                        <?= ($res['publication_date'])?>
                    </th>
                    <th>
                        <?= ($res['modification_date'])?>
                    </th>
                    <th>
                        <a role="button" class="btn btn-light" href="http://localhost/Projet4/index.php?action=edit&&id_chapter=<?=$res['id_chapter']?>" role="button"><i class="far fa-edit"></i>
                        </a>
                    </th>
                </tr>
                <?php
            }
            $resume->closeCursor();
                ?>
            </tbody>
        </table>
    </article>
    <article id="supprim">
        <h3> Si vous voulez supprimer un chapitre veuliiez indiquer son numéro dans le champs ci-dessous. </h3>
        <div class="row">
            <form action="./index.php?action=supprim" method="post" value="delete" class="delete">
                <div class="col-sm-12 col-md-6 col-lg-6">

                    <label for="number">
                        <h3> Numéro : </h3>
                    </label>
                    <input type="text" id="number" name="number" />
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deletChap">
                        <h5> Supprimer<br /></h5>
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
                <div class="modal" id="deletChap" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <p>Êtes-vous sûr de vouloir supprimer ce chapitre<br />
                                    <button type="submit" role="submit" class="btn btn-primary"><i class="fas fa-check"></i> oui
                                    </button>
                                </p>
                            </div>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fas fa-times"></i> annuler
                            </button>

                        </div>
                    </div>


                </div>
            </form>

        </div>
    </article>
</div>


<?php $content=ob_get_clean(); ?>
<?php require('templateBack.php'); ?>
