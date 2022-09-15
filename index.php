<?php

include 'config.php';

session_start();

error_reporting(0);

if (isset ($_SESSION['username'])) {
    header("Location: welcome.php");
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM registration WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result ->num_rows > 0) {
       $row = mysqli_fetch_assoc($result);
       $_SESSION['username'] = $row['username'];
       header("Location: welcome.php");
    } else {
        echo "<script>alert('Email or password is incorrect.')</script>";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login to your account</title>
        <link rel="stylesheet" href="style.css">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css">
    </head>
    <body>
       <div class="container">
     <form class="login-email" action="" method="POST">
           <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
           <div class="input-group">
            <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
           </div>
           <div class="input-group">
            <input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
           </div>
           <div class="input-group">
            <button name="submit" class="btn">Login</button>
           </div>
           <p class="login-register-text">Don't have an account? <a href="registerer.php">Register Here.</a></p>
     </form>
       </div>
    </body>
</html>