<!DOCTYPE html>
<html lang="fr">

<head>
    <title>
        <?=$title?>
    </title>
    <meta charset="utf-8">
    <meta name="description" content="Ce site a pour but de publier le dernier livre du célébre écrivaint Jean Forteroche. Le titre de ce livre est: Aller simple pour l'Alaska" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="./public/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

</head>

<body>

    <?php include('header.php')?>

    <?=$content?>

    <?php include('footer.php')?>

</body>

</html>
