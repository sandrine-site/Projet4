<!--titre de la page -->
<?php $title = 'Administration des chapitres';?>

<?php ob_start(); ?>
<div id="administrationChapter">
    <article id="create">
        <form action="./index.php?action=saveNew&&id_chapter=<?=$chapter['id_chapter']?>" method="post" value="save" class="chapitre">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <h2> Créer un nouveau chapitre : </h2>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <button type="submit" role="submit" class="btn btn-primary">
                    <h5> Enregistrer<br /></h5>
                    <i class="far fa-save"></i>
                </button>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="title">
                        <h3> Titre : </h3>
                    </label>
                    <input type="text" id="title" name="title" value="<?=$chapter['title']?>" />
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="id_chapter">
                        <h3> Numéro : </h3>
                    </label>
                    <input type="text" id="id_chapter" name="idChapter" value="<?=$chapter['id_chapter']?>" />
                </div>
            </div>
            <div class="row">

                <div class="col-sm-12 col-md-12 col-lg-12">
                    <textarea id="mytextarea" name="mytextarea" rows="25"><?=$chapter['content']?></textarea>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12">

                <button type="submit" role="submit" class="btn btn-primary">
                    <h5> Enregistrer<br /></h5>
                    <i class="far fa-save"></i>
                </button>
            </div>
        </form>
    </article>
    <article id="fast" class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <h3>Chapitres déjà enregistés:</h3>
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
            { $limit=300;
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
                    <th> <a role="button" class="btn btn-light" href="http://localhost/Projet4/index.php?action=edit&&id_chapter=<?=$res['id_chapter']?>" role="button"><i class="far fa-edit"></i></a></th>
                </tr>
                <?php

            }
            $resume->closeCursor();
            ?>

            </tbody>
        </table>

    </article>
</div>


<?php $content=ob_get_clean(); ?>
<?php require('templateBack.php'); ?>
