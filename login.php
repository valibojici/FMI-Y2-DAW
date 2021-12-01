<?php
    session_start();

    if(isset($_SESSION['loggedin'])){
        header('Location: index.php');
        exit;
    }

    require_once './view/view.php';
    $view = new View();
    $view->assign('title', 'Login | Hillside Hotel');

    $view->render('./view/login.tpl.php');

    unset($_SESSION['login_error']);
?>

