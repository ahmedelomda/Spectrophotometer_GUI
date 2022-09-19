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
}

$data = $connection->query("select * from db_wlform");

while($row = $data -> fetch_assoc())
{
   echo "<tr>";
   echo "<td>{$row['WL1']}</td>";
   echo "<td>{$row['Wl2']}</td>";
   echo "<td>{$row['Wl3']}</td>";
   echo "<td>{$row['A1']}</td>";
   echo "<td>{$row['A2']}</td>";
   echo "<td>{$row['A3']}</td>";
   echo "<td>{$row['C1']}</td>";
   echo "<td>{$row['C2']}</td>";
   echo "<td>{$row['C3']}</td>"; 
   echo "</tr>";
}

$connection->close();

?>
