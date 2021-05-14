<?php

$login = false;
$error = false;
if($_SERVER["REQUEST_METHOD"]== "POST") {

    include 'components/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];

    // $sql="SELECT * FROM `users` WHERE username = '$username' AND password = '$password'";
    $sql="SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1) {
      while($row=mysqli_fetch_assoc($result)) {
        if (password_verify($password,$row['password'])){
          $login = true;
          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['username'] = $username;
          header("location: welcome.php");
        }
        else {
          $error = "Invalid Password";
      }
      }
    }
    else {
        $error = "Invalid Password";
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

    <title>Login Page</title>
    
  </head>
  <body>
  <?php require 'components/_nav.php' ?>
    <?php
       if($login) {
       echo '<div class="alert alert-success alert-dismissible fade show" role="alert ">
        <strong>Welcome!</strong> You have successfully Logged In  on our website . Welcome.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
       }

       if($error) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert ">
         Sorry '.$error.'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
        }
    ?>
    <div class="container" align="center">
    
        <h1 class="text-center my-4">Log In Page</h1>
        <form action="/loginsystem/login.php " method="post">
            <div class="mb-3 col-md-6 my-5">
                <label for="username" class="form-label"><h3>Username</h3></label>
                <input type="text" maxlength="11" class="form-control" id="username" name="username" aria-describedby="username" placeholder="Your Username">
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label"><h3>Password</h3></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="your Password">
            </div>
            <button type="submit" class="btn btn-primary col-md-6">Log In</button>
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