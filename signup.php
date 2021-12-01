<?php
    session_start();

    if(isset($_SESSION['loggedin'])){
        header('Location: index.php');
        exit;
    }

    require_once './view/view.php';
    $view = new View();
    $view->assign('title', 'Sign up | Hillside Hotel');

    $view->render('./view/signup.tpl.php');

    unset($_SESSION['fname_error']);
    unset($_SESSION['lname_error']);
    unset($_SESSION['phone_error']);
    unset($_SESSION['email_error']);
    unset($_SESSION['pass_error']);
?>

