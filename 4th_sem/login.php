<?php
require 'connection.php';
session_start();

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

    $data = $conn->query($sql);

    if($data->num_rows > 0)
    {
        $user=$data->fetch_assoc();
        // print_r($data);
        // print_r($data->fetch_assoc());
        $_SESSION['id'] = $user['id'];
        $_SESSION['un'] = $user['username'];
        $_SESSION['type'] = $user['type'];
        header('location: dashboard.php');
    }
    else
    {
        echo('<script>alert("Wrong Credentials")</script>');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>
<body>
<style>
    p {
      background-image: url('bg.JPG');
    }
    </style>
<div class="container">

    <?php
        include 'headernav.php';
    ?>

        <div class="row">
            <div class="col-6 offset-3">
                <form method="post">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control">
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="mb-3">
                    <input type="submit" name="login" value="Login" class="btn btn-primary">
                </div>

                </form>
            </div>
        </div>

        <?php
            include 'footer.php';
        ?>
    </div>

    <script src="js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>