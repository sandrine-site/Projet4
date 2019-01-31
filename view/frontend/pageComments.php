<!-- titre de la page -->
<?php $title = 'Billet simple pour l\'alaska : commentaires';?>

<?php ob_start(); ?>
<div id="backComments">
    <div id="frontComments">
        <!-- les avis-->
        <article id="list" class="row">
            <div class="col-12" id="conteneur">
                <?php
                if (isset($_GET['ErreurMessage'])){
            ?>
                <div class="warning">
                    <p>Désolés, nous n'avons pas pu enregistrer votre message. <br />
                        Les deux champs doivent être remplis, ils ne doivent pas contenir de caractères spéciaux.</p>
                </div>
                <?php
                }
            ?>
                <?php
                if (isset($_GET['from'])&&$_GET['from']=='frontend'){
                ?>
                <div class="warning">
                    <p>Merci de nous avoir indiqué ce commentaire, nous allons le lire avec attention.</p>
                </div>
                <?php
                }
                ?>
                <h1>Les commentaires sur le chapitre :
                    <?=$_GET['id_chapter'] ?>
                </h1>
                <?php
                    while ($comment = $comments->fetch())
                    {
                ?>
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
                        <a class="btn btn-secondary" href="./index.php?action=signalComment&&id_comment=
                        <?=$comment['id_comment'] ?>&&id_chapter=<?=$comment['id_chapter'] ?>&&from='Comments'"><em>signaler ce commentaire</em></a>
                    </p>
                </div>
                <?php
    }
                    $comments->closeCursor();
                ?>
            </div>
        </article>

        <article id="letComment" class="row">

            <h2>Laisser un commentaire </h2>
            <form action="./index.php?action=addComment&&id_chapter=<?=$_GET['id_chapter']?> " method="post">
                <div class="col-12">
                    <textarea id="comment" name="comment" rows="10" cols="60"></textarea>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <label for="author">
                        <h4> Auteur</h4>
                    </label><br />
                    <input type="text" id="author" name="author" />
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <input type="submit" value="Envoyer" />
                </div>
            </form>
        </article>
    </div>
</div>

<?php $content=ob_get_clean(); ?>
<?php require('template.php'); ?>
