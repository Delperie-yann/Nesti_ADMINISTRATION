<?php
class UsersController extends BaseController
{
    public function initialize()
    {
        $newUser = new Users();
        $model   = new ModelUsers();

        $loc     = filter_input(INPUT_GET, "loc", FILTER_SANITIZE_STRING);
        $action  = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
        $idUser  = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
        $idRecipe  = filter_input(INPUT_GET, "supp", FILTER_SANITIZE_STRING);
        $state  = filter_input(INPUT_GET, "state", FILTER_SANITIZE_STRING);


        if ($action == '') {
            $model                    = new ModelUsers();
            $this->data['arrayUsers'] = $model->readAll();
        }
        if ($action == "creation") {
            $this->addUser();
        }
        if ($action == "editing") {
            if ($idRecipe == "resumepassword") {
                $this->passwordChange($idUser);
            }
            if ($state == "1") {
                $this->endorse($idUser, $idRecipe);
            }
            if ($state == "0") {
                $this->block($idUser, $idRecipe);
            }

            $this->editUser($idUser);
        }
        if ($action == "deleted") {
            $this->delete($idUser);
        }

        if ($action == "orderline") {
            $this->readOrder();
        }
    }
    public function endorse($idUser, $idRecipe)
    {
        $idModerat = $_SESSION['idUser'];

        $model   = new ModelComment();
        $newComm = $model->readOneBy2Prameter("idUsers", $idUser, "idRecipe",  $idRecipe);
        $newComm->setFlag("a");
        $newComm->setIdModerator($idModerat);
        $model->updateComment($newComm);
        // echo '<script type="text/javascript">window.alert("Le commenatire avec le titre '."' ".$newComm->getCommentTitle()." '".' est Approuver");</script>';


    }
    public function block($idUser, $idRecipe)
    {
        $idModerat = $_SESSION['idUser'];

        $model   = new ModelComment();
        $newComm = $model->readOneBy2Prameter("idUsers", $idUser, "idRecipe",  $idRecipe);
        // var_dump( $newComm);
        $newComm->setFlag("b");
        $newComm->setIdModerator($idModerat);
        $model->updateComment($newComm);


        // echo '<script type="text/javascript">window.alert("Le commenatire avec le titre '."' ".$newComm->getCommentTitle()." '".' est blocké");</script>';
    }



    public function addUser()
    {
        $newUser = new Users();
        $model   = new ModelUsers();

        if (isset($_POST["userLogin"])) {
            $newUser->setLastname(filter_input(INPUT_POST, "userLastname"));
            $newUser->setFirstname(filter_input(INPUT_POST, "userFirstname"));
            $newUser->setLogin(filter_input(INPUT_POST, "userLogin"));
            $newUser->setEmail(filter_input(INPUT_POST, "userEmail"));
            $newUser->setPasswordHash(filter_input(INPUT_POST, "userPwd"));
            $newUser->setAddress1(filter_input(INPUT_POST, "userAdress1"));
            $newUser->setAddress2(filter_input(INPUT_POST, "userAdress2"));
            $newUser->setZipCode(filter_input(INPUT_POST, "userZipCode"));
            $newUser->setIdCity($newUser->setTownId(filter_input(INPUT_POST, "userTown")));

            if ($_POST["State"] == "actif") {
                $newUser->setFlag("a");
            }
            if ($_POST["State"] == "wait") {
                $newUser->setFlag("w");
            }
            if ($_POST["State"] == "block") {
                $newUser->setFlag("b");
            }
            $userExistEmmail = $model->readOneBy("email", $newUser->getEmail());
            $userExist = $model->readOneBy("login", $newUser->getLogin());


            $error     = 0;
            if (($userExistEmmail->getIdUser()) != NUll) {
                $this->data['emailError'] = true;
                $error = 1;
            }
            if (($userExist->getIdUser()) != NUll) {
                $this->data['loginError'] = true;
                $error = 1;
            }


            if ($error == 0) {
                $insertedUser = $model->insertUser($newUser);
                if (isset($_POST["roleAdmin"])) {
                    $insertedUser->makeAdmin();
                }
                if (isset($_POST["roleChef"])) {
                    $insertedUser->makeChef();
                }
                if (isset($_POST["roleModerator"])) {
                    $insertedUser->makeModerator();
                }
                header('Location:' . BASE_URL . "users");
            } else {
                isset($this->data['emailError']);
                isset($this->data['loginError']);
            }
        }
    }


    public function user($id)
    {
        $model = new ModelUsers();
        $user = $model->readOneBy("idUsers", $id);
        $this->data['user'] = $user;
        $model = new ModelOrders();
        $this->data['arrayOrders'] = $model->readAll();

        $com = new ModelComment();
        $this->data['arrayCom'] = $com->readAll();
    }
    public function delete($id)
    {
        $model = new ModelUsers();
        $user = $model->readOneBy("idUsers", $id);
        $deletedUsers = $model->deleteUser($user);
        header('Location:' . BASE_URL . "users");
    }

    public function editUser($idUsers)
    {
        $model = new ModelUsers();
        $user = $model->readOneBy("idUsers", $idUsers);
        $this->data['user'] = $user;
        $model2 = new ModelOrders();
        $orders = $model2->readAllBy("idUsers", $idUsers);

        $this->data['arrayOrder'] = $orders;

        if (isset($_POST["userLastname"])) {
            $user->setLastName(filter_input(INPUT_POST, "userLastname"));
            $user->setFirstname(filter_input(INPUT_POST, "userFirstname"));
            $user->setAddress1(filter_input(INPUT_POST, "userAdress1"));
            $user->setAddress2(filter_input(INPUT_POST, "userAdress2"));
            $user->setZipCode(filter_input(INPUT_POST, "userZipCode"));

            $townInput = (filter_input(INPUT_POST, "userTown"));
            $modelcity = new ModelCity();
            $cities = $modelcity->readAll();
            //Check every city 
            foreach ($cities as $town) {
                $townName = $town->getName();
                //if exist change by BDD idcity and stop
                if ($townInput == $townName) {
                    $city = $modelcity->readOneBy("name",  $townName);
                    $valuecity = $user->setIdCity($city->getIdCity());
                    break;
                } else {
                    //if not exist add and give id insered and stop
                    if ($townInput != "" && $townInput != NULL) {
                        $newTown = $modelcity->insertCity($townInput);
                        $valuecity =   $user->setIdCity($newTown->getIdCity());
                        break;
                    }
                }
            }
            if ($_POST["State"] == "actif") {
                $user->setFlag("a");
            }
            if ($_POST["State"] == "wait") {
                $user->setFlag("w");
            }
            if ($_POST["State"] == "block") {
                $user->setFlag("b");
            }
            $model = new ModelUsers();
            $insertedUser = $model->updateUsers($user);



            $error     = 0;
            if (isset($_POST["roleAdmin"]) == NUll) {
                $this->data['roleAdmin'] = true;
                $error = 1;
            }
            if (isset($_POST["roleChef"]) == NUll) {
                $this->data['roleChef'] = true;
                $error = 1;
            }
            if (isset($_POST["roleModerator"]) == NUll) {
                $this->data['roleModerator'] = true;
                $error = 1;
            }


            if (isset($_POST["roleAdmin"])) {
                $insertedUser->makeAdmin();
            }
            if (isset($_POST["roleChef"])) {
                $insertedUser->makeChef();
            }
            if (isset($_POST["roleModerator"])) {
                $insertedUser->makeModerator();
            }
            if ($error != 0) {

                // header('Location:' . BASE_URL . "users/editing/" . $idUsers);

                isset($this->data['roleAdmin']);
                isset($this->data['roleChef']);
                isset($this->data['roleModerator']);
                $this->data["error"] = "error";
            }
            if (isset($insertedUser)) {
                $this->data["success"] = "success";
            }
        }
    }
    public function passwordChange($idUser)
    {
        $Value = $this->randomPassword();
        $model = new ModelUsers();
        $user = $model->readOneBy("idUsers", $idUser);
        $userNewPass = $user->setPasswordHash($Value);

        $newpass = $model->updatePassword($userNewPass);


        $this->data['pass'] =  $Value;
    }


    public function readOrder()
    {
        // POST comme from orderScript
        $order = $_POST['order'];
        $model = new ModelOrderline();
        $ArrayOrders = $model->readAllBy("idOrders", $order);
        $data = [];
        foreach ($ArrayOrders as $orders) {
            $modelArticle = new ModelArticles();
            $article = $modelArticle->readOneBy("idArticle", $orders->getIdArticle());
            $name = $article->getUnitQuantity() . " " . $article->getUnitName() . " " . $article->getName();
            $data[] = $name;
        }
        echo json_encode($data);

        //$value->getUnitQuantity() $value->getUnitName(), $value->getName(); 


        die();
    }
    function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}
