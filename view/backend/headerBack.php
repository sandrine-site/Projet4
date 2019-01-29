<header>
    <nav>
        <h1>Accés rapides</h1>


        <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=<?='CreeNewChapter'?>" role="button">
            <h5>Créer un chapitre</h5> <i class="fas fa-pen-nib"></i>
        </a>
        <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=<?='AdminChapter'?>" role="button">
            <h5>Editer un chapitre</h5> <i class="far fa-edit"></i>
        </a>

        <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=<?='AllComments'?>&&message=" role="button">
            <h5>Commentaires</h5><i class="fas fa-list-ul"></i>
        </a>
        <a class="btn btn-primary" href="http://localhost/Projet4/index.php?action=<?='Adminpw'?>&&message=" role="button">
            <h5> Mot de passe</h5><i class="fas fa-key"></i>
        </a>
        <a class="btn btn-primary" href="http://localhost/Projet4/index.php" role="button">
            <h5>Quiter</h5> <i class="fas fa-sign-out-alt"></i>
        </a>

        <div class="warning">
            <?php   
        if (isset($message)){
            echo ($message);
        }
        ?>
        </div>
    </nav>

</header>
