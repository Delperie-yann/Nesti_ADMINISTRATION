<a href="<?= BASE_URL ?>index.php?loc=users" class="mb-2 mt-4 ml-5">Utilisateurs </a>><a class="mb-2 mt-4"> Création</a>

<div class="container">
    <div class="row mt-3">
        <div class="col">
            <h1>Modification d'un utilisateur</h1>
            <p class="mt-5">Nom</p><br>
            <input type="text" class="w-75">
            <p>Prénom</p><br>
            <input type="text" class="w-75">
            <p>Rôle</p><br>
            <input type="text" class="w-75">
            <p>Etat</p><br>
            <input type="text" class="w-75">

            <div class="row">
                <div class="d-flex justify-content-center p-2">
                    <button type="submit" class="btn m-10 ml-2 valid w-50">Valider</button>
                    <button type="submit" class="btn m-10 ml-5 cancel w-50">Annuler</button>
                </div>
            </div>
        </div>

        <div class="col mt-5">
            <p class="mt-5">Email</p><br>
            <input type="text" class="w-75">
            <p>Mot de passe</p><br><input type="password" class="w-75" name="pwd" id="pwd" required>
            &nbsp;<br><br>Complexité du mot de passe : <meter value="0" low="3" high="5" min="0" max="5" id="pwd_meter">0%</meter><br>

            <ul><br>
                <li><span class="advice mr-5" id=><em><b>Conseils pour le mot de passe (Tous les lignes ci-dessous doivent être vertes).</b></em></span></li>
                <li><span class="advice mr-5" id="pwd_warn1">Le mot de passe doit faire plus de 8 caractères.</span></li>
                <li><span class="advice" id="pwd_warn2">Le mot de passe doit contenir au moins une lettre minuscule.</span></li>
                <li><span class="advice" id="pwd_warn3">Le mot de passe doit contenir au moins une lettre majuscule.</span></li>
                <li><span class="advice" id="pwd_warn4">Le mot de passe doit contenir au moins un chiffre.</span></li>
                <li><span class="advice" id="pwd_warn5">Le mot de passe doit contenir au moins un caractère non-alphanumérique.</span></li>
            </ul>
        </div>

    </div>
</div>
<div class="container">
    <h2>Modal Example</h2>
    <!-- Trigger the modal with a button -->
    <a type="button" class="btn " data-toggle="modal" data-target="#myModal">Open Modal</a>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>