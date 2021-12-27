<?php
    session_start();

    if(!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }
    require_once './includes/view/view.php';
    $view = new View(['title' => 'Booking | Hillside Hotel']);

    require_once './includes/model/connectDB.php';
    require_once './includes/model/room.model.php';
    $conn = connectDB();
    $max_guests = getMaxRoomCapacity($conn);
    $min_guests = getMinRoomCapacity($conn);
    $view->assign('max_guests', $max_guests['capacitate'] ?? 0);
    $view->assign('min_guests', $min_guests['capacitate'] ?? 0);

    // daca nu sunt camere disp se afis eroare
    if(isset($_SESSION['available_types_error'])){
        $view->assign('available_types_error', 1);
        $view->assign('booking_info', $_SESSION['booking_info']);
        $view->render('./includes/view/booking.tpl.php');
        exit;
    }
    
    // daca nu este setata din booking.php
    if(!isset($_SESSION['booking_info']) || !isset($_SESSION['available_types'])){
        header('Location: booking.php');
        exit;
    }
    
    $view->assign('booking_info', $_SESSION['booking_info']);
    $view->assign('available_types', $_SESSION['available_types']);
    $view->render('./includes/view/booking.tpl.php');
?>