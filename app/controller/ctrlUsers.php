<?php


$model = new ModelUsers ();
$arrayUsers = $model -> readAll(); 


$action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
if ($action == "add") {
      $user = new Users();
      
      $user->setLastname(filter_input(INPUT_POST, "userLastname"));
      $user->setFirstname(filter_input(INPUT_POST, "userFirstname"));
      $user->setLogin(filter_input(INPUT_POST, "userLogin"));
      $user->setEmail(filter_input(INPUT_POST, "userEmail"));
      $user->setPasswordHash(filter_input(INPUT_POST, "userPwd"));
      $user->setAddress1(filter_input(INPUT_POST, "userAdress1"));
      $user->setAddress2(filter_input(INPUT_POST, "userAdress2"));
      $user->setZipCode(filter_input(INPUT_POST, "userZipCode"));
      $user->setFlag("w");
      //verif IS valid?
      $insertedUser = $model->insertUser($user);
     // var_dump($insertedUser);
     header('Location:' . BASE_URL . "users/create/" . $insertedUser->getIdUser());

// $user = new Users();
// $user->setName($_SESSION["idUsers"]);
}
if($action=="editing"){

  $user = $model->readOneBy("idUser",$id);



}
?>