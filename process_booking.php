<?php 
    # aici ajung dupa ce clientul isi alege tipul camerei (dupa ce a ales checkin/out)

    session_start();

    if(!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        header('Location: booking.php');
        exit;
    }

    if(!isset($_SESSION['booking_info'])){
        header('Location: booking.php');
        exit;
    }

    require_once './includes/view/view.php';
    require_once './includes/model/room.model.php';
    require_once './includes/model/connectDB.php';
    
    unset($_SESSION['room_type']);

    $conn = connectDB();
    $view = new View(['title' => 'Confirm Booking | Hillside Hotel']);
    
    // iau tipul camerei alese de user
    $room_type = $_POST['room_type'] ?? null;
    // daca nu e in POST
    if($room_type === null){
        $_SESSION['message'] = 'Missing POST parameter';
        header('Location: message.php');
        exit;
    }

    // iau tipurile de camere din BD
    $db_room_types = getRoomTypes($conn);

    // daca in BD nu sunt tipuri de camere
    if($db_room_types === null){
        $_SESSION['message'] = 'No rooms available';
        header('Location: message.php');
        exit;
    }
    
    // iau numele din tipurile camerelor din BD
    $db_room_types = array_map(function($arr){return $arr['nume'];}, $db_room_types);
    
    // verific daca tipul camerei alese de user e in tipurile camerelor din BD
    if(!in_array($room_type, $db_room_types)){
        $_SESSION['message'] = 'Invalid room type';
        header('Location: message.php');
        exit;
    }

    // calculez pretul total
    $roominfo = getRoomInfo($conn, $room_type);
    $price = $roominfo['pret'];
    $total = $_SESSION['booking_info']['nights'] * $price;

    // pun pretul total si tipul camerei alese in session
    $_SESSION['booking_info']['total'] = $total;
    $_SESSION['booking_info']['room_type'] = $room_type;

    header('Location: booking_confirmation.php');
    exit;
?>