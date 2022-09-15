<?php

include 'config.php';

error_reporting(0);

session_start();

if (isset ($_SESSION['username'])) {
  header("Location: index.php");
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    if ($password == $cpassword) {
      $sql = "SELECT * FROM registration WHERE email='$email'";
      $result  = mysqli_query($conn, $sql);
      if (!$result->num_rows > 0) {
        $sql = "INSERT INTO registration (username, email, password)
          VALUES ('$username', '$email', '$password')";
          $result = mysqli_query($conn, $sql);
          if ($result) {
            echo "<script>alert('User Registration Successful.')</script>";
            $username = "";
            $email ="";
            $_POST['password'] = "";
            $_POST['cpassword'] = "";
          } else {
            echo "<script>alert('Woops! Something went wrong..')</script>";
          }
          } else {
            echo "<script>alert('Email Already Exists.')</script>";
          }
  
    } else {
        echo "<script>alert('Password does not match.')</script>";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register to Login</title>
        <link rel="stylesheet" href="style.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css">
    </head>
    <body>
       <div class="container">
     <form class="login-email" action="" method="POST">
           <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
           <div class="input-group">
            <input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
           </div>
           <div class="input-group">
            <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
           </div>
           <div class="input-group">
            <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
           </div>
           <div class="input-group">
            <input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
           </div>
           <div class="input-group">
            <button name="submit" class="btn">Register</button>
           </div>
           <p class="login-register-text">Already have an account? <a href="index.php">Login Here.</a></p>
     </form>
       </div>
    </body>
</html>