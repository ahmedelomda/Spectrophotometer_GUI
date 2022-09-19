<?php

$l = 1;
$x1 = 87.67;
$x2 = 166;
$x3 = 51.36;
$A1 = 0.2519;
$A2 = 0.1675;
$A3 = 0.3459;

$C1 = $A1/($x1 * $l);
$C2 = $A2/($x2 * $l);
$C3 = $A3/($x3 * $l);


//serialize function converts data or variables to a storable format 
$serialized_A1 = serialize($A1);
$serialized_A2 = serialize($A2);
$serialized_A3 = serialize($A3);

$serialized_C1 = serialize($C1);
$serialized_C2 = serialize($C2);
$serialized_C3 = serialize($C3);


$connection = new mysqli("localhost","ESP32","esp32io.com","db_esp32");

// Check connection
if ($connection->connect_errno) {
    die("Error " . $connection->connect_error);
}else
{

   //
   $connection->query("insert into db_wlform (WL1, Wl2, Wl3, A1, A2, A3, C1, C2, C3)  
   VALUES
   ('{$_POST['WL1']}',
   '{$_POST['WL2']}', 
   '{$_POST['WL3']}',
   '{$serialized_A1}', 
   '{$serialized_A2}', 
   '{$serialized_A3}', 
   '{$serialized_C1}', 
   '{$serialized_C2}',
   '{$serialized_C3}')"
);
   
header("Location:index.php?data=success");
}


$connection->close();
?>


