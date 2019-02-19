<?php
namespace jeanForteroche\Model;
/**
 * Created by PhpStorm.
 * User: Sandrine
 * Date: 12/02/2019
 * Time: 05:59
 */
/**
 * This file manages useful functions for the frontend
 * package /[model]/[ChapterManager.php]
 * package /[model]/[CommentManager.php]
 */

require_once('./model/ChapterManager.php');
require_once('./model/CommentManager.php');

class User
{
    /**
     *  Displays last chapter and its comments
     * @param $id_chapter[int]
     */
    public function chapPost($id_chapter){
        $chapterManager=new ChapterManager();
        $post=$chapterManager->getChap($id_chapter);
        $len=$chapterManager->len();
        $num=$chapterManager->num();
        $commentsManager=new CommentsManager();
        $comments=$commentsManager->getComments($post['id_chapter']);
        require('view/frontend/pageChapters.php');
    }

    /**
     * Displays the comments of the selected chapter
     * @param $id_chapter[int]
     */
    public function commentChapter($id_chapter){
        $chapterManager=new ChapterManager();
        $commentsManager=new CommentsManager();
        $num=$chapterManager->getChap($id_chapter);
        $number=$num['number_chapter']   ;
        $post=$chapterManager->getChap($id_chapter);
        $comments=$commentsManager->getComments($id_chapter);
 require('view/frontend/pageComments.php');
    }

    /**
     *displays the last chapter and its comments
     */
    public function post(){
        $chapterManager=new ChapterManager();
        $commentsManager=new CommentsManager();
        $post=$chapterManager->getChapter();
        $len=$chapterManager->len();
        $comments=$commentsManager->getComments($post['id_chapter']);
        $num=$chapterManager->num();
        require('view/frontend/frontpage.php');
    }

    /**
     * locates a reported comment and places it in the table signal comment
     * @param $id_comment [int]
     * @param $id_chapter[int]
     * @param $from[string]
     */
    public function signalComment($id_comment, $id_chapter, $from){
        $commentsManager=new CommentsManager();
       $commentsManager->getSignal($id_comment);
        $comments=$commentsManager->getComments($id_chapter);
     $_SESSION['signal comment']=true;
        switch ($from)
        {
            case  'Commentaires':
                header("Location: index.php?action=comments&&id_comment=".$id_comment."&&id_chapter=".$id_chapter."&&from= Commentaires");
                break;
            case 'Site de Jean Forteroche':
                header("Location: index.php?from2=user");
                break;
            case "chapitre":
                header("Location: index.php?action=others&&id_comment=".$id_comment."&&id_chapter=".$id_chapter."&&from=".$title2."chapitre");
                break;
            default:
                require('view/frontend/error.php');
        }
    }

    /**
     * allows you to add a comment
     * @param $id_chapter [int]
     * @param $author[string]
     * @param $comment[string]
     */
    public function addComment($id_chapter, $author, $comment){
        $commentsManager=new CommentsManager();
        $signalReturn=$commentsManager->postComment($id_chapter, $author, $comment);
        if ($signalReturn=1)
        {
            header('Location: index.php?action=comments&id_chapter=' . $_GET['id_chapter'] );
        }
        else
        {
            $_SESSION['comment no']=true;
            header('Location: index.php?action=comments&id_chapter=' . $_GET['id_chapter']);

        }
    }
}
