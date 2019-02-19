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
     * look for and displays the comment corresponding at the chapter, public access
     * @param $chapter[int]
     *
     * @return bool|\PDOStatement
     */
    public function getComments($chapter){
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id_comment,id_chapter,author,comment, DATE_FORMAT(dateComment, \'%d/%m/%Y \') AS DateComment_fr FROM comments WHERE id_chapter=? ORDER BY dateComment DESC');
        $comments->execute(array($chapter));
        return $comments;
    }
    /**
     * signal a comment
     * @param $id_comment
     */
    public function getSignal($id_comment){
        $db = $this->dbConnect();
        $comment = $db->prepare( 'UPDATE comments SET signalement=signalement + 1 WHERE id_comment=?');
        $comment->execute( array($id_comment));
        return ;
    }

    /**
     *  managed the post
     * @param $id_chapter[int]
     * @param $author[string]
     * @param $comment[string]
     *
     * @return bool|\PDOStatement
     */
    public function postComment($id_chapter, $author, $comment){
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(id_comment,signalement,id_chapter,author,comment,dateComment) VALUES (NULL,0,?,?,?,NOW())');
        $req->execute(array($id_chapter,$author,$comment));
        return $req ;
    }
}
