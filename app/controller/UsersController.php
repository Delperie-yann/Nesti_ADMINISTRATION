<?php
class UsersController extends BaseController
{
    /**
     * initialize
     *
     * @return void
     */
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

    /**
     * endorse
     *
     * @param  mixed $idUser
     * @param  mixed $idRecipe
     * @return void
     */
    public function endorse($idUser, $idRecipe)
    {
        $idModerat = $_SESSION['idUser'];
        $model   = new ModelComment();
        $newComm = $model->readOneBy2Prameter("idUsers", $idUser, "idRecipe",  $idRecipe);
        $newComm->setFlag("a");
        $newComm->setIdModerator($idModerat);
        $model->updateComment($newComm);
    }
    /**
     * block
     *
     * @param  mixed $idUser
     * @param  mixed $idRecipe
     * @return void
     */
    public function block($idUser, $idRecipe)
    {
        $idModerat = $_SESSION['idUser'];
        $model   = new ModelComment();
        $newComm = $model->readOneBy2Prameter("idUsers", $idUser, "idRecipe",  $idRecipe);
        $newComm->setFlag("b");
        $newComm->setIdModerator($idModerat);
        $model->updateComment($newComm);
    }



    /**
     * addUser
     *
     * @return void
     */
    public function addUser()
    {
        $newUser = new Users();
        $model   = new ModelUsers();

        if (isset($_POST["userLogin"])) {
            $userLastname = filter_input(INPUT_POST, "userLastname");
            $userFirstname = filter_input(INPUT_POST, "userFirstname");
            $userLogin = filter_input(INPUT_POST, "userLogin");
            $userEmail = filter_input(INPUT_POST, "userEmail");
            $userPwd = filter_input(INPUT_POST, "userPwd");
            $userAdress1 = filter_input(INPUT_POST, "userAdress1");
            $userAdress2 = filter_input(INPUT_POST, "userAdress2");
            $userZipCode = filter_input(INPUT_POST, "userZipCode");
            $userTown = filter_input(INPUT_POST, "userTown");

            $error     = 0;
            if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL) && (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $userEmail))) {
                $data['email'] = true;
                $error = 1;
            }
            if (!preg_match("/^[a-zA-Z-' ]*$/", $userLogin)) {
                $data['login'] = true;
                $error = 1;
            }
            if (!preg_match("/^\d{5}$/", $userZipCode)) {
                $error        = 1;
                $data['zipcode'] = true;
            }

            $newUser->setLastname($userLastname);
            $newUser->setFirstname($userFirstname);
            $newUser->setLogin($userLogin);
            $newUser->setEmail($userEmail);
            $newUser->setPasswordHash($userPwd);
            $newUser->setAddress1($userAdress1);
            $newUser->setAddress2($userAdress2);
            $newUser->setZipCode($userZipCode);
            $townInput = ($userTown);

            if ($error == 0) {

                $modelcity = new ModelCity();
                $cities = $modelcity->readAll();
                //Check every city 
                foreach ($cities as $town) {
                    $townName = $town->getName();
                    //if exist change by BDD idcity and stop
                    if ($townInput == $townName) {
                        $city = $modelcity->readOneBy("name",  $townName);
                        $Uservaluecity = $newUser->setIdCity($city->getIdCity());
                        break;
                    } else {
                        //if not exist add and give id insered and stop
                        if ($townInput != "" && $townInput != NULL) {
                            $newTown = $modelcity->insertCity($townInput);
                            $Uservaluecity =   $newUser->setIdCity($newTown->getIdCity());
                            break;
                        }
                    }
                }


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
                    isset($this->data['emailError']) + isset($this->data['loginError']);
                }
            }
        }
    }


    /**
     * user
     *
     * @param  mixed $id
     * @return void
     */
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
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $model = new ModelUsers();
        $user = $model->readOneBy("idUsers", $id);
        $deletedUsers = $model->deleteUser($user);
        header('Location:' . BASE_URL . "users");
    }

    /**
     * editUser
     *
     * @param  mixed $idUsers
     * @return void
     */
    public function editUser($idUsers)
    {
        $model = new ModelUsers();
        $user = $model->readOneBy("idUsers", $idUsers);
        $this->data['user'] = $user;
        $model2 = new ModelOrders();
        $orders = $model2->readAllBy("idUsers", $idUsers);

        $this->data['arrayOrder'] = $orders;

        if (isset($_POST["userLastname"])) {
            $userLastname = filter_input(INPUT_POST, "userLastname");
            $userFirstname = filter_input(INPUT_POST, "userFirstname");

            $userAdress1 = filter_input(INPUT_POST, "userAdress1");
            $userAdress2 = filter_input(INPUT_POST, "userAdress2");
            $userZipCode = filter_input(INPUT_POST, "userZipCode");
            $userTown = filter_input(INPUT_POST, "userTown");
            $error     = 0;


            if (!preg_match("/^\d{5}$/", $userZipCode)) {
                $error        = 1;
                $data['zipcode'] = true;
            }

            $user->setLastName($userLastname);
            $user->setFirstname($userFirstname);
            $user->setAddress1($userAdress1);
            $user->setAddress2($userAdress2);
            $user->setZipCode($userZipCode);

            if ($error == 0) {

                $modelcity = new ModelCity();
                $cities = $modelcity->readAll();
                //Check every city 
                foreach ($cities as $town) {
                    $townName = $town->getName();
                    //if exist change by BDD idcity and stop
                    if ($userTown == $townName) {
                        $city = $modelcity->readOneBy("name",  $townName);
                        $valuecity = $user->setIdCity($city->getIdCity());
                        break;
                    } else {
                        //if not exist add and give id insered and stop
                        if ($userTown != "" && $userTown != NULL) {
                            $newTown = $modelcity->insertCity($userTown);
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
               
                $insertedUser = $model->updateUsers($user);
                $error2 = 0;
                $this->errorRole( $error2 ,$user);
              
                if (isset($_POST["roleAdmin"])) {
                    $insertedUser->makeAdmin();
                }
                if (isset($_POST["roleChef"])) {
                    $insertedUser->makeChef();
                }
                if (isset($_POST["roleModerator"])) {
                    $insertedUser->makeModerator();
                }
                if ($error2 != 0) {
                    isset($this->data['roleAdmin']) + isset($this->data['roleChef']) + isset($this->data['roleModerator']);
                    $this->data["error"] = "error";
                }
               
            }
            if (isset($insertedUser)) {
                $this->data["success"] = "success";
            }
        }
    }
public function errorRole( $error2 ,$user){
   
    if (isset($_POST["roleAdmin"]) == NUll && $user->isAdmin()!=false) {
        $this->data['roleAdmin'] = true;
        $error2 = 1;
    }
    if (isset($_POST["roleChef"]) == NUll && $user->isChef()!=false) {
        $this->data['roleChef'] = true;
        $error2 = 1;
    }
    if (isset($_POST["roleModerator"]) == NUll && $user->isModerateur()!=false) {
        $this->data['roleModerator'] = true;
        $error2 = 1;

    }
    return $error2;
}
    
    /**
     * passwordChange
     *
     * @param  mixed $idUser
     * @return void
     */
    public function passwordChange($idUser)
    {
        $Value = $this->randomPassword();
        $model = new ModelUsers();
        $user = $model->readOneBy("idUsers", $idUser);
        $userNewPass = $user->setPasswordHash($Value);

        $newpass = $model->updatePassword($userNewPass);


        $this->data['pass'] =  $Value;
    }


    /**
     * readOrder
     *
     * @return void
     */
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


        die();
    }
    /**
     * randomPassword
     *
     * @return string
     */
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
