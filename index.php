<?php
require('controller/frontend.php');
require('controller/backend.php');
try{
    if (isset($_GET['action'])){
        switch ($_GET['action']) {
            case 'others':
                if (isset($_GET['id_chapter'])&& $_GET['id_chapter']>0)
                {
                    chapPost($_GET['id_chapter']);
                }
                else
                {
                    throw new exception('Aucun identifiant de chapitre envoyé');}
                break;
            case 'comments':
                if (isset($_GET['id_chapter'])&& $_GET['id_chapter']>0)
                {
                    commentChapter($_GET['id_chapter']);
                }
                else
                {
                    throw new exception('Aucun identifiant de chapitre envoyé');}
                break;
            case 'addComment':
                if (isset($_GET['id_chapter'])&&$_GET['id_chapter']>0)
                {
                    if(!empty($_POST['author'])&&!empty($_POST['comment']))
                    {
                        addComment($_GET['id_chapter'],$_POST['author'],$_POST['comment']);
                    }
                    else
                    {header('Location: index.php?action=comments&id_chapter=' . $_GET['id_chapter']."&& ErreurMessage=".true );
                    }
                }
                else
                {
                    throw new exception('Aucun identifiant de chapitre envoyé');
                }
                break;
            case 'signalComment':
                if (isset($_GET['id_comment'])&&$_GET['id_comment']>0&&$_GET['id_chapter']&&$_GET['id_chapter']>0)
                {
                    $from=$_GET['from'];
                    signalComment($_GET['id_comment'],$_GET['id_chapter'],$from);
                }
                else
                {
                    throw new exception('il y a un probleme sur un des identifiants envoyé');
                }
                break;
            case 'interfaceAdmin':
                if(!empty($_POST['Name'])&&!empty($_POST['Password']))
                {
                    verifiePws($_POST['Name'],$_POST['Password']);
                }
                elseif (!empty($_POST['Name']) xor !empty($_POST['password'])) {
                    $message='Attention vous devez renseigner un mot de passe et un nom d\'utilisateur';
                    require("view/frontend/password.php");}
                else{
                    interfaceAdminPW("");}
                break;
            case 'AllComments':
                if (isset($_GET['message'])){
                    adminAllComments($_GET['message']);}
                else{adminAllComments("");}
                break;

            case 'delete':
                if (isset($_GET['id_comment'])>0)
                { deletComment($_GET['id_comment'],$_GET['from']);
                }
                else
                {
                    throw new exception('Aucun identifiant de chapitre envoyé');}
                break;

            case 'adminAccueil':
                adminAccueil($_GET['message']);
                break;

            case 'keepComment':
                if (isset($_GET['id_comment'])>0)
                { 
                    keep($_GET['id_comment'],$_GET['from']);
                }
                else
                {
                    throw new exception('Aucun identifiant de chapitre envoyé');}
                break;
            case'Adminpw':
                admPW("");
                break;
            case'AdminPW':
                if(!empty($_POST['Name'])&&!empty($_POST['Password'])&&!empty($_POST['Password1'])&&!empty($_POST['Password2']))
                {
                    if ($_POST['Password1']==$_POST['Password2']) {newPws($_POST['Name'],$_POST['Password'],$_POST['Password1']);}
                    else 
                    {$message='Les deux mots de passe doivent etre identiques';
                     admPW($message);}}
                else{$message='Tous les champs doivent être remplis' ;
                     admPW($message);}
                break;
            case 'AdminChapter':
                adminChapters();
                break;

            case 'save': 
                saveChapter($_POST["idChapter"],$_POST['title'],$_POST['mytextarea'],$_GET['from']);
                break;
            case 'edit':
                if (isset($_GET['message'])){
                    $_message=$_GET['message'];}
                else{$_message="";}
                editAchapter($_GET['id_chapter'],$_message);
                break;
            case 'creditsPhoto':
                require('view/frontend/creditsPhoto.php');
                break;
            default:
                throw new exception('Désolé je n\'ai pas compris votre demande');
                break;
        }
    }
    else {
        post();
    }
}

catch(Exception $e)
{
    require("view/frontend/erreur.php");
}
