<?php
/**
 * This file manages useful functions for the frontend
 * package /[model]/[ChapterManager.php]
 * package /[model]/[CommentManager.php]
 */

require_once('./model/ChapterManager.php');
require_once('./model/CommentManager.php');

/**
 *  this function displays the last chapter and its comments
 * @param [integer] $id_chapter [Id of the last chapter]
 * @use chapterMananger
 * @use commentsManager
 * 
 * @link ['view/frontend/pageChapters.php] [Page affichant le chapitre]                                    
 * @return [array] $post [array containing the element of the chapter]
 * @return [integer] $len [nombre de chapitre]
 * @return [array] $comments [array containing different post concerning the chapter]                                             
 */
function chapPost($id_chapter){
    $chapterManager=new jeanForteroche\Model\ChapterManager;
    $post=$chapterManager->getChap($id_chapter);
    $len=$chapterManager->len();
    $commentsManager=new jeanForteroche\Model\CommentsManager;
    $comments=$commentsManager->getComments($post['id_chapter']);
    require('view/frontend/pageChapters.php');
}

/**
 * this function displays the comments of the seleted chapter
 * @param [integer] $id_chapter Id of the chapter
 * @use chapterManager
 * @use commentsManager   
 * 
 * @link [view/frontend/pageComments.php] [Page affichant les commentaires]
 * @return [array] $comments [containing the different post concerning the chapter]
 * @return [array] $post [array containing the element of the chapter]
 */
function commentChapter($id_chapter){
    $chapterManager=new jeanForteroche\Model\ChapterManager;
    $commentsManager=new jeanForteroche\Model\CommentsManager;
    $post=$chapterManager->getChap($id_chapter);
    $comments=$commentsManager->getComments($id_chapter);
    require('view/frontend/pageComments.php');
}

/**
 * this function displays the last chapter and its comments
 * @use chapterManager
 * @use commentsManager
 *                            
 * @link [view/frontend/frontpage.php] [Page accueil]
 * @return [array] $comments containing the different post concerning the chapter
 * @return [integer] $len [cont of chapter]
 * @return [array] $comments [array containing different post concerning the chapter]            
 */
function post(){
    $chapterManager=new jeanForteroche\Model\ChapterManager;
    $commentsManager=new jeanForteroche\Model\CommentsManager;
    $post=$chapterManager->getChapter();
    $len=$chapterManager->len();
    $comments=$commentsManager->getComments($post['id_chapter']);
    require('view/frontend/frontpage.php');
}

/**
 * this function locates a reported comment and places it in the table signal comment
 * @use commentsManager
 * @param [integer] $id_comment [Id of the post]
 * @param [integer] $id_chapter [Id of the post]
 * @param [text] $from [from whitch page]
 * @link [view/frontend/pageComments.php] [Page affichant les commentaires]
 *
 * @return [array] $comments containing the different post concerning the chapter
 * @return [array] commented [containing the comment signaled]
 */

function signalComment($id_comment,$id_chapter,$from){

    $commentsManager=new jeanForteroche\Model\CommentsManager;
    $message=$commentsManager->getSignal($id_comment,$id_chapter);
    $comments=$commentsManager->getComments($id_chapter);
    if ($from=='Comments') {
        header("Location: index.php?action=comments&&id_comment=".$id_comment."&&id_chapter=".$id_chapter."&&from=".'frontend');}
        elseif($from="Front"){
            header("Location: index.php?from=frontend");}
        elseif($from='Chapter'){
            header("Location: index.php?action=comments&&id_comment=".$id_comment."&&id_chapter=".$id_chapter."&&from=".'frontend');}
           else{
            require('view/frontend/erreur.php');}
         
    
}

/**
 * this function allows you to add a comment
 * @param [Integer] $id_chapter [id of the chapter for which we want to add a comment]
 * @param [text] $author [person who add a comment]
 * @param [text] $comment [commentaire]
 * @use commentsManager        
 */
function addComment($id_chapter,$author,$comment){
    $commentsManager=new jeanForteroche\Model\CommentsManager;
    $affectedLines = $commentsManager->postComment($id_chapter, $author, $comment);
    if ($affectedLines === false){
        header('Location: index.php?action=comments&id_chapter=' . $id_chapter."&& ErreurMessage=".true);
    }
    else {
        header('Location: index.php?action=comments&id=' . $id_chapter);
    }
}
