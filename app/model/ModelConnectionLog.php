<?php
include_once(PATH_MODEL.'Connection.php');
class ModelConnectionLog  { 

    public static function readAll() {
        //requete
        $pdo= Connection::getPdo();

        $sql="SELECT * from connectionlog";
        $result=$pdo->query($sql);
        if($result){
            $array = $result-> fetchAll(PDO::FETCH_CLASS,'ConnectionLog');
        } else{
            $array=[];
        }
        return $array;
    }

    public function insertDateCo(Users &$IdUser){

        $pdo= Connection::getPdo();
        try{
            // Create prepared statement
            $sql = "INSERT INTO connectionLog (IdUsers) Values (?)";
            
            $stmt = $pdo->prepare($sql);
      
            $values= [$IdUser -> getIdUser()];        
            // Execute the prepared statement
        
            $stmt->execute($values);
       
           
            echo "Records inserted successfully.";
        } catch(PDOException $e){
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
       
    }
    public  function readAllBy($columnName,$value){

        //requete
        $pdo= Connection::getPdo();

        $sql="SELECT idUsersLog,dateConnection,IdUsers From connectionlog Where $columnName=$value ORDER BY dateConnection DESC";
        $result=$pdo->query($sql);
        if($result){
            $array = $result-> fetchAll(PDO::FETCH_CLASS,'ConnectionLog');
        } else{
            $array=[];
        }
        return $array;
    }
    
    public function readOneBy($parameter,$value) {
        //requete
        $pdo= Connection::getPdo();

        $sql="SELECT idUsersLog,dateConnection,IdUsers From connectionlog Where $parameter=$value ORDER BY dateConnection DESC";
      
        $result=$pdo->query($sql);
        //var_dump($result);
        if($result){
         
            $data = $result-> fetch(PDO::FETCH_ASSOC) ;
        } else{
          
            $data=[];
        }
        //var_dump($data);
        $user = new ConnectionLog();
        $user -> setLogFromArray($data);
        // var_dump($user);
        //$user -> setId($data);
        return $user;
    }
    


    








    
}