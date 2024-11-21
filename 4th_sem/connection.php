<?php
$server = 'localhost';
$user = 'root';
$password = '';
$database = 'thrift';

$conn = new mysqli($server, $user, $password, $database);

if($conn->connect_error)
{
    die('Connection Failed: '. $conn->connect_error);
}
