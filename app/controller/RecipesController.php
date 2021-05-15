<?php

class RecipesController extends BaseController
{
  public function initialize()
  {
    $model  = new ModelRecipes();
    $loc    = filter_input(INPUT_GET, "loc", FILTER_SANITIZE_STRING);
    $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
    $id     = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
    $supp   = filter_input(INPUT_GET, "supp", FILTER_SANITIZE_STRING);
    
    if ($action == '') {
      $this->data['arrayRecipes'] = $model->readAll();
    }
   
    if ($action == "add") {
      $this->create();
    }
    if ($action == "editing") {
      if ($supp == "supp"){
      $this->suppres($id);
      }
      $this->editRecipe($id);
      
    }
    if ($action == "deleted") {
      $this->delete($id);
    }
    if ($action == "addimage") {
      $this->addImage($id);
    }
    
  }

  //Destroy Ingredient in DDB but not Product and Unit created
  public function suppres($isIngredient){
    
    $model = new ModelIngredientRecipe();
    $isProduct = $model->readOneby("idProduct", $isIngredient);
    $model->delete($isProduct);

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

  public function delete($id)
  {
    $model         = new ModelRecipes();
    $recipe        = $model->readOneBy("idRecipe", $id);
    $deletedRecipe = $model->deleteRecipe($recipe);
    header('Location:' . BASE_URL . "recipes");
  }

  public function addImage($id)
  {
    $modelRecipe = new ModelRecipes();
    $recipe      = $modelRecipe->readOneBy("idRecipe", $id);

    $target_dir    = "public/img/recipes/";
    $target_file   = $target_dir . basename($_FILES["pictures"]["name"]);
    $uploadOk      = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
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

        $model  = new ModelImages();
        $images = new Images();

        $name = explode(".", $_FILES["pictures"]["name"]);
        $images->setName($name[0]);
        $images->setFileExtension($name[1]);

        
        $insertedImages = $model->insertImages($images);
        $recipe->setIdImage($insertedImages->getIdImage());
        $modelRecipe->updateRecipes($recipe);
        header('Location:' . BASE_URL . "recipes/editing/" . $id);
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }

  public function addPreparation($id)
  {
    $model          = new ModelParagraph();
    $recipe         = $model->readOneBy("idRecipe", $id);
    $addPreparation = $model->addPreparation($recipe);
  }

  public function editRecipe($idRecipe)
  {
    $model                          = new ModelRecipes();
    $recipe                         = $model->readOneBy("idRecipe", $idRecipe);
    $this->data['recipe']           = $recipe;
    $ing                            = new ModelIngredientRecipe();
    $ingredientrecipe               = $ing->readAllBy("idRecipe", $recipe->getIdRecipe());
    $this->data['ingredientrecipe'] = $ingredientrecipe;

    if (isset($_POST["recipeName"])) {
      $recipe->setName(filter_input(INPUT_POST, "recipeName"));
      $recipe->setDifficulty(filter_input(INPUT_POST, "recipedifficult"));
      $recipe->setPortions(filter_input(INPUT_POST, "recipePortion"));
      $recipe->setPreparationTime(filter_input(INPUT_POST, "recipeTimePrepare"));

      $model->updateRecipes($recipe);
      header('Location:' . BASE_URL . "recipes/editing/" . $idRecipe);
    }
    

    //  if the user click in "ok" insert an Ingredient in table
    if (isset($_POST["ingredientName"])) {
      $modelProd  = new ModelProduct();
      $ingredient = new Product();
      $ingredient->setName(filter_input(INPUT_POST, "ingredientName"));
      // var_dump($model->isAlreadyExistProduct(  $ingredient->getName()));
      $isExistProd = $modelProd->readOneby("name", $ingredient->getName());

      // if the name of ingredient still exist return else or give id of the insered product 
      if ((($isExistProd->getName()) == null) && ($ingredient->getName()!="")) {
        $insertedIng = $modelProd->insertProduct($ingredient);
        $isProdId    = $insertedIng->getIdProduct();
        $ingredient  = new ModelIngredient();
        $ingredient->insertIngredient($insertedIng);
      } else {
        $isProdId = $isExistProd->getIdProduct();
      }

      $modelUnit = new ModelUnit();
      $unit      = new Unit();
      $unit->setName(filter_input(INPUT_POST, "ingredientUnit"));
      $isExistUnit = $modelUnit->readOneby("name", $unit->getName());

      // if the name of unit still exist return else or give id of the insered unit
      if (($isExistUnit)->getName() == null && $unit->getName()!="") {
        $insertedUnit = $modelUnit->insertUnit($unit);
        $isUnitid     = $insertedUnit->getIdUnit();
      
      } else {
        $isUnitid = $isExistUnit->getIdUnit();
      }

      $ing = new IngredientRecipe();
      // $ingredientrecipe->setQuantity(filter_input(INPUT_POST, "ingredientQuant"));
      $ing->setIdRecipe($idRecipe);
      $ing->setIdProduct($isProdId);
      $ing->setIdUnit($isUnitid);
      $ing->setQuantity(filter_input(INPUT_POST, "ingredientQuant"));
        $model = new ModelIngredientRecipe();

        // if the quantity of ingredient is not 0 insert a row of IngredientRecipe 
      if($ing->getQuantity()!=0){
      $insertedRecipe = $model->insertIngredientRecipe($ing);
     

      header('Location:' . BASE_URL . "recipes/editing/" . $idRecipe);
    }
    }

  }
}