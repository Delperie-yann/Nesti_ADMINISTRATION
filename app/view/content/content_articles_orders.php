

<?php

$session=$_SESSION['Roles'];
//var_dump(strpos($session,'Administateur')." ".strpos($session,'Moderateur'));
if((is_int(strpos($session,'Administateur'))||(is_int(strpos($session,'Chef'))))){
?>

<h1 class="mb-2 mt-4 ml-5">Commandes</h1>


<div class="container bg-white d-flex flex-column align-items-left" id="order">
  <div class="d-flex flex-row justify-content-between">
    <nav class="navbar navbar-white bg-white pl-0">
      <form class="form-inline">
        <input class="form-control mr-sm-2" id="customSearch" type="search" placeholder="" aria-label="Search">
        <img id="searchRecipe" src="<?php BASE_URL ?>public/images/search.png" alt="" width="20px" height="25px">
      </form>
    </nav>
    
  </div>



  <table class="table">

<thead>
 
    <th scope="col">ID</th>
    <th scope="col">Utilisateurs</th>
    <th scope="col">Montant</th>
    <th scope="col">Date</th>
    <th scope="col">Etat</th>
   
 
</thead>

<?php


foreach($arrayOrders as $value){
?>
  <tr>
    <td class="font-weight-bold"><?=$value->getId();?>
    <td><?=$value->getLastname();?> <?=$value->getFirstname();?></td>
    <td><?=$value->getQuant();?></td>
    <td><?=$value->getDateCreation();?></td>
    <td><?=$value->getFlag();?></td>
  </tr>
  <?php
}
}else{
  include_once(PATH_ERROR.'403.php');
}  

  ?>
 </table>
</tbody>