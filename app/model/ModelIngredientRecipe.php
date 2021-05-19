<?php

include_once(PATH_MODEL . 'Connection.php');
class ModelIngredientrecipe 
{

    public static function readAll() {
        //requete
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM ingredientrecipe";
        $result = $pdo->query($sql);
        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Ingredientrecipe');
        } else {
            $array = [];
        }
        return $array;
    }

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
    public function readAllBy($parameter, $value)
    {
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM ingredientrecipe where $parameter = '$value'";
        $result = $pdo->query($sql);

        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Ingredientrecipe');
        } else {
            $array = [];
        }
        return $array;
    }

    public function insertIngredientRecipe(Ingredientrecipe &$ingredientrecipe)
    {

        $pdo = Connection::getPdo();
        try {
            // Create prepared statement name is insered whitout id in product
            $sql = "INSERT INTO ingredientrecipe (idProduct,idRecipe,quantity,idUnit) VALUES (?,?,?,?)";

            $stmt = $pdo->prepare($sql);

            $values = [$ingredientrecipe->getIdProduct(),$ingredientrecipe->getIdRecipe(),$ingredientrecipe->getQuantity(),$ingredientrecipe->getIdUnit()];
            // Execute the prepared statement
            // var_dump($values);
            $stmt->execute($values);
           
            echo "Records inserted successfully.";
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        // return $newingredientrecipe;
    
    }
    public function delete($value)
    {
        //requete
        $pdo = Connection::getPdo();
        try {
        $sql = "DELETE FROM ingredientrecipe where idRecipe = (?)";
        // var_dump( $sql);
        $stmt = $pdo->prepare($sql);

        $values = $value;
        // Execute the prepared statement
        $stmt->execute($values);
     
        echo "Records deleted successfully.";
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
          }
    

}