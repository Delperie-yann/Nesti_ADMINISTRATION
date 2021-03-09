<?php
include_once(PATH_MODEL.'Connection.php');
class ModelArticles {
   
    public function readAll() {
        //requete
        $pdo= Connection::getPdo();

        $sql="SELECT a.idArticle AS id, unitQuantity AS unitQuantity, flag AS flag, dateCreation AS dateCreation, dateModification AS dateModification, idImage AS idImage, ap.price AS price, u.name AS unit, i.importationDate AS importationDate, pro.name as name, lot.quantity AS quantStock FROM article a JOIN lot ON lot.idArticle = a.idArticle JOIN product pro ON pro.idProduct = a.idProduct JOIN articleprice ap ON ap.idArticle = a.idArticle JOIN unit u ON a.idUnit = u.idUnit JOIN importation i ON i.idArticle = a.idArticle INNER JOIN( SELECT idArticle, MAX(dateStart) AS maxDate FROM articleprice GROUP BY idArticle ) a3 ON ap.idArticle = a3.idArticle AND ap.dateStart = a3.maxDate  ";
        $result=$pdo->query($sql);
        if($result){
            $array = $result-> fetchAll(PDO::FETCH_CLASS,'Articles');
        } else{
            $array=[];
        }
        
        return $array;
    }


}