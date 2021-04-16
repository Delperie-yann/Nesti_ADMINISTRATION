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
    }
    if ($action == "deleted") {
      $this->delete($id);
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
}
