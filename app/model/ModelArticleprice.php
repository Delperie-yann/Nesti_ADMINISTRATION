<?php
include_once(PATH_MODEL . 'Connection.php');
class ModelArticleprice
{
    //=============
    // readAll
    //=============
   
    /**
     * readAll
     *
     * @return array
     */
    public function readAll()
    {
        //requete
        $pdo = Connection::getPdo();
        // SELECT a.idArticle AS id, unitQuantity AS unitQuantity, flag AS flag, dateCreation AS dateCreation, dateModification AS dateModification, idImage AS idImage, ap.price AS price, u.name AS unit, i.importationDate AS importationDate, pro.name as name, lot.quantity AS quantStock FROM article a JOIN lot ON lot.idArticle = a.idArticle JOIN product pro ON pro.idProduct = a.idProduct JOIN articleprice ap ON ap.idArticle = a.idArticle JOIN unit u ON a.idUnit = u.idUnit JOIN importation i ON i.idArticle = a.idArticle INNER JOIN( SELECT idArticle, MAX(dateStart) AS maxDate FROM articleprice GROUP BY idArticle ) a3 ON ap.idArticle = a3.idArticle AND ap.dateStart = a3.maxDate  ;

        $sql = "SELECT * FROM articleprice";

        $result = $pdo->query($sql);
        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Articleprice');
        } else {
            $array = [];
        }

        return $array;
    }
    //=============
    // readOneBy
    //=============
    /**
     * Read articleprice with ele1 at value ele2
     * 
     * readOneBy
     *
     * @param  mixed $parameter
     * @param  mixed $value
     * @return object articleprice
     */
    public function readOneBy($parameter, $value)
    {
        //requete
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM articleprice where $parameter = '$value'";

        $result = $pdo->query($sql);
     
        if ($result) {

            $data = $result->fetch(PDO::FETCH_ASSOC);
        } else {

            $data = [];
        }
        $articleprice = new Articleprice();
        $articleprice->setArticlepriceFromArray($data);

        return $articleprice;
    }
    //=============
    // findChild
    //=============
    /**
     *
     *
     *
     */
    public function findChild($type, $value)
    {
        $pdo = Connection::getPdo();
        $sql = "SELECT * FROM $type WHERE id" . ucfirst($type) . "= $value";
        $result = $pdo->query($sql);
        $data = $result->fetch();
        return $data;
    }
    //=============
    // readAllBy
    //=============
    /**
     *
     *
     *
     */
    public function readAllBy($parameter, $value)
    {
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM articleprice where $parameter = '$value'";
        $result = $pdo->query($sql);

        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Articleprice');
        } else {
            $array = [];
        }

        return $array;
    }
}
