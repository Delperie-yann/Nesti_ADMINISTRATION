<a href="<?= BASE_URL ?>users" class="mb-2 mt-4 ml-5">Utilisateurs </a>><a class="mb-2 mt-4"> Création</a>

<div class="container">
<form action="<?php echo (BASE_URL) ?>users/add" method="POST">
    <div class="row mt-3">
       
            <div class="col">
                <h1>Création d'un utilisateur</h1>

                <p class="mt-5">Nom</p><br>
                <input type="text" class="w-75" name="userLastname">
                
                <p class="mt-5">Prénom</p><br>
                <input type="text" class="w-75" name="userFirstname">
                
                <p class="mt-5">Adress1</p><br>
                <input type="text" class="w-75" name="userAdress1">
                
                <p class="mt-5">Adress2</p><br>
                <input type="text" class="w-75" name="userAdress2">
                
                <p class="mt-5">Zipcode</p><br>
                <input type="text" class="w-75" name="userZipCode">
                
                
                <p class="mt-5">Rôle</p><br>
                <input type="checkbox" class="w-75" name="role['chef']"><label for="chef">Chef</label>
                <input type="checkbox" class="w-75" name="role['moderator']"><label for="moderator">Moderateurr</label>
                <input type="checkbox" class="w-75" name="role['Utilisateur']" checked><label for="Utilisateur">Utilisateur</label>
                <p class="mt-5">Etat</p><br>
                <!--a passer en  select -->
                <input type="checkbox" class="w-75" name="state['actif']"><label for="a">Actif</label>
                <input type="checkbox" class="w-75" name="state['wait']" checked><label for="w">En attente</label>
                <input type="checkbox" class="w-75" name="state['block']"><label for="b">Bloqué</label>
                <!-- CA -->
                <div class="row">
                    <div class="d-flex justify-content-center p-2">
                        <button type="submit" class="btn m-10 ml-2 valid w-50">Valider</button>
                        <button type="submit" class="btn m-10 ml-5 cancel w-50">Annuler</button>
                    </div>
                </div>
            </div>

            <div class="col mt-5">
                 <p class="mt-5">Login</p><br>
                <input type="text" class="w-75" name="userLogin">
                <p class="mt-5">Email</p><br>
                <input type="text" class="w-75" name="userEmail">
                <p class="mt-5">Mot de passe</p><br><input type="password" class="w-75" name="userPwd" id="pwd" required>
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
            </div>
        </form>
    </div>
</form>