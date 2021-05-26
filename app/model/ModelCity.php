<?php
include_once(PATH_MODEL . 'Connection.php');
class ModelCity
{

    //=============
    // readAll
    //=============
    /**
     *
     *
     *
     */
    public static function readAll()
    {

        $pdo = Connection::getPdo();

        $sql = "SELECT * from city";
        $result = $pdo->query($sql);
        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'City');
        } else {
            $array = [];
        }
        return $array;
    }
    //=============
    // insertCity
    //=============
    /**
     *
     *
     *
     */
    public function insertCity($name)
    {

        $pdo = Connection::getPdo();
        try {

            $sql = "INSERT INTO city (name) VALUES (?)";

            $stmt = $pdo->prepare($sql);

            $values = [$name];

            $stmt->execute($values);

            $newTown = $this->readOneBy("idCity", $pdo->lastInsertId());
            // echo "Records insert Chef inserted successfully.";
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        return $newTown;
    }
    //=============
    // readOneBy
    //=============
    /**
     *
     *
     *
     */
    public function readOneBy($parameter, $value)
    {
        //requete
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM city where $parameter = '$value'";

        $result = $pdo->query($sql);

        if ($result) {

            $data = $result->fetch(PDO::FETCH_ASSOC);
        } else {

            $data = [];
        }

        $city = new City();
        $city->setCityFromArray($data);

        return $city;
    }
}
