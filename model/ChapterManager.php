<?php

/*
 * this class manages the chapters
 * package [Manager.php]
 * package [jeanForteroche]\[Model]
 */

namespace jeanForteroche\Model;
require_once("Manager.php");

class ChapterManager extends Manager{

    /**
 * this function will look for and displays an excerpt from the last chapter, public access
 * @param[int] $limit lenght of the abstract
 *                           
 * @return [array] $post [containing the last chapter]
 */  
    public function getChapter()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id_chapter,title,content FROM chapter ORDER BY id_chapter DESC LIMIT 0,1');
        $post = $req->fetch();
        $limit=1000;
            if (strlen($post['content'])>=$limit){
                $post['content']=substr($post['content'],0,$limit);
                $space=strrpos($post['content'],' ');
                $post['content']=substr($post['content'],0,$space)."...";
            }
        return $post;
    }

    /**
 * this function will look for and displays an excerpt from a seleted chapter, public access
 * @param [int] $id_chapter [the id of the seleted chapter]
 *                           
 * @return [array] $post [containing the chapter]
 */ 
    public function getChap($id_chapter)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id_chapter,title,content FROM chapter WHERE id_chapter = ?');
        $req->execute(array($id_chapter));
        $post = $req->fetch();
        return $post;
    }
    /**
 * this function counts the number of chapter, public access
 *                           
 * @return [int] $len t[he number of chapter]
 */  
    public function len()
    {
        $db = $this->dbConnect();
        $req=$db->query('SELECT COUNT(id_chapter) FROM chapter WHERE 1 ');
        $len=$req->fetch();
        return $len;
    }
}
