<?php
/**[
 * Created by PhpStorm.
 * User: Sandrine
 * Date: 11/02/2019
 * Time: 13:07
 */

namespace jeanForteroche\Model;


use jeanForteroche\Model\AdminManager;
use jeanForteroche\Model\ChapterManager;

require_once ('./model/AdminManager.php');

class Admin
{
    /**
     * Verify the password
     * @param $login[string]
     * @param $pw[string]
     */
    public function verifiyPws ($login, $pw)
    {
        $adminManager = new AdminManager();
        $verify = $adminManager->verifiePw ($login, $pw);
        if ( $verify == true ) {
            $_SESSION[ 'verifyPwsMessage' ] = 'ok';
            $_SESSION['connected']=true;
            header ("Location: index.php?action=adminAccueil"
            );
        } else {
            $_SESSION[ 'verifyPwsMessage' ] = 'ko';
            $post = $this->interfaceAdminPW ();
        }
    }

    /**
     * get the login to fill the form
     */
    public function admPW ()
    {
        $adminManager = new AdminManager();
        $post = $this->admPWS ();
        require ('view/backend/Adminpassword.php');
    }

    /**
     *get the login to fill the form
     */
    public function interfaceAdminPW ()
    {
        $adminManager = new AdminManager();
        $post = $this->admPWS ();
        require ("view/frontend/password.php");
    }

    /**
     * change the password
     * @param $name[string]
     * @param $pwActual[string]
     * @param $pwNew[string]
     */
    public function newPws ($name, $pwActual, $pwNew)
    {
        $adminManager = new AdminManager();
        $verifypw = $adminManager->verifiePw ($name, $pwActual);
        if ( $verifypw == true ) {
            $pass_hache = password_hash ($pwNew, PASSWORD_DEFAULT);
            $_SESSION[ "message new Pw" ] = 'ok';
            $adminManager->changedPW ($name, $pass_hache);
            $this->adminAccueil ();
        } else {
            $_SESSION[ "message new Pw" ] = 'ko';
            $adminManager = new AdminManager();
            $post = $adminManager->AdmPW ();
            require ('view/backend/Adminpassword.php');
        }
    }

    /**
     * *display the password
     * @return mixed
     */
    public function admPWS ()
    {
        $adminManager = new AdminManager();
        $post = $adminManager->AdmPW ();
        return $post;
    }

    /**
     * displays the first page of the admin interface
     */
    public function adminAccueil ()
    {
        $adminManager = new AdminManager();
        $resume = $adminManager->resumeChapter ();
        $resumecomments = $adminManager->getComments ();
        require ('view/backend/AccueilAdmin.php');
    }

    /**
     * comments for administration page
     */
    public function adminAllComments ()
    {
        $adminManager = new AdminManager();
        $resumecomments = $adminManager->getComments ();
        require ('view/backend/AdminAllComments.php');
    }

    /**
     *  deletes a comment and reloads the page
     * @param $id[int]
     * @param $from[string]
     */
    public function deleteComment ($id, $from)
    {
        $adminManager = new AdminManager();
        $resume = $adminManager->resumeChapter ();
        $resumecomments = $adminManager->getComments ();
        $messageDeleteComment = $adminManager->deletComments ($id);
        $_SESSION[ "delete comment" ] = $messageDeleteComment;

        switch ( $from ) {
            case 'AllComment':
                $this->adminAllComments ();
                break;
            case 'Accueil':
                $this->adminAccueil ();
                break;
            default:
                require ('view/frontend/error.php');
                break;
        }
    }

    /**
     * erases the number of reports
     * @param $id[int]
     * @param $from[string]
     */
    public function keep ($id, $from)
    {
        $adminManager = new AdminManager();
        $resume = $adminManager->resumeChapter ();
        $resumecomments = $adminManager->getComments ();
        $messageKeepComment = $adminManager->keepComment ($id);
        switch ( $from ) {
            case 'AllComment':
                header ("Location: index.php?action=AllComments");
                break;
            case 'Accueil':
                header ("Location: index.php?action=adminAccueil");
                break;
            default:
                require ('view/frontend/error.php');
                break;
        }
    }

