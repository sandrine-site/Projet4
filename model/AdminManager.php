<?php

/*
* this class manages the administration interface
* package [Manager.php]
* package [jeanForteroche]\[Model]
*/
namespace jeanForteroche\Model;
require_once("Manager.php");

class AdminManager extends Manager{

/**
* this function checks if password and login are good
* @param[text] $login
* @param[text] $pw
*
* @return[bool ]$pwVerif = 1 if the password is ok
*/
    public function verifiePw($login,$pw)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT passwords FROM Passwordtable WHERE logins = ?');
        $req->execute(array($login));
        $resultat = $req->fetch();
        $pwVerif= password_verify($pw,$resultat['passwords']);
        return $pwVerif;
    }

/**
* this function will look for the login in the password table
*
* @return[text]$resultat the login
*/
    public function AdmPW(){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT logins FROM Passwordtable WHERE  ?');
        $req->execute(array(1));
        $resultat = $req->fetch();
        return $resultat;
    }

/**
* this function update the password
* @param[text] $name
* @param[text] $pw
*
* @return[text]$message [confimation message]
*/
    public function changedPW($name,$pw){
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE Passwordtable SET passwords=? where logins=?');
        $req->execute(array($pw,$name));
        $message='le mot de passe a bien été modifié';
        return $message;
    }

/**
*this function give an absract of evry chapter
*
* @return[array]$resum = the caracteres of the chapter
*/
    public function resumeChapter(){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id_chapter,title,content,DATE_FORMAT(publication_date, \'%d/%m/%Y \')AS publication_date,DATE_FORMAT(modification_date, \'%d/%m/%Y \') AS modification_date FROM chapter WHERE ? ORDER BY id_chapter DESC ');
        $req->execute(array(1));
        return $req;
    }
/**
*this function give an absract of one chapter
*
* @return[array]$resum = the caracteres of the chapter
*/
    public function resumeAChapter($id){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id_chapter,title,content,DATE_FORMAT(publication_date, \'%d/%m/%Y \')AS publication_date,DATE_FORMAT(modification_date, \'%d/%m/%Y \') AS modification_date  FROM chapter WHERE id_chapter=?');
        $req->execute(array($id));
        $resultat = $req->fetch();
        return $resultat;
    }

/**
* this function counts the number of chapter, public access
*
* @return [int] $len t[he number of chapter]
*/
    public function lenchapter(){
        $db = $this->dbConnect();
        $req=$db->query('SELECT COUNT(id_chapter) FROM chapter WHERE 1 ');
        $len=$req->fetch();
        return $len;
    }

/**
* this function will look for and displays the comment corresponding at the chapter
* @param [int] $id_chapter [the id of chapter]
*
* @return [array] $comments [containing the comments]
*/
    public function getComments(){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id_comment,signalement,id_chapter,author,comment,DATE_FORMAT(dateComment, \'%d/%m/%Y \') AS dateComment FROM comments WHERE ? ORDER BY id_comment DESC ');
        $req->execute(array(1));
        return $req;
    }

/**
 * This function delete the selectionned comment
 * @param [integer] $id
 *
 * return [text] $confirm [confimation message]
 */
    public function deletComments($id){
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT author, DATE_FORMAT(dateComment, \'%d/%m/%Y \') AS DateComment_fr FROM comments WHERE id_comment=? ');
        $comment->execute(array($id));
        $req=$db->prepare('DELETE FROM comments WHERE id_comment=?');
        $req->execute(array($id));
         while ($res = $comment->fetch()){$confirm="Le message ecrit par ".$res['author'].", le ".$res['DateComment_fr']." a bien été supprimé.";}
        return $confirm;
    }

/**
 * this function erases the number of reports
 * @param [integer] $id
 *
 * return [text] $message [confimation message]
 */
    public function keepComment ($id){
        $db = $this->dbConnect();
        $req=$db->prepare('UPDATE comments SET signalement=0 where id_comment=?');
        $req->execute(array($id));
        $message="";
        return $message;
    }

/**
* this function update a existing chapter
* @param[int] $id
* @param[text] $title
* @param[text]  $content
*/
    public function saveChapter($id,$title,$content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE chapter SET title=?,modification_date=NOW(), content=? WHERE id_chapter=?');
        $req->execute(array($title,$content,$id));
            return $req ;
    }

/**
* this function save a new chapter
* @param[int] $id
* @param[text] $title
* @param[text]  $content
*/

    public function createChapter($id,$title,$content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO chapter (id_chapter, publication_date,title,content,modification_date) VALUES(?, NOW(), ?,?,NOW()) ');
        $req->execute(array($id,$title,$content));
            return $req ;
    }
}
