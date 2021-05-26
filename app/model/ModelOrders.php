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
}
