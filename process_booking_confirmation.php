<?php
    # aici ajung dupa ce clientul introduce datele din card

    session_start();

    if(!$_SESSION['loggedin']){
        header('Location: login.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        if(!isset($_SESSION['booking_info'])){
            header('Location: booking.php');
            exit;
        }

        $card = trim($_POST['card']);
        $month = trim($_POST['month']);
        $year = trim($_POST['year']);
        $cvv = trim($_POST['cvv']);

        require_once './includes/extra/validations.php';
        $isOk = true;

        $isOk &= validateCardNumber($card) === true;
        $isOk &= validateCardYear($year) === true ;
        $isOk &= validateCardMonth($month) === true ;
        $isOk &= validateCardCVV($cvv) === true;
        
        $isOk &= (intval($year) > date('Y') || intval($year) == date('Y') && intval($month) > date('m'));

        require_once './includes/view/view.php';
        $view = new View(['title' => 'Processing Booking | Hillside Hotel']);

        if(!$isOk || !maPrefacCaTestezCardul($card, $month, $year, $cvv)){
            $view->assign('message', 'Error: invalid credit card');
            $view->render('./includes/view/message.tpl.php');
            exit;
        }

        $checkin = $_SESSION['booking_info']['checkin'];
        $checkout = $_SESSION['booking_info']['checkout'];
        $guests = $_SESSION['booking_info']['guests'];
        $nights = $_SESSION['booking_info']['nights'];
        $room_type = $_SESSION['booking_info']['room_type'];
        $total = $_SESSION['booking_info']['total'];

        require_once './includes/model/connectDB.php';
        require_once './includes/model/reservation.model.php';
        $conn = connectDB();

        $ok = makeReservation($conn, $_SESSION['user_email'], $room_type, $checkin, $checkout, $guests, $total);

        unset($_SESSION['booking_info']);
        unset($_SESSION['room_types']);

        if($ok){
            maPrefacCaFacPlata($card, $month, $year, $cvv, $total);
            $_SESSION['booking_message'] = 'Booking confirmed!';
        } else {
            $_SESSION['booking_message'] = 'The room type is not available anymore and payment has not been done, please book again.';
        }
        
        header('Location: booking_message.php');
        exit;
    }


    function maPrefacCaTestezCardul($card, $month, $year, $cvv){
        return true;
    }

    function maPrefacCaFacPlata($card, $month, $year, $cvv, $total){
        return true;
    }
?>