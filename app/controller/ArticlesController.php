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
}
