<?php
    session_start();
    if(!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }

    require_once './includes/view/view.php';
    require_once './includes/model/connectDB.php';
    require_once './includes/model/user.model.php';
    require_once './includes/model/room.model.php';
    require_once './includes/model/reservation.model.php';

    $conn = connectDB();
    $user_data = getUserData($conn, $_SESSION['user_email']);
    

    $reservations = getUserReservations($conn, $user_data['id']);

    foreach($reservations as $key => $r){
        $room_info = getRoomNumberAndType($conn, $r['id_camera']);
        $reservations[$key]['room_type'] = $room_info['nume'];
        $reservations[$key]['room_no'] = $room_info['numar'];
    }

    $view = new View(['title' => 'My Account | Hillside Hotel']);
    $view->assign('reservations', $reservations);
    $view->assign('firstname', $user_data['prenume']);
    $view->assign('lastname', $user_data['nume']);
    $view->assign('phone', $user_data['telefon']);
    $view->assign('email', $_SESSION['user_email']);
 
    $view->render('./includes/view/myaccount.tpl.php');
?>