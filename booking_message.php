<?php
    session_start();

    if(!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }

    if(!isset($_SESSION['booking_message'])){
        header('Location: booking.php');
        exit;
    }

    require_once './includes/view/view.php';

    $view = new View(['title' => 'Booking | Hillside Hotel']);
    $view->assign('message', $_SESSION['booking_message']);
    $view->render('./includes/view/message.tpl.php');
?>