<?php

$servername = "localhost";
$username = "ESP32";
$password = "esp32io.com";
$database_name = "db_esp32";

// Create MySQL connection from PHP to MySQL server

$connection = new mysqli($servername, $username, $password, $database_name);

// Check connection
if ($connection->connect_error) {
    die("MySQL connection failed: " . $connection->connect_error); //print and exit
}else
{

    $connection->query("INSERT INTO wl_scan (Start_WL, End_WL)  
    VALUES('{$_POST['Start_WL']}', 
        '{$_POST['End_WL']}')"
    );

    header("Location:index.php?data=success");
}

$connection->close();

?>
