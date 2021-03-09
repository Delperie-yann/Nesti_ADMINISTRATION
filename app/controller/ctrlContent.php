<?php

switch ($loc) {

  case 'connection':
    include(PATH_CONTENT . "/content_connection.php");
    break;
  case 'recipes':
    switch ($action) {
      case 'editing':
        include(PATH_CONTENT . "/content_recipes_editing.php");
        break;
      case 'creation':
        include(PATH_CONTENT . "/content_recipes_creation.php");
        break;
      default:
        include(PATH_CONTENT . "/content_recipes.php");
        break;
    }

    break;
  case 'articles':
    switch ($action) {
      case 'orders':
        include(PATH_CONTENT . "/content_articles_orders.php");
        break;
      case 'importation':
        include(PATH_CONTENT . "/content_articles_importation.php");
        break;
      case 'editing':
        include(PATH_CONTENT . "/content_articles_editing.php");
        break;
      default:
        include(PATH_CONTENT . "/content_articles.php");
        break;
    }

    break;
  case 'users':
    switch ($action) {
      case 'creation':
        include(PATH_CONTENT . "/content_users_creation.php");
        break;
      case 'editing':
        include(PATH_CONTENT . "/content_users_editing.php");
        break;
      default:
        include(PATH_CONTENT . "/content_users.php");
        break;
    }

    break;
  case 'statistics':
    include(PATH_CONTENT . "/content_statistics.php");
    break;
    
  case 'deconnection':
    break;

  default:
    include(PATH_CTRL . "/error/404.php");
    break;
}
