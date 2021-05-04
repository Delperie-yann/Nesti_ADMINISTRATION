<?php
include_once(PATH_MODEL.'Connection.php');
class ModelChef {


    public static function readAll() {
        //requete
        $pdo= Connection::getPdo();

        $sql="SELECT * from Chef";
        $result=$pdo->query($sql);
        if($result){
            $array = $result-> fetchAll(PDO::FETCH_CLASS,'Chef');
        } else{
            $array=[];
        }
        return $array;
    }

    public function insertChef(Chef &$idChef){

        $pdo= Connection::getPdo();
        try{
            // Create prepared statement
            $sql = "INSERT INTO chef (idChef) VALUES (?)";
            
            $stmt = $pdo->prepare($sql);
      
            $values= [$idChef->getIdChef()];        
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