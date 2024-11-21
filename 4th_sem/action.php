<?php
if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $type = $_POST['type'];
    $status = $_POST['status'];

    if($password !== $cpassword)
    {
        header('location: register.php?msg=Password Mismatch');
    }

    else
    {
        $sql = "INSERT INTO users VALUES (null, '$name', '$email', '$mobile', '$username', '$password', '$type', $status)";

        if($conn->query($sql))
        {
            echo('<script>alert("Registration Successful")</script>');
        }
        else
        {
            die('Error: '. $conn->error);
        }
    }
}

if(isset($_POST['login'])){}

if(isset($_POST['addProduct'])){}

if(isset($_POST['addToCart'])){}

if(isset($_POST['addAssignment'])){}