    /**
     *look for the numbers of future chapter
     */
    public function createNewChapters ()
    {
        $adminManager = new AdminManager();
        $resume = $adminManager->resumeChapter ();
        $number = $adminManager->nummax ();
        $numberChap = ($number[ 'number_chapter' ]);
        $chapter = [
            "id_chapter" => "",
            "number_chapter" => $numberChap + 1,
            "title" => "",
            "content" => "",
            "from" => "new"
        ];
        require ('view/backend/AdminCreateChapter.php');
    }

    /**
     * displays a chapter already saved
     * @param $id[int]
     */
    public function editAChapter ($id)
    {
        $adminManager = new AdminManager();
        $chapter = $adminManager->resumeAChapter ($id);
        $resume = $adminManager->resumeChapter ();
        require ('view/backend/AdminEditChapter.php');
    }

    /**
     * Displays a chapter when it save for the first time
     * @param $newChap [string]
     */
    public function editANewChapter ($newChap)
    {
        $adminManager = new AdminManager();
        $resume = $adminManager->resumeChapter ();
        $chapter = $newChap;
        require ('view/backend/AdminCreateChapter.php');
    }

    /**
     * save or create a chapter
     * @param $numbers[int]
     * @param $title[string]
     * @param $text[string]
     */
    public function saveNew ($numbers, $title, $text)
    {
        $adminManager = new AdminManager();
        $num = $adminManager->num ();
        $tabNumber = [];
        while ( $number = $num->fetch () ) {
            array_push ($tabNumber, $number[ 'number_chapter' ]);
        }
        if ( in_array ($numbers, $tabNumber) && ($_SESSION[ 'exist' ] == false) ) {
            $id = $adminManager->getId ($numbers);
            $chapter = [
                "id_chapter" => $id,
                "number_chapter" => $numbers,
                "title" => $title,
                "content" => $text
            ];
            $_SESSION[ 'exist' ] = true;
            $this->editANewChapter ($chapter);
        } else {
            if ( in_array ($numbers, $tabNumber) ) {
                $id = $adminManager->getId ($numbers);
                $res = $adminManager->saveChapter ($id, $numbers, $title, $text);
                $_SESSION[ 'save chapter' ] = true;
                $this->editAChapter ($id);
            } else {

                $res = $adminManager->createChapter ($numbers, $title, $text);
                $id = $adminManager->getId ($numbers);
                $_SESSION[ 'save chapter' ] = true;
                $this->editAChapter ($id);
            }
        }
    }

    /**
     * deletes a chapter and reloads the page
     * @param $numberchap [int]
     */
    public function deleteChapter ($numberchap)
    {
        $adminManager = new AdminManager();
        $adminManager->delete ($numberchap);
        $resume = $adminManager->resumeChapter ();
        $resume2 = $adminManager->resumeChapter ();
        $this->listChapters ();
    }

    /**
     * this function update a existing chapter
     * @param $id [int]
     * @param $title [int]
     * @param $content [int]
     */
    public function updateChapter ($id, $title, $content)
    {
        $adminManager = new AdminManager();
        $post = $adminManager->saveChapter ($id, $title, $content);
        $chapter = $adminManager->resumeAChapter ($id);
        $resume = $adminManager->resumeChapter ();
        require ('view/backend/AdminEditChapter.php');
    }


    /**
     *this function update a existing chapter
     */
    public function listChapters ()
    {
        $adminManager = new AdminManager();
        $resume = $adminManager->resumeChapter ();
        $resume2 = $adminManager->resumeChapter ();
        require ('view/backend/AdminListChapters.php');
    }

    /**
     * looks for the last id
     * @return mixed
     */
    public function idmax ()
    {
        $adminManager = new AdminManager();
        $id = $adminManager->idMax ();
        $idMax = ($id[ 'id_chapter' ]);
        return $idMax;
    }


    /**
     * this function update the number of chapter
     * @param $new [string]
     * @param $id [int]
     */
    function changeNumber ($new, $id)
    {
        $adminManager = new AdminManager();
        $adminManager->changeNum ($new, $id);
        $doublon = $adminManager->count ();
        if ( $doublon >= 2 ) {
            $_SESSION[ 'doublons' ] = true;
        } else {
            $_SESSION[ 'doublons' ] = false;
        }

        return;
    }

}
