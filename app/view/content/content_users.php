<?php

$session = $_SESSION['Roles'];
//var_dump(strpos($session,'Administateur')." ".strpos($session,'Moderateur'));
if ((is_int(strpos($session, 'Administateur')) || (is_int(strpos($session, 'Moderateur'))))) {
?>
<h1 class="mb-2 mt-4 ml-5">Utilisateurs</h1>

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
            <a href="<?php BASE_URL ?>users/creation" class="btn mb-1 border align-self-end"><img id="add"
                    src="<?php BASE_URL ?>public/images/add.png" alt="" width="20px" height="20px"> Ajouter</a>
        </div>
    </div>


    <table class="table">

        <thead>

            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Rôle</th>
            <th scope="col">Derniere connexion</th>
            <th scope="col">Etat</th>
            <th scope="col">Actions</th>

        </thead>

        <?php

            foreach ($arrayUsers as $value) {
            ?>

        <tr>
            <td class="font-weight-bold"><?= $value->getIdUser(); ?></th>
            <td><?= $value->getFirstname(); ?> <?= $value->getLastname(); ?></td>
            <td><?= $value->getRoles(); ?></td>
            <td><?= $value->getLastConnectionLog(); ?></td>
            <td><?= $value->getFlag(); ?></td>
            <td>
                <a href="<?= BASE_URL . "users/editing/" . $value->getIdUser(); ?>">Modifier</a><br>
                <!-- href="#mymodal<?= $value->getIdUser(); ?>" -->
                <a data-toggle="modal" href="#myModal<?= $value->getIdUser(); ?>">Supprimer</a>
                <div class="container">
                    <div class="row">


                        <div id="myModal<?= $value->getIdUser(); ?>" class="modal fade in">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <a class="btn btn-default" data-dismiss="modal"><span
                                                class="glyphicon glyphicon-remove"></span></a>
                                        <p class="modal-body"> <i
                                                class="fas fa-exclamation-triangle fa-3x text-danger"></i>Voulez
                                            vous vraiment supprimer <?= $value->getLastname(); ?> ?</p>
                                    </div>
                                    <div class="modal-body">

                                        <p>Cette action est définitive</p>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="btn-group">
                                            <form
                                                action="<?php echo (BASE_URL) ?>users/deleted/<?= $value->getIdUser(); ?>"
                                                method="POST">
                                                <button class="btn btn-primary"><span
                                                        class="glyphicon glyphicon-check"></span> Confirmer</button>
                                            </form>
                                            <button class="btn btn-danger" data-dismiss="modal"><span
                                                    class="glyphicon glyphicon-remove"></span> Annuler</button>

                                        </div>
                                    </div>

                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dalog -->
                        </div><!-- /.modal -->
            </td>
        </tr>
        <?php
            }
        } else {
            include_once(PATH_ERROR . '403.php');
        }

        ?>
    </table>
</div>