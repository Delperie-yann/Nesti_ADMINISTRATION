<?php
include_once(PATH_MODEL.'Connection.php');
class ModelUsers {

    public function readAll() {
        //requete
        $pdo= Connection::getPdo();

        $sql="SELECT users.idUsers AS idUser, lastName AS lastname, firstName AS firstname, email AS email, passwordHash AS passwordHash, flag AS flag, dateCreation AS dateCreation, login AS loginUser, address1 AS address1, address2 AS address2, zipCode AS zipCode, idcity AS idcity, connectionlog.dateConnection as lastConnection FROM users inner JOIN connectionlog ON connectionlog.idUsers=users.idUsers ";
        $result=$pdo->query($sql);
        if($result){
            $array = $result-> fetchAll(PDO::FETCH_CLASS,'Users');
        } else{
            $array=[];
        }
        return $array;
    }
    public function readOneBy($parameter,$value) {
        //requete
        $pdo= Connection::getPdo();

        $sql="SELECT idUsers AS idUser, lastName AS lastname, firstName AS firstname, email AS email, passwordHash AS passwordHash, flag AS flag, dateCreation AS dateCreation, login , address1 AS address1, address2 AS address2, zipCode AS zipCode, idcity AS idcity FROM users where $parameter = '$value'";
      
        $result=$pdo->query($sql);
        //var_dump($result);
        if($result){
         
            $data = $result-> fetch(PDO::FETCH_ASSOC) ;
        } else{
          
            $data=[];
        }
        //var_dump($data);
        $user = new Users();
        $user -> setUserFromArray($data);
        //$user -> setId($data);
        return $user;
    }
    public function findChild($type,$value){
        $pdo= Connection::getPdo();
        $sql="SELECT * FROM $type WHERE id".ucfirst($type)."= $value";
       //var_dump($sql);
        $result=$pdo->query($sql);
        $data = $result-> fetch();
        return $data;

    }
    public function insertUser(Users &$user){

        $pdo= Connection::getPdo();
        try{
            // Create prepared statement
            $sql = "INSERT INTO users (lastName,firstName,email,flag ,dateCreation,login,address1,address2,zipCode,idCity) VALUES (?,?,?,?,?,?,?,?,?,?)";
            
            $stmt = $pdo->prepare($sql);
          // var_dump($stmt);
           //var_dump($user);
            $values= [$user -> getLastName(),$user -> getFirstName(),$user -> getEmail(),$user -> getFlag(),$user -> getDateCreation(),$user -> getLogin(),$user -> getAddress1(),$user -> getAddress2(),$user -> getZipCode(),'1'];        
            // Execute the prepared statement
        
            $stmt->execute($values);
           var_dump($values);
            // var_dump($pdo->lastInsertId());
            $newUser = $this->readOneBy("idUsers",$pdo->lastInsertId());
            echo "Records inserted successfully.";
        } catch(PDOException $e){
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        return $newUser;
    }
    
}