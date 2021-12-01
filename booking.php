<?php
session_start();

    if(!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }

    require_once './view/view.php';
    $view = new View(['title' => 'Booking | Hillside Hotel']);

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        unset($_SESSION['booking_info']);
        unset($_SESSION['available_types']);
        unset($_SESSION['available_types_error']);
        $view->render('./view/booking.tpl.php');
        exit;
    }
    
     
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
        $guests = $_POST['guests'];

        require_once './extra/validations.php';
        require_once './model/connectDB.php';
        require_once './model/room.model.php';
        $conn = connectDB();

        $_SESSION['booking_info'] = ['checkin' => $checkin, 'checkout' => $checkout, 'guests' => $guests, 'nights' => $nights];

        if(validateDate($checkin) === false || validateDate($checkout) === false){
            $_SESSION['available_types_error'] = 1;
            header('Location: booking_results.php');
            exit;
        }

        $max_capac = getMaxRoomCapacity($conn);
        if($max_capac === null || intval($guests) > $max_capac['capacitate']){
            $_SESSION['available_types_error'] = 1;
            header('Location: booking_results.php');
            exit;
        }


        $types = getAvailableRoomTypes($conn, $checkin, $checkout, $guests);
        if($types === null){
            $_SESSION['available_types_error'] = 1;
            header('Location: booking_results.php');
            exit;
        }
        
        unset($_SESSION['available_types_error']);
        
        $types = array_map(function($arr){ return $arr['nume']; }, $types);
        $room_types_info = [];
        $checkin_date = new DateTime($checkin);
        $checkout_date = new DateTime($checkout);
        $nights = $checkout_date->diff($checkin_date)->format('%a');
        
        
        foreach($types as $type_name){
            $info = getRoomInfo($conn, $type_name); // intoarce ceva de genul ['nume' => ... , 'descriere' => ...];
            $room_types_info[$type_name] = $info;
            
            $imgs = getRoomImages($conn, $type_name); // intoarce [ ['path' => ...], ['path' => ...], .... ]    
            
            $room_types_info[$type_name]['imgs'] = array_map(function($arr){ return $arr['path']; }, $imgs);   
            $room_types_info[$type_name]['nopti'] = $nights;
            $room_types_info[$type_name]['total'] = $nights * $room_types_info[$type_name]['pret'];
        }
        
        
        $_SESSION['available_types'] = $room_types_info;
        header('Location: booking_results.php');
    }

?>