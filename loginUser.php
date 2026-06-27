<?php
session_start();

require_once('connect.php');

if (!isset($_SESSION['username']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['password'] = $_POST['password'];
}

if (isset($_SESSION['username'], $_SESSION['password'])) {
    $username = $_SESSION['username'];
    $input_password = $_SESSION['password'];

    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query(query: $sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if (password_verify($input_password, $user['password'])) {
            $_SESSION['role'] = $user['role'];
            $currentTab = 'progress.php';
            include("progress.php");
        } else {
            echo "Login Fail: Wrong Password";
            session_unset();
            echo "<meta http-equiv='refresh' content='2;URL=login.php'>";
        }
    } else {
        echo "Login Fail: Username Not Existed";
        session_unset();
        echo "<meta http-equiv='refresh' content='2;URL=login.php'>";
    }
}
?>