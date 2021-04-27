<?php
include_once(PATH_MODEL.'Connection.php');
class ModelIngredient {

    public function insertChef(Ingredient &$idProduct){

        $pdo= Connection::getPdo();
        try{
            // Create prepared statement
            $sql = "INSERT INTO chef (idProduct) VALUES (?)";
            
            $stmt = $pdo->prepare($sql);
      
            $values= [$idProduct->getIdProduct()];        
            // Execute the prepared statement
            // var_dump($values);
            $stmt->execute($values);
      
            //$newUser = $this->readOneBy("idUsers",$pdo->lastInsertId());
            echo "Records insert Chef inserted successfully.";
        } catch(PDOException $e){
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        // return $newUser;
    }
    // public function findChild($type,$value){
    //     $pdo= Connection::getPdo();
    //     $sql="SELECT * FROM $type WHERE id".ucfirst($type)."= $value";
    //    //var_dump($sql);
    //     $result=$pdo->query($sql);
    //     $data = $result-> fetch();
    //     return $data;

    // }
}