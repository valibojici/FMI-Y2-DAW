<?php
    session_start();

    if(isset($_SESSION['loggedin'])){
        header('Location: index.php');
        exit;
    }

    require_once './includes/view/view.php';
    $view = new View();
    $view->assign('title', 'Login | Hillside Hotel');

    $view->assign('login_error', $_SESSION['login_error'] ?? null);
    $view->assign('login_email', $_SESSION['login_email'] ?? null);
    $view->assign('captcha_error', $_SESSION['captcha_error'] ?? null);

    $view->render('./includes/view/login.tpl.php');
    unset($_SESSION['login_error']);
    unset($_SESSION['login_email']);
    unset($_SESSION['captcha_error']);
?>

