<?php
session_start();

if(!isset($_SESSION['id']))
{
    header('location: login.php');
}
// if(isset($_SESSION['type']) !== 'Admin')
// {
//     header('location: login.php');
// }
// if(isset($_SESSION['type']) === 'Student')
// {
//     header('location: login.php');
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>Dashboard</h1>
</body>
</html>