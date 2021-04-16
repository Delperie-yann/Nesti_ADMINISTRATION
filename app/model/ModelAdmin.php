<?php
include_once(PATH_MODEL.'Connection.php');
class ModelAdmin {

    public function insertAdmin(Admin &$idAdmin){

        $pdo= Connection::getPdo();
        try{
            // Create prepared statement
            $sql = "INSERT INTO administrator (idAdministrator) VALUES (?)";
            
            $stmt = $pdo->prepare($sql);
      
            $values= [$idAdmin -> getIdAdmin()];        
            // Execute the prepared statement
            var_dump($values);
            $stmt->execute($values);
      
            //$newUser = $this->readOneBy("idUsers",$pdo->lastInsertId());
            echo "Records insert admin inserted successfully.";
        } catch(PDOException $e){
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        // return $newUser;
    }
}