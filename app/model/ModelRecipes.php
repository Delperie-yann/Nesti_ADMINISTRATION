<?php
include_once PATH_MODEL . 'Connection.php';
class ModelRecipes
{
    //=============
    // readAll
    //=============  
    /**
     * readAll
     *
     * @return array
     */
    public static function readAll()
    {
        //requete
        $pdo = Connection::getPdo();

      
        $sql    = "SELECT * FROM recipe";
        $result = $pdo->query($sql);
        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Recipes');
        } else {
            $array = [];
        }
        return $array;
    }
    //=============
    // insertRecipe
    //=============
    /**
     *
     *
     *
     */
    public function insertRecipe(Recipes &$recipe)
    {
        $pdo = Connection::getPdo();
        try {
            // Create prepared statement
            $sql = "INSERT INTO recipe (name, difficulty,portions,flag,preparationTime,idChef) VALUES (?,?,?,?,?,?)";

            $stmt = $pdo->prepare($sql);

            $values = [$recipe->getName(), $recipe->getDifficulty(), $recipe->getPortions(), $recipe->getFlag(), $recipe->getPreparationTime(), $recipe->getIdChef()];
            // Execute the prepared statement
            $stmt->execute($values);
         
            $newRecipe = $this->readOneBy("idRecipe", $pdo->lastInsertId());
        
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        return $newRecipe;
    }
    //=============
    // deleteRecipe
    //=============
    /**
     *
     *
     *
     */
    public function deleteRecipe(Recipes &$recipe)
    {
        $pdo = Connection::getPdo();
        try {
            $sql = "UPDATE recipe SET flag = 'b' WHERE idRecipe = ?";

            $stmt = $pdo->prepare($sql);

            $values = [$recipe->getIdRecipe()];
            // Execute the prepared statement
            $stmt->execute($values);
            $deleteRecipe = $this->readOneBy("idRecipe", $recipe->getIdRecipe());
         
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        return $deleteRecipe;
    }
    //=============
    // readOneBy
    //=============
    /**
     * Read recipe with ele1 at value ele2
     * 
     *  $parametrer
     *  $value
     *  return object recipe
     */
    public function readOneBy($parameter, $value)
    {
        //requete
        $pdo = Connection::getPdo();

        $sql = "SELECT * FROM recipe where $parameter = '$value'";
        // var_dump($sql);
        $result = $pdo->query($sql);

        if ($result) {
            $data = $result->fetch();
        } else {
            $data = [];
        }

        $recipe = new Recipes();
        $recipe->setRecipeFromArray($data);

        return $recipe;
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

        $sql    = "SELECT * FROM recipe where $parameter = '$value'";
        $result = $pdo->query($sql);

        if ($result) {
            $array = $result->fetchAll(PDO::FETCH_CLASS, 'Recipes');
        } else {
            $array = [];
        }

        return $array;
    }
    //=============
    // updateRecipes
    //=============  
    /**
     * updateRecipes
     *
     * @param  object $recipe
     * @return object
     */
    public function updateRecipes(Recipes &$recipe)
    {
        $pdo = Connection::getPdo();
        try {
            $sql = "UPDATE recipe SET idImage = ?, name = ?, difficulty = ? , portions = ?,preparationTime=?, flag = ?, idChef = ? where idRecipe = ?";
            $stmt = $pdo->prepare($sql);
            $values = [$recipe->getIdImage(), $recipe->getName(), $recipe->getDifficulty(), $recipe->getPortions(), $recipe->getPreparationTime(), $recipe->getFlag(), $recipe->getIdChef(), $recipe->getIdRecipe()];
            // Execute the prepared statement
            $stmt->execute($values);
            $recipe = $this->readOneBy("idRecipe", $recipe->getIdRecipe());
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
        }
        unset($pdo);
        return $recipe;
    }
}
