<?php
class ArticlesController extends BaseController
{
    /**
     * initialize
     *
     * @return void
     */
    public function initialize()
    {
        $loc    = filter_input(INPUT_GET, "loc", FILTER_SANITIZE_STRING);
        $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
        if ($action == '') {
            $model = new ModelArticles();
            $this->data['arrayArticles'] = $model->readAll();
        }
        if ($action == "editing") {
            $this->editArticle($id);
        }
        if ($action == "deleted") {
            $this->deleteArticle($id);
        }
        if ($action == "orders") {
            $model = new ModelOrders();
            $this->data['arrayOrders'] = $model->readAll();
        }
        if ($action == "importation") {
            $this->import();
        }
    }

    /**
     * editArticle
     *
     * @param  mixed $idArticles
     * @return void
     */
    public function editArticle($idArticles)
    {
        $model = new ModelArticles();
        $article = $model->readOneBy("idArticle", $idArticles);
        $this->data['article'] = $article;
        if (isset($_POST["nameReal"]) && $_POST["nameReal"] != "") {

            $article->setRealName(filter_input(INPUT_POST, "nameReal"));

            $valid = $model->updateArticleName($idArticles, $article);
            if ($valid) {
                $this->data['success'] = "success";
            } else {
                $this->data['error'] = "error";
            }
        }
    }

    /**
     * deleteArticle
     *
     * @param  mixed $idArticles
     * @return void
     */
    public function deleteArticle($idArticles)
    {
        $model = new ModelArticles();
        $article = $model->readOneBy("idArticle", $idArticles);
        $deletedArticle = $model->deletedArticle($article);
        header('Location:' . BASE_URL . "articles");
    }

    public function import()
    {

        if ($_FILES != array()) {
            if ($_FILES["file"]["type"] != "application/vnd.ms-excel") {
                die("Ce n'est pas un fichier de type .csv");
            } else {
                // var_dump($_FILES);
                is_uploaded_file($_FILES['file']['tmp_name']);

                $handle = fopen($_FILES['file']['tmp_name'], "r");


                $data = fgetcsv($handle, 1000, ",");
                $row = 1;

                $array = [];
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);
                    // echo "<p> $num fields in line $row: </p>\n";

                    $modelArticle = new ModelArticles();
                    $modelArticlePrice = new ModelArticleprice();
                    $modelUnit = new ModelUnit();
                    $modelProduct = new ModelProduct();
                    $importation = new Importation();



                    $article = new Articles();
                    $article->setIdArticle($data[0]);
                    $article->setUnitQuantity($data[1]);
                    if ($data[2] == "Unblocked") {
                        $data[2] = "a";
                    } else {
                        $data[2] = "b";
                    }
                    $article->setFlag($data[2]);
                    $article->setDateCreation($data[3]);
                    $article->setDateModification($data[4]);
                    $article->setIdProduct($data[8]);

                    //Unit insert
                    $unit = new Unit();
                    $UnitExist = $modelUnit->readOneBy("name", $data[13]);
                    if ($UnitExist->getIdUnit() == NULL) {
                        $unit->setIdUnit($data[12]);
                        $unit->setName($data[13]);
                        $UnitInsert = $modelUnit->insertUnit($unit);
                        $idUnitInsert = $UnitInsert->getIdUnit();
                    } else {
                        $idUnitInsert = $UnitExist->getIdUnit();
                    }
                    $article->setIdUnit($idUnitInsert);


                    //Product insert
                    $product = new Product();
                    $ProductExist = $modelProduct->readOneBy("name", $data[9]);
                    if ($ProductExist->getIdProduct() == NULL) {
                        $product->setIdProduct($data[8]);
                        $product->setName($data[9]);
                        $ProductInsert = $modelProduct->insertProduct($product);

                        $modelIngredient = new ModelIngredient();
                        $modelIngredient->insertIngredient($ProductInsert);
                    
                        $ProductInsert =  $ProductInsert->getIdProduct();
                    } else {
                        $ProductInsert = $ProductExist->getIdProduct();
                    }
                    $article->setIdProduct($ProductInsert);
                  
                    
                 
                    $array[] = $ArticleInsert = $modelArticle->insertArticles($article);
                    

                    $artPrice = new Articleprice();
                    $artPrice->setPrice($data[14]);
                    $artPrice->setIdArticle($ArticleInsert->getIdArticle());
                    $artPrice->setDateStart($data[3]);

                    $ArticlePriceInsert = $modelArticlePrice->insertArticlesPrice($artPrice);




                    $lot = new Lot();
                    $modellot = new ModelLot();
                    $lot->setIdArticle($ArticleInsert->getIdArticle());
                    $lot->setIdSupplierOrder($data[16]);
                    $lot->setUnitCost($data[14]);
                    $lot->setDateReception($data[17]);
                    $lot->setQuantity($data[18]);
                    $modellot->insertLot($lot);

                    $importation->setIdArticle($ArticleInsert->getIdArticle());
                    $importation->setIdSupplierOrder($data[16]);
                    $importation->setIdAministrator($data[7]);

                    $modelImportation = new ModelImportation();
                    $modelImportation->insertImportation($importation);
                    var_dump($importation);


                   
                    $row++;
                }

                $this->data['arrayArticlesImport'] = $array;
                fclose($handle);
            }
        }
    }
}
