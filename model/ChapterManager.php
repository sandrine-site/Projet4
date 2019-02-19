<?php

/*
 * this class manages the chapters
 * package [Manager.php]
 * package [jeanForteroche]\[Model]
 */

namespace jeanForteroche\Model;
require_once ("Manager.php");

class ChapterManager extends Manager
{


    /**
     *  displays the last chapter
     * @return mixed
     */
    public function getChapter ()
    {
        $db = $this->dbConnect ();
        $req = $db->query ('SELECT id_chapter,number_chapter,title,content FROM chapter ORDER BY id_chapter DESC LIMIT 0,1');
        $post = $req->fetch ();
        $limit = 1000;
        $post[ 'content' ] = strip_tags ($post[ 'content' ]);
        if ( strlen ($post[ 'content' ]) >= $limit ) {
            $post[ 'content' ] = substr ($post[ 'content' ], 0, $limit);
            $space = strrpos ($post[ 'content' ], ' ');
            $post[ 'content' ] = substr ($post[ 'content' ], 0, $space) . "...";
        }
        return $post;
    }

    /**
     * counts the number of chapter
     * @return false|\PDOStatement
     */
    public function num ()
    {
        $db = $this->dbConnect ();
        $req = $db->query ('SELECT ALL number_chapter,id_chapter FROM chapter ORDER BY number_chapter ');
        return $req;
    }

    /**
     * look for and displays a selected chapter
     * @param $id[int]
     *
     * @return mixed
     */
    public function getChap ($id)
    {
        $db = $this->dbConnect ();
        $req = $db->prepare ('SELECT id_chapter,number_chapter,title,content FROM chapter WHERE id_chapter = ?');
        $req->execute (array ( $id ));
        $post = $req->fetch ();
        return $post;
    }

    /**
     * counts the number of chapter
     * @return mixed
     */
    public function len ()
    {
        $db = $this->dbConnect ();
        $req = $db->query ('SELECT COUNT(id_chapter) FROM chapter WHERE 1 ');
        $len = $req->fetch ();
        return $len;
    }

    /**
     *  give an abstract of every chapter
     * @return bool|\PDOStatement
     */
    public function resumeChapter ()
    {
        $db = $this->dbConnect ();
        $req = $db->prepare ('SELECT id_chapter,title,content,DATE_FORMAT(publication_date, \'%d/%m/%Y \')AS publication_date,DATE_FORMAT(modification_date, \'%d/%m/%Y \') AS modification_date FROM chapter WHERE ? ORDER BY id_chapter DESC ');
        $req->execute (array ( 1 ));
        return $req;
    }

    /**
     * give an abstract of one chapter
     * @param $id[int]
     *
     * @return mixed
     */
    public function resumeAChapter ($id)
    {
        $db = $this->dbConnect ();
        $req = $db->prepare ('SELECT id_chapter,title,content,DATE_FORMAT(publication_date, \'%d/%m/%Y \')AS publication_date,DATE_FORMAT(modification_date, \'%d/%m/%Y \') AS modification_date  FROM chapter WHERE id_chapter=?');
        $req->execute (array ( $id ));
        $resultat = $req->fetch ();
        return $resultat;
    }
}
