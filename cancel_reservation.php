<?php 
    session_start();

    if(!isset($_SESSION['loggedin'])){
        quit('login.php');
    }

    if($_SERVER['REQUEST_METHOD'] !== "POST"){
        quit('myaccount.php');
    }

    $reservation_id = $_POST['id'] ?? null;
    // daca nu exista in post
    if($reservation_id === null){
        quit('myaccount.php');
    }
    
    require_once './includes/model/connectDB.php';
    require_once './includes/model/reservation.model.php';
    require_once './includes/model/user.model.php';

    $conn = connectDB();
    
    // iau info despre reservare
    $res_info = getReservationInfo($conn, $reservation_id);
    if($res_info === null){
        $_SESSION['message'] = 'Database error';
        quit('message.php');
    }

    // iau info despre user curent
    $user_info = getUserData($conn, $_SESSION['user_email']);
    
    // verific daca rezervarea e facuta de userul asta
    if($res_info['id_user'] != $user_info['id']){
        quit('myaccount.php');
    }

    // ok merge sa fie anulata
    if(strtotime($res_info['check_in']) >= strtotime('+2 day')){
        $ok = deleteReservation($conn, $reservation_id);
        $_SESSION['message'] = $ok ? 'Reservation canceled.' : 'Database error';
        quit('message.php');
    } else {
        // nu merge a depasit 2 zile
        $_SESSION['message'] = 'You can only cancel reservations at least 2 days before check in.';
        quit('message.php');
    }
 
    function quit($where){
        header('Location: ' . $where);
        exit;
    }
?>