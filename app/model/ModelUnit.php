<?php
include_once PATH_MODEL . 'Connection.php';
class ModelUnit
{
    //=============
    // readAll
    //=============
    /**
     * Read all unit
     *  return empty array or object
     *
     */
    public function readAll()
    {
        $pdo = Connection::getPdo();
        try {
            $sql    = "SELECT * FROM unit ";
            $result = $pdo->query($sql);
            if ($result) {
                $array = $result->fetchAll(PDO::FETCH_CLASS, 'Unit');
            } else {
                $array = [];
            }
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        return $array;
    }

    //=============
    // readOneBy
    //=============
    /**
     * Read unit with ele1 at value ele2
     * 
     *  $parametrer
     *  $value
     *  return object unit
     */
    public function readOneBy($parameter, $value)
    {
        //requete
        $pdo = Connection::getPdo();
        try {
            $sql = "SELECT * FROM unit where $parameter = '$value'";

            $result = $pdo->query($sql);
            if ($result) {
                $data = $result->fetch(PDO::FETCH_ASSOC);
            } else {
                $data = [];
            }
            $unit = new Unit();
            $unit->setUnitFromArray($data);
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        return $unit;
    }
     //=============
    // findChild
    //=============
    /**
     *  Read table with id of table equals ele1 
     * $type
     * $value 
     * return array
     */
    public function findChild($type, $value)
    {
        $pdo = Connection::getPdo();
        $sql = "SELECT * FROM $type WHERE id" . ucfirst($type) . "= $value";
        $result = $pdo->query($sql);
        $data   = $result->fetch();
        return $data;
    }

    //=============
    // insertUnit
    //=============
    /**
     *  Insert to unit table the name of the unit
     *  $unit
     *  return last inserted object
     */
    public function insertUnit(Unit &$unit)
    {

        $pdo = Connection::getPdo();
        try {
            // Create prepared statement name is insered whitout id in product
            $sql = "INSERT INTO unit (name) VALUES (?)";

            $stmt = $pdo->prepare($sql);

            $values = [$unit->getName()];
            // Execute the prepared statement
            $stmt->execute($values);
            $newUnit = $this->readOneBy("idUnit", $pdo->lastInsertId());
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        return $newUnit;
    }
    //=============
    // insertUnit
    //=============
    /**
     *  Insert to unit table the name of the unit
     *  $unit
     *  return last inserted object
     */
    public function insertUnitJquery($unit)
    {

        $pdo = Connection::getPdo();
        try {
            // Create prepared statement name is insered whitout id in product
            $sql = "INSERT INTO unit (name) VALUES (?)";

            $stmt = $pdo->prepare($sql);

            $values = [$unit];
            // Execute the prepared statement
            $stmt->execute($values);
            $newUnit = $this->readOneBy("idUnit", $pdo->lastInsertId());
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        return $newUnit;
    }
}
