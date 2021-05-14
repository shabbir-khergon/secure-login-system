<?php

$alert = false;
$error = false;
$exists= false;
if($_SERVER["REQUEST_METHOD"]== "POST") {

    include 'components/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmpass = $_POST["confirmpass"];
    
    $existSql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExistsRows = mysqli_num_rows($result);
    if($numExistsRows > 0) {
        $exists = true;
    }
    else {
        if($password == $confirmpass) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql="INSERT INTO `users`( `username`, `password`, `date`) VALUES ('$username', '$hash',  CURRENT_TIMESTAMP())";
            $result = mysqli_query($conn, $sql);
            if($result) {
                $alert = true;
            }
        }
        else {
            $error = true;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <title>Sign Up Page</title>
    
  </head>
  <body>
  <?php require 'components/_nav.php' ?>
    <?php
       if($alert) {
       echo '<div class="alert alert-success alert-dismissible fade show" role="alert ">
        <strong>Welcome!</strong> You have successfully signed Up on our website . Login Again.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
       }

       if($exists) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert ">
         Sorry your username already exists ! try another username
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
        }

       if($error) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert ">
         Sorry your password do not match please retype your passwprd carefully
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
        }
    ?>
    <div class="container" align="center">
    
        <h1 class="text-center my-4">Sign Up to Our website</h1>
        <form action="/loginsystem/signup.php " method="post">
            <div class="mb-3 col-md-6 my-5">
                <label for="username" class="form-label"><h3>Username</h3></label>
                <input type="text" maxlength="11" class="form-control" id="username" name="username" aria-describedby="username" placeholder="Your Username">
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label"><h3>Password</h3></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="your Password">
            </div>
            <div class="mb-3 col-md-6">
                <label for="confirmpass" class="form-label"><h3>Confirm Password</h3></label>
                <input type="password" class="form-control" id="confirmpass" name="confirmpass" placeholder="Confirm your Password">
                <div id="passwarning" class="form-text">make sure your password is correctly entered.</div>
            </div>
            <button type="submit" class="btn btn-primary col-md-6">Sign Up</button>
        </form>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->
  </body>
</html>