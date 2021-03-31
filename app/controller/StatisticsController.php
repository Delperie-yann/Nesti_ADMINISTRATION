<?php

// $model = new ModelStatistics();
// $arrayStatistics = $model->readall();

// switch ($action) {
//     case 'statistics':
//         include(PATH_CONTENT . "/content_statistics.php");
//         break;


class StatisticsController extends BaseController
{
    // $model = new ModelUsers();
    // $arrayUsers = $model->readAll();

    public function initialize()
    {
        $loc    = filter_input(INPUT_GET, "loc", FILTER_SANITIZE_STRING);
        $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);
        if ($action == '') {
            $model = new ModelStatistics();
            $this->data['arrayStatistics'] = $model->readAll();
        }
    }
}

