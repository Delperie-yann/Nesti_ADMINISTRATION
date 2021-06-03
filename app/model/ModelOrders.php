<?php
include_once PATH_MODEL . 'Connection.php';
class ModelOrders
{

    //=============
    // readAll
    //=============
    /**
     *
     *
     *
     */
    public function readAll()
    {
        //requete
        $pdo = Connection::getPdo();

        $sql    = "SELECT * FROM orders ";
        $result = $pdo->query($sql);
        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Orders');
        } else {
            $array = [];
        }

        return $array;
    }
    //=============
    // readAllBy
    //=============
    /**
     *
     *
     *
     */
    public function readAllBy($parameter, $value)
    {

        $pdo = Connection::getPdo();

        $sql    = "SELECT * FROM orders where $parameter = '$value'";
        $result = $pdo->query($sql);

        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Orders');
        } else {
            $array = [];
        }
        return $array;
    }
    //     //=============
    // // readAllBy
    // //=============
    // /**
    //  *
    //  *
    //  *
    //  */
    // public static function findAllAffterDate(String $key, $value, $flag=null)
    // {
    //       $pdo = Connection::getPdo();
       
    //     $sql = "SELECT * FROM orders WHERE $key > ? AND DAY($key) = ? AND flag = ?";
    //     $values = $value;

      

    //     $req = $pdo->prepare($sql);
    //     $req->execute($values);

    //     $entities = [];
    //     while ($entity = self::fetch(PDO::FETCH_CLASS, 'Orders'))  { // set entity properties to fetched column values
    //         if ($entity != null){ // entity might have a parent with a blocked flag
    //             $entities[] = $entity;
    //         }
    //     };
    //     return $entities;
    // }
}
