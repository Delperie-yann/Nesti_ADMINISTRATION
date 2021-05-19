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
        if ($action == "add") {
            $this->addUser();
        }
        if ($action == "editing") {
        //    var_dump($idUser,$idRecipe,$state);
                if($state=="1"){
                    $this->endorse( $idUser,$idRecipe);
                }
                if($state=="0"){
                    $this->block($idUser,$idRecipe);
                }
            $this->editUser($idUser);
        }
        if ($action == "deleted") {
            $this->delete($idUser);
        }
        if($action=="endorse"){
            $this->endorse($idUser);
        }
        if($action=="block"){
            $this->block($idUser);
        }
    }
public function endorse($idUser,$idRecipe){
    $idModerat=$_SESSION['idUser'];
   
    $model   = new ModelComment();
    $newComm = $model->readOneBy2Prameter("idUsers", $idUser,"idRecipe",  $idRecipe);
    $newComm->setFlag("a");
    $newComm->setIdModerator($idModerat);
    $model->updateComment($newComm);
    // echo '<script type="text/javascript">window.alert("Le commenatire avec le titre '."' ".$newComm->getCommentTitle()." '".' est Approuver");</script>';
  
   
}
public function block($idUser,$idRecipe){
    $idModerat=$_SESSION['idUser'];
   
    $model   = new ModelComment();
    $newComm = $model->readOneBy2Prameter("idUsers", $idUser,"idRecipe",  $idRecipe);
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

        if ($_POST["userLogin"]) {
            $newUser->setLastname(filter_input(INPUT_POST, "userLastname"));
            $newUser->setFirstname(filter_input(INPUT_POST, "userFirstname"));
            $newUser->setLogin(filter_input(INPUT_POST, "userLogin"));
            $newUser->setEmail(filter_input(INPUT_POST, "userEmail"));
            $newUser->setPasswordHash(filter_input(INPUT_POST, "userPwd"));
            $newUser->setAddress1(filter_input(INPUT_POST, "userAdress1"));
            $newUser->setAddress2(filter_input(INPUT_POST, "userAdress2"));
            $newUser->setZipCode(filter_input(INPUT_POST, "userZipCode"));
            if ($_POST["State"] == "actif") {
                $newUser->setFlag("a");
            }
            if ($_POST["State"] == "wait") {
                $newUser->setFlag("w");
            }
            if ($_POST["State"] == "block") {
                $newUser->setFlag("b");
            }
            //verif IS valid?
         
            $insertedUser = $model->insertUser($newUser);
// var_dump($insertedUser);
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
        }
    }
    public function user($id)
    {
        $model = new ModelUsers();
        $user = $model->readOneBy("idUsers", $id);

        $this->data['user'] = $user;
        $model = new ModelOrders();
        $this->data['arrayOrders'] = $model->readAll();
    //    var_dump($this->data['arrayOrders']);
          $com = new ModelComment();
         $this->data['arrayCom'] = $com->readAll();
         
  // $user = new Users();
   // $user->setName($_SESSION["idUsers"]);

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
        $model = new ModelOrders();
        $orders = $model->readAllBy("idUsers", $idUsers);
   
        $this->data['ArrayOrder'] = $orders;

        if (isset($_POST["userLastname"])) {
            $user->setLastName(filter_input(INPUT_POST, "userLastname"));
            $user->setFirstname(filter_input(INPUT_POST, "userFirstname"));
            $user->setAddress1(filter_input(INPUT_POST, "userAdress1"));
            $user->setAddress2(filter_input(INPUT_POST, "userAdress2"));
            $user->setZipCode(filter_input(INPUT_POST, "userZipCode"));

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
            //verif IS valid?
            // var_dump($model->updateUsers($user));
         
            $insertedUser = $model->updateUsers($user);

            if (isset($_POST["roleAdmin"])) {
                $insertedUser->makeAdmin();
                // echo'totoad';
                // // var_dump( $insertedUser->makeAdmin());
            }
            if (isset($_POST["roleChef"])) {
                $insertedUser->makeChef();
                // echo'totoCh';
                // var_dump( $insertedUser->makeChef());
            }
            if (isset($_POST["roleModerator"])) {
                $insertedUser->makeModerator();
                // echo'totoMO';
                // var_dump( $insertedUser->makeModerator());
            }

            header('Location:' . BASE_URL . "users/editing/" . $idUsers);
        }
    }
}
