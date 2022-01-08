<?php
    if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        header('Location: login.php');
        exit;   
    }
    session_start();
    if(isset($_SESSION['loggedin'])){
        header('Location: index.php');
        exit;   
    }

    $email = $_POST['email'] ?? null;
    $pass  = $_POST['password'] ?? null;
    $captcha = $_POST['g-recaptcha-response'] ?? null;

    foreach([$email, $pass, $captcha] as $var){
        // nu sunt setate in POST
        if($var === null){
            header('Location: login.php');
            exit;   
        }
    }
    
    require_once './includes/model/connectDB.php';
    require_once './includes/model/user.model.php';
    require_once './includes/extra/captcha.php';

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

   

    // fac post request la google api si imi da JSON cu raspunsul daca e ok captcha
    $captcha_response = verify($captcha);
    // scot din JSON success
    $captcha_response = json_decode($captcha_response, true)['success'];
    // daca nu e ok
    if(!$captcha_response){
        $_SESSION['captcha_error'] = 'Please complete the CAPTCHA';
        $isOk = false;
    }

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

?>