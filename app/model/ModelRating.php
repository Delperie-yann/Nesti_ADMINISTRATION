<?php
include_once(PATH_MODEL.'Connection.php');
class ModelRating {


    public function readAllBy($parameter, $value)
    {
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM grades where $parameter = '$value'";
        $result = $pdo->query($sql);

        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Rating');
        } else {
            $array = [];
        }

        return $array;
    }


}
