<?php
include_once(PATH_MODEL.'Connection.php');
class ModelOrdeline {
   
    public function readAll() {
        //requete
        $pdo= Connection::getPdo();

        $sql="SELECT * FROM orderline ";
        $result=$pdo->query($sql);
        if($result){
            $array = $result-> fetchAll(PDO::FETCH_CLASS,'Orderline');
        } else{
            $array=[];
            
        }
     
        return $array;
    }
    public function readAllBy($parameter, $value)
    {
       
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM orderline where $parameter = '$value'";
        $result = $pdo->query($sql);

    if ($result) {
        $array = $result->fetchAll(PDO::FETCH_CLASS, 'Orderline');
    } else {
        $array = [];
    }
    return $array;
}
}