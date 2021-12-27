<?php
    session_start();

    if(isset($_SESSION['admin'])){
        header('Location: index.php');
        exit;
    }

    include '../includes/view/view.php';

    $view = new View(['title' => 'Admin Login']);

    if(isset($_SESSION['admin_login_error'])){
        $view->assign('login_error', 'incorrect username or password');
    }
    $view->render('../includes/view/admin/login.tpl.php');
    unset($_SESSION['admin_login_error']);
?>