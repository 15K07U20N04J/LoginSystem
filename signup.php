<?php

$login = false;
$showerr = false;


if($_SERVER["REQUEST_METHOD"] === "POST") {

    include "partials/_dbconnect.php";

    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $cnt = mysqli_num_rows($result);

    if($cnt == 0) {
        if($password == $cpassword) {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            // $sql = "INSERT INTO users ('username', 'password') VALUES ('$username', '$password')";
            $sql = "INSERT INTO `users` (`username`, `password`) VALUES ('$username', '$hash')";
    
            $result = mysqli_query($conn ,$sql);
    
            if($result) {
                $login = true;  
            }
        }
        else{
            $showerr = "Password do not match";
        }

    }
    else{
        $showerr = "Username already exist, please try to sign up with another user name";
    }

}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <?php
    include "partials/_nav.php";
    ?>

    <?php

    if($login) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Sucess!</strong> Your account is created and you can login.
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
            SignUp to our website
        </h2>

        <form action="signup.php" method = "post">
            <div class="mb-3">
                <label for="username"  class="form-label">User Name</label>
                <input type="text" maxlength="11" class="form-control" id="username" name = "username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="23" class="form-control" name = "password" id="password">
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" maxlength="23" class="form-control" name = "cpassword" id="cpassword">
                <div id="emailHelp" class="form-text">Make sure to type the same password.</div>  
            </div>
           
            <button type="submit" class="btn btn-primary">SignUp</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>