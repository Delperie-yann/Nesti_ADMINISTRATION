<?php
include_once(PATH_MODEL.'Connection.php');
class ModelOrders {
   
    public function readAll() {
        //requete
        $pdo= Connection::getPdo();

        $sql="SELECT o.idOrders AS id, u.lastName AS lastname, u.firstName AS firstname, o.flag as flag, o.dateCreation as dateCreation, ol.quantity AS quant FROM orders o INNER JOIN orderline ol ON ol.idOrders = o.idOrders INNER JOIN users u ON u.idUsers = o.idUsers ";
        $result=$pdo->query($sql);
        if($result){
            $array = $result-> fetchAll(PDO::FETCH_CLASS,'Orders');
        } else{
            $array=[];
            
        }
     
        return $array;
    }


}