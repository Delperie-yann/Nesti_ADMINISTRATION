<nav class="navbar navbar-expand-xl p-0" id="mainNav">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav mr-auto navnesti justify-content-around">
            <li class="nav-item m-xl-3 <?= ($loc == 'recipes') ? 'active' : ''; ?>">
                <a class="nav-link text-light" href="<?= BASE_URL ?>recipes">
                    <i class="fas fa-clipboard-list ml-2"></i>
                    Recettes</a>
            </li>
            <li class="nav-item m-xl-3 <?= ($loc == 'articles') ? 'active' : ''; ?>">
                <a class="nav-link text-light" href="<?= BASE_URL ?>articles">
                    <i class="fas fa-utensils ml-2"></i>
                    Articles</a>
            </li>
            <li class="nav-item m-xl-3 <?= ($loc == 'users') ? 'active' : ''; ?>">
                <a class="nav-link text-light" href="<?= BASE_URL ?>users">
                    <i class="fas fa-user ml-2"></i>
                    Utilisateurs</a>
            </li>
            <li class="nav-item m-xl-3 <?= ($loc == 'statistics') ? 'active' : ''; ?>">
                <a class="nav-link text-light" href="<?= BASE_URL ?>statistics">
                    <i class="fas fa-chart-bar ml-2"></i>
                    Statistiques
                </a>
            </li>
        </ul>
        <form class="form-inline logOut my-2 my-lg-0 justify-content-around">
            <a class="nav-link" href="">
                <i class="fas fa-user mr-2 text-dark"></i>
                <?php print_r($_SESSION["firstname"]." ".$_SESSION["lastname"]." ".$_SESSION['idUser']) ?>
            </a>
            <a class="nav-link text-dark" value="Deconnection" href="<?= BASE_URL ?>deconnection">
                <i class="fas fa-sign-out-alt mr-2 text-dark" <?= ( $loc =='deco')?'active':''; ?>></i>
                Déconnexion</a>
        </form>
    </div>

</nav>

