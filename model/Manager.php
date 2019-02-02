<?php
/*
 * this class manages the db connect
 * package [jeanForteroche]\[Model]
 * 
 * @return $db 
 */
namespace jeanForteroche\Model;

class Manager{
  protected function dbConnect()
  {
    try
    {
      $db = new \PDO('mysql:host=localhost;dbname=slash1040766_1oujev;charset=utf8', 'root','');
      return $db;
    }
    catch(Exception $e)
    {
      die('Erreur : '.$e->getMessage());
    }
  }
}
