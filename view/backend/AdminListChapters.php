<?php $title = 'Edition des Chapitres';$config=include('config/config.php');
$url=$config['url'];
ob_start(); ?>

<div id="administrationChapter">
    <!--résumé des chapitres -->
    <article id="fast" class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <h3>Vous pouvez choisir le chapitre à éditer dans la liste ci-dessous :</h3>
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
                    <th scope="col">Supprimer</th>
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
                        <a role="button" class="btn btn-light"
                           href="<?=$url?>?action=edit&&id_chapter=<?=$res['id_chapter']?>" role="button"><i class="far fa-edit"></i>
                        </a>
                    </th>
                    <td>
                        <button type="button" class="btn btn-light" data-toggle="modal"
                                data-target="#deletChap<?=$res['number_chapter']?>"><i class="far fa-trash-alt"></i>
                        </button>
                        <div class="modal" id="deletChap<?=$res['number_chapter']?>" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Êtes-vous sûr de vouloir supprimer ce chapitre<br />
                                            <a class="btn btn-primary"
                                               href="<?=$url?>?action=supprim&&number=<?=$res['number_chapter']?>"
                                               role="button"> <i class="fas fa-check"></i> oui
                                            </a>
                                        </p>
                                    </div>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fas fa-times"></i> annuler
                                    </button>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
            }
            $resume->closeCursor();
                ?>
            </tbody>
        </table>
    </article>
    <article id="numero">
        <h3>Pour changer la numérotation des chapitres, veuillez la changer dans le tableau ci-dessous puis valider.</h3>
        <form action="./index.php?action=numero" method="post" value="numero" class="numero">
            <button type="submit" class="btn btn-primary">
                <h5>Valider </h5><i class="fas fa-check"></i>
            </button>
            <table class="table table-striped numero">
                <thead>
                    <tr>
                        <th scope="col">titre</th>
                        <th scope="col">ancien numéro</th>
                        <th scope="col">nouveau numéro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
            while ($res = $resume2->fetch())
            {?>
                    <tr>
                        <th scope="row">
                            <?= ($res['title'])?>
                        </th>
                        <th scope="row">
                            <?=($res['number_chapter'])?>
                            <input type="hidden" id=" old<?=$res['id_chapter']?>" name="old<?=$res['id_chapter']?>" value="<?=($res['number_chapter'])?>" />

                        </th>
                        <th>
                            <input type="text" id="new<?=$res['id_chapter']?>" name="new<?=$res['id_chapter']?>" value="<?=($res['number_chapter'])?>" size="3" />
                        </th>
                        <input type="hidden" id=" <?=$res['id_chapter']?>" name="<?=$res['id_chapter']?>" value="<?=$res['id_chapter']?>" />
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
