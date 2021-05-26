<?php
include_once(PATH_MODEL . 'Connection.php');
class ModelIngredient
{


    //=============
    // insertIngredient
    //=============
    /**
     *
     *
     *
     */
    public function insertIngredient(Product &$product)
    {

        $pdo = Connection::getPdo();
        try {
            // Create prepared statement
            $sql = "INSERT INTO ingredient (idProduct) VALUES (?)";

            $stmt = $pdo->prepare($sql);

            $values = [$product->getIdProduct()];
            // Execute the prepared statement

            $stmt->execute($values);

            //$newUser = $this->readOneBy("idUsers",$pdo->lastInsertId());
            echo "Records insert Chef inserted successfully.";
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
    }
}
