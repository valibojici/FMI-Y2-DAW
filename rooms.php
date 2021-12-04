<?php
    require_once './includes/view/view.php';
    $view = new View(['title' => 'Rooms | Hillside Hotel']);

    require_once './includes/model/connectDB.php';
    require_once './includes/model/room.model.php';

    $conn = connectDB();
    $room_types = getRoomTypes($conn);

    foreach($room_types as $key => $type){
        $imgs = getRoomImages($conn, $type['nume']);
        $imgs = array_map(function($arr){return $arr['path']; }, $imgs);

        $room_types[$key]['imgs'] = $imgs;
    }

    $view->assign('types', $room_types);
    $view->render('./includes/view/rooms.tpl.php');

?>