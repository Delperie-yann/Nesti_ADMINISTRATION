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
            $this->dashboard();
        }
    }
    public  function dashboard()
    {
        // $connexionByHour = [];
        // $categories = [];
        // $allLogs = ModelConnectionLog::findAll();
        // foreach ($allLogs as $book) {
        //     $format = 'Y-m-d H:i:s';
        //     $logDate = DateTime::createFromFormat($format, $book->getDateConnection());
        //     // echo $lotDate;
        //     $categories[$logDate->format('H')][] = $book;
        // }
        // foreach ($categories as $key => $logs) {
        //     $connexionByHour[] = (object) array("name" => $key, "data" => count($logs));
        // }
       
        // $allUsers = ModelUsers::findAll();
        // usort($allUsers, function ($v1, $v2) {
        //     return count($v2->getConnectionLogs()) <=> count($v1->getConnectionLogs());
        // });
        // $allUsers = array_slice($allUsers, 0, 10);
        $cost = [444, 457, 477, 479, 446, 476, 457, 472, 467, 455, 458, 458, 451];
        $vente= [466, 507, 472, 475, 485, 470, 500, 496, 487, 491, 490, 476, 489];
        $connexionByHour=[46];

        $this->data['arrayVars'] = [
            "cost" => $cost,
            "vente" => $vente,
            "connexionByHour"=>$connexionByHour,
            
        ];
}


}