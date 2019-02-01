<?php 
$title = 'Site de Jean Forteroche';
ob_start();
?>

<div id=back>
    <!--       Annimation oiseaux -->
    <div id="bird1"></div>
    <div id="bird2"></div>
    <div id="bird3"></div>
    <div id="bird4"></div>
    <div id="bird5"></div>

    <div id=front>
        <!--Article titre -->
        <article id="intro" class="row">
            <div class="col-12 conteneur">
                <h1>Billet simple pour l'Alaska </h1>
                <br />
                <p> Afin de vous remercier de ces nombreuses années à me suivre. J'ai choisi de publier mon prochain ouvrage en ligne.<br />
                    Je vous invite donc à vous installer confortablement, pour partir en voyage et découvrir l'Alaska. Qui sait peut-être que pour vous aussi ce voyage sera sans retour.<br />
                    N'hésitez pas à me laisser des commentaires. Je pourrais les utiliser pour la suite de mon voyage.</p>
            </div>
        </article>
        <!--Article à propos de l'auteur -->
        <article id="about" class="row">
            <div class="col-12 conteneur">
                <h2>A propos de l'auteur </h2>
                <div class="col-sm-6 col-md-5 col-lg-4 photo"><img src="./public/images/dmitry-ratushny-412448-unsplash.jpg" alt="Photo de Jean Forteroche"></div>
                <div class="col-sm-6 col-md-7 col-lg-8 texteAPropos">
                    <p>Jean Forteroche écrit des romans qui expriment sa passion pour le voyage, l'idéologie et le développement personnel.
                        <br /><br />
                        Acteur, formé en France et aux Etats-Unis, conférencier à l'Université de Clermont-Ferrand, il a pendant de nombreuses années sillonné le monde à la rencontre d'hommes et de femmes qui, chacun à sa manière, apporte des éclairages sur la question fondamentale entre toutes : comment s'épanouir et donner du sens à sa vie.
                        <br /><br />
                        Il se consacre aujourd'hui à l'écriture.
                        Les romans de Jean Forteroche sont des best-sellers traduits dans le monde entier.</p>
                </div>
            </div>
        </article>
        <!--Article billet simple pour l'Alaska -->
        <article id="extracts" class="row">
            <div class="col-12 conteneur">
                <h2>Billet simple pour l'Alaska </h2>
                <br />
                <div id="title">
                    <p>Je griffonne ces quelques lignes sur le joli calepin que tu m’as offert avant mon départ.<br />
                        Ce livre est l'histoire de Pierre explorateur, imaginée par sa fille Maud.<br />
                        Jour aprés jour elle raconte le voyage de son père, parti pour l'Alaska. Mais reviendra-t-il? </p>
                    <br />

                </div>
                <div class="col-sm-6 col-md-7 col-lg-8 texteAPropos">
                    <h2>
                        chapitre :
                        <?= $post['id_chapter'] ?> -
                        <?=strip_tags($post['title'])?>
                    </h2>
                    <p>
                        <?=nl2br(strip_tags($post['content']))?><br /><br />
                    </p>
                    <a class="btn btn-primary" href="./index.php?action=others&&id_chapter=<?=$post['id_chapter'] ?>" role="button">Lire la suite</a>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-4 photo"><img src="./public/images/coverAlaska.png" alt="Photo de couverture du livre billet simple pour l'Alaska"></div>
            </div>
        </article>
        <!--Article derniers avis -->
        <article id="comments">
            <div class="col-12 conteneur">
                <?php
    if (isset($_GET['ErrorComments'])){
                ?>
                <div class="warning">
                    <p>Veuillez m'excuser mais je n'ai pas compris votre demande</p>
                </div>
                <?php
    }
                        if (isset($_GET['from'])&&$_GET['from']=='frontend'){
                ?>
                <div class="warning">
                    <p>Merci de nous avoir indiqué ce commentaire, nous allons le lire avec attention.</p>
                </div>
                <?php
                        }

                        $number= $post['id_chapter'];
                ?>
                <h2>
                    Les derniers commentaires sur le chapitre :
                    <?=$number?>
                </h2>
                <div class="row">
                    <?php
    $i=1;
                    while ($comment = $comments->fetch())
                    {
                        if ($i<=4)
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
                            <a class="btn btn-secondary" href="./index.php?action=signalComment&&id_comment=<?=$comment['id_comment'] ?>&&id_chapter=<?=$comment['id_chapter'] ?>&&from=<?=$title?>"><em>signaler ce commentaire</em></a>
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
        <!--Article principaix titres -->
        <article id="mainTitles" class="row">
            <div class="col-12 conteneur">
                <h2>Du même auteur</h2>
                <figure class="col-sm-6 col-md-4 col-lg-2 photo"><img src="./public/images/cover1.jpg" alt="couverture du livre Wall street" />
                    <figcaption>
                        <h4>Wall Street</h4>
                        <p>Argent,
                            <br /> courbes ascendantes et inversement,
                            <br />arnaqueurs,
                            <br />partenaires,
                            <br />buildings,
                            <br />bourse.
                            <br />Burn-out.</p>
                    </figcaption>
                </figure>
                <figure class="col-sm-6 col-md-4 col-lg-2 photo"><img src="./public/images/cover2.jpg" alt="couverture du livre Une maison dans le ciel" />
                    <figcaption>
                        <h4>Une maison dans le ciel</h4>
                        <p>Après un énième virage dans les cieux, elle apparut, soudainement, subitement, au creux de plusieurs nuages effilés : une maison, une véritable bâtisse, que les pilotes du ballon s’empressèrent d'explorer.</p>
                    </figcaption>
                </figure>
                <figure class="col-sm-6 col-md-4 col-lg-2 photo"><img src="./public/images/cover3.jpg" alt="couverture du livre C'est là que le couteux tombe" />
                    <figcaption>
                        <h4>C'est là que le couteau tombe</h4>
                        <p>Un lieu clôt.
                            <br />Des personnages suspects.
                            <br />Un inspecteur déboussolé,
                            <br />dans un univers où les erreurs ne sont plus permises. </p>
                    </figcaption>
                </figure>
                <figure class="col-sm-6 col-md-4 col-lg-2 photo"><img src="./public/images/cover4.png" alt="Sur le pouvoir et l'idéologie" />
                    <figcaption>
                        <h4>Sur le pouvoir et l'idéologie</h4>
                        <p>2034, le drapeau Nazis flotte sur la lune, l'allemand est langue première dans toutes les écoles d'Europe. La monarchie n'a jamais été abolie dans l'hexagone.
                            Et si l'histoire que vous aviez connue n'était plus que songe ? </p>
                    </figcaption>
                </figure>
                <figure class="col-sm-6 col-md-4 col-lg-2 photo"><img src="./public/images/cover5.jpg" alt="couverture du livre 1000 parapluies noirs" />
                    <figcaption>
                        <h4>1000 parapluies noirs</h4>
                        <p>1 parapluie.
                            <br /> 2 parapluies.
                            <br />3 parapluies.
                            <br />1000 parapluies, et toujours pas protégée de l'orage qui tourmentait son esprit.</p>
                    </figcaption>
                </figure>
                <figure class="col-sm-6 col-md-4 col-lg-2 photo"><img src="./public/images/cover6.jpg" alt="couverture du livre Et puis il y a ça">
                    <figcaption>
                        <h4>Et puis il y a ça</h4>
                        <p>En cherchant sur Google de quoi compléter leur exposé sur les sorcières, Taissa et Emilie étaient loin de se douter sur quoi elles allaient tomber. </p>
                    </figcaption>
                </figure>
            </div>
        </article>
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
</div>

<?php
$content=ob_get_clean();
require('template.php');
?>
