<!DOCTYPE html>
<html lang="fr">

<head>
    <title>
        <?=$title?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link href="./public/css/styleAdmin.css" rel="stylesheet" />
    <link href="../../public/tinyMCE/custom/skin.min.css" />
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ml0pyee54mk9ckslddh5xe90xundxmo02hggj1v9bnnbyi8a'></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            themes: "skin",
            skin_url: Projet4 / public / custom / skin,
            width: 600,
            height: 300,
            plugins: "image  fullpage preview save insertdatetime",
            toolbar: [
                " cut, copy, paste, undo, redo,bold, italic, underline, strikethrough, alignjustify, alignleft, aligncenter, alignright,styleselect, bullist, numlist, outdent, indent, blockquote"
            ],
            automatic_uploads: true,
            image_prepend_url: "http://jeanforteroche.slashcreations.fr/images/",
            file_browser_callback: function(field_name, url, type, win) {
                win.document.getElementById(field_name).value = 'my browser value';
            }
        });

    </script>
</head>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

</head>

<body>

    <?php include('headerBack.php')?>

    <?=$content?>

    <?php include('headerBack.php')?>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            width: 600,
            height: 600,
            plugins: "fullpage preview save preview",
            theme_advanced_buttons: [
                "cut, copy, paste, bullist, numlist, outdent, indent, blockquote, undo, redo,preview,bold, italic, underline, strikethrough, alignjustify, alignleft, aligncenter, alignright, styleselect"
            ],
            automatic_uploads: false,
            image_prepend_url: "http://jeanforteroche.slashcreations.fr/images/",
            file_browser_callback: function(field_name, url, type, win) {
                win.document.getElementById(field_name).value = 'my browser value';
            },
            valid_elements: "em/i,strike,u,strong/b,div[align],br,#p[align],-ol[type|compact],-ul[type|compact],-li"
        });

    </script>
</body>

</html>
