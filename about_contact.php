<?php 
    require_once './includes/view/view.php';
    $view = new View(['title' => 'About Us | Hillside Hotel']);
    $view->render('./includes/view/about.tpl.php');
?>