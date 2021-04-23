<?php
include_once(PATH_MODEL.'Connection.php');
class ModelUnit {
   
    public function readAll() {
        //requete
        $pdo= Connection::getPdo();

        $sql="SELECT * FROM unit ";
        $result=$pdo->query($sql);
        if($result){
            $array = $result-> fetchAll(PDO::FETCH_CLASS,'Unit');
        } else{
            $array=[];
            
        }
     
        return $array;
    }
    public function readOneBy($parameter,$value) {
        //requete
        $pdo= Connection::getPdo();

        $sql="SELECT * FROM unit where $parameter = '$value'";
      
        $result=$pdo->query($sql);
        // var_dump($result);
        if($result){
         
            $data = $result-> fetch(PDO::FETCH_ASSOC) ;
        } else{
          
            $data=[];
        }
        //var_dump($data);
        $user = new Unit();
        $user -> setUnitFromArray($data);
        // var_dump($user);
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