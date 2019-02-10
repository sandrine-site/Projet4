<?php
require('controller/frontend.php');
require('controller/backend.php');
try{
    if (isset($_GET['action'])){
        switch ($_GET['action'])
        {
            case 'others':
                if (isset($_GET['id_chapter'])&& $_GET['id_chapter']>0)
                {
                    if (isset($_GET['message'])){$message=$_GET['message'];}
                    elseif(isset($_GET['ErreurMessage'])){$message=$_GET['ErreurMessage'];}
                    else{$message="";}
                    chapPost($_GET['id_chapter'],$message);
                }
                else
                {
                    require("view/frontend/erreur.php");}
                break;

            case 'comments':
                if (isset($_GET['id_chapter'])&& $_GET['id_chapter']>0)
                {
                    if (isset($_GET['message'])){$message=$_GET['message'];}
                    elseif(isset($_GET['ErreurMessage'])){$message=$_GET['ErreurMessage'];}
                    else{$message="";}
                    commentChapter($_GET['id_chapter'],$message);
                }
                else
                {
                    require("view/frontend/erreur.php");}
                break;

            case 'addComment':
                if (isset($_GET['id_chapter'])&&$_GET['id_chapter']>0){
                    if(isset($_POST['author'])&&isset($_POST['comment'])&&$_POST['author']!=""&&$_POST['comment']!=""){
                        addComment($_GET['id_chapter'],$_POST['author'],htmlspecialchars($_POST['comment']));
                    }
                    else{
                        header('Location: index.php?action=comments&&id_chapter=' . $_GET['id_chapter']."&&ErreurMessage=Désolés, nous n'avons pas pu enregistrer votre message" );}
                }
                else
                {
                    require("view/frontend/erreur.php");
                }
                break;

            case 'signalComment':
                if (isset($_GET['id_comment'])&&$_GET['id_comment']>0&&$_GET['id_chapter']&&$_GET['id_chapter']>0)
                {
                    $from=$_GET['from'];
                    if (isset($message)){
                        signalComment($_GET['id_comment'],$_GET['id_chapter'],$from,$message);}
                    else{
                        signalComment($_GET['id_comment'],$_GET['id_chapter'],$from,"");}
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
                    if ($_POST['Password1']==$_POST['Password2']) {
                        newPws($_POST['Name'],$_POST['Password'],$_POST['Password1']);
                    }
                    else
                    {
                        $message='Les deux mots de passe doivent etre identiques';
                        admPW($message);
                    }
                }
                else
                {
                    $message='Tous les champs doivent être remplis' ;
                    admPW($message);
                }
                break;

            case 'CreeNewChapter':
                createNewChapters();
                break;

            case 'saveNew':
                if (isset($_GET['message'])){
               $message=$_GET['message'];}
                else{$message="";}
                   saveNew($_POST["number_chapter"],$_POST['title'],$_POST['mytextarea'],$message);
                break;

            case'ListOfChapter':
                listChapters("");
                break;

            case 'edit':
                editAchapter($_GET['id_chapter']);
                break;

            case 'update':
                updateChapter($_POST["id_chapter"],$_POST['title'],$_POST['mytextarea']);
                break;
            case 'supprim':
                deleteChapter($_POST["number"]);
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
