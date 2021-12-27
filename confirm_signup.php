<?php
    if($_SERVER['REQUEST_METHOD'] !== 'GET'){
        header('Location: index.php');
        exit;
    }

    session_start();
    $email = $_GET['email'] ?? null;
    $hash = $_GET['hash'] ?? null;

    require_once './includes/view/view.php';
    $view = new View(['title' => 'Confirm account | Hillside Hotel']);

    // daca nu sunt in URL
    if($email === null || $hash == null){
        $_SESSION['message'] = 'Missing URL parameters';
        header('Location: message.php');
        exit;
    }
     
    // altfel verific sa existe email si hashul din URL
    require_once './includes/model/connectDB.php';
    require_once './includes/model/user.model.php';
    
    $conn = connectDB();

    // sterg si aici useri neverificati
    deleteUnverifiedUsers($conn);

    $user_info = getUserData($conn, $email);

    // daca nu exista emailul
    if($user_info === null){
        $_SESSION['message'] = 'Invalid email or hash value';
        header('Location: message.php');
        exit;
    }

    $signup_info = $email . $user_info['parola'] . 'nk*C6c6@h2-jc932;.L';
    $verify_hash = password_verify($signup_info, $hash);

    if(!$verify_hash){
        $_SESSION['message'] = 'Invalid email or hash value';
        header('Location: message.php');
        exit;
    } 

    if(!verifyUser($conn, $email)){
        $_SESSION['message'] = 'Cannot confirm account or account is already confirmed.';
        header('Location: message.php');
        exit;
    }

    $_SESSION['message'] = 'Account verified! You can now login!';
    header('Location: message.php');
?>