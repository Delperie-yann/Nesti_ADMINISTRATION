<?php
include_once(PATH_MODEL.'Connection.php');
class ModelUsers {

    public function readAll() {
        //requete
        $pdo= Connection::getPdo();

        $sql="SELECT users.idUsers AS id, lastName AS lastname, firstName AS firstname, email AS email, passwordHash AS passwordHash, flag AS flag, dateCreation AS dateCreation, login AS loginUser, address1 AS address1, address2 AS address2, zipCode AS zipCode, idcity AS idcity, connectionlog.dateConnection as lastConnection FROM users inner JOIN connectionlog ON connectionlog.idUsers=users.idUsers ";
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

        $sql="SELECT idUsers AS id, lastName AS lastname, firstName AS firstname, email AS email, passwordHash AS passwordHash, flag AS flag, dateCreation AS dateCreation, login , address1 AS address1, address2 AS address2, zipCode AS zipCode, idcity AS idcity FROM users where $parameter = '$value'";
       // var_dump($sql);
        $result=$pdo->query($sql);
        
        if($result){
         
            $data = $result-> fetch();
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

}