<?php
include_once(PATH_MODEL . 'Connection.php');
class ModelImages
{

    public function readOneBy($parameter, $value)
    {
        //requete
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM image where $parameter = '$value'";

        $result = $pdo->query($sql);
        //var_dump($result);
        if ($result) {

            $data = $result->fetch(PDO::FETCH_ASSOC);
        } else {

            $data = [];
        }
        //var_dump($data);
        $images = new Images();
        $images->setImagesFromArray($data);
        //$user -> setId($data);
        return $images;
    }

    public function insertImages(Images &$images)
    {
        $pdo = Connection::getPdo();
        try {
            // Create prepared statement
            $sql = "INSERT INTO image (name,fileExtension) VALUES (?,?)";

            $stmt = $pdo->prepare($sql);

            echo ("c'est de la merde php");
            $values = [$images->getName(), $images->getFileExtension()];
            var_dump($values);
            // Execute the prepared statement
            $stmt->execute($values);
            $newImages = $this->readOneBy("idImage", $pdo->lastInsertId());
            echo "Records inserted successfully.";
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        return $newImages;
    }
}
