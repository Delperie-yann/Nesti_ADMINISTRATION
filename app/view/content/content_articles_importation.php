<?php

$session = $_SESSION['Roles'];
if ((is_int(strpos($session, 'Administateur')) || (is_int(strpos($session, 'Chef'))))) {
?>
  <h1 class="mb-2 mt-4 ml-5">Articles</h1>
  <h2 class="mb-2 mt-4 ml-5">Importation</h2>

  <div class="row">

    <div class="col mt-5 ml-5">
      <div class="mt-5 ml-5 ">
        <p>Téléverser un fichier .CSV</p>
        <form class="form w-25">
          <input class="form-control mt-3 mb-3" id="customSearch" type="search" placeholder="" aria-label="Search">
          <div class="d-flex justify-content-end">
            <a href="<?php BASE_URL ?>index.php?loc=" class=" btn btnImportation border pr-3 pl-3"> Importer</a>
          </div>
        </form>
      </div>
    </div>
    <div class="container">
      <div class="col mt-5 ml-5">
        <h2 class="ml-5">Liste des articles importés</h2>


        <div class="consult row  mt-5 ml-5 w-50 h-100">
          <table class="table">


            <tr>
              <td class="font-weight-bold">
                </th>
              <td>Jean Robert</td>
              <td>Jean Robert</td>
              <td> <a class="mr-2 w-100" href="">voir</a></td>
            </tr>
            <tr>
              <td class="font-weight-bold">
                </th>
              <td>Marc Lavoine</td>
              <td>Marc Lavoine</td>
              <td> <a class="mr-2 w-100" href="">voir</a></td>
            </tr>
            <tr>
              <td class="font-weight-bold">
                </th>
              <td>Régis Pierre</td>
              <td>Régis Pierre</td>
              <td> <a class="mr-2 w-100" href="">voir</a></td>
            </tr>
              <!-- <div class="mr-2">
              <p>Jean Robert</p><br>
              <p>Marc Lavoine</p><br>
              <p>Régis Pierre</p><br>
            </div>

            <div class="mr-2">
              <p>Jean Robert</p><br>
              <p>Marc Lavoine</p><br>
              <p>Régis Pierre</p><br>
            </div>

            <div>
              <a class="mr-2 w-100" href="">voir</a><br><br>
              <a href="">voir</a><br><br>
              <a href="">voir</a><br>
            </div> -->
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