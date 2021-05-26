<?php


session_start();

include './app/loader.php';


$loc    = filter_input(INPUT_GET, "loc", FILTER_SANITIZE_STRING);
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);

if (($loc == null) || (!isset($_SESSION["login"]))) {
  $loc = "connection";
}

switch ($loc) {
  case 'connection':
    $ctrl = new ConnectionController();
    break;
  case 'recipes':
    $ctrl = new RecipesController();
    break;
  case 'articles':
    $ctrl = new ArticlesController();
    break;
  case 'users':
    $ctrl = new UsersController();
    break;
  case 'statistics':
    $ctrl = new StatisticsController();
    break;
  case 'deconnection':
    $a = new Session();
    $a->disconnectUser();
    break;
  default:
    echo ("404");
    break;
}
extract($ctrl->getData());
include 'app/view/common/template.php';
