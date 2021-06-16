<?php

declare(strict_types=1);

/** @var object $user */
/** @var array<object> $arrayOrder */


$session = $_SESSION['Roles'];

if ((is_int(strpos($session, 'Administateur')) || (is_int(strpos($session, 'Moderateur'))))) {
?>

    <a href="<?= BASE_URL ?>users" class="mb-2 mt-4 ml-5">Utilisateurs </a>><a class="mb-2 mt-4"> Edition</a>

    <div class="container">
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
        <div class="row mt-3">
            <form action="<?= BASE_URL ?>users/editing/<?= $user->getIdUser() ?>" class="col" method="POST">

                <h1>Edition des utilisateurs</h1>

                <p class="mt-5">Nom</p><br>
                <input type="text" class="w-75" name="userLastname" value="<?= $user->getLastname() ?>">

                <p class="mt-5">Prénom</p><br>
                <input type="text" class="w-75" name="userFirstname" value="<?= $user->getFirstname() ?>">

                <p class="mt-5">Adresse</p><br>
                <input type="text" class="w-75" name="userAdress1" value="<?= $user->getAddress1() ?>">

                <p class="mt-5">Adresse</p><br>
                <input type="text" class="w-75" name="userAdress2" value="<?= $user->getAddress2() ?>">

                <p class="mt-5">Code postal</p><br>
                <input type="text" class="w-75" name="userZipCode" value="<?= $user->getZipCode() ?>">

                <p class="mt-5">Ville</p><br>
                <input type="text" class="w-75" name="userTown" value="<?= $user->getTownName() ?>">

                <p class="mt-5">Rôle (ajout uniquement)</p><br>
                <?php if (isset($roleAdmin) || isset($roleChef) || isset($roleModerator)) {
                    echo ' <div class="alert alert-danger text-center" role="alert">Rôles non enlevable</div>';
                }; ?>
                <input id="roleChef" type="checkbox" class="w-75" name="roleChef" <?= $user->isChef() == "chef" ? 'checked' : '' ?>><label for="roleChef">Chef</label>
                <input id="roleModerator" type="checkbox" class="w-75" name="roleModerator" <?= $user->isModerateur() == "moderator" ? 'checked' : '' ?>><label for="roleModerator">Moderateur</label>
                <input id="roleAdmin" type="checkbox" class="w-75" name="roleAdmin" <?= $user->isAdmin() == "Administateur" ? 'checked' : '' ?>><label for="roleAdmin">Administateur</label>

                <p class="mt-5">Etat</p><br>

                <div>
                    <input type="radio" id="actif" name="State" value="actif" <?= $user->getFlag() == "a" ? 'checked' : '' ?>>
                    <label for="actif">actif</label>
                </div>

                <div>
                    <input type="radio" id="wait" name="State" value="wait" <?= $user->getFlag() == "w" ? 'checked' : '' ?>>
                    <label for="wait">wait</label>
                </div>

                <div>
                    <input type="radio" id="block" name="State" value="block" <?= $user->getFlag() == "b" ? 'checked' : '' ?>>
                    <label for="block">block</label>
                </div>

                <div class="row">
                    <div class="d-flex justify-content-center p-2">

                        <button type="submit" class="btn m-10 ml-2 valid w-50">Valider</button>
                        <button type="reset" class="btn btn-danger m-10 ml-2 w-50">Supprimer</button>
                    </div>
                </div>
            </form>

            <div class="col mt-5">
                <h2>Informations</h2>
                <div class="card">
                    <div class="card-body-editing">
                        Date de Création : <?= $user->getDateCreation() ?> <br>
                        Dernière Connexion : <?= $user->getLastConnectionLog() ?><br>
                        <?= $user->isChef() == "chef" ? '<Strong>Chef patissier</Strong> <br> Nombre de recette :' . $user->getHimAsChef()->getCountRecipe() . '  <br> Derniere Recette : ' . $user->getHimAsChef()->getLastRecipe() : '' ?>
                        <br>
                        <Strong>Utilisateur </Strong><br>
                        Nombre de commande : <?= $user->getCountOrders() ?> <br>
                        Montant total des commandes : <?php

                                                        $tot = 0;
                                                        if (isset($order)) {
                                                            foreach ($arrayOrder as $order) {
                                                                $orderForUser = $order->getIdOrders();
                                                                $tot += $order->getCoast($orderForUser);
                                                            }
                                                        ?> <br>
                            Derniere commande : <?= $order == null ? '' : $order->getLastOrder($order->getIdUsers());
                                                        };
                                                ?><br>
                        <?= $user->isAdmin() == "Administateur" ? '<Strong>Administateur</Strong> <br> Nombre d"importation faite : <br> Date de la derniere importation :' : '' ?>
                        <br>
                        <?= $user->isModerateur() == "moderator" ? '<Strong>Moderateur</Strong> <br> Nombre de commantaire bloqué : ' . $user->getCommentNbB() . ' <br> Nombre de commentaire approuvé : ' . $user->getCommentNbA() : '' ?>
                        <br>

                    </div>

                </div>


                <form action="<?= BASE_URL ?>users/editing/<?= $user->getIdUser() ?>/resumepassword" class="col" method="POST">
                    <button type="submit" class="btn btn-info editing" data-toggle="modal" data-target="#exampleModal">Réinitalistation du mot de passe</button>

                </form>
                <?php if (isset($pass)) {

                ?>

                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Votre nouveau mot de passe : <?= $pass ?></h5>



                            </div>
                            <p> Notez le bien! Votre mot de passe ne pourras vous être retransmis, </p>
                        </div>
                    </div>
            </div>
        <?php    }  ?>
        </div>
    </div>
    <div class="container commande">

        <div class="row mt-9">

            <div class="col-9">

                <h1 class="mb-2 mt-4 ml-5">Ses commandes</h1>
                <p>Consultation des commandes</p>

                <div class="container bg-grey d-flex flex-column align-items-left" id="recipes2">
                    <div class="d-flex flex-row justify-content-between">
                        <nav class="navbar navbar-white  pl-0">
                            <form class="form-inline">
                                <input class="form-control mr-sm-2" id="customSearch" type="search" placeholder="" aria-label="Search">
                                <img id="searchRecipe" src="<?= BASE_URL ?>/public/images/search.png" alt="image search" class="minipict">
                            </form>
                        </nav>

                    </div>

                    <table class="table">

                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Utilisateur</th>
                                <th scope="col">Montant</th>
                                <th scope="col">Nb d'articles</th>
                                <th scope="col">Date</th>
                                <th scope="col">Etat</th>
                            </tr>
                        </thead>
                        <?php

                        foreach ($user->getOrders() as $value) {
                        ?>
                            <tr class="order" data-idorder="<?= $value->getIdOrders(); ?>" data-url="<?= BASE_URL ?>">
                                <td><?= $value->getIdOrders(); ?></td>
                                <td><?= $user->getLastname(); ?> <?= $user->getFirstname(); ?></td>
                                <td><?= $value->getCoast(); ?></td>
                                <td><?= $value->getNumberArticles(); ?></td>
                                <td><?= $value->getDateCreation(); ?></td>
                                <td><?= $value->getState($value); ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>

            <div class="col mt-3">
                <h2>Détails </h2>
                <div class="card" id="order-id">
                    <div class="card-body-detail" id="orderLine">

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="container commantaire">

        <div class="row mt-12">

            <div class="col-12">

                <h1 class="mb-2 mt-4 ml-5">Ses Commentaires</h1>
                <p>Modération de ses commentaires</p>

                <div class="container bg-white d-flex flex-column align-items-left" id="recipes">
                    <div class="d-flex flex-row justify-content-between">
                        <nav class="navbar navbar-white bg-white pl-0">

                        </nav>

                    </div>

                    <table class="table">

                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Recette</th>
                            <th scope="col">Contenu</th>
                            <th scope="col">Date</th>
                            <th scope="col">Etat</th>
                            <th scope="col">Actions</th>
                    </tr>
                        </thead>
                        <?php
                        //var_dump($arrayRecipes);

                        foreach ($user->getComments() as $com) {
                        ?>
                            <tr>
                                <td><?= $com->getIdRecipe(); ?></td>
                                <td><?= $com->getCommentTitle(); ?></td>
                                <td><?= $com->getNameRecipe($com->getIdRecipe()); ?></td>
                                <td><?= $com->getCommentContent(); ?></td>
                                <td><?= $com->getDateCreation(); ?></td>
                                <td><?= $com->getState($com); ?></td>

                                <td>
                                    <?php if ($userlogged->isModerateur()) { ?>
                                        <a href="<?= BASE_URL . "users/editing/" . $com->getIdUsers() . "/" . $com->getIdRecipe() . "/1"; ?>">Approuver</a><br>

                                        <a href="<?= BASE_URL . "users/editing/" . $com->getIdUsers() . "/" . $com->getIdRecipe() . "/0"; ?>">Bloquer</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>



<?php

} else {
    include_once PATH_ERROR . '403.php';
}

?>