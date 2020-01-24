<?php

$cad = getopt("u:p:h:");
if ((isset($cad['h'])) && isset($cad['u']) && isset($cad['p'])) {

    // Create connection
    $conn = new mysqli($cad['h'], $cad['u'], $cad['p']);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}