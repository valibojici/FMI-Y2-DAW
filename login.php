<?php
    session_start();

    if(isset($_SESSION['loggedin'])){
        header('Location: index.php');
        exit;
    }

    require_once './includes/view/view.php';
    $view = new View();
    $view->assign('title', 'Login | Hillside Hotel');

    $view->render('./includes/view/login.tpl.php');

    unset($_SESSION['login_error']);
?>

