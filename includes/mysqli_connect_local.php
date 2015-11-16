<?php
    // Database connect
    $db_connect = mysqli_connect('localhost', 'root', '', 'idabong');
    
    // If could not connect
    if(!$db_connect) {
        trigger_error("Could not connect to DB: " . mysqli_connect_error());
    } else {
        // utf-8 for Vietnamese
        mysqli_set_charset($db_connect, 'utf-8');
    }
?>