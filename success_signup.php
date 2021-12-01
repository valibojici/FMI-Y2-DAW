<?php
    require_once './view/view.php';

    $view = new View(['title' => 'Signup | Hillside Hotel']);
    $view->assign('message', 'Success! You can now login!');
    $view->render('./view/message.tpl.php');
?>