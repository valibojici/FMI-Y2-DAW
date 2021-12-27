<?php
    session_start();

    if(isset($_SESSION['loggedin'])){
        header('Location: index.php');
        exit;
    }

    require_once './includes/view/view.php';
    $view = new View();
    $view->assign('title', 'Sign up | Hillside Hotel');

    $view->assign('fname', $_SESSION['signup_fname'] ?? null);
    $view->assign('lname', $_SESSION['signup_lname'] ?? null);
    $view->assign('email', $_SESSION['signup_email'] ?? null);
    $view->assign('phone', $_SESSION['signup_phone'] ?? null);

    $view->assign('fname_error', $_SESSION['fname_error'] ?? null);
    $view->assign('lname_error', $_SESSION['lname_error'] ?? null);
    $view->assign('email_error', $_SESSION['email_error'] ?? null);
    $view->assign('phone_error', $_SESSION['phone_error'] ?? null);
    $view->assign('pass_error', $_SESSION['pass_error'] ?? null);
    $view->assign('captcha_error', $_SESSION['captcha_error'] ?? null);
    
    $view->render('./includes/view/signup.tpl.php');

    foreach(['fname', 'lname', 'email', 'phone', 'captcha', 'pass'] as $field){
        unset($_SESSION['signup_' . $field]); // gen unset($_SESSION['signup_fname'])
        unset($_SESSION[$field . '_error']); // gen unset($_SESSION['fname_error'])
    }
?>

