<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

include './app/loader.php';

// require_once __DIR__ . "/app/tools/SiteUtil.php";
$loc    = filter_input(INPUT_GET, "loc", FILTER_SANITIZE_STRING);
$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
$mySession = new Session();
if ($mySession->isConnectUser()) {
  //echo("ID : ".$_SESSION['idUser']." est connecter commme ".$_SESSION['Roles']);

} else {
  // echo (" je suis pas co");
}
$post = filter_input(INPUT_POST, "loginUser", FILTER_SANITIZE_STRING);
if (($loc == null) || (!isset($_SESSION["login"]))) {
  $loc = "connection";
}

switch ($loc) {

  case 'connection':
    // include(PATH_CTRL . "/ctrlConnection.php");
    $ctrl = new ConnectionController();
    break;
  case 'recipes':
    $ctrl = new RecipesController();
    break;
  case 'articles':
    // include(PATH_CTRL . '/ctrlArticles.php');
    // include(PATH_CTRL . '/ctrlOrders.php');
    $ctrl = new ArticlesController();
    break;
  case 'users':
    // include(PATH_CTRL . '/ctrlUsers.php');
    $ctrl = new UsersController();
    break;
  case 'statistics':
    // include(PATH_CTRL . '/ctrlStatistics.php');
    $ctrl = new StatisticsController();
    break;
  case 'deconnection':
    //header('location:' . BASE_URL . "deconnection");
    $a = new Session();
    $a->disconnectUser();
    break;
  default:
    echo ("404");
    break;
}
extract($ctrl->getData());
include 'app/view/common/template.php';
