<?php
    # aici ajung de la process_booking.php
    session_start();

    if(!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }

    // daca nu a trecut prin booking.php sau process_booking.php
    if(!isset($_SESSION['booking_info']) || !isset($_SESSION['booking_info']['total'])){
        header('Location: booking.php');
        exit;
    }

    require_once './includes/view/view.php';
    require_once './includes/extra/curs.php';
    $curs = getCurs();

    $view = new View(['title' => 'Booking | Hillside Hotel']);


    $view->assign('checkin', formatDate($_SESSION['booking_info']['checkin']));
    $view->assign('checkout', formatDate($_SESSION['booking_info']['checkout']));
    $view->assign('guests', $_SESSION['booking_info']['guests']);
    $view->assign('nights', $_SESSION['booking_info']['nights']);
    $view->assign('room_type', $_SESSION['booking_info']['room_type']);
    $view->assign('total', $_SESSION['booking_info']['total']);

    $view->assign('exchange_rates', $curs);
    
    $view->render('./includes/view/confirm_booking.tpl.php');

    function formatDate($date){
        $date = new DateTime($date);
        return $date->format('d M Y');
    }
?>