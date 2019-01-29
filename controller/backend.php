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
     require('view/frontend/password.php');}
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
    require("view/backend/Adminpassword.php");}

/** this function display the admin chapter page
 * @use adminManager
 * 
 * @return[array] containing the carracteristique of chapter
 */
function adminChapters(){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $resume=$adminManager->resumeChapter();
    $number=$adminManager->lenChapter();
    $numberChap=$number['COUNT(id_chapter)'] + 1;
    $chapter=[
        "id_chapter"=>$numberChap,
        "title"=>"",
        "content"=>"",
        "from"=>"adminChapters"
    ];
    
    require('view/backend/AdminEditChapter.php');}

/** this function display the admin chapter page whit a alraydy saved chapter
 * @param[integer] the id of chapter
 * @use adminManager
 */
function editAChapter($id,$message){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $chapter=$adminManager->resumeAChapter($id);

    $resume=$adminManager->resumeChapter();
    $message=$message;

    require('view/backend/AdminEditChapter.php');
}
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
        $message='le chapitre a bien été sauvegardé';
        
        
switch ($from) {
    case 'AdminEditChapter':header('Location: index.php?action=edit&&id_chapter='.$id.'&&message='.$message );
        break;
        case'ButtonEditChapter':
        header('Location: index.php?action=AdminChapter' );
        break;
    case 'Commentaire':
        header('Location: index.php?action=AllComments' );
        break;
    case 'password':
        header('Location: index.php?action=Adminpw' );
        break;
    case'exit':require("http://localhost/Projet4/index.php" );
        break;
}}
