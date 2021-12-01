<?php

    session_start();

    if(!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }

    if(!isset($_SESSION['booking_info'])){
        header('Location: booking.php');
        exit;
    }

    require_once './view/view.php';

    $view = new View(['title' => 'Booking | Hillside Hotel']);
    if(isset($_SESSION['booking_error'])){
        $view->assign('booking_error', $_SESSION['booking_error']);
        $view->render('./view/message.tpl.php');
        exit;
    }
    
    $view->assign('checkin', formatDate($_SESSION['booking_info']['checkin']));
    $view->assign('checkout', formatDate($_SESSION['booking_info']['checkout']));
    $view->assign('guests', $_SESSION['booking_info']['guests']);
    $view->assign('nights', $_SESSION['booking_info']['nights']);
    $view->assign('room_type', $_SESSION['booking_info']['room_type']);
    $view->assign('total', $_SESSION['booking_info']['total']);
    $view->render('./view/confirm_booking.tpl.php');

    function formatDate($date){
        $date = new DateTime($date);
        return $date->format('d M Y');
    }
?>