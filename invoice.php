<?php
    session_start();

    if(!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] !== 'GET'){
        header('Location: myaccount.php');
        exit;
    }

    $res_id = $_GET['id'] ?? null;
    // nu e in POST
    if($res_id === null){
        header('Location: myaccount.php');
        exit;
    }

    require_once './includes/model/connectDB.php';
    require_once './includes/model/reservation.model.php';
    require_once './includes/model/user.model.php';
    require_once './includes/model/room.model.php';
    require_once './includes/fpdf/invoice.php';

    $conn = connectDB();

    // iau info despre reservare
    $res_info = getReservationInfo($conn, $res_id);
    if($res_info === null){
        header('Location: myaccount.php');
        exit;
    }

    $room_info = getRoomNumberAndType($conn, $res_info['id_camera']);
    if($room_info === null){
        header('Location: myaccount.php');
        exit;
    }

    $user_info = getUserData($conn, $_SESSION['user_email']);
    if($user_info === null){
        header('Location: myaccount.php');
        exit;
    }

    // daca id-ul rezervarii din url nu facuta de userul curent
    if($res_info['id_user'] != $user_info['id']){
        header('Location: myaccount.php');
        exit;
    }

    getPDF(
        $room_info['nume'],
        date('d F Y', strtotime($res_info['check_in'])),
        date('d F Y', strtotime($res_info['check_out'])),
        $res_id, $room_info['numar'],
        date('d F Y', strtotime($res_info['data'])),
        $res_info['suma_plata'],
        $user_info['nume'] . ' ' . $user_info['prenume']);

?>