<?php
class UsersController extends BaseController
{
    // $model = new ModelUsers();
    // $arrayUsers = $model->readAll();

    public function initialize()
    {
        $loc    = filter_input(INPUT_GET, "loc", FILTER_SANITIZE_STRING);
        $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
        if ($action == '') {
            $model = new ModelUsers();
            $this->data['arrayUsers'] = $model->readAll();
        }
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
