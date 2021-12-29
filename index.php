<?php
    session_start();

    require_once './includes/view/view.php';

    require_once './includes/model/room.model.php';
    require_once './includes/model/statistics.model.php';
    require_once './includes/model/connectDB.php';
    $conn = connectDB();
    
    $view = new View(['title' => 'Home | Hillside Hotel']);
    
    // iau imaginile din BD
    $img_paths = getRoomTypeImages($conn);
    if($img_paths !== null){
        // daca exista o sa fie [ [0 => ...], [0 => ... ], ... ]
        $img_paths = array_map(function($arr){return $arr[0];}, $img_paths);
        $view->assign('room_img_src', array_slice($img_paths, 0, 3));
    }    
   
    // pun in BD statistici
    $url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

    insert_statistics($conn, $_SERVER['REMOTE_ADDR'], $url, session_id());

    $visitors = getVisitors($conn, $url)[0] ?? null;
    $visits = getvisits($conn, $url)[0] ?? null;
    $views = getViews($conn, $url)[0] ?? null;

    $view->assign('visitors', $visitors);
    $view->assign('visits', $visits);
    $view->assign('views', $views);

    $view->render('./includes/view/home.tpl.php');
?>