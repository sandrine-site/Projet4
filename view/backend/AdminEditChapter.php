<?php $title = 'Edition des Chapitres';?>

<?php ob_start(); ?>
<!--Editeur de texte -->
<div id="administrationChapter">
    <article id="create">
        <form action="./index.php?action=update" method="post" value="save" class="chapitre">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <h2> Edition du Chapitre :
                    <?=$chapter['id_chapter']?>
                </h2>
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
                    <div id="dates">
                        <p> date de publication :
                            <?=$chapter['publication_date']?>
                        </p>
                        <br />
                        <p> dernière modification :
                            <?=$chapter['modification_date']?>
                        </p>
                    </div>
                    <div id=numberChapter>
                        <input type="hidden" id="id_chapter" name="id_chapter" value="<?=$chapter['id_chapter']?>" type="hidden" />
                    </div>
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
    <!--résumé des chapitres -->
    <article id="fast" class="row">
        <div class="col-sm-12 col-md-6 col-lg-6">
            <h3>Chapitres :</h3>
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
    while ($res = $resume->fetch()){
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
</div>

<?php $content=ob_get_clean(); ?>
<?php require('templateBack.php'); ?>
