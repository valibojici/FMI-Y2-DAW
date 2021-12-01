<?php

function connectDB(){
    require_once '../../.config/db.php'; // asta trb schimbat pe hosting
    return new mysqli($servername, $username, $password, $database);
}

?>