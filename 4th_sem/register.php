<?php
require 'connection.php';
// if(isset($_GET['msg']))
//     echo('<script>alert("'. $_GET['msg'] .'")</script>');

if(isset($_POST['register']))
{
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
        echo('<script>alert("Password mismatch")</script>');
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

if(isset($_POST['update']))
{
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
        echo('<script>alert("Password mismatch")</script>');
    }

    else
    {
        $sql = "UPDATE users SET name='$name', email='$email', mobile='$mobile', password='$password', type='$type', status=$status WHERE id = $_GET[uid]";

        if($conn->query($sql))
        {
            echo('<script>alert("Update Successful")</script>');
        }
        else
        {
            die('Error: '. $conn->error);
        }
    }    
}

$user = ['name'=>'', 'email'=>'', 'mobile'=>'', 'username'=>'', 'password'=>'', 'type'=>'', 'status'=>false];

if(isset($_GET['uid']))
{
    $sql_single = "SELECT * FROM users WHERE id=$_GET[uid]";
    $single_user = $conn->query($sql_single);
    $user = $single_user->fetch_assoc();
}

if(isset($_GET['did']))
{
    $sql_delete = "DELETE FROM users WHERE id=$_GET[did]";

    if($conn->query($sql_delete))
    {
        echo('<script>alert("User Deleted")</script>');
    }
    else
    {
        die('Error: '. $conn->error);
    }
}

$sql_users = "SELECT * FROM users";
$data = $conn->query($sql_users);

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
   
    <div class="container">

        <?php
            include 'headernav.php';
        ?>

        <div class="row">
            <div class="col-6 offset-3">
                <form action="" method="post">
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" pattern="/^[a-zA-Z]+$/" class="form-control" value="<?php if(isset($_GET['uid'])) echo $user['name'] ?>" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $user['email'] ?>">
                </div>

                <div class="mb-3">
                    <label>Mobile</label>
                    <input type="number" name="mobile" class="form-control"
                    min="9700000000" max="9999999999" value="<?php echo $user['mobile'] ?>">
                </div>

                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" value="<?php echo $user['username'] ?>">
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="<?php echo $user['password'] ?>">
                </div>

                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="cpassword" class="form-control" value="<?php echo $user['password'] ?>">
                </div>

                <div class="mb-3">
                    <label>Type</label>
                    <select name="type" class="form-select">
                        <option value="Admin" <?php if($user['type'] == 'Admin') {echo 'selected';} ?>>Admin</option>
                        <option value="Staff" <?php if($user['type'] == 'Staff') {echo 'selected';} ?>>Staff</option>
                        <option value="Faculty" <?php if($user['type'] == 'Faculty') {echo 'selected';} ?>>Faculty</option>
                        <option value="Student" <?php if($user['type'] == 'Student') {echo 'selected';} ?>>Student</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <input type="radio" value="1" name="status" id="active" <?php if($user['status']) {echo 'checked';} ?>>
                    <label for="active">Active</label>
                    <input type="radio" value="0" name="status" id="inactive" <?php if(!$user['status']) {echo 'checked';} ?>>
                    <label for="inactive">Inactive</label>
                </div>

                <div class="mb-3">
                    <input type="submit" name="register" value="Register" class="btn btn-primary">

                    <input type="submit" name="update" value="Update" class="btn btn-primary">
                </div>

                </form>
            </div>
        </div>
        
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Mobile</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                    while($row=$data->fetch_assoc())
                    {
                        echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['username']."</td>";
                        echo "<td>".$row['mobile']."</td>";
                        echo "<td>".$row['type']."</td>";
                        echo "<td>".$row['status']."</td>";
                        echo "<td><a href='register.php?uid=". $row['id'] ."' class='btn btn-primary btn-sm'>Edit</a></td>";
                        echo "<td><a href='register.php?did=". $row['id'] ."' class='btn btn-danger btn-sm' onclick='return confirm(`Are your sure?`)'>Delete</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </table>
            </div>
        </div>

        <?php
            include 'footer.php';
        ?>
    </div>

    <script src="js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>