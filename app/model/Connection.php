<?php 

class Connection{

    static private $pdo=null;

public static function getPdo()
    {
        if(self::$pdo==null){
            self::startConnexion();
    }
    
    return self::$pdo;
    }

    public static function  startConnexion(){
    self::$pdo = new PDO (DSN,USERNAME,PWD, [PDO::ATTR_PERSISTENT=>true]);
    }
}
