<?php
include('connect.php');

$username = $_POST['usernameInput'];
$pass = $_POST['passwordInput'];
$role = $_POST['role'];
$name = $_POST['nameInput'];
$birthday = $_POST['birthdayInput'];
$gender = $_POST['gender'];
$address = $_POST['addressInput'];
$phone = $_POST['phoneInput'];



// Hash password sebelum simpan
$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);


// Masukkan ke dalam database
$sql = "INSERT INTO user (username, password, phone_number, role, birthday, address, gender, name)
        VALUES ('$username', '$hashedPassword', '$phone', '$role', '$birthday', '$address', '$gender', '$name')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    echo "<meta http-equiv='refresh' content='2;URL=login.php'>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>