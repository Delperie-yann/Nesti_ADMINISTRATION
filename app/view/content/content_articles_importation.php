<?php

$session = $_SESSION['Roles'];
if ((is_int(strpos($session, 'Administateur')))) {
?>
  <div class="container">


    <h1 class="mb-2 mt-4 ml-5">Articles</h1>

    <div class="row">
      <div class="col">

        <h2 class="mb-2 mt-4 ml-5">Importation</h2>
        <p>Téléverser un fichier .CSV</p>
        <form class="form w-25" type="file" accept=".csv" enctype="multipart/form-data" action="<?= BASE_URL ?>articles/importation" method="POST">
          <input class="form-control mt-3 mb-3" id="customSearch" type="file" name="file" placeholder="" aria-label="Search">
          <div class="d-flex justify-content-end">
            <button type="submit" class=" btn btnImportation border pr-3 pl-3"> Importer</a>
          </div>
        </form>
      </div>

      <div class="col">
        <h2 class="ml-5">Liste des articles importés</h2>
        <div class="consult row  mt-5 ml-5 w-75 h-100">
          <table class="table">
            <?php 
             if (isset($arrayArticlesImport)) {
              foreach ($arrayArticlesImport as $value) { 
            ?>
                <tr>
                  <td class="font-weight-bold">
                    </th>
                  <td><?= $value->getUnitQuantity(); ?> <?= $value->getUnitName() == 'UNITE' ? '' : $value->getUnitName(); ?> <?= $value->getName(); ?></td>
                  <td><a href="<?= BASE_URL . "articles/editing/" . $value->getIdArticle()  ?>">Voir</a></td>
                
                </tr>


            <?php
              }
            }
            ?>
        </div>
      </div>
   

    </div>
  </div>
  </div>
  </div>
  </div>
<?php

} else {
  include_once(PATH_ERROR . '403.php');
}

?>