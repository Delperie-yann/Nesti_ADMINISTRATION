<?php
include_once PATH_MODEL . 'Connection.php';
class ModelProduct
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

        $sql    = "SELECT * FROM product ";
        $result = $pdo->query($sql);
        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Product');
        } else {
            $array = [];
        }

        return $array;
    }
    //=============
    // readOneBy
    //=============
    /**
     *
     *
     *
     */
    public function readOneBy($parameter, $value)
    {
        //requete
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM product where $parameter = '$value'";

        $result = $pdo->query($sql);
        // var_dump($result);
        if ($result) {

            $data = $result->fetch(PDO::FETCH_ASSOC);
        } else {

            $data = [];
        }
        //var_dump($data);
        $user = new Product();
        $user->setProductFromArray($data);
        // var_dump($user);
        //$user -> setId($data);
        return $user;
    }
    //=============
    // findChildType
    //=============
    /**
     *
     *
     *
     */
    public function findChildType($table, $type, $value)
    {
        $pdo = Connection::getPdo();
        $sql = "SELECT * FROM $table WHERE id" . ucfirst($type) . "= $value";
        //    var_dump($sql);
        $result = $pdo->query($sql);
        // var_dump($result);
        $data = $result->fetch();
        return $data;
    }
    //=============
    // insertProduct
    //=============
    /**
     *
     *
     *
     */
    public function insertProduct(Product &$product)
    {

        $pdo = Connection::getPdo();
        try {
            // Create prepared statement name is insered whitout id in product
            $sql = "INSERT INTO product (name) VALUES (?)";

            $stmt = $pdo->prepare($sql);

            $values = [$product->getName()];
            // Execute the prepared statement
            $stmt->execute($values);
            $newProduct = $this->readOneBy("idProduct", $pdo->lastInsertId());
            echo "Records inserted successfully.";
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        return $newProduct;
    }
    //=============
    // isAlreadyExistProduct
    //=============
    /**
     *
     *
     *
     */

    public function isAlreadyExistProduct($string)
    {

        $pdo = Connection::getPdo();

        $sql = "SELECT EXISTS (SELECT * FROM product WHERE name like (?) > 0)";

        $stmt = $pdo->prepare($sql);

        $values = [$string];
        $result = $stmt->execute($values);

        return $result;
    }
}
