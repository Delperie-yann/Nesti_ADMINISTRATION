<?php

// $model = new ModelArticles ();
// $arrayArticles = $model -> readAll(); 
// include 'app/view/common/head.php';
// switch ($action) {
//     case 'orders':
//       include(PATH_CONTENT . "/content_articles_orders.php");
//       break;
//     case 'importation':
//       include(PATH_CONTENT . "/content_articles_importation.php");
//       break;
//     case 'editing':
//       include(PATH_CONTENT . "/content_articles_editing.php");
//       break;
//     default:
//       include(PATH_CONTENT . "/content_articles.php");
//       break;
//   }
//   include 'app/view/common/footer.php';

class ArticlesController extends BaseController
{
    public function initialize()
    {
        $loc    = filter_input(INPUT_GET, "loc", FILTER_SANITIZE_STRING);
        $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
        if ($action == '') {
            $model = new ModelArticles();
            $this->data['arrayArticles'] = $model->readAll();
            $model1 = new ModelOrders();
         
            $unit = new ModelUnit();
            
            $import = new ModelImportation();
             // var_dump($import);
            
           
        }
    }
}
