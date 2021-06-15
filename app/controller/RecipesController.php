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

    if ($action == "create") {
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

 
  /**
   * create
   * Creat a recipe without picture, ingredient, comment.  
   * @return void
   */
  public function create()
  {
    $model  = new ModelRecipes();
    $recipe = new Recipes();
    if (isset($_POST["recipeName"])) {
      $recipeName = filter_input(INPUT_POST, "recipeName",FILTER_DEFAULT);
      $recipedifficult = filter_input(INPUT_POST, "recipedifficult",FILTER_SANITIZE_NUMBER_INT);
      $recipePortion = filter_input(INPUT_POST, "recipePortion",FILTER_SANITIZE_NUMBER_INT);
      $recipeTime = filter_input(INPUT_POST, "recipeTimePrepare",FILTER_SANITIZE_STRING);
      $error        = 0;
      // accepted :  aze aze aze
      if (!preg_match("/^[a-zA-Z\s\.]*$/", $recipeName)) {
        $error        = 1;
        $this->data['recipeName'] = false;
      }
      //  accepted : 1 to 5
      if (!preg_match("/^([1-5][0-5]{0,0}|5)$/", $recipedifficult)) {
        $error        = 1;
        $this->data['recipedifficult'] = false;
      }
      // accepted : 1 to 9
      if (!preg_match("/^([1-9])$/", $recipePortion)) {
        $error        = 1;
        $this->data['recipePortion'] = false;
      }
      // accepted : 00:00 to 59:59 or 00:00 to 23:59:59
      if (!preg_match("/^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$/", $recipeTime)) {
        $error        = 1;
        $this->data['recipeTimePrepare'] = false;
      }
      // if fonction have no error controle create object and redirect 
      if ($error == 0) {
        $recipe->setName($recipeName);
        $recipe->setDifficulty($recipedifficult);
        $recipe->setPortions($recipePortion);
       
        $timeFormat = DateTime::createFromFormat('H:i',$recipeTime)->format('H:i:s');
        $recipe->setPreparationTime($timeFormat);
        $recipe->setFlag("a");
        $recipe->setIdChef($_SESSION['idUser']);
        $insertedRecipe = $model->insertRecipe($recipe);
        header('Location:' . BASE_URL . "recipes/editing/" . $insertedRecipe->getIdRecipe());
      } else {

        isset($this->data['recipeName']) + isset($this->data['recipedifficult']) + isset($this->data['recipePortion']) + isset($this->data['recipeTimePrepare']);
      }
    }
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
      $recipeName = filter_input(INPUT_POST, "recipeName");
      $recipedifficult = filter_input(INPUT_POST, "recipedifficult");
      $recipePortion = filter_input(INPUT_POST, "recipePortion");
      $recipeTimePrepare = filter_input(INPUT_POST, "recipeTimePrepare");
      $error        = 0;
      // accepted :  aze aze aze
      if (!preg_match("/^[a-zA-Z\s\.]*$/", $recipeName)) {
        $error        = 1;
        $this->data['recipeName'] = false;
      }
      //  accepted : 1 to 5
      if (!preg_match("/^([1-5][0-5]{0,0}|5)$/", $recipedifficult)) {
        $error        = 1;
        $this->data['recipedifficult'] = false;
      }
      // accepted : 1 to 9
      if (!preg_match("/^([1-9])$/", $recipePortion)) {
        $error        = 1;
        $this->data['recipePortion'] = false;
      }
      // accepted :00:00 to 59:59 or 00:00 to 23:59:59
      if (!preg_match("/^(?:(?:([01]?\d|2[0-3]):)?([0-5]?\d):)?([0-5]?\d)$/", $recipeTimePrepare)) {
        $error        = 1;
        $this->data['recipeTimePrepare'] = false;
      }
      // if fonction have no error controle create object and redirect 
      if ($error == 0) {
        $recipe->setName($recipeName);
        $recipe->setDifficulty($recipedifficult);
        $recipe->setPortions($recipePortion);
        $timeFormat= DateTime::createFromFormat('H:i:s',$recipeTimePrepare)->format('H:i:s');
        $recipe->setPreparationTime($timeFormat);
     
        $model                          = new ModelRecipes();
        $upadate = $model->updateRecipes($recipe);
       
        if (!empty($upadate)) {
          $this->data["success"] = "success";
        }
      } else {

        isset($this->data['recipeName']) + isset($this->data['recipedifficult']) + isset($this->data['recipePortion']) + isset($this->data['recipeTimePrepare']);
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

    $isExistProd = $modelProd->readOneby("name", $name);

    // if exist a product with the same name give id else insered it
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
    } else {
      header('Content-Type: application/json');
      echo json_encode(array('success' => false));
    }
    die;
  }
  
}
