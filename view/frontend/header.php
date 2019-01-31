<header>

    <div class="menu">
        <input type="checkbox" name="menuburger" id="menuburger">
        <label for="menuburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </label>
        <nav>
            <a href="http://localhost/Projet4/index.php">Accueil</a><br />
            <a href="http://localhost/Projet4/index.php?action=others&&id_chapter=<?=1 ?>">Billet simple pour l'Alaska</a>
            <hr />

            <a href="http://localhost/Projet4/index.php?action=interfaceAdmin&&message<?=0 ?>">Administration</a>
        </nav>
    </div>
    <?php
    if (isset($message)&&$message!=""){?>
    <article>

        <div class="warning">

            <?=$message?>

        </div>
    </article>
    <?php }?>
</header>
