<?php

$session = $_SESSION['Roles'];
//var_dump(strpos($session,'Administateur')." ".strpos($session,'Moderateur'));
if ((is_int(strpos($session, 'Administateur')) )) {
?>



<div class="container bg-white d-flex flex-column align-items-left" id="recettes">
<?php if (isset($success)) { ?>

             <div id="login-row" class="row justify-content-center align-items-center">
                 <div id="login-column" class="col-md-6">
                     <div class="alert alert-success text-center" role="alert">
                         Entrée enregistré
                     </div>
                 </div>
             </div>
         <?php
            };
            
 if (isset($error)) { ?>
                <div id="login-row" class="row justify-content-center align-items-center">
                 <div id="login-column" class="col-md-6">
                     <div class="alert alert-warning text-center" role="alert">
                         Erreur d'enregistrement
                     </div>
                 </div>
             </div> <?php
            }
            ?>
    <div class="row mt-3">
        <form action="<?= BASE_URL ?>articles/editing/<?= $article->getIdArticle() ?>" class="col" method="POST">
            <div class="col">
                <h1 class="mb-2 mt-5">Edition de l'article</h1>
                <p class="mt-5">Nom d'usine de l'article</p>

                <input type="text" class="w-100 mt-2 bg-secondary text-white" value="<?= $article->getFactoryName()  ?>"
                    readonly>
                <p class="mt-5">Nom de l'article pour l'utilisateur</p>
                <input type="text" name="nameReal" class="w-100 mt-2" value="<?= $article->getRealName()  ?>">
                <div class="row">
                    <div class="col d-flex justify-content-between flex-column">
                        <p class="mt-5 mb-2">Identifiant</p>
                        <p class="mt-5 mb-2">Prix de vente</p>
                        <p class="mt-5 mb-2">Stock</p>
                    </div>
                    <div class="col">
                        <div class="col d-flex justify-content-between flex-column p-0">
                            <div class="d-flex justify-content-end"><input type="text" min="0" max="5"
                                    class="w-50 mt-5 mb-2 bg-secondary text-white"
                                    value="<?= $article->getIdArticle()  ?>" readonly></div>
                            <div class="d-flex justify-content-end"><input type="text" min="0"
                                    class="w-50 mt-5 mb-2 bg-secondary text-white" value="<?= $article->getPrice()  ?>"
                                    readonly></div>
                            <div class=" d-flex justify-content-end"><input type="text"
                                    class="w-50 mt-5 mb-2 bg-secondary text-white" value="<?= $article->getStock()  ?>"
                                    readonly></div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center p-2 mt-5">
                    <button type="submit" class="btn m-2 valid w-50">Valider</button>
                  
                    <a type="submit" href="<?= BASE_URL . "articles"  ?>" class="btn m-2 cancel w-50">Annuler</a>
                </div>
                </form>
    </div>
    <div class="row mt-3 mr-5 ml-5">
    <div class="col">
        <form enctype="multipart/form-data" action="<?= BASE_URL ?>recipes/addimage/" method="post">
            <div class="mt-4 h-75 w-100 d-flex justify-content-center align-items-center" id="imgCtn"
                style="background-color: lightgray;">
                <img src="" alt="" id="img">
            </div>
            <div class="row">
                <div class="mb-3">
                    <label for="formFile" class="form-label"></label>
                    <input class="form-control ml-3" type="file" id="formFile" name="pictures">
                </div>
                <div class="col-sm-2 ml-3 mt-2"><button type="submit" class="btn valid w-100">Ok</button></div>
            </div>
        </form>
    </div>
</div>
<?php

} else {
    include_once(PATH_ERROR . '403.php');
}

?>