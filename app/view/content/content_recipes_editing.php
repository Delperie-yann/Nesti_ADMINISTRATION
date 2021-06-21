<?php

declare(strict_types=1);


/** @var object $recipe */
/** @var object $ingredientrecipe */

$session = $_SESSION['Roles'];

if ((is_int(strpos($session, 'Administateur')) || (is_int(strpos($session, 'Chef'))))) {
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
                        Erreur d'enregistrement : voir détail
                    </div>
                </div>
            </div> <?php
                }
                    ?>
        <?php if (isset($recipeName)) {
            echo '<div class="alert alert-danger text-center" role="alert">Erreur saisie nom</div>';
        }; ?>
        <?php if (isset($recipedifficult)) {
            echo ' <div class="alert alert-danger text-center" role="alert">Erreur saisie difficulté</div>';
        }; ?>
        <?php if (isset($recipePortion)) {
            echo ' <div class="alert alert-danger text-center" role="alert">Erreur saisie portion</div>';
        }; ?>
        <?php if (isset($recipeTimePrepare)) {
            echo ' <div class="alert alert-danger text-center" role="alert">Erreur saisie temps de preparation</div>';
        }; ?>
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
                        <p class="mt-4 mb-2">Temps de préparation </p>
                    </div>
                    <div class="col">
                        <div class="col d-flex justify-content-between flex-column p-0">
                            <div class="d-flex justify-content-end"><input type="number" min="0" max="5" class="w-50 mt-4 mb-2" value="<?= $recipe->getDifficulty()  ?>" name="recipedifficult">
                            </div>
                            <div class="d-flex justify-content-end"><input type="number" min="0" max="10" class="w-50 mt-4 mb-2" value="<?= $recipe->getPortions()  ?>" name="recipePortion"></div>
                            <div class="d-flex justify-content-end"><input type="time" class="w-50 mt-4 mb-2" value="<?= $recipe->getPreparationTime()   ?>" name="recipeTimePrepare"></div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center p-2">
                    <button type="submit" class="btn m-5 valid w-25">Valider</button>
                    <a href="<?= BASE_URL ?>recipes " class="btn m-5 cancel w-25">Retour</a>
                </div>
            </form>
            <div class="col">
                <form enctype="multipart/form-data" action="<?= BASE_URL ?>recipes/addimage/<?= $recipe->getIdRecipe(); ?>" method="POST">
                    <div class="mt-4 h-75 w-100 d-flex justify-content-center align-items-center" id="imgCtn">
                        <img src="<?= $recipe->displayImages(); ?>" alt="" id="img" class="maxpict">
                    </div>
                    <div class="row">
                        <div class="mb-5">
                            <label for="formFile" class="form-label"></label>
                            <input class="form-control ml-3" type="file" id="formFile" name="pictures">
                        </div>
                        <div class="col-sm-2 ml-3 mt-2"><button type="submit" class="btn valid w-100 " name="imageDdl" id="idImageDdl">Ok</button></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="recipeCtn h-100">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col">
                            <h2>Préparations</h2>
                        </div>
                    </div>
                    <form action="<?= BASE_URL ?>recipes/editing/<?= $recipe->getIdRecipe() ?>" class="col" method="POST">
                        <div id="prepCtn">
                            <div class="row prepItem mb-5" id="baseItem" data-order="1">
                                <div class="col-sm-2">
                                    <button class="upText btn mt-2 mb-2 d-flex justify-content-center" onclick="upBtn(this)">
                                        <img src="<?= BASE_URL ?>public/images/up-arrow.png" alt="">
                                    </button>
                                    <button class="downText btn mt-2 mb-2 d-flex justify-content-center" onclick="downBtn(this)">
                                        <img src="<?= BASE_URL ?>public/images/down-arrow.png" alt="">
                                    </button>
                                    <button class="deleteText btn mt-2 mb-2 d-flex justify-content-center" onclick="deleteBtn(this)">
                                        <img src="<?= BASE_URL ?>public/images/delete.png" alt="">
                                    </button>
                                </div>
                                <div class="col">
                                    <?php foreach ($recipe->getParagraphs() as $paragraph) { ?>
                                        <!-- <textarea class="prepText w-100 h-100" id= "contentComment"><?= $paragraph->getContent() ?></textarea><?= $paragraph->getParagraphPosition() ?> -->

                                        <input type="text" id="contentComment" class="prepText w-100 h-100" value="<?= $paragraph->getContent() ?>">
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 h-50">
                            <div class="col-sm-2"></div>
                            <div class="col">
                                <button class="btn w-100" id="AddComm" onclick="addTextArea()">
                                    <img src="<?= BASE_URL ?>public/images/addinput.png" alt="Ajouter zone de texte">
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="col-sm-4">
                    <h2>Liste des ingrédients</h2>
                    <ul class="ingredientsCtn" id="ingCtn">

                        <?php

                        foreach ($ingredientrecipe as $ingredient) { ?>
                            <li class="flex justify-between">
                                <?= $ingredient->getquantity() . " " . ($ingredient->getNameUnit()->getName()) . " de " . $ingredient->getNameProd()->getName(); ?>
                                <a href="<?= BASE_URL ?>recipes/editing/<?= $recipe->getIdRecipe() ?>/supp/<?= $ingredient->getIdProduct() ?>">Supprimer</a>
                            </li>


                        <?php } ?>
                    </ul>
                    <form action="<?= BASE_URL ?>recipes/editing/<?= $recipe->getIdRecipe() ?>" class="col" method="POST">
                        <p class="mt-2 mb-2">Ajouter un ingrédient</p>
                        <label for="ingName">Nom de l'ingredient</label>
                        <input type="text" id="ingName" name="ingredientName" class="mb-2 w-50">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="ingQty">Quantité</label>
                                <input type="text" name="ingredientQuant" onkeypress="" id="ingQty" class="w-100 h-50">
                            </div>
                            <div class="col-md-5">
                                <label for="ingUnit">Unité </label>
                                <input type="text" name="ingredientUnit" id="ingUnit" class="w-100 h-50">
                            </div>
                            <div class="col d-flex justify-content-end">
                                <button type="submit" class="btn valid" id="ingAdd" onclick="" data-id="<?= $recipe->getIdRecipe() ?>">Ok</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php

} else {
    include_once PATH_ERROR . '403.php';
}

?>