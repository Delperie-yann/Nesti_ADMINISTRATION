<?php

declare(strict_types=1);


/** @var array<object> $arrayVars */



$session = $_SESSION['Roles'];

if (is_int(strpos($session, 'Administateur'))) {
?>
    <div class="container">
        <h1 class="mb-2 mt-4 ml-5">Statistiques</h1>

        <div class="row">

            <div class="col">
                <h2 class="mb-2 mt-4 ml-5">Commandes</h2>
                <div class=" ml-5" id="chartOrders"></div>

            </div>

            <div class="col">
                <h2 class="mb-2 mt-4 ml-5">Consultation du site</h2>
                <div id="chartConsultations"></div>
                <p class="ml-4 mt-5">Nombre de connexions en fonction de l'heure de la journée</p>
            </div>

            <div class="col">
                <h5 class="mt-5 ml-5">Top 10 utilisateurs</h5>

                <div class="consult row w-75 h-75 ml-5">
                    <div class="col">
                        <ul>
                            <?php

                            foreach ($arrayVars['TopTenUsers'] as $user) { ?>
                                <li class="flex justify-between">

                                    <?= $user->getFirstName() . ' ' . $user->getLastName() ?>
                                    <a href="<?= BASE_URL ?>users/editing/<?= $user->getIdUser() ?>">Voir</a>
                                </li>


                            <?php } ?>
                        </ul>
                    </div>



                </div>

            </div>

        </div>


        <h5 class="mb-2 mt-4 ml-5">Plus grosses commandes</h5>

        <div class="row ordersList ml-5 w-35">

            <div class="col">
                <ul>
                    <?php
                    // var_dump($arrayVars['TopTenUsers']);
                    foreach ($arrayVars['largerOrders'] as $order) { ?>
                        <li class="flex justify-between">Commande n°
                            <?= $order->getIdOrders()  ?>
                            <a href="<?= BASE_URL ?>articles/orders">Voir</a>
                        </li>


                    <?php } ?>
                </ul>
            </div>
        </div>

        <div class="row">

            <div class="col">
                <h2 class="mb-2 mt-4 ml-5">Recettes</h2>

            </div>
            <div class="col">
                <h2 class="mb-2 mt-4 ml-5">Articles</h2>
            </div>

        </div>

        <div class="row">

            <div class="col-sm-5 mr-5">
                <h5 class="mb-2 mt-4 ml-5">Top 10 Chefs</h5>

                <div class="row recipesChiefsList w-100 h-75 ml-4">

                    <div class="col">
                        <ul>
                            <?php

                            //  var_dump($arrayVars['TopTenChef'] );
                            foreach ($arrayVars['TopTenChef'] as $chef) {

                            ?>

                                <li class="flex justify-between">
                                    <?= $chef->getUser()->getFirstName() . ' ' . $chef->getUser()->getLastName() ?>

                                    <a href="<?= BASE_URL ?>users/editing/<?= $chef->getIdChef() ?>">Voir</a>
                                </li>


                            <?php } ?>
                        </ul>
                    </div>

                </div>

            </div>
            <div class="row">

                <div class="col ml-5 mr-4">

                    <h5 class="mb-2 mt-4 ml-4">Top 10 Recettes</h5>
                    <div class="row recipesChiefsList w-75 h-75 ml-4">

                        <div class="col">
                            <ul>
                                <?php
                                // var_dump($arrayVars['TopTenUsers']);
                                foreach ($arrayVars['TopTenRecipe'] as $recipe) { ?>
                                    <li class="flex justify-between">
                                        <?= $recipe->getname()  ?>
                                        <a href="<?= BASE_URL ?>recipes/editing/<?= $recipe->getIdRecipe() ?>">Voir</a>
                                    </li>


                                <?php } ?>
                            </ul>
                        </div>


                    </div>
                </div>

            </div>

            <div class="col">
                <h5 class="ml-3 mt-5">Nombre d'article en vente :
                    <?php $tot = 0;
                    foreach ($arrayVars['NbCount'] as $recipe) {
                        $tot = ($recipe->getUnitQuantity()) + $tot;
                    }
                    echo ($tot);
                    ?>
                </h5>
                <div class="mb-5" id="chartArticles"></div>
                <h5 class="ml-3 mt-5">En rupture de stock</h5>
                <div class="container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Qtx vendus</th>
                                <th scope="col">Bénéfice (€)</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>


                        <?php
                        // var_dump($arrayVars['TopTenUsers']);
                        foreach ($arrayVars['NbCount'] as  $article) { ?>
                            <tr>
                                <td> <?= $article->getUnitQuantity() . " " . $article->getUnitName() . " " . $article->getName() ?>
                                <td></td>
                                <td></td>
                                <td> <a href="">voir</a></td>
                            </tr>
                        <?php } ?>

                    </table>
                </div>

            </div>

        </div>
    </div>
    <!-- <div class="row">
    <div class="col">
        <h2 class="mb-2 mt-4 ml-5">Articles</h2>


    </div>
</div> -->
<?php

} else {
    include_once(PATH_ERROR . '403.php');
}

?>