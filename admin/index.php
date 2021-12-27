<?php
    session_start();

    if(!isset($_SESSION['admin'])){
        header('Location: login.php');
        exit;
    }

    include '../includes/view/view.php';
    $view = new View(['title' => 'Admin']);

    $view->assign('tables',  $_SESSION['admin']['tables'] ?? []);
    $view->assign('permissions', $_SESSION['admin']['permissions'] ?? []);
    $view->assign('username', $_SESSION['admin']['userinfo']['username'] ?? '');

    if(isset($_SESSION['access_table_error'])){
        $view->assign('error', "table doesn't exist or you dont have permission to view it");
        unset($_SESSION['access_table_error']);
    }
    $view->assign('username', $_SESSION['admin']['userinfo']['username'] ?? '');

    $view->render('../includes/view/admin/home.tpl.php');

    // sterg alegerea tabelului daca a mai fost facuta
    unset($_SESSION['admin']['table']);
?>