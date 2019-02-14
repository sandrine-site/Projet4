<?php
/*
 * this class manages the comments
 * package [Manager.php]
 * package [jeanForteroche]\[Model]
 */
namespace jeanForteroche\Model;
require_once("Manager.php");

class CommentsManager extends Manager{

/**
* this function will look for and displays the comment corresponding at the chapter, public access
* @param [int] $id_chapter [the id of chapter]
*
* @return [array] $comments [containing the comments]
*/
    public function getComments($chapter){
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id_comment,id_chapter,author,comment, DATE_FORMAT(dateComment, \'%d/%m/%Y \') AS DateComment_fr FROM comments WHERE id_chapter=? ORDER BY dateComment DESC');
        $comments->execute(array($chapter));
        return $comments;
    }

/**
* this function will look for the comment who is signaled, public access
* @param [int] $id_comment [the id of the comment]
* @param [int] $id_chapter [the id of the chapter]
*
* @return [text] $message ['...']
*/
    public function getSignal($id_comment){
        $db = $this->dbConnect();
        $comment = $db->prepare( 'UPDATE comments SET signalement=signalement + 1 WHERE id_comment=?');
        $comment->execute( array($id_comment));
        return ;
    }

/**
* this function managed the post
* @param [int] $id_chapter [the id of the chapter who is commented]
* @param [text] $author [person who add a comment]
* @param [text] $comment [comment]
*
* @return [array] $affectedLines [coresponding at a line of comments table]
*/
    public function postComment($id_chapter, $author, $comment){
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(id_comment,signalement,id_chapter,author,comment,dateComment) VALUES (NULL,0,?,?,?,NOW())');
        $req->execute(array($id_chapter,$author,$comment));
        return $req ;
    }
}
