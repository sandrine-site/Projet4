<?php
/**
 * This file manages useful functions for the backend
 * package /[model]/[AdminManager.php]
 */

require_once('./model/AdminManager.php');

/**
 * this function verify the password
 * @param [text] $login [the name]
 * @param[text] $pw[the password]
 * @use AdminManager
 *
 * @return [text] $message [error message]
 *  or 1 if there are no errors
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

/**
 * this function is used to get the login to fill the form
 * @param [text] $message [if there is an error message to display]
 * @use AdminManager
 *
 * @link ['view/backend/Adminpassword.php']
 */
function admPW($message){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $post=$adminManager->AdmPW();
    require('view/backend/Adminpassword.php');
}

/**
 * this function is used to get the login to fill the form
 * @param [text] $message [if there is an error message to display]
 * @use AdminManager
 *
 * @link ['view/frontend/password.php']
 */
function interfaceAdminPW($message){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $post=$adminManager->AdmPW();
    require("view/frontend/password.php");
}

/**
 *  this function his function displays the first page of the admin interface
 * @param [text] $message [if there is an error or a confimation message to display]
 * @use AdminManager
 *
 * @link ['view/frontend/adminAccueil.php] [Accueil Admin] *
 */
function adminAccueil($message){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $resume=$adminManager->resumeChapter();
    $resumecomments=$adminManager->getComments();
    $message=''.$message;
    require('view/backend/AccueilAdmin.php');
}

/**
 *  this function displays the comments administration page
 * @param [text] $message [if there is an error or a confimation message to display]
 * @use AdminManager
 *
 * @link ['view/backend/AdminAllComments.php']
 */
function adminAllComments($message){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $resumecomments=$adminManager->getComments();
    $message=''.$message;
    require('view/backend/AdminAllComments.php');
}

/**
 *  this function deletes the desired comment and reloads the page
 * @param[integer] $id id of seleted chapter
 * @param[text] from which page we arrive
 * @use AdminManager
 *
 * @link tne same at start
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
    }
}
/**
 *  this function erases the number of reports of the desired comment and reloads the page
 * @param[integer] $id id of seleted chapter
 * @param[text] from which page we arrive
 * @use AdminManager
 *
 * @link tne same at start
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
    }
}

/**
 *  this function change the password
 * @param [text] $name [the login]
 * @param[text] $pwActuel[the password]
 * @param[text] $pwNew[the new password]
 * @use AdminManager
 *
 * @return [text] $message [error or confimation message]
 * @link ["Location: index.php?action=adminAccueil&&message=$newPW'] if the old password is good
 */
function newPws($name,$pwActuel,$pwNew){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $verifypw=$adminManager->verifiePw($name,$pwActuel);
    if ($verifypw==true)
    {
        $pass_hache = password_hash($pwNew, PASSWORD_DEFAULT);
        $newPW=$adminManager->changedPW($name,$pass_hache);
        header("Location: index.php?action=adminAccueil&&message=$newPW");
    }
    else{ $message='le mot de passe et le nom ne correspondent pas.';
         admPW($message);}
}

/** this function looks for the numbers of the next chapter
 * @use adminManager
 * 
 * @return[array] containing the carracteristique of chapter
 * @link ['view/backend/AdminCreateChapter.php']
 */
function createNewChapters(){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $resume=$adminManager->resumeChapter();
    $number=$adminManager->nummax();
    $numberChap=($number['number_chapter']);
    $chapter=[
        "id_chapter"=>"",
        "number_chapter"=>$numberChap+1,
        "title"=>"",
        "content"=>"",
        "from"=>"new"
    ];
    require('view/backend/AdminCreateChapter.php');
}

/** this function displays a chapter already saved
 * @param[integer] the id of chapter
 * @use adminManager
 *
 *  @link ['view/backend/AdminEditChapter.php']
 */
function editAChapter($id){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $chapter=$adminManager->resumeAChapter($id);
    $resume=$adminManager->resumeChapter();
    require('view/backend/AdminEditChapter.php');
}

/** this function displays a chapter when it save for the first time
 * @param[integer] the id of chapter
 * @par[text] $message confimation message
 * @use adminManager
 *
 * @return [text] $message [confimation message]
 *  @link ['view/backend/AdminEditChapter.php']
 */
function editANewChapter($newChap,$message){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $resume=$adminManager->resumeChapter();
    $chapter=$newChap;
    if (!isset ($message)){$message="";}
    require('view/backend/AdminCreateChapter.php');
}

/**
 *this function save a existing chapter or create a new chapter
 * @param [integer] $id the number of chapter
 * @param[text] $title the title of chapter
 * @param[text] $content the content of chapter
 * @use adminManager
 * 
 * @return [text] $message [confimation message]
 * @link ['view/backend/AdminCreateChapter.php']
 */

function saveNew($numberpost,$title,$text,$message){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $num=$adminManager->num();
    $tabnumber=[];
    while($number=$num->fetch()){
        array_push($tabnumber,$number['number_chapter']);}

    if(((in_array($numberpost,$tabnumber))&&$message !="Attention ce chapitre existe déjà!")){
        $id=$adminManager->getId($numberpost);

        $message="Attention ce chapitre existe déjà!";
        $chapter=[
            "id_chapter"=>$id,
            "number_chapter"=>$numberpost,
            "title"=>$title,
            "content"=>$text
        ];
        editANewChapter($chapter,$message);}

    elseif(in_array($numberpost,$tabnumber)) {
        $id=$adminManager->getId($numberpost);
        $res=$adminManager->saveChapter($id,$numberpost,$title,$text);
        $message='le chapitre a bien été sauvegardé';
        editAChapter($id);
    }
    else{
        $res=$adminManager->createChapter($numberpost,$title,$text);
        $id=$adminManager->getId($numberpost);
        $message='le chapitre a bien été sauvegardé';
        editAChapter($id);}
}
function deleteChapter($numberpost){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $num=$adminManager->num();
    $tabnumber=[];
    while($number=$num->fetch()){
        array_push($tabnumber,$number['number_chapter']);}
    if(in_array($numberpost,$tabnumber)){
        $del=$adminManager->delete($numberpost);
        $message='Le chapitre a bien été supprimé. Attention à la numérotation des chapitres';
    }
    else{$message='Désolé mais ce chapitre n\'existe pas!';}
    listChapters($message);
}
/**
 *this function uptdate a existing chapter
 * @param [integer] $id the number of chapter
 * @param[text] $title the title of chapter
 * @param[text] $content the content of chapter
 * @use adminManager
 *
 * @return [text] $message [confimation message]
 * @link ['view/backend/AdminEditChapter.php']
 */

function updateChapter($id,$title,$content){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $post=$adminManager->saveChapter($id,$title,$content);
    $chapter=$adminManager->resumeAChapter($id);
    $resume=$adminManager->resumeChapter();
    $message='le chapitre a bien été sauvegardé';
    require('view/backend/AdminEditChapter.php');
}

/** this function displays the list of the existing chapter
 * @use adminManager
 *
 * @return [text] $message [confimation message]
 *  @link ['view/backend/AdminListChapters.php']
 */
function listChapters($message){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $resume=$adminManager->resumeChapter();
    $resume2=$adminManager->resumeChapter();
    $message=$message;
    require('view/backend/AdminListChapters.php');
}
function idmax(){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $id=$adminManager->idMax();
    $idMax=($id['id_chapter']);
    return $idMax;}


function changeNummero($new,$id){
    $adminManager=new jeanForteroche\Model\AdminManager;
    $res=$adminManager->changeNum($new,$id);
    $message="Les changements de numéro ont bien étés effectués";
    return $message;
}
