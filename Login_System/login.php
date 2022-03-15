<?php
$login = false;
require "./partials/_dbconection.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $sql = "SELECT*FROM `admin` where `user_mail`='$email'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_num_rows($result);
  if ($row == 1) {
    while ($access = mysqli_fetch_assoc($result)) {
      $name = $access['user_name'];
      $hass_pass = $access['user_pass'];
      //   echo $access['user_pass'];
    }
    if (password_verify($pass, $hass_pass)) {
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['name'] = $name;
      $_SESSION['username'] = $email;
      header("location:welcome.php");
    }
  } else {
    $login = true;
  }
}
// $update_msg=false;
// if($_SERVER['REQUEST_METHOD']=='POST'){
//       $username=$_POST['forget_email'];
//       $forget_pass=$_POST['forget_password'];
//       $forget_pass = $_POST['Cforget_password'];
      
// }

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Login page</title>
</head>
<!-- Modal -->
<div class="modal fade" id="forget" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reset password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/Login_system/login.php" method="POST">
          <div class="mb-3 col-md-6">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="forget_email" class="form-control" id="email" aria-describedby="emailHelp" autocomplete="Off" required>
          </div>
          <div class="mb-3 col-md-6">
            <label for="pass" class="form-label">New Password</label>
            <input type="password" class="form-control" id="password" name="forget_password" required>
          </div>
          <div class="mb-3 col-md-6">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="cpassword" name="Cforget_password" required>
          </div>
          <button type="submit" class="btn btn-success">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<body>
  <?php
  require "./partials/_nav.php";
  ?>

  <?php
  if ($login) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>error !</strong> invalid credentials ,kindly check login.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
  }
  ?>
  <div class="container">
    <h1 class="text-center">login To Library</h1>
    <hr>
    <form action="/Login_system/login.php" method="POST">
      <div class="mb-3 col-md-6">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" id="email" autocomplete="Off" aria-describedby="emailHelp" required>
      </div>
      <div class="mb-3 col-md-6">
        <label for="pass" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <p class="my-2"> <a href="#" data-bs-toggle="modal" data-bs-target="#forget">Forget Password.?</a></p>
      <button type="submit" class="btn btn-primary">Login</button>
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