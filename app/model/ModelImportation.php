<?php
include_once(PATH_MODEL . 'Connection.php');
class ModelImportation
{

    //=============
    // readAll
    //=============
    /**
     *
     *
     *
     */
    public function readAll()
    {
        //requete
        $pdo = Connection::getPdo();
        // SELECT a.idArticle AS id, unitQuantity AS unitQuantity, flag AS flag, dateCreation AS dateCreation, dateModification AS dateModification, idImage AS idImage, ap.price AS price, u.name AS unit, i.importationDate AS importationDate, pro.name as name, lot.quantity AS quantStock FROM article a JOIN lot ON lot.idArticle = a.idArticle JOIN product pro ON pro.idProduct = a.idProduct JOIN articleprice ap ON ap.idArticle = a.idArticle JOIN unit u ON a.idUnit = u.idUnit JOIN importation i ON i.idArticle = a.idArticle INNER JOIN( SELECT idArticle, MAX(dateStart) AS maxDate FROM articleprice GROUP BY idArticle ) a3 ON ap.idArticle = a3.idArticle AND ap.dateStart = a3.maxDate  ;
        $sql = "SELECT * FROM importation";
        $result = $pdo->query($sql);
        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Importation');
        } else {
            $array = [];
        }

        return $array;
    }
    //=============
    // readOneBy
    //=============
    /**
     * Read importation with ele1 at value ele2
     * 
     *  $parametrer
     *  $value
     *  return object importation
     */
    public function readOneBy($parameter, $value)
    {
        //requete
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM importation where $parameter = '$value'";

        $result = $pdo->query($sql);
        //var_dump($result);
        if ($result) {

            $data = $result->fetch(PDO::FETCH_ASSOC);
        } else {

            $data = [];
        }
        // var_dump($data);
        $importation = new Importation();
        $importation->setImportationFromArray($data);
        // var_dump($importation);
        //$importation -> setId($data);
        return $importation;
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
        //var_dump($sql);
        $result = $pdo->query($sql);
        $data = $result->fetch();
        return $data;
    }
       //=============
    // insertImportation
    //=============
    /**
     *
     *
     *
     */
    public function insertImportation(Importation &$importation)
    {
        $pdo = Connection::getPdo();
        try {
            // Create prepared statement
            $sql = "INSERT INTO importation (idAdministrator,idArticle, idSupplierOrder,importationDate) VALUES (?,?,?,?)";

            $stmt = $pdo->prepare($sql);

            $values = [$importation->getIdAministrator(), $importation->getIdArticle(), $importation->getIdSupplierOrder(),$importation->getImportationDate()];
            // Execute the prepared statement
            $stmt->execute($values);
         
            $newRecipe = $this->readOneBy("idArticle", $pdo->lastInsertId());
           
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        return $newRecipe;
    }
}
