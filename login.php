<?php
$login = false;
$showerr = false;


if($_SERVER['REQUEST_METHOD'] === 'POST') {

  include "partials/_dbconnect.php";

  $username = $_POST['username'];
  $password = $_POST['password'];


  $sql = "SELECT * FROM users WHERE username = '$username'";

  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);

  if($num == 1) {
    $row=mysqli_fetch_assoc($result);
    if(password_verify($password, $row['password'])) {
      $login = true;
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['username']  = $username;
      header("location: welcome.php");
    }
    else{
      $showerr = "Invaild username";
    }
  }
  else{
    $showerr = "Invaild username";
  }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php
    include "partials/_nav.php";
    ?>

    <?php

    if($login) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Sucess!</strong> You are logged in.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }

    ?>

    <?php

    if($showerr) {
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>ERROR!</strong> $showerr
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }

    ?>
    <div class="container mt-4">
        <h2 class="text-center">
            Login to our website
        </h2>

        <form action="login.php" method = "post">
            <div class="mb-3">
                <label for="username"  class="form-label">User Name</label>
                <input type="text" maxlength="11" class="form-control" id="username" name = "username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="23" class="form-control" name = "password" id="password">
            </div>
           
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>