<!--titre de la page -->
<?php $title = "chapitre : ".$post['id_chapter'];?>

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
                <div class="col-12" id="conteneur">
                    <?php
                if (isset($_GET['from'])&&$_GET['from']=='frontend'){
                ?>
                    <h4>Merci de nous avoir indiqué ce commentaire, nous allons le lire avec attention.</h4>
                    <?php
                }
                
        $number= $post['id_chapter'];
          ?>
                    <h1>
                        Les derniers commentaires sur le chapitre :
                        <?=$post['id_chapter']?>
                    </h1>
                    <?php
            $i=1;
while ($comment = $comments->fetch())
{
if ($i<=4) { ?>

                    <div class="col-sm-12 col-md-6 col-lg-3 Avis">
                        <h4> Par :
                            <?= htmlspecialchars($comment['author']) ?>
                        </h4>
                        <p>
                            <?= nl2br(htmlspecialchars($comment['comment'])) ?>
                            <br />
                            <br />
                            <span>le :
                                <?= $comment['DateComment_fr'] ?></span>
                            <a class="btn btn-secondary" href="./index.php?action=signalComment&&id_comment=<?=$comment['id_comment'] ?>&&id_chapter=<?=$comment['id_chapter'] ?>&&from='Chapter'"><em>signaler ce commentaire</em></a>
                    </div>
                    <?php
                $i++;
              }
            }
            $comments->closeCursor();
          ?>
                </div>
            </div>
            <div class="row">
                <a class="btn btn-primary" href="./index.php?action=comments&&id_chapter=<?=$post['id_chapter'] ?>" role="button">Tous les commentaires/Laisser un commentaire</a>
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
          while ($i<=$len['COUNT(id_chapter)'])
          {
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
