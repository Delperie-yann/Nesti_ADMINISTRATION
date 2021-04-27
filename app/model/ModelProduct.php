<?php
include_once(PATH_MODEL.'Connection.php');
class ModelProduct {
   
    public function readAll() {
        //requete
        $pdo= Connection::getPdo();

        $sql="SELECT * FROM product ";
        $result=$pdo->query($sql);
        if($result){
            $array = $result-> fetchAll(PDO::FETCH_CLASS,'Product');
        } else{
            $array=[];
            
        }
     
        return $array;
    }
    public function readOneBy($parameter,$value) {
        //requete
        $pdo= Connection::getPdo();

        $sql="SELECT * FROM product where $parameter = '$value'";
      
        $result=$pdo->query($sql);
        // var_dump($result);
        if($result){
         
            $data = $result-> fetch(PDO::FETCH_ASSOC) ;
        } else{
          
            $data=[];
        }
        //var_dump($data);
        $user = new Product();
        $user -> setProductFromArray($data);
        // var_dump($user);
        //$user -> setId($data);
        return $user;
    }
    public function findChildType($table,$type,$value){
        $pdo= Connection::getPdo();
        $sql="SELECT * FROM $table WHERE id".ucfirst($type)."= $value";
    //    var_dump($sql);
        $result=$pdo->query($sql);
        // var_dump($result);
        $data = $result-> fetch();
        return $data;

    }

}