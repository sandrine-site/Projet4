<?php
session_start();
use jeanForteroche\Model\Admin;
use jeanForteroche\Model\User;

require('controller/User.php');
require('controller/Admin.php');
$admin=new Admin();
$user=new User();
$config=include('config/config.php');
$url=$config['url'];
$_SESSION['error add comment']=$config['error add comment'];
if ((!isset($_GET['from2'])||$_GET['from2']!='user')){
$_SESSION['signal comment']=$config['signal comment'];}
$_SESSION['password message']=$config['password message'];
$_SESSION['newPwerror']=$config['newPwerror'];
$_SESSION['newPwless']=$config['newPwless'];
$_SESSION['message new Pw']=$config['message new Pw'];
$_SESSION['save chapter']=$config['save chapter'];
try{
    if (isset($_GET['action'])){
        switch ($_GET['action'])
        {
            case 'others':
                if (isset($_GET['id_chapter'])&& $_GET['id_chapter']>0)
                { if (isset($_GET['from'])){$_SESSION['signal comment']=true;}
                    $user->chapPost($_GET['id_chapter']);
                }
                else
                {
                    require("view/frontend/error.php");}
                break;

            case 'comments':
                if (isset($_GET['id_chapter'])&& $_GET['id_chapter']>0)
                {if (isset($_GET['from'])){$_SESSION['signal comment']=true;}

                    $user->commentChapter($_GET['id_chapter']);
                }
                else
                {
                    require("view/frontend/error.php");}
                break;

            case 'addComment':
                if (isset($_GET['id_chapter'])&&$_GET['id_chapter']>0){
                    if(isset($_POST['author'])&&isset($_POST['comment'])&&$_POST['author']!=""&&$_POST['comment']!=""){
                        $user->addComment($_GET['id_chapter'],$_POST['author'],htmlspecialchars($_POST['comment']));
                    }
//
                    else{
                        $_SESSION['error add comment']=true;
                        $user->commentChapter($_GET['id_chapter']);;}
                }
                else
                {
                    require("view/frontend/error.php");
                }
                break;

            case 'signalComment':
                if (isset($_GET['id_comment'])&&$_GET['id_comment']>0)
                {
                    $from=$_GET['from'];
                    $user->signalComment($_GET['id_comment'],$_GET['id_chapter'],$from);
                }

                else
                {
                    throw new exception('il y a un problème sur un des identifiants envoyés');
                }
                break;

            case 'interfaceAdmin':
                var_dump($_SESSION['password message']);
                if(!empty($_POST['Name'])&&!empty($_POST['Password']))
                {
                    $admin->verifiyPws($_POST['Name'],$_POST['Password']);
                }
                elseif (!empty($_POST['Name']) xor !empty($_POST['password'])) {
                    $_SESSION['password message']=true;
                    $admin->interfaceAdminPW();
}
                else{
                    $_SESSION['password message']=false;
                    $admin->interfaceAdminPW();}
                break;
            case 'adminAccueil':
                $admin->adminAccueil();
                break;

            case 'AllComments':
                $admin->adminAllComments();
                break;

            case 'delete':
                if (isset($_GET['id_comment'])>0)
                { $admin->deleteComment($_GET['id_comment'],$_GET['from']);
                }
                else
                {
                    throw new exception('Aucun identifiant de chapitre envoyé');}
                break;

            case 'keepComment':
                if (isset($_GET['id_comment'])>0)
                {
                    $admin->keep($_GET['id_comment'],$_GET['from']);
                }
                else
                {
                    throw new exception('Aucun identifiant de chapitre envoyé');}
                break;

            case'Adminpw':
                $post=$admin->admPWS();
                require('view/backend/Adminpassword.php');
                break;

            case'AdminPW':
                if(!empty($_POST['Name'])&&!empty($_POST['Password'])&&!empty($_POST['Password1'])&&!empty($_POST['Password2']))
                {
                    if ($_POST['Password1']==$_POST['Password2']) {
                       $admin->newPws($_POST['Name'],$_POST['Password'],$_POST['Password1']);
                    }
                    else
                    {
                        $_SESSION['newPwerror']=true;
                        $post=$admin->admPWS();
                        require('view/backend/Adminpassword.php');
                    }
                }
                else
                {
                  $_SESSION['newPwless']=true;
                    $post=$admin->admPWS();
                    require('view/backend/Adminpassword.php');
                }
                break;

            case 'CreeNewChapter':
                $_SESSION['exist']=false;
                $admin->createNewChapters();
                break;

            case 'saveNew':
                $admin->saveNew($_POST["number_chapter"],$_POST['title'],$_POST['mytextarea']);
                break;

            case'ListOfChapter':
              $admin->listChapters();
                break;

            case 'edit':
                $admin->editAChapter($_GET['id_chapter']);

                break;

            case 'update':
                $admin->updateChapter($_POST["id_chapter"],$_POST['title'],$_POST['mytextarea']);
                break;

            case 'supprim':
                $admin->deleteChapter($_GET['number']);
                break;

            case 'numero':
                   $idMax=$admin->idmax();
                $id=0;
               while ($id<=$idMax) {
                   if (isset($_POST['old' . $id]) && $_POST['old' . $id] != $_POST['new' . $id]) {
                       $admin->changeNumber($_POST['new' . $id], $_POST[$id]);
                   }
                   $id++;
               }

                $admin->listChapters();
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
        $user->post();
    }
}
catch(Exception $e)
{
    require("./view/frontend/error.php");
}
