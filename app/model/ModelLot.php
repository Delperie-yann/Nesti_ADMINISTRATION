<?php
include_once(PATH_MODEL.'Connection.php');
class ModelLot {
   
    public function readAll() {
        //requete
        $pdo= Connection::getPdo();
        // SELECT a.idArticle AS id, unitQuantity AS unitQuantity, flag AS flag, dateCreation AS dateCreation, dateModification AS dateModification, idImage AS idImage, ap.price AS price, u.name AS unit, i.importationDate AS importationDate, pro.name as name, lot.quantity AS quantStock FROM article a JOIN lot ON lot.idArticle = a.idArticle JOIN product pro ON pro.idProduct = a.idProduct JOIN articleprice ap ON ap.idArticle = a.idArticle JOIN unit u ON a.idUnit = u.idUnit JOIN lot i ON i.idArticle = a.idArticle INNER JOIN( SELECT idArticle, MAX(dateStart) AS maxDate FROM articleprice GROUP BY idArticle ) a3 ON ap.idArticle = a3.idArticle AND ap.dateStart = a3.maxDate  ;
        $sql="SELECT * FROM lot";
        $result=$pdo->query($sql);
        if($result){
            $array = $result-> fetchAll(PDO::FETCH_CLASS,'Lot');
        } else{
            $array=[];
        }
        
        return $array;
    }
    public function readOneBy($parameter,$value) {
        //requete
        $pdo= Connection::getPdo();

        $sql="SELECT * FROM lot where $parameter = '$value'";
      
        $result=$pdo->query($sql);
        //var_dump($result);
        if($result){
         
            $data = $result-> fetch(PDO::FETCH_ASSOC) ;
        } else{
          
            $data=[];
        }
        // var_dump($data);
        $lot = new Lot();
        $lot -> setLotFromArray($data);
        // var_dump($lot);
        //$lot -> setId($data);
        return $lot;
    }

    public function readAllBy($parameter, $value)
    {
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM lot where $parameter = '$value'";
        $result = $pdo->query($sql);

        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Lot');
        } else {
            $array = [];
        }
        return $array;
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