<?php
/*
 * this class manages the db connect
 * package [jeanForteroche]\[Model]
 * 
 * @return $db 
 */
namespace jeanForteroche\Model;
require_once("ManagerLog.php");

class Manager extends ManagerLog  {

  protected function dbConnect()

  {  $managerLog=new ManagerLog;

    try
    {
      $db = new \PDO($managerLog->_dsn ,$managerLog->_user, $managerLog->_password);
      return $db;
    }
    catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
  }
}
