<?php
include 'config.php';
//include'/'//fonctions,gestions url
// include('app/model/ModelRecipes.php');
// include('entity/Recipes.php');
include PATH_MODEL . 'Connection.php';

function my_autoloader($class)
{
  
  
    if (substr($class, 0, 5) == "Model") {
        include PATH_MODEL . $class . '.php';
    } else {
        include 'controller/entity/' . $class . '.php';
    }
}

spl_autoload_register('my_autoloader');
//