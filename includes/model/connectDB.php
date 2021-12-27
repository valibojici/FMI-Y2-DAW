<?php

function connectDB(){
    // require_once '../../.config/db.php'; // asta trb schimbat pe hosting
    require_once 'D:/web/Apache24/.config/db.php';
    return new mysqli($servername, $username, $password, $database);
}

?>