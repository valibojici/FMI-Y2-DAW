<?php
session_start();

    if(!isset($_SESSION['loggedin'])){
        header('Location: login.php');
        exit;
    }

    require_once './includes/view/view.php';
    $view = new View(['title' => 'Booking | Hillside Hotel']);

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        unset($_SESSION['booking_info']);
        unset($_SESSION['available_types']);
        unset($_SESSION['available_types_error']);

        require_once './includes/model/connectDB.php';
        require_once './includes/model/room.model.php';
        $conn = connectDB();
        $max_guests = getMaxRoomCapacity($conn);
        $min_guests = getMinRoomCapacity($conn);
        $view->assign('max_guests', $max_guests['capacitate'] ?? 0);
        $view->assign('min_guests', $min_guests['capacitate'] ?? 0);
        $view->render('./includes/view/booking.tpl.php');
        exit;
    }
    
     
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        $checkin = $_POST['checkin'] ?? null;
        $checkout = $_POST['checkout'] ?? null;
        $guests = $_POST['guests'] ?? null;

        if($checkin == null || $checkout == null || $guests == null){
            header('Location: booking.php');
            exit;
        }

        // salvez input in session
        $_SESSION['booking_info'] = ['checkin' => $checkin, 'checkout' => $checkout, 'guests' => $guests];

        require_once './includes/extra/validations.php';
        require_once './includes/model/connectDB.php';
        require_once './includes/model/room.model.php';
        $conn = connectDB();

        // verific daca check in si check out au forma corecta
        if(validateDate($checkin) === false || validateDate($checkout) === false){
            $_SESSION['available_types_error'] = 1;
            header('Location: booking_results.php');
            exit;
        }

        // verific daca checkout > checkin
        if(strtotime($checkout) <= strtotime($checkin)){
            $_SESSION['available_types_error'] = 1;
            header('Location: booking_results.php');
            exit;
        }

        // verific daca checkout <= now + 1 an
        if(strtotime($checkout) > strtotime('+365 day')){
            $_SESSION['available_types_error'] = 1;
            header('Location: booking_results.php');
            exit;
        }

        // verific capacitatea camerei sa fie ok
        $max_capac = getMaxRoomCapacity($conn);
        if($max_capac === null || intval($guests) > $max_capac['capacitate'] || intval($guests) <= 0){
            $_SESSION['available_types_error'] = 1;
            header('Location: booking_results.php');
            exit;
        }

        // iau tipurile de camere disponibile
        $types = getAvailableRoomTypes($conn, $checkin, $checkout, $guests);
        if($types === null){
            // daca nu exista camere disp
            $_SESSION['available_types_error'] = 1;
            header('Location: booking_results.php');
            exit;
        }
        
        unset($_SESSION['available_types_error']);
        
        $types = array_map(function($arr){ return $arr['nume']; }, $types); // altfel aveam [ [...], [...] ]
        $room_types_info = [];

        $checkin_date = new DateTime($checkin);
        $checkout_date = new DateTime($checkout);
        $nights = $checkout_date->diff($checkin_date)->format('%a');

        $_SESSION['booking_info']['nights'] = $nights;
        
        foreach($types as $type_name){
            $info = getRoomInfo($conn, $type_name); // intoarce ceva de genul ['nume' => ... , 'descriere' => ...];
            $room_types_info[$type_name] = $info;
            
            $imgs = getRoomImages($conn, $type_name); // intoarce [ ['path' => ...], ['path' => ...], .... ]    
            $imgs = $imgs !== null ? array_map(function($arr){ return $arr['path']; }, $imgs) : [];
            $room_types_info[$type_name]['imgs'] = $imgs;
            
            $room_types_info[$type_name]['nights'] = $nights;
            $room_types_info[$type_name]['total'] = $nights * $room_types_info[$type_name]['pret'];
        }
        
        $_SESSION['available_types'] = $room_types_info;
        header('Location: booking_results.php');
    }

?>