<?php
/**
 * This file manages useful functions for the backend
 * package /[model]/[AdminManager.php]
 */

require_once('./model/AdminManager.php');

/**
 *  this function verify the password
 * @param [text] $login [the name]
 * @param[text] $pw[the password]
 * @use AdminManager
 *
 * @return [text] $message [error message]
 * or 1 if they is not error
 */
function verifiePws($login,$pw){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $verify=$adminManager->verifiePw($login,$pw);
    if ($verify==true)
    { $message='';
     header("Location: index.php?action=adminAccueil&&message=$message");}
    else
    {$message='le nom d\'utilisateur et le mot de passe ne correspondent pas';
     interfaceAdminPW($message);}
}

function admPW($message){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $post=$adminManager->AdmPW();
    require('view/backend/Adminpassword.php');
}
function interfaceAdminPW($message){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $post=$adminManager->AdmPW();
    require("view/frontend/password.php");

}

/**
 *  this function is use to fill the admin table
 * @use AdminManager
 *
 * @link ['view/frontend/adminAccueil.php] [Accueil Admin]
 * @return [array] $resume [array containing the element of the chapter]
 * 
 */
function adminAccueil($message){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $resume=$adminManager->resumeChapter();
    $resumecomments=$adminManager->getComments();
    $message=''.$message;
    require('view/backend/AccueilAdmin.php');}

/**
 *  this function is use to fill the admin table
 * @use AdminManager
 *
 * @link ['view/frontend/adminAccueil.php] [Accueil Admin]
 * @return [array] $post [array containing the element of the chapter]
 * @return [integer] $len [nombre de chapitre]
 *
 */
function adminAllComments($message){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $resumecomments=$adminManager->getComments();
    $message=''.$message;
    require('view/backend/AdminAllComments.php');}

/**
 *  This function deletes the comment Selected and reload the page
 * @use 
 * @param[integer] $id id of seleted chapter
 * @param[text] from which page we arrive
 *
 * @link tne same at start
 * @return [array] $resume [array containing the element of the chapter]
 * @return [integer] $len [nombre de chapitre]
 *
 */
function deletComment($id,$from){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $resume=$adminManager->resumeChapter();
    $resumecomments=$adminManager->getComments();
    $message=$adminManager->deletComments($id);

    switch ($from){
        case 'AllComment':
            header("Location: index.php?action=AllComments&&message=$message");
            break;
        case 'Accueil':
            header("Location: index.php?action=adminAccueil&&message=$message");
            break;
        default: require('view/frontend/erreur.php');
            break;
    }}
/**
 *  This function deletes the comment Selected and reload the page
 * @use 
 * @param[integer] $id id of seleted chapter
 * @param[text] from which page we arrive
 *
 * @link tne same at start
 * @return [array] $resume [array containing the element of the chapter]
 * @return [integer] $len [nombre de chapitre]
 *
 */
function keep($id,$from){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $resume=$adminManager->resumeChapter();
    $resumecomments=$adminManager->getComments();
    $message=$adminManager->keepComment($id);

    switch ($from){
        case 'AllComment':
            header("Location: index.php?action=AllComments&&message=$message");
            break;
        case 'Accueil':
            header("Location: index.php?action=adminAccueil&&message=$message");
            break;
        default: require('view/frontend/erreur.php');
            break;
    }}

/**
 *  this function change the password
 * @param [text] $login [the name]
 * @param[text] $pw[the password]
 * @use AdminManager
 *
 * @return [text] $message [error message]
 */
function newPws($name,$pwActuel,$pwNew){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $verifypw=$adminManager->verifiePw($name,$pwActuel);
    if ($verifypw==true){

        $pass_hache = password_hash($pwNew, PASSWORD_DEFAULT);
        $newPW=$adminManager->changedPW($name,$pass_hache);
        header("Location: index.php?action=adminAccueil&&message=$newPW");

    }
    else $message='le mot de passe et le nom ne correspondent pas.';
    admPW($message);}

/** this function display the admin chapter page
 * @use adminManager
 * 
 * @return[array] containing the carracteristique of chapter
 */
function createNewChapters(){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $resume=$adminManager->resumeChapter();
    $number=$adminManager->lenChapter();
    $numberChap=$number['COUNT(id_chapter)'] + 1;
    $chapter=[
        "id_chapter"=>$numberChap,
        "title"=>"",
        "content"=>"",
        "from"=>"new"
    ];

    require('view/backend/AdminCreateChapter.php');}

function adminChapters(){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $resume=$adminManager->resumeChapter();
    $number=$adminManager->lenChapter();
    $numberChap=$number['COUNT(id_chapter)'] + 1;
    $chapter=[
        "id_chapter"=>$numberChap,
        "title"=>"",
        "content"=>"",
        "from"=>"new"
    ];

    require('view/backend/AdminCreateChapter.php');}

/** this function display the admin chapter page whit a alraydy saved chapter
 * @param[integer] the id of chapter
 * @use adminManager
 */
function editAChapter($id){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $chapter=$adminManager->resumeAChapter($id);
    $resume=$adminManager->resumeChapter();

    require('view/backend/AdminEditChapter.php');
}
function editANewChapter($newChap,$message){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $resume=$adminManager->resumeChapter();
    $chapter=$newChap;
    $message=$message;
    require('view/backend/AdminCreateChapter.php');}
/**
 * this function creates a new chapter
 * 
 * @use adminManager
 * 
 * 
 * @link [index.php] [pour réaficher la page]
 */

function saveChapter($id,$title,$content,$from){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $number=$adminManager->lenChapter();
    if ($id>$number['COUNT(id_chapter)']){
        $post=$adminManager->createChapter($id,$title,$content);
    }
    else{
        $post=$adminManager->saveChapter($id,$title,$content);
    }
    $resume=$adminManager->resumeChapter();
    $resume2=$adminManager->resumeAChapter($id);

    $message='le chapitre a bien été sauvegardé';

            switch ($from){
                    case 'active1':
                    header("Location: index.php?action=CreeNewChapter&&message=$message");;
                    break;
                case 'active2':
                    header("Location: index.php?action=ListOfChapter&&message=$message");
                    break;
                 case 'active3':
                    header("Location: index.php?action=AllComments&&message=$message");
                    break;


                default:
                require('view/backend/AdminCreateChapter.php');
            break;}
}

function updateChapter($id,$title,$content){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $post=$adminManager->saveChapter($id,$title,$content);
    $chapter=$adminManager->resumeAChapter($id);
    $resume=$adminManager->resumeChapter();
    $message='le chapitre a bien été sauvegardé';
    require('view/backend/AdminEditChapter.php');

}
function listChapters(){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $resume=$adminManager->resumeChapter();
    require('view/backend/AdminListChapters.php');
}
