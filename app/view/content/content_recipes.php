<?php

$session=$_SESSION['Roles'];
//var_dump(strpos($session,'Administateur')." ".strpos($session,'Moderateur'));
if((is_int(strpos($session,'Administateur'))||(is_int(strpos($session,'Chef'))))){
?>

<h1 class="mb-2 mt-4 ml-5">Recettes</h1>


<div class="container bg-white d-flex flex-column align-items-left" id="recipes">
    <div class="d-flex flex-row justify-content-between">
        <nav class="navbar navbar-white bg-white pl-0">
            <form class="form-inline">
                <input class="form-control mr-sm-2" id="customSearch" type="search" placeholder="" aria-label="Search">
                <img id="searchRecipe" src="<?php BASE_URL ?>public/images/search.png" alt="" width="20px"
                    height="25px">
            </form>
        </nav>
        <div>
            <a href="<?php BASE_URL ?>recipes/creation" class="btn mb-1 border align-self-end"><img id="add"
                    src="<?php BASE_URL ?>public/images/add.png" alt="" width="20px" height="20px"> Ajouter</a>
        </div>
    </div>



    <table class="table">
        <thead>
            <tr class="bg-info text-white">
                <th scope="col">ID</th>
                <th scope="col">Nom</th>
                <th scope="col">Difficulté</th>
                <th scope="col">Pour</th>
                <th scope="col">Temps</th>
                <th scope="col">Chef</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
//var_dump($arrayRecipes);
foreach($arrayRecipes as $value){
?>

            <tr>
                <th scope="row"><?=$value->getIdRecipe();?></th>
                <td><?=$value->getName();?></td>
                <td><?=$value->getDifficulty();?></td>
                <td><?=$value->getPortions();?></td>
                <td><?=$value->getPreparationTime();?></td>
                <td><?=$value->getChef();?></td>
                <td>
                    <a href="<?=BASE_URL."recipes/editing/".$value->getIdRecipe();?>">Modifier</a><br>
                    <!-- href="#mymodal<?=$value->getIdRecipe();?>" -->

                    <a data-toggle="modal" href="#myModal<?=$value->getIdRecipe();?>">Supprimer</a>
                    <div class="container">
                        <div class="row">


                            <div id="myModal<?=$value->getIdRecipe();?>" class="modal fade in">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <a class="btn btn-default" data-dismiss="modal"><span
                                                    class="glyphicon glyphicon-remove"></span></a>
                                            <p class="modal-body"> <i
                                                    class="fas fa-exclamation-triangle fa-3x text-danger"></i>Voulez
                                                vous vraiment supprimer <?=$value->getIdRecipe();?> ?</p>
                                        </div>
                                        <div class="modal-body">

                                            <p>Cette action est définitive</p>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="btn-group">
                                                <button class="btn btn-primary"><span
                                                        class="glyphicon glyphicon-check"></span> Confirmer</button>
                                                <button class="btn btn-danger" data-dismiss="modal"><span
                                                        class="glyphicon glyphicon-remove"></span> Annuler</button>

                                            </div>
                                        </div>

                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dalog -->
                            </div><!-- /.modal -->


                        </div>
                    </div>
                </td>
            </tr>

            <?php
}
?>
        </tbody>
    </table>
</div>
<?php


}else{
  include_once(PATH_ERROR.'403.php');
}  

  ?>