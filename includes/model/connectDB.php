<?php

function connectDB(){
    require_once $_SERVER['DOCUMENT_ROOT'] . '/.config/db.php';
    return new mysqli($servername, $username, $password, $database);
}

?>