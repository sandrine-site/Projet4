<!--titre de la page -->
<?php $title = ("chapitre : ".$post['id_chapter']);$title2="chapitre";?>

<?php ob_start(); ?>
<div id="backChapter">
    <div id="frontChapter">
        <!-- chapitre -->
        <article id="chapter" class="row">
            <div class="col-12" id="conteneur">
                <h1>Billet simple pour l'Alaska </h1>
                <div id="title">
                    <h3>
                        chapitre :
                        <?= $post['id_chapter'] ?> -
                        <?=strip_tags($post['title'])?>
                    </h3>
                </div>
                <p>
                    <br /><br />
                    <?=nl2br(strip_tags($post['content']))?>
                </p>
            </div>
        </article>
        <!-- commentaires -->
        <article id="comments">
            <div class="row">
                <h2>
                    Les derniers commentaires sur le chapitre :
                    <?=$post['id_chapter']?>
                </h2>
                <?php
    $i=1;
                        while ($comment = $comments->fetch()){
                            $id=$comment['id_comment'];
                            if ($i<=4){
                ?>
                <div class="col-sm-12 col-md-6 col-lg-3 Avis">
                    <h4> Par :
                        <?= htmlspecialchars($comment['author']) ?>
                    </h4>
                    <p>
                        <?= nl2br(htmlspecialchars($comment['comment'])) ?>
                        <br />
                        <br />
                        <span> le :
                            <?= $comment['DateComment_fr'] ?> </span>
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="<?='#signal'.$id?>"><em>signaler ce commentaire</em>
                        </button>
                        <div class="modal" id="<?='signal'.$id?>" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <p>Êtes-vous sûr de vouloir signaler ce commentaire<br /></p>
                                    <div class="modal-footer">
                                        <a class="btn btn-primary" href="./index.php?action=signalComment&&id_comment=<?=$id?>&&id_chapter=<?=$comment['id_chapter'] ?>&&from=<?=$title?>" role="button"> <i class="fas fa-check"></i> oui</a>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fas fa-times"></i> annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <?php
                    $i++;
                            }
                        }
                        $comments->closeCursor();
                ?>
            </div>
            <div class="row">
                <a class="btn btn-primary" href="./index.php?action=comments&&id_chapter=<?=$post['id_chapter'] ?>" role="button">
                    Tous les commentaires
                    <br />
                    Laisser un commentaire
                </a>
            </div>
        </article>
    </div>
    <!-- accés aux autre chapitres -->
    <article id="nav" class="row">
        <h4>Accéder aux autres chapitres :</h4>
        <div class="othersChapter">
            <p>
                <?php
    $i=1;
                   while ($i<=$len['COUNT(id_chapter)']){
                ?>
                <a class="btn btn-primary" href="./index.php?action=others&&id_chapter=<?=$i ?>" role="button">
                    Chapitre
                    <?=$i?>
                </a>
                <?php
                    $i++;
                   }
                ?>
            </p>
        </div>
    </article>
</div>

<?php $content=ob_get_clean(); ?>
<?php require('template.php'); ?>
