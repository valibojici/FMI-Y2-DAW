<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = $_POST['email'];
        $pass  = $_POST['password'];
        
        require_once './includes/model/connectDB.php';
        require_once './includes/model/user.model.php';

        $conn = connectDB();

        session_start();
        
        $isOk = true;

        $db_pass = getUserPassword($conn, $email);
        if($db_pass === null || !password_verify($pass, $db_pass)){
            $isOk = false;
        }
    
        if($isOk){
            $_SESSION['loggedin'] = true;
            $_SESSION['user_email'] = $email;

            header('Location: index.php');
            exit;
        } else {
            
            $_SESSION['login_error'] = "wrong email or password";
            header('Location: login.php');
            exit;
        }
    }
 
?>