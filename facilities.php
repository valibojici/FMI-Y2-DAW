<?php
    require_once './view/view.php';
    $view = new View(['title' => 'Facilities | Hillside Hotel']);

    require_once './model/connectDB.php';
    require_once './model/facility.model.php';

    $conn = connectDB();
    $facilities = getFacilities($conn);

    foreach($facilities as $key => $fac){
        $imgs = getFacilityImages($conn, $fac['denumire']);
        $imgs = array_map(function($arr){return $arr['path']; }, $imgs);

        $facilities[$key]['imgs'] = $imgs;
    }

    $view->assign('facilities', $facilities);
    $view->render('./view/facilities.tpl.php');

?>