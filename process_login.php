<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = $_POST['email'];
        $pass  = $_POST['password'];
        
        require_once './includes/model/connectDB.php';
        require_once './includes/model/user.model.php';

        $conn = connectDB();
        
        // sterg useri neverificati de 15 minute
        deleteUnverifiedUsers($conn);

        $isOk = true;

        // iau info din bd despre util cu emailul introdus
        $user_info = getUserData($conn, $email);

        // daca nu exista util cu email, sau util nu e verificat => eroare
        if($user_info === null || $user_info['status'] == 0){
            $isOk = false;
        } else {
            // daca nu coincid parolele => eroare
            $db_pass = $user_info['parola'];
            if($db_pass === null || !password_verify($pass, $db_pass)){
                $isOk = false;
            }
        }

        session_start();
        if($isOk){
            // e ok, acum e logged in
            $_SESSION['loggedin'] = true;
            $_SESSION['user_email'] = $email;

            header('Location: index.php');
            exit;
        } else {
            // am avut o eroare
            $_SESSION['login_error'] = "wrong email or password";
            $_SESSION['login_email'] = $email;
            header('Location: login.php');
            exit;
        }
    }
 
?>