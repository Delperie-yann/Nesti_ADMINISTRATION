<?php
class UsersController extends BaseController
{
    // $model = new ModelUsers();
    // $arrayUsers = $model->readAll();

    public function initialize()
    {
        $newUser = new Users();
        $model   = new ModelUsers();
        $loc     = filter_input(INPUT_GET, "loc", FILTER_SANITIZE_STRING);
        $action  = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
        $idUser  = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
        if ($action == '') {
            $model                    = new ModelUsers();
            $this->data['arrayUsers'] = $model->readAll();
        }
        if ($action == "add") {
            $this->addUser();

        }
        if ($action == "deleted") {
            $this->delete($idUser);
          }

    }
    public function addUser()
    {
        $newUser = new Users();
        $model   = new ModelUsers();
        //  var_dump($_POST["roleAdmin"]);
        // // die();
        if ($_POST["userLogin"]) {
            $newUser->setLastname(filter_input(INPUT_POST, "userLastname"));
            $newUser->setFirstname(filter_input(INPUT_POST, "userFirstname"));
            $newUser->setLogin(filter_input(INPUT_POST, "userLogin"));
            $newUser->setEmail(filter_input(INPUT_POST, "userEmail"));
            $newUser->setPasswordHash(filter_input(INPUT_POST, "userPwd"));
            $newUser->setAddress1(filter_input(INPUT_POST, "userAdress1"));
            $newUser->setAddress2(filter_input(INPUT_POST, "userAdress2"));
            $newUser->setZipCode(filter_input(INPUT_POST, "userZipCode"));
            if ($_POST["State"]=="actif"){
                $newUser->setFlag("a");
            }
            if ($_POST["State"]=="wait"){
                $newUser->setFlag("w");
            }
            if ($_POST["State"]=="block"){
                $newUser->setFlag("b");
            }
            //verif IS valid?
            $insertedUser = $model->insertUser($newUser);
            // var_dump( $insertedUser);
            if (isset($_POST["roleAdmin"])){
                $insertedUser->makeAdmin();
           }
           if (isset($_POST["roleChef"])){
            $insertedUser->makeChef();
           }
            if (isset($_POST["roleModerator"])){
             $insertedUser->makeModerator();
           }
           
            
             header('Location:' . BASE_URL . "users");
        }
    }
    public function editUser()
    {
        if ($action == "editing") {
            $user = $model->readOneBy("idUser", $idUser);

        }
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
  }


// switch ($action) {
//     case 'creation':
//         var_dump($_POST);
//         if (isset($_POST['email'])) {
//             $error['email'] = Utils::checkEmail($_POST['email']);
//         }

//         break;
//     case 'editing':
//         include(PATH_CONTENT . "/content_users_editing.php");
//         break;
//     default:
//         include(PATH_CONTENT . "/content_users.php");
//         break;
// }