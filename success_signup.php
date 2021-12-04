<?php
    require_once './includes/view/view.php';

    $view = new View(['title' => 'Signup | Hillside Hotel']);
    $view->assign('message', 'Success! You can now login!');
    $view->render('./includes/view/message.tpl.php');
?>