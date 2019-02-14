<?php

/*
* manages the administration interface
* package [Manager.php]
* package [jeanForteroche]\[Model]
*/

namespace jeanForteroche\Model;
require_once("Manager.php");

class AdminManager extends Manager{

    /**
     * checks the password
     * @param $login [string]
     * @param $pw [string]
     * @return bool [bool ]$pwVerif
     */
    public function verifiePw($login,$pw)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT passwords FROM passwordtable WHERE logins = ?');
        $req->execute(array($login));
        $resultat = $req->fetch();
        $pwVerif= password_verify($pw,$resultat['passwords']);
        return $pwVerif;
    }

    /**
     * look for the login  password table
     *
     * @return mixed [string]$result the login
     */
    public function AdmPW(){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT logins FROM passwordtable WHERE id_pw=?');
        $req->execute(array(1));
        $result = $req->fetch();
        return $result;
    }

    /**
     * update the password
     * @param $name
     * @param $pw
     * @return string [text]$message [confimation message]
     */
    public function changedPW($name,$pw){
        $db=$this->dbConnect();
        $req=$db->prepare('UPDATE passwordtable SET passwords=? where logins=?');
        $req->execute(array($pw,$name));
        $_SESSION["message new Pw"]='ok';
        return ;
    }

    /**
     * abstract of every chapter
     *
     * @return bool|\PDOStatement [array]$resum = the caracteres of the chapter
     */
    public function resumeChapter(){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id_chapter,number_chapter,title,content,DATE_FORMAT(publication_date, \'%d/%m/%Y \')AS publication_date,DATE_FORMAT(modification_date, \'%d/%m/%Y \') AS modification_date FROM chapter WHERE ? ORDER BY number_chapter DESC ');
        $req->execute(array(1));
        return $req;
    }

    /**
     *abstract of one chapter
     *
     * @param $id
     * @return mixed [array]$resume = character's
     */
    public function resumeAChapter($id){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id_chapter,number_chapter,title,content,DATE_FORMAT(publication_date, \'%d/%m/%Y \')AS publication_date,DATE_FORMAT(modification_date, \'%d/%m/%Y \') AS modification_date  FROM chapter WHERE id_chapter=?');
        $req->execute(array($id));
        $resultat = $req->fetch();
        return $resultat;
    }


    /**
     * delete a chapter
     * @param $number[int]
     */
    public function delete($number){
        $db = $this->dbConnect();
        $req=$db->prepare('DELETE FROM chapter WHERE number_chapter=?');
        $req->execute(array($number));
        return;

    }

    /**
     * counts the number of chapter, public access
     *
     * @return mixed [int] $len [he number of chapter]
     */
    public function lenchapter(){
        $db = $this->dbConnect();
        $req=$db->query('SELECT COUNT(number_chapter) FROM chapter WHERE 1 ');
        $len=$req->fetch();
        return $len;
    }

    /**
     * get the n° of the last chapter
     *
     * @return mixed [int}
     */
    public function nummax(){
        $db = $this->dbConnect();
        $req = $db->query('SELECT id_chapter,number_chapter FROM chapter ORDER BY number_chapter DESC LIMIT 0,1');
        $resultat = $req->fetch();
        return $resultat;
    }

    /**
     * get the list of chapter
     * @return false|\PDOStatement
     */
    public function num(){
        $db = $this->dbConnect();
        $req = $db->query('SELECT ALL number_chapter,id_chapter FROM chapter');

        return $req;
    }

    public function getId($number){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id_chapter FROM chapter WHERE number_chapter=?');
        $req->execute(array($number));
        $resultat=$req->fetch();
        return $resultat["id_chapter"];
    }
    public function idMax(){
        $db = $this->dbConnect();
        $req = $db->query('SELECT id_chapter,number_chapter FROM chapter ORDER BY id_chapter DESC LIMIT 0,1');
        $resultat = $req->fetch();
        return $resultat;
    }

    /**
* this function will look for and displays the comment corresponding at the chapter
* @param [int] $number_chapter [the number of chapter]
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

    public function createChapter($number,$title,$content)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO chapter (number_chapter, publication_date,title,content,modification_date) VALUES(?, NOW(), ?,?,NOW()) ');
        $req->execute(array($number,$title,$content));
        return $req ;
    }

    /**
     * change the number of chapter
     * @param $new
     * @param $id
     *
     * @return bool|\PDOStatement
     */
    public function changeNum($new,$id){
        $db = $this->dbConnect();
        $req=$db->prepare('UPDATE chapter SET number_chapter=? where id_chapter=?');
        $req->execute(array($new,$id));
        return $req;
    }

    public function count(){
        $db = $this->dbConnect();
        $nbr_doublon=$db->query('SELECT COUNT(number_chapter) AS nbr_doublon FROM chapter GROUP BY number_chapter HAVING  COUNT(number_chapter) > 1');
        $doublon = max($nbr_doublon->fetch(),1);
    return $doublon;}
}
