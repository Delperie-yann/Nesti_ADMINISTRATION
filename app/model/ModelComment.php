<?php
include_once(PATH_MODEL.'Connection.php');
class ModelComment {

    public function readAll() {
        //requete
        $pdo= Connection::getPdo();

        $sql="SELECT * FROM comment";
        $result=$pdo->query($sql);
        if($result){
            $array = $result-> fetchAll(PDO::FETCH_CLASS,'Comment');
        } else{
            $array=[];
        }
        return $array;
    }




    
}