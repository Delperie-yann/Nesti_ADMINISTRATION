<?php

$session=$_SESSION['Roles'];
//var_dump(strpos($session,'Administateur')." ".strpos($session,'Moderateur'));
if(is_int(strpos($session,'Administateur'))){
?>

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
        <h5 class="mt-5">Top 10 utilisateurs</h5>

        <div class="consult row w-75 h-75">
            <div class="col">
            
            <?php 
            // var_dump($arrayVars['TopTenUsers']);
             foreach ($arrayVars['TopTenUsers'] as $user) { ?>
                    <li class="flex justify-between">
                        <?= $user->getFirstName() . ' ' . $user->getLastName() ?>
                        <a href="<?=BASE_URL?>users/editing/<?= $user->getIdUser() ?>"  >Voir</a>
                    </li>


                <?php } ?>
            </div>

           

        </div>

    </div>

</div>

<h5 class="mb-2 mt-4 ml-5">Plus grosses commandes</h5>

<div class="row ordersList ml-5 w-25">

    <div class="col">
    <?php 
            // var_dump($arrayVars['TopTenUsers']);
             foreach ($arrayVars['largerOrders'] as $order) { ?>
                    <li class="flex justify-between">Commande n°
                        <?=  $order->getIdOrders()  ?>
                        <a href="<?=BASE_URL?>articles/orders"  >Voir</a>
                    </li>


                <?php } ?>
   
                </div>
</div>

<div class="row">

    <div class="col">
        <h2 class="mb-2 mt-4 ml-5">Recettes</h2>
    </div>

    <div class="col">
        <h2 class="mb-5 ml-5">Articles</h2>
    </div>

</div>

<div class="row">

    <div class="col-sm-2 mr-5">
        <h5 class="mb-2 mt-4 ml-5">Top 10 Chefs</h5>

        <div class="row recipesChiefsList w-100 h-75 ml-5">

            <div class="col">
               
            <?php 
            // var_dump($arrayVars['TopTenUsers']);
             foreach ($arrayVars['TopTenChef'] as $chef) { ?>
                    <li class="flex justify-between">
                        <?= $chef->getUser()->getFirstName() . ' ' . $chef->getUser()->getLastName() ?>
                        <a href="<?=BASE_URL?>users/editing/<?= $chef->getIdChef() ?>"  >Voir</a>
                    </li>


                <?php } ?>

            </div>

        </div>

    </div>

    <div class="col ml-5 mr-5">

        <h5 class="mb-2 mt-4 ml-4">Top 10 Recettes</h5>

        <div class="row recipesChiefsList w-75 h-75 ml-4">

            <div class="col">
            <?php 
            // var_dump($arrayVars['TopTenUsers']);
             foreach ($arrayVars['TopTenRecipe'] as $recipe) { ?>
                    <li class="flex justify-between">
                        <?= $recipe->getname()  ?>
                        <a href="<?=BASE_URL?>recipes/editing/<?= $recipe->getIdRecipe() ?>"  >Voir</a>
                    </li>


                <?php } ?>
            </div>

            <div class="col">
            
            </div>

        </div>

    </div>

    <div class="col">
    <h5 class="ml-3 mt-5">Nombre d'article en vente : 
        <?php $tot=0; foreach ($arrayVars['NbCount'] as $recipe) 
        {
         $tot=($recipe->getUnitQuantity())+$tot;
        }
        echo($tot); 
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

            </table>

            <div class="row">

                <div class="container w-100">

                    <div class="row stock">

                        <div class="col mr-5">
                            <p>Oeufs (6 unités)</p><br>
                            <p>Farine (1kg)</p><br>
                        </div>

                        <div class="col mr-5">
                            <p><?php foreach ($arrayVars['NbCount'] as $recipe) 
        { 
        $recipe->getNbBought();
        }  ?>
        </p><br>
                            <p>1020</p><br>
                        </div>

                        <div class="col mr-5">
                            <p>985</p><br>
                            <p>600</p><br>
                        </div>

                        <div class="col mr-5">
                            <a class="ml-5" href="">voir</a><br><br>
                            <a class="ml-5" href="">voir</a><br>
                        </div>

                    </div>

                </div>

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

}else{
  include_once(PATH_ERROR.'403.php');
}  

  ?>
