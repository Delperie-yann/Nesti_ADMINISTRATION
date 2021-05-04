<div class="container bg-white d-flex flex-column align-items-left" id="recettes">
    <div class="row mt-3">
        <div class="col">
            <h1 class="mb-2 mt-5">Edition de l'article</h1>
            <p class="mt-5">Nom d'usine de l'article</p>
            <input type="text" class="w-100 mt-2" value="<?= $article->getFactoryName()  ?>">
            <p class="mt-5">Nom de l'article pour l'utilisateur</p>
            <input type="text" class="w-100 mt-2" value="">
            <div class="row">
                <div class="col d-flex justify-content-between flex-column">
                    <p class="mt-5 mb-2">Identifiant</p>
                    <p class="mt-5 mb-2">Prix de vente</p>
                    <p class="mt-5 mb-2">Stock</p>
                </div>
                <div class="col">
                    <div class="col d-flex justify-content-between flex-column p-0">
                        <div class="d-flex justify-content-end"><input type="text" min="0" max="5" class="w-25 mt-5 mb-2" value=""></div>
                        <div class="d-flex justify-content-end"><input type="text" min="0" class="w-25 mt-5 mb-2""></div>
                        <div class=" d-flex justify-content-end"><input type="text" class="w-25 mt-5 mb-2" value=""></div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center p-2 mt-5">
                <button type="submit" class="btn m-2 valid w-25">Valider</button>
                <button type="submit" class="btn m-2 cancel w-25">Annuler</button>
            </div>
        </div>

        <div class="col">
            <form enctype="multipart/form-data" action="<?= BASE_URL ?>recipes/addimage/" method="post">
                <div class="mt-4 h-75 w-100 d-flex justify-content-center align-items-center" id="imgCtn" style="background-color: lightgray;">
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
</div>