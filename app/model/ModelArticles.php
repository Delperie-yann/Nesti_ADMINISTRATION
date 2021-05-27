<?php
include_once(PATH_MODEL . 'Connection.php');
class ModelArticles
{

    //=============
    // readAll
    //=============
    /**
     *
     *
     *
     */
    public static function readAll()
    {
        //requete
        $pdo = Connection::getPdo();
        // SELECT a.idArticle AS id, unitQuantity AS unitQuantity, flag AS flag, dateCreation AS dateCreation, dateModification AS dateModification, idImage AS idImage, ap.price AS price, u.name AS unit, i.importationDate AS importationDate, pro.name as name, lot.quantity AS quantStock FROM article a JOIN lot ON lot.idArticle = a.idArticle JOIN product pro ON pro.idProduct = a.idProduct JOIN articleprice ap ON ap.idArticle = a.idArticle JOIN unit u ON a.idUnit = u.idUnit JOIN importation i ON i.idArticle = a.idArticle INNER JOIN( SELECT idArticle, MAX(dateStart) AS maxDate FROM articleprice GROUP BY idArticle ) a3 ON ap.idArticle = a3.idArticle AND ap.dateStart = a3.maxDate  ;
        $sql = "SELECT * FROM article";
        $result = $pdo->query($sql);
        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Articles');
        } else {
            $array = [];
        }
        return $array;
    }
    //=============
    // readOneBy
    //=============
    /**
     * Read article with ele1 at value ele2
     * 
     *  $parametrer
     *  $value
     *  return object article
     */
    public function readOneBy($parameter, $value)
    {
        //requete
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM article where $parameter = '$value'";
        $result = $pdo->query($sql);
        //var_dump($result);
        if ($result) {

            $data = $result->fetch(PDO::FETCH_ASSOC);
        } else {

            $data = [];
        }

        $user = new Articles();
        $user->setArticleFromArray($data);
        return $user;
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
    // deletedArticle
    //=============
    /**
     *
     *
     *
     */
    public function deletedArticle(Articles &$article)
    {
        $pdo = Connection::getPdo();
        try {
            $sql = "UPDATE article SET flag = 'b' WHERE idArticle = ?";

            $stmt = $pdo->prepare($sql);

            $values = [$article->getIdArticle()];
            // Execute the prepared statement
            $stmt->execute($values);
            $deleteArticle = $this->readOneBy("idArticle", $article->getIdArticle());
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        return  $deleteArticle;
    }
    //=============
    // updateArticleName
    //=============
    /**
     *
     *
     *
     */
    public function updateArticleName($idArticle, Articles &$article)
    {
        $pdo = Connection::getPdo();
        try {
            $sql = "UPDATE article SET realName = ? where idArticle = ?";

            $stmt = $pdo->prepare($sql);

            $values = [$article->getRealName(), $idArticle];
            // var_dump($stmt);
            // Execute the prepared statement
            $stmt->execute($values);
            $article = $this->readOneBy("idArticle", $article->getIdArticle());
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        return $article;
    }
}
