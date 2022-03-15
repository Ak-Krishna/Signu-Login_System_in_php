<?php
$alertmsg = false;
$pass = false;
$errormsg = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "./partials/_dbconection.php";
    $username = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $userEntry = "SELECT*FROM `admin` where `user_mail`='$email'";
    $result = mysqli_query($conn, $userEntry);
    $data = mysqli_num_rows($result);
    if ($data > 0) {
        $errormsg = true;
    } else {
        if ($pass == $cpass) {
            $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `admin`(`user_name`,`user_mail`,`user_pass`)values('$username','$email','$hash_pass')";
            $result = mysqli_query($conn, $sql);
            $alertmsg = true;
        } else {
            $pass = true;
        }
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Signup page</title>
</head>

<body>
    <?php
    require "./partials/_nav.php";

    if ($alertmsg) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>success !</strong> Your account created successfully please login.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
    } elseif ($errormsg) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>error !</strong> This email id is already exists please kindly login.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
    } elseif ($pass) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>password mismatch !</strong> kindly check your password .
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
    }
    ?>
    <div class="container my-4">
        <h1 class="text-center">Signup To Library</h1>
        <hr>
        <form action="/Login_system/signup.php" method="POST">
            <div class="mb-3 col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" autocomplete="Off" required>
            </div>
            <div class="mb-3 col-md-6">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" autocomplete="Off" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3 col-md-6">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" autocomplete="Off" required>
            </div>
            <div class="mb-3 col-md-6">
                <label for="cpass" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpass" name="cpassword" autocomplete="Off" required>
            </div>
            <button type="submit" class="btn btn-primary">SignUp</button>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>