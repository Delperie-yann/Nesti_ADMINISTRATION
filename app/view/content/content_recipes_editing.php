<div class="container bg-white d-flex flex-column align-items-left" id="recettes">
    <div class="row mt-3">
        <form action="<?= BASE_URL ?>recipes/editing/<?= $recipe->getIdRecipe() ?>" class="col" method="POST">
            <h1 class="mb-2 mt-4">Edition d'une recette</h1>
            <p class="mt-4">Nom de la recette</p>
            <input type="text" class="w-100" value="<?= $recipe->getName() ?>" name="recipeName">
            <p class="mt-4">Auteur de la recette : <?= $recipe->getChef() ?></p>
            <div class="row">
                <div class="col d-flex justify-content-between flex-column">
                    <p class="mt-4 mb-2">Difficulté (note sur 5)</p>
                    <p class="mt-4 mb-2">Nombre de personnes</p>
                    <p class="mt-4 mb-2">Temps de préparation en minutes</p>
                </div>
                <div class="col">
                    <div class="col d-flex justify-content-between flex-column p-0">
                        <div class="d-flex justify-content-end"><input type="number" min="0" max="5" class="w-50 mt-4 mb-2" value="<?= $recipe->getDifficulty()  ?>" name="recipedifficult"></div>
                        <div class="d-flex justify-content-end"><input type="number" min="0" class="w-50 mt-4 mb-2" value="<?= $recipe->getPortions()  ?>" name="recipePortion"></div>
                        <div class="d-flex justify-content-end"><input type="text" class="w-50 mt-4 mb-2" value="<?= $recipe->getPreparationTime()  ?>" name="recipeTimePrepare"></div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center p-2">
                <button type="submit" class="btn m-5 valid w-25">Valider</button>
                <button type="reset" class="btn m-5 cancel w-25">Annuler</button>
            </div>
        </form>
        <div class="col">
            <form enctype="multipart/form-data" action="<?= BASE_URL ?>recipes/addimage/<?= $recipe->getIdRecipe(); ?>" method="post">
                <div class="mt-4 h-75 w-100 d-flex justify-content-center align-items-center" id="imgCtn" ;">
                    <img src="<?= $recipe->displayImages(); ?>" alt="" id="img" width="550px" height="375px">
                </div>
                <div class="row">
                    <div class="mb-5">
                        <label for="formFile" class="form-label"></label>
                        <input class="form-control ml-3" type="file" id="formFile" name="pictures">
                    </div>
                    <div class="col-sm-2 ml-3 mt-2"><button type="submit" class="btn valid w-100" onclick="dlImg()">Ok</button></div>
                </div>
            </form>
        </div>
    </div>
    <div class="recipeCtn h-100">
        <div class="row">
            <form class="col">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col">
                        <h2>Préparations</h2>
                    </div>
                </div>
                <div id="prepCtn">
                    <div class="row prepItem mb-5" id="baseItem" data-order="1">
                        <div class="col-sm-1">
                            <button class="upText btn mt-2 mb-2 d-flex justify-content-center" onclick="upBtn(this)">
                                <img src="<?php BASE_URL ?>../../public/images/up-arrow.png" alt="">
                            </button>
                            <button class="downText btn mt-2 mb-2 d-flex justify-content-center" onclick="downBtn(this)">
                                <img src="<?php BASE_URL ?>../../public/images/down-arrow.png" alt="">
                            </button>
                            <button class="deleteText btn mt-2 mb-2 d-flex justify-content-center" onclick="deleteBtn(this)">
                                <img src="<?php BASE_URL ?>../../public/images/delete.png" alt="">
                            </button>
                        </div>
                        <div class="col">
                            <?php foreach ($recipe->getParagraphs() as $paragraph) { ?>
                                <textarea class="prepText w-100 h-100"><?= $paragraph->getContent() ?></textarea>
                                <!-- <input type="text" class="w-100" value="<?= $paragraph->getContent() ?>"> -->
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row mt-4 h-50">
                    <div class="col-sm-1"></div>
                    <div class="col">
                        <button class="btn w-100" onclick="addTextArea()">
                            <img src="<?php BASE_URL ?>../../public/images/addinput.png" alt="Ajouter zone de texte">
                        </button>
                    </div>
                </div>
            </form>
            <div class="col-sm-4">
                <h2>Liste des ingrédients</h2>
                <div class="ingredientsCtn" id="ingCtn">
                </div>
                <p class="mt-2 mb-2">Ajouter un ingrédient</p>
                <input type="text" id="ingName" class="mb-2 w-100" style="height: 38px;">
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" onkeypress="return onlyNumberKey(event)" id="ingQty" class="w-100 h-100">
                    </div>
                    <div class="col-md-5">
                        <input type="text" id="ingUnit" class="w-100 h-100">
                    </div>
                    <div class="col-md-2 d-flex justify-content-end">
                        <button type="submit" class="btn valid" onclick="addIngredient()">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>