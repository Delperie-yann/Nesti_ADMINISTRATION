<?php

class RecipesController extends BaseController
{
  /**
   * initialize
   *
   * @return void
   */
  public function initialize()
  {
    $model  = new ModelRecipes();
    $loc    = filter_input(INPUT_GET, "loc", FILTER_SANITIZE_STRING);
    $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
    $id     = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
    $supp   = filter_input(INPUT_GET, "supp", FILTER_SANITIZE_STRING);
    $idProduct = filter_input(INPUT_GET, "state", FILTER_SANITIZE_STRING);

    if ($action == '') {
      $this->data['arrayRecipes'] = $model->readAll();
    }

    if ($action == "add") {
      $this->create();
    }
    if ($action == "editing") {
      if ($supp == "supp") {

        $this->suppres($id, $idProduct);
      }
      $this->editRecipe($id);
    }
    if ($action == "deleted") {
      $this->delete($id);
    }
    if ($action == "addimage") {
      $this->addimage($id);
    }
    if ($action == "adding") {
      $this->adding($id);
    }
  }




  //Destroy Ingredient in DDB but not Product and Unit created
  public function suppres($idRecipe, $idProduct)
  {

    $model = new ModelIngredientrecipe();
    $isIngredient = $model->readOneByTwoElement("idRecipe", $idRecipe, "idProduct", $idProduct);
    if (isset($isIngredient) == true) {
      $model->delete($idRecipe, $idProduct);
    }
    header('Location:' . BASE_URL . "recipes/editing/" . $idRecipe);
  }

  // Creat a recipe without picture, ingredient, comment.
  public function create()
  {
    $model  = new ModelRecipes();
    $recipe = new Recipes();
    $recipe->setName(filter_input(INPUT_POST, "recipeName"));
    $recipe->setDifficulty(filter_input(INPUT_POST, "recipedifficult"));
    $recipe->setPortions(filter_input(INPUT_POST, "recipePortion"));
    $recipe->setPreparationTime(filter_input(INPUT_POST, "recipeTimePrepare"));
    $recipe->setFlag("a");
    $recipe->setIdChef($_SESSION['idUser']);

    //verif IS valid?
    $insertedRecipe = $model->insertRecipe($recipe);
    header('Location:' . BASE_URL . "recipes/editing/" . $insertedRecipe->getIdRecipe());
  }
  
  /**
   * delete
   *
   * @param  mixed $id
   * @return void
   */
  public function delete($id)
  {
    $model         = new ModelRecipes();
    $recipe        = $model->readOneBy("idRecipe", $id);
    $deletedRecipe = $model->deleteRecipe($recipe);
    header('Location:' . BASE_URL . "recipes");
  }


  
  /**
   * addPreparation
   *
   * @param  mixed $id
   * @return void
   */
  public function addPreparation($id)
  {
    $model          = new ModelParagraph();
    $recipe         = $model->readOneBy("idRecipe", $id);
    $addPreparation = $model->addPreparation($recipe);
  }
  
  /**
   * editRecipe
   *
   * @param  mixed $idRecipe
   * @return void
   */
  public function editRecipe($idRecipe)
  {
    $model                          = new ModelRecipes();
    $recipe                         = $model->readOneBy("idRecipe", $idRecipe);
    $this->data['recipe']           = $recipe;
    $ing                            = new ModelIngredientrecipe();
    $ingredientrecipe               = $ing->readAllBy("idRecipe", $recipe->getIdRecipe());
    $this->data['ingredientrecipe'] = $ingredientrecipe;

    if (isset($_POST["recipeName"])) {

      $recipe->setName(filter_input(INPUT_POST, "recipeName"));
      $recipe->setDifficulty(filter_input(INPUT_POST, "recipedifficult"));
      $recipe->setPortions(filter_input(INPUT_POST, "recipePortion"));
      $recipe->setPreparationTime(filter_input(INPUT_POST, "recipeTimePrepare"));
      $model                          = new ModelRecipes();
      $upadate = $model->updateRecipes($recipe);
      if (!empty($upadate)) {
        $this->data["success"] = "success";
      }
    }


   
  }
    
  /**
   * addImage
   *
   * @param  mixed $id
   * @return void
   */
  public function addImage($id)
  {
    $modelRecipe = new ModelRecipes();
    $recipe = $modelRecipe->readOneBy("idRecipe", $id);

    $target_dir = "public/img/recipes/";
    $target_file = $target_dir . basename($_FILES["pictures"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    // Check if image file is a actual image or fake image
    if (isset($_POST["pictures"])) {
      var_dump($_FILES["pictures"]);
      $check = getimagesize($_FILES["pictures"]["tmp_name"]);
      if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["pictures"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }

    // Allow certain file formats
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["pictures"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["pictures"]["name"])) . " has been uploaded.";

        $model = new ModelImages();
        $images = new Images();

        $name = explode(".", $_FILES["pictures"]["name"]);
        $images->setName($name[0]);
        $images->setFileExtension($name[1]);

        //verif IS valid?
        $insertedImages = $model->insertImages($images);
        $recipe->setIdImage($insertedImages->getIdImage());
        $modelRecipe->updateRecipes($recipe);
        header('Location:' . BASE_URL . "recipes/editing/" . $id);
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }

  
  /**
   * adding
   *
   * @param  mixed $id
   * @return void
   */
  function adding($id)
  {

    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $quant = filter_input(INPUT_POST, "quant", FILTER_SANITIZE_STRING);
    $unit = filter_input(INPUT_POST, "unit", FILTER_SANITIZE_STRING);



    $modelProd  = new ModelProduct();
    $ingredient = new Product();
    $isExistProd = $modelProd->readOneby("name", $name);


    if ((($isExistProd->getName()) == null) && ($name != "")) {
      $insertedIng = $modelProd->insertProductJquery($name);
      $isProdId    = $insertedIng->getIdProduct();
      $ingredient  = new ModelIngredient();
      $ingredient->insertIngredient($insertedIng);
    } else {
      $isProdId = $isExistProd->getIdProduct();
    }


    $modelUnit = new ModelUnit();
    $isExistUnit = $modelUnit->readOneby("name", $unit);

    // if the name of unit still exist return else or give id of the insered unit
    if (($isExistUnit)->getName() == null && $unit != "") {
      $insertedUnit = $modelUnit->insertUnitJquery($unit);
      $isUnitid     = $insertedUnit->getIdUnit();
    } else {
      $isUnitid = $isExistUnit->getIdUnit();
    }
    $ing = new Ingredientrecipe();

    $ing->setIdRecipe($id);
    $ing->setIdProduct($isProdId);
    $ing->setIdUnit($isUnitid);
    if ($quant != 0) {
      $ing->setQuantity($quant);
    }

    $model = new ModelIngredientrecipe();

    // if the quantity of ingredient is not 0 insert a row of IngredientRecipe 
    if ($ing->getQuantity() != 0) {
      $model->insertIngredientRecipe($ing);
      header('Content-Type: application/json');
      echo json_encode(array('success' => true, 'recipe' => $id, 'name' => $name, 'quant' => $quant, 'unit' => $unit, 'idProduct' => $isProdId));
      // var_dump( $insertedRecipe);

      // header('Location:' . BASE_URL . "recipes/editing/" . $id);
    } else {
      header('Content-Type: application/json');
      echo json_encode(array('success' => false));
    }



    die;
  }
}
