<?php

$model        = new ModelRecipes();
$arrayRecipes = $model->readAll();

$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
if ($action == "add") {
      $recipe = new Recipes();
      $recipe->setName(filter_input(INPUT_POST, "recipeName"));
      $recipe->setDifficulty(filter_input(INPUT_POST, "recipedifficult"));
      $recipe->setPortions(filter_input(INPUT_POST, "recipePortion"));
      $recipe->setPreparationTime(filter_input(INPUT_POST, "recipeTimePrepare"));
      $recipe->setFlag("w");
      //verif IS valid?
      $insertedRecipe = $model->insertRecipe($recipe);
      header('Location:' . BASE_URL . "recipes/editing/" . $insertedRecipe->getIdRecipe());

// $user = new Users();
// $user->setName($_SESSION["idUsers"]);
}
if($action=="editing"){

  $recipe = $model->readOneBy("idRecipe",$id);



}