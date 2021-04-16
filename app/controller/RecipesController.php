<?php

class RecipesController extends BaseController
{
  public function initialize()
  {
    $model = new ModelRecipes();
    $loc    = filter_input(INPUT_GET, "loc", FILTER_SANITIZE_STRING);
    $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
var_dump("initialze");
    if ($action == '') {
      $this->data['arrayRecipes'] = $model->readAll();
    }
    var_dump($action);
    if ($action == "add") {
     
      $this->create();
    }
    if ($action == "editing") {

      $recipe = $model->readOneBy("idRecipe", $id);
      $this->data['recipe'] = $recipe;
    }
    if ($action == "deleted") {
      $this->delete($id);
    }
    if ($action == "addimage") {
      $this->addImage($id);
    }
  }

  public function create()
  {
    $model = new ModelRecipes();
    $recipe = new Recipes();
    $recipe->setName(filter_input(INPUT_POST, "recipeName"));
    $recipe->setDifficulty(filter_input(INPUT_POST, "recipedifficult"));
    $recipe->setPortions(filter_input(INPUT_POST, "recipePortion"));
    $recipe->setPreparationTime(filter_input(INPUT_POST, "recipeTimePrepare"));
    $recipe->setFlag("w");
    // var_dump($_SESSION['idUser']);
    $recipe->setIdChef($_SESSION['idUser']);
    
    //verif IS valid?
    $insertedRecipe = $model->insertRecipe($recipe);
    header('Location:' . BASE_URL . "recipes/editing/" . $insertedRecipe->getIdRecipe());
    // var_dump($recipe);
    // $user = new Users();
    // $user->setName($_SESSION["idUsers"]);
  }

  public function delete($id)
  {
    $model = new ModelRecipes();
    $recipe = $model->readOneBy("idRecipe", $id);
    $deletedRecipe = $model->deleteRecipe($recipe);
    header('Location:' . BASE_URL . "recipes");
  }

  public function addImage($id)
  {
    // echo  $id;
    // $model = new ModelRecipes();
    // $recipe = $model->readOneBy("idRecipe", $id);
    // var_dump($recipe);

    // var_dump($_FILES["pictures"]["name"]);
    // $name = explode(".", $_FILES["pictures"]["name"]);
    // echo  "<br>" . $name[0] . "<br>"; 
    // echo $name[1]; 
    // die();

    $target_dir = "public/img/recipes/";
    $target_file = $target_dir . basename($_FILES["pictures"]["name"]);
    $uploadOk = 1;
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

        $model = new ModelImages();
        $images = new Images();
        $images->setIdImage(filter_input(INPUT_POST, "idImage"));
        $images->setDateCreation(filter_input(INPUT_POST, "dateCreation"));
        $images->setName(filter_input(INPUT_POST, "name"));
        $images->setFileExtension(filter_input(INPUT_POST, "FileExtension"));
      
        //verif IS valid?
        $insertedImages = $model->insertImages($images);
        header('Location:' . BASE_URL . "recipes/editing/" . $insertedImages->getIdImage());

      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }

    // die();
  }
}
