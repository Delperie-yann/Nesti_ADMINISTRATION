<?php

include_once PATH_MODEL . 'Connection.php';
class ModelIngredientrecipe
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

        $sql    = "SELECT * FROM ingredientrecipe";
        $result = $pdo->query($sql);
        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Ingredientrecipe');
        } else {
            $array = [];
        }
        return $array;
    }
    //=============
    // readOneBy
    //=============
    /**
     * Read ingredientrecipe with ele1 at value ele2
     * 
     *  $parametrer
     *  $value
     *  return object ingredientrecipe
     */
    public function readOneBy($parameter, $value)
    {
        //requete
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM ingredientrecipe where $parameter = '$value'";

        $result = $pdo->query($sql);

        if ($result) {

            $data = $result->fetch(PDO::FETCH_ASSOC);
        } else {

            $data = [];
        }

        $user = new Ingredientrecipe();
        $user->setIngredientRecipeFromArray($data);

        return $user;
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

        $sql    = "SELECT * FROM ingredientrecipe where $parameter = '$value'";
        $result = $pdo->query($sql);

        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Ingredientrecipe');
        } else {
            $array = [];
        }
        return $array;
    }
    //=============
    // insertIngredientRecipe
    //=============
    /**
     *
     *
     *
     */
    public function insertIngredientRecipe(Ingredientrecipe &$ingredientrecipe)
    {

        $pdo = Connection::getPdo();
        try {
            // Create prepared statement name is insered whitout id in product
            $sql = "INSERT INTO ingredientrecipe (idProduct,idRecipe,quantity,idUnit) VALUES (?,?,?,?)";

            $stmt = $pdo->prepare($sql);

            $values = [$ingredientrecipe->getIdProduct(), $ingredientrecipe->getIdRecipe(), $ingredientrecipe->getQuantity(), $ingredientrecipe->getIdUnit()];
            // Execute the prepared statement
            // var_dump($values);
            $stmt->execute($values);
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        // return $newingredientrecipe;

    }
    //=============
    // delete
    //=============
    /**
     *
     *
     *
     */
    public function delete($value, $value2)
    {
        //requete
        $pdo = Connection::getPdo();
        try {
            $sql = "DELETE FROM ingredientrecipe where idRecipe = ? AND idProduct = ? ";
            // var_dump( $sql);
            $stmt = $pdo->prepare($sql);

            $values = [$value, $value2];
            // Execute the prepared statement
            $stmt->execute($values);
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
    }
    //=============
    // readOneByTwoElement
    //=============
    /**
     * Read ingredientrecipe with ele1 at value of ele1 and ele2 at value2 of ele2 
     * 
     *  $parametrer
     *  $value
     *  $parametrer2
     *  $value2
     *  return object ingredientrecipe
     */
    public function readOneByTwoElement($parameter, $value, $parameter2, $value2)
    {
        //requete
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM ingredientrecipe where $parameter =  $value AND $parameter2 =  $value2 ";

        $result = $pdo->query($sql);
        if ($result) {

            $data = $result->fetch(PDO::FETCH_ASSOC);
        } else {

            $data = [];
        }

        $user = new Ingredientrecipe();
        $user->setIngredientRecipeFromArray($data);

        return $user;
    }
}
