<?php 
    session_start();

    if(!isset($_SESSION['message'])){
        header('Location: index.php');
        exit;
    }

    require_once './includes/view/view.php';
    $view = new View(['title' => 'Hillside Hotel']);
    $view->assign('message', $_SESSION['message']);
    $view->render('./includes/view/message.tpl.php');
?>