<!--titre de la page -->
<?php $title = 'Edition des Chapitres';?>

<?php ob_start(); ?>
<div id="administrationChapter">
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
            { $limit=500;
            $res['content']= strip_tags($res['content']);
             if (strlen($res['content'])>=$limit){
                 $res['content']=substr($res['content'],0,$limit);
                 $space=strrpos($res['content'],' ');
                 $res['content']=substr($res['content'],0,$space)."...";}
            ?>
                <tr>
                    <th scope="row">
                        <?= ($res['id_chapter'])?>
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
                    <th><a role="button" class="btn btn-light" href="http://localhost/Projet4/index.php?action=edit&&id_chapter=<?=$res['id_chapter']?>" role="button"><i class="far fa-edit"></i></a></th>
                </tr>
                <?php

            }
            $resume->closeCursor();
            ?>

            </tbody>
        </table>

        </tbody>
        </table>

    </article>
</div>


<?php $content=ob_get_clean(); ?>
<?php require('templateBack.php'); ?>
