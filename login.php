<?php
session_start();
if (isset($_SESSION['username']))
  {
    $_SESSION = array();
    session_destroy();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="login-style.css">

    <style>@import url('https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap');</style>

</head>

<body id="backgroundColor">

    <header>
    <div class="imgLogo"><img src="images/logo.svg" alt="Hustle Logo"></div>
    </header>

    <div id="formGroup">

        <div class="imgIcon">
            <img src="images/iconuser.png" alt="User Icon"> 
        </div>

        <h1>Log in Hustle</h1>

        <form action="loginUser.php" method="POST">

            <div class="formSection">
                <label>Username</label>
                <input type="text" id="nameInput" name="username" required placeholder="Username">
            </div>

            <div class="formSection">
                <label>Password</label>
                <input type="password" id="passwordInput" name="password" required placeholder="Password">
            </div>

            <button type="submit">Log In</button>

        </form>

        <h2>Don't have an account? <a href="signup.html">Sign Up</a></h2>

    </div>
</body>
</html>