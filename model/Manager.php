<?php

/*
 * this class manages the db connect
 * package [jeanForteroche]\[Model]
 * 
 * @return $db 
 */
namespace jeanForteroche\Model;

class Manager  {

    protected function dbConnect(){
        try
        {
            $config=include('.\config\config.php');
            $db = new \PDO($config['hostname'] ,$config['user'], $config['password']);
            return $db;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }

}
