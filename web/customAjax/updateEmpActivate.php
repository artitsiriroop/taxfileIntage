<?php
/**
 * Created by PhpStorm.
 * User: artit-s
 * Date: 2560-06-12
 * Time: 15:15
 */

$servername = "localhost";
$username = "intagedb";
$password = "password";

// Create connection
$mysqli = @new mysqli('127.0.0.1', 'newuser', 'Manifold1@@', 'intagedb');

if ($mysqli->connect_errno) {
    echo  json_encode($mysqli->connect_errno);
   // die('Connect Error: ' . $mysqli->connect_errno);
}else{
    echo  json_encode('success');
}


$conn->close();
