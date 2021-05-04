<a href="<?= BASE_URL ?>users" class="mb-2 mt-4 ml-5">Utilisateurs </a>><a class="mb-2 mt-4"> Edition</a>

<div class="container">

    <div class="row mt-3">
        <form action="<?= BASE_URL ?>users/editing/<?= $user->getIdUser() ?>" class="col" method="POST">

            <h1>Edition des utilisateurs</h1>

            <p class="mt-5">Nom</p><br>
            <input type="text" class="w-75" name="userLastname" value="<?= $user->getLastname() ?>">

            <p class="mt-5">Prénom</p><br>
            <input type="text" class="w-75" name="userFirstname" value="<?= $user->getFirstname() ?>">

            <p class="mt-5">Adress1</p><br>
            <input type="text" class="w-75" name="userAdress1" value="<?= $user->getAddress1() ?>">

            <p class="mt-5">Adress2</p><br>
            <input type="text" class="w-75" name="userAdress2" value="<?= $user->getAddress2() ?>">

            <p class="mt-5">Zipcode</p><br>
            <input type="text" class="w-75" name="userZipCode" value="<?= $user->getZipCode() ?>">

            <p class="mt-5">Rôle</p><br>
            <input type="checkbox" class="w-75" name="roleChef" <?= $user->isChef() == "chef" ? 'checked' : '' ?>><label for="Chef">Chef</label>
            <input type="checkbox" class="w-75" name="roleModerator" <?= $user->isModerateur() == "moderator" ? 'checked' : '' ?>><label for="Moderator">Moderateur</label>
            <input type="checkbox" class="w-75" name="roleAdmin" <?= $user->isAdmin() == "Administateur" ? 'checked' : '' ?>><label for="Admin">Administateur</label>

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
                    <?= $user->isChef() == "chef" ? '<Strong>Chef patissier</Strong> <br> Nombre de recette :' . $user->getChef()->getCountRecipe() . '  <br> Derniere Recette : ' . $user->getChef()->getLastRecipe() : '' ?> <br>
                    <Strong>Utilisateur </Strong><br>
                    Nombre de commande : <?= $user->getCountOrders() ?> <br>
                    Montant total des commandes : <br>
                    Derniere commande : <br>
                    <?= $user->isAdmin() == "Administateur" ? '<Strong>Administateur</Strong> <br> Nombre d"importation faite : <br> Date de la derniere importation :' : '' ?> <br>
                    <?= $user->isModerateur() == "moderator" ? '<Strong>Moderateur</Strong> <br> Nombre de commantaire bloqué : <br> Nombre de commentaire approuvé :' : '' ?> <br>
                    <Strong>Moderateur</Strong> <br> Nombre de commantaire bloqué : <br> Nombre de commentaire approuvé :
                </div>

            </div>
            <button type="button" class="btn btn-info editing">Réinitalistation du mot de passe</button>

        </div>
    </div>
</div>
<div class="container commande">

    <div class="row mt-9">

        <div class="col-9">

            <h1 class="mb-2 mt-4 ml-5">Ses commandes</h1>
            <p>Consultation des commandes</p>

            <div class="container bg-grey d-flex flex-column align-items-left" id="recipes">
                <div class="d-flex flex-row justify-content-between">
                    <nav class="navbar navbar-white  pl-0">
                        <form class="form-inline">
                            <input class="form-control mr-sm-2" id="customSearch" type="search" placeholder="" aria-label="Search">
                            <img id="searchRecipe" src="<?php BASE_URL ?>../../public/images/search.png" alt="" width="20px" height="25px">
                        </form>
                    </nav>

                </div>

                <table class="table">

                    <thead>

                        <th scope="col">ID</th>
                        <th scope="col">Utilisateur</th>
                        <th scope="col">Montant</th>
                        <th scope="col">Nb d'articles</th>
                        <th scope="col">Date</th>
                        <th scope="col">Etat</th>

                    </thead>
                    <?php
                    //var_dump($arrayRecipes);
                    foreach ($user->getOrders() as $value) {
                    ?>
                        <tr>
                            <td><?= $value->getIdOrders(); ?></td>
                            <td><?= $user->getLastname(); ?> <?= $user->getFirstname(); ?></td>
                            <td><?= $value->getCoast(); ?></td>
                            <td></td>
                            <td><?= $value->getDateCreation(); ?></td>
                            <td><?= $value->getState($value); ?></td>
                            <td></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>

        <div class="col mt-3">
            <h2>Détails </h2>
            <div class="card">
                <div class="card-body-detail">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi, iste architecto ullam optio non
                    porro esse sint deserunt minus distinctio debitis natus, voluptatum eaque corrupti hic
                    dignissimos fugit voluptas consequatur!
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

                        <th scope="col">ID</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Recette</th>
                        <th scope="col">Contenu</th>
                        <th scope="col">Date</th>
                        <th scope="col">Etat</th>
                        <th scope="col">Actions</th>
                    </thead>
                    <?php
                    //var_dump($arrayRecipes);
                    foreach ($user->getComments() as $com) {
                    ?>
                        <tr>
                            <td></td>
                            <td><?= $com->getCommentTitle(); ?></td>
                            <td>a modifier : <?= $com->getNameRecipe(); ?></td>
                            <td><?= $com->getCommentContent(); ?></td>
                            <td><?= $value->getDateCreation(); ?></td>
                            <td><?= $value->getState($value); ?></td>
                            <td>
                                <a href="">Approuver</a><br>

                                <a data-toggle="modal" href="">Bloquer</a>
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

<!-- <div class="col mt-5">
              
                <p class="mt-5">Mot de passe</p><br><input type="password" class="w-75" name="userPwd" id="pwd"
                    required>
                &nbsp;<br><br>Complexité du mot de passe : <meter value="0" low="3" high="5" min="0" max="5"
                    id="pwd_meter">0%</meter><br>

                <ul><br>
                    <li><span class="advice mr-5" id=><em><b>Conseils pour le mot de passe (Tous les lignes ci-dessous
                                    doivent être vertes).</b></em></span></li>
                    <li><span class="advice mr-5" id="pwd_warn1">Le mot de passe doit faire plus de 8 caractères.</span>
                    </li>
                    <li><span class="advice" id="pwd_warn2">Le mot de passe doit contenir au moins une lettre
                            minuscule.</span></li>
                    <li><span class="advice" id="pwd_warn3">Le mot de passe doit contenir au moins une lettre
                            majuscule.</span></li>
                    <li><span class="advice" id="pwd_warn4">Le mot de passe doit contenir au moins un chiffre.</span>
                    </li>
                    <li><span class="advice" id="pwd_warn5">Le mot de passe doit contenir au moins un caractère
                            non-alphanumérique.</span></li>
                </ul>
            </div> -->