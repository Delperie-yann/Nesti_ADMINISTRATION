<?php

declare(strict_types=1);



/** @var array<object> $arrayOrders */

$session = $_SESSION['Roles'];
//var_dump(strpos($session,'Administateur')." ".strpos($session,'Moderateur'));
if ((is_int(strpos($session, 'Administateur')))) {
?>
  <div class="container">
    <h1 class="mb-2 mt-4 ml-5">Commandes</h1>

    <div class="row mt-9">

      <div class="col-9 ml-5">

        <div class="container bg-white d-flex flex-column align-items-left" id="order">
          <div class="d-flex flex-row justify-content-between">
            <nav class="navbar navbar-white bg-white pl-0">
              <form class="form-inline">
                <input class="form-control mr-sm-2" id="customSearch" type="search" placeholder="" aria-label="Search">
                <img id="searchRecipe" src="<?= BASE_URL ?>public/images/search.png" alt="image search" class="minipict">
              </form>
            </nav>

          </div>

          <table class="table">

            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Utilisateurs</th>
                <th scope="col">Montant</th>
                <th scope="col">Nb d'articles</th>
                <th scope="col">Date</th>
                <th scope="col">Etat</th>
              </tr>
            </thead>

            <?php

            foreach ($arrayOrders as $value) {
            ?>
              <tr class="order" data-idorder="<?= $value->getIdOrders(); ?>" data-url="<?= BASE_URL ?>">
                <td class="font-weight-bold"><?= $value->getIdOrders(); ?>
                <td><?= $value->orderUserName() ?></td>
                <td><?= $value->getCoast(); ?></td>
                <td><?= $value->getNumberArticles(); ?></td>
                <td><?= $value->getDateCreation(); ?></td>
                <td><?= $value->getFlag(); ?></td>
              </tr>
          <?php
            }
          } else {
            include_once(PATH_ERROR . '403.php');
          }
          ?>
          </table>
        </div>
      </div>
      <div class="col mt-3 mr-2">
        <h2>Détails </h2>
        <div class="card" id="order-id">
          <div class="card-body-detail" id="orderLine">

          </div>

        </div>
      </div>
    </div>

  

  </div>