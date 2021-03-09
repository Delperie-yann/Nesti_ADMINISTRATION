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
                <p class="ml-2">Jean Robert</p><br>
                <p class="ml-2">Marc Lavoine</p><br>
                <p class="ml-2">Régis Pierre</p><br>
            </div>

            <div>
                <a class="col" href="">voir</a><br><br>
                <a class="col" href="">voir</a><br><br>
                <a class="col" href="">voir</a><br>
            </div>

        </div>

    </div>

</div>

<h5 class="mb-2 mt-4 ml-5">Plus grosses commandes</h5>

<div class="row ordersList ml-5 w-25">

    <div class="col">
        <p class="ml-2">Commande n°1562</p><br>
        <p class="ml-2">Commande n°4523</p><br>
        <p class="ml-2">Commande n°6969</p><br>
    </div>

    <div class="col">
        <a class="d-flex justify-content-end" href="">voir</a><br>
        <a class="d-flex justify-content-end" href="">voir</a><br>
        <a class="d-flex justify-content-end" href="">voir</a><br>
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
                <p>Jean Robert</p><br>
                <p>Marc Lavoine</p><br>
                <p>Régis Pierre</p><br>
            </div>

            <div class="col">
                <a class="d-flex justify-content-end" href="">voir</a><br>
                <a class="d-flex justify-content-end" href="">voir</a><br>
                <a class="d-flex justify-content-end" href="">voir</a><br>

            </div>

        </div>

    </div>

    <div class="col ml-5 mr-5">

        <h5 class="mb-2 mt-4 ml-4">Top 10 Recettes</h5>

        <div class="row recipesChiefsList w-75 h-75 ml-4">

            <div class="col">
                <a href="">Gâteau au chocolat</a><br><br>
                <a href="">Gâteau au chocolat</a><br><br>
                <a href="">Gâteau au chocolat</a><br><br>
            </div>

            <div class="col">
                <p class="d-flex justify-content-end">Par Jean Robert</p><br>
                <p class="d-flex justify-content-end">Par Jean Robert</p><br>
                <p class="d-flex justify-content-end">Par Jean Robert</p><br>
            </div>

        </div>

    </div>

    <div class="col">

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
                            <p>5300</p><br>
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
