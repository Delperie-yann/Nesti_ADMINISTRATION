<?php

class ConnectionController extends BaseController
{
      
    /**
     * initialize
     *
     * @return void
     */
    public function initialize()
    {
        $loc    = filter_input(INPUT_GET, "loc", FILTER_SANITIZE_STRING);
        $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);

        if ($action == '') {
            $model = new Connection();
        }

        if (!empty($_POST)) {
            if ($loc != "connection") {
                header('Location:' . BASE_URL . 'connection');
                die();
            } else {
                $login    = filter_input(INPUT_POST, "loginUser", FILTER_SANITIZE_STRING);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
                $model    = new ModelUsers();
                $user     = $model->readOneBy("login", $login);
                if (($user != null) && ($user->isPassword($password))) {
                    $_SESSION['Roles']     = $user->getRoles();
                    $_SESSION['idUser']    = $user->getIdUser();
                    $_SESSION["login"]     = $login;
                    $_SESSION["firstname"] = $user->getFirstname();
                    $_SESSION["lastname"]  = $user->getLastname();

                    if ((!is_int(strpos($user->getRoles(), 'Administateur'))
                        && (!is_int(strpos($user->getRoles(), 'Chef')))
                        && (!is_int(strpos($user->getRoles(), 'Moderateur'))))) {
                        header('Location:' . BASE_URL . 'connection');
                        die();
                    }
                    $model = new ModelConnectionLog();
                    $model->insertDateCo($user);
                    header('Location:' . BASE_URL . 'recipes');
                } else {
                    $this->data['loginError']=true;
                 
               
                }
            }
        }
    }
}
