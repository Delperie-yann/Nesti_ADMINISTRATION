<?php

class ConnectionController extends BaseController
{
    // $model = new ModelUsers();
    // $arrayUsers = $model->readAll();

    public function initialize()
    {
        $loc    = filter_input(INPUT_GET, "loc", FILTER_SANITIZE_STRING);
        $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
        if ($action == '') {
            $model = new Connection();
            // $this->data['arrayConnection'] = $model->readAll();
        }

        if (!empty($_POST)) {

            if ($loc != "connection") {

                header('Location:' . BASE_URL . 'connection');
                die();
            } else {
                // echo ("else");

                $login    = $_POST["loginUser"];
                $password = $_POST["password"];
                $model    = new ModelUsers();
                $user     = $model->readOneBy("login", $login);
                if (($user != null) && ($user->isPassword($password))) {
                    $_SESSION['Roles']     = $user->getRoles();
                    $_SESSION['idUser']    = $user->getIdUser();
                    $_SESSION["login"]     = $login;
                    $_SESSION["firstname"] = $user->getFirstname();
                    $_SESSION["lastname"]  = $user->getLastname();

                $model = new ModelConnectionLog;
                $model->insertDateCo($user);
                    header('Location:' . BASE_URL . 'recipes');
                } else {
                    header('Location:' . BASE_URL . 'connection');
                }
            }
        }
    }
}
