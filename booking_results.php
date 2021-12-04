<?php
    session_start();

    if(!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }
    require_once './includes/view/view.php';
    $view = new View(['title' => 'Booking | Hillside Hotel']);

    if(!isset($_SESSION['booking_info'])){
        header('Location: booking.php');
        exit;
    }

    if(isset($_SESSION['available_types_error'])){
        $view->assign('available_types_error', true);
        $view->render('./includes/view/booking.tpl.php');
        exit;
    }
    
    $view->assign('booking_info', $_SESSION['booking_info']);
    $view->assign('available_types', $_SESSION['available_types']);
    $view->render('./includes/view/booking.tpl.php');
?>