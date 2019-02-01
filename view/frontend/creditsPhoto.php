<?php 
  $title = 'Site de Jean Forteroche : crédits photo';
  ob_start();
?>

<body>
    <h1>crédits photo</h1>
    <div class="row credits">
        <div class="col-sm-6 col-md-2 col-lg-3 photo"><img src="./public/images/dmitry-ratushny-412448-unsplash.jpg" alt="Photo de Jean Forteroche"></div>
        <div class="col-sm-6 col-md-4 col-lg-3 legende">
            <p>Photo by Dmitry Ratushny on Unsplash</p>
        </div>
        <div class="col-sm-6 col-md-2 col-lg-3 photo"><img src="./public/images/billet.jpg" alt="Photo de couverture du livre billet simple pour l'Alaska"></div>
        <div class="col-sm-6 col-md-4 col-lg-3 legende">
            <p>Photo by cynthia del rio onunsplash</p>
        </div>
    </div>
    <div class="row credits">
        <div class="col-sm-6 col-md-2 col-lg-3 photo"><img src="./public/images/header" alt="Photo de conte livre ouvert"></div>
        <div class="col-sm-6 col-md-4 col-lg-3 legende">
            <p>Photo by Dmitry Jonny Lindner on Pixabay</p>
        </div>
        <div class="col-sm-6 col-md-2 col-lg-3 photo"><img src="./public/images/work-1627703_1920.jpg" alt="Photo d'un homme travaillant sur ordinateur"></div>
        <div class="col-sm-6 col-md-4 col-lg-3 legende">
            <p>Photo by Dmitry Jonny Lindner on Pixabay</p>
        </div>
    </div>
    <div class="row credits">
        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="row books">
                <div class="col-sm-3 col-md-3 col-lg-3 book"><img src="./public/images/cover1.jpg" alt="couverture du livre Wall street" /></div>
                <div class="col-lg-offset-1 col-sm-offset-1 col-md-offset-1 col-sm-3 col-md-3 col-lg-3 book"><img src="./public/images/cover2.jpg" alt="couverture du livre Une maison dans le ciel" /></div>
                <div class="col-lg-offset-1 col-sm-offset-1 col-md-offset-1 col-sm-3 col-md-3 col-lg-3 book"><img src="./public/images/cover3.jpg" alt="couverture du livre C'est là que le couteux tombe" /></div>
            </div>
            <div class="row books">
                <div class="col-sm-3 col-md-3 col-lg-3 book"><img src="./public/images/cover4.png" alt="Sur le pouvoir et l'idéologie" /></div>
                <div class="col-lg-offset-1 col-sm-offset-1 col-md-offset-1 col-sm-3 col-md-3 col-lg-3 book"><img src="./public/images/cover5.jpg" alt="couverture du livre 1000 parapluies noirs" /></div>
                <div class="col-lg-offset-1 col-sm-offset-1 col-md-offset-1 col-sm-3 col-md-3 col-lg-3 book"><img src="./public/images/cover6.jpg" alt="couverture du livre Et puis il y a ça"></div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 legende">
            les couvertures de livre proviennent de: bookcoverarchive.com
        </div>
    </div>

</body>
<?php
  $content=ob_get_clean();
  require('template.php');
?>
