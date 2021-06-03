<?php
include_once(PATH_MODEL . 'Connection.php');
class ModelImages
{
  //=============
    // readOneBy
    //=============
    /**
     * Read image with ele1 at value ele2
     * 
     *  $parametrer
     *  $value
     *  return object image
     */
    public function readOneBy($parameter, $value)
    {
        //requete
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM image where $parameter = '$value'";

        $result = $pdo->query($sql);
        if ($result) {

            $data = $result->fetch(PDO::FETCH_ASSOC);
        } else {

            $data = [];
        }
        $images = new Images();
        $images->setImagesFromArray($data);

        return $images;
    }
    //=============
    // insertImages
    //=============
    /**
     *
     *
     *
     */
    public function insertImages(Images $images)
    {
        $pdo = Connection::getPdo();
        try {
            // Create prepared statement
            $sql = "INSERT INTO image (name,fileExtension) VALUES (?,?)";

            $stmt = $pdo->prepare($sql);

            $values = [$images->getName(), $images->getFileExtension()];

            // Execute the prepared statement
            $stmt->execute($values);
            $newImages = $this->readOneBy("idImage", $pdo->lastInsertId());
            echo "Records inserted successfully.";
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        return $newImages;
    }
}