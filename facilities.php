<?php
    require_once './includes/view/view.php';
    $view = new View(['title' => 'Facilities | Hillside Hotel']);

    require_once './includes/model/connectDB.php';
    require_once './includes/model/facility.model.php';

    $conn = connectDB();
    $facilities = getFacilities($conn);

    foreach($facilities as $key => $fac){
        $imgs = getFacilityImages($conn, $fac['denumire']);
        $imgs = array_map(function($arr){return $arr['path']; }, $imgs);

        $facilities[$key]['imgs'] = $imgs;
    }

    $view->assign('facilities', $facilities);
    $view->render('./includes/view/facilities.tpl.php');

?>