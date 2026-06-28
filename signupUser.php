<?php
require_once('connect.php');

$username = $_POST['usernameInput'];
$pass = $_POST['passwordInput'];
$role = $_POST['role'];
$name = $_POST['nameInput'];
$birthday = $_POST['birthdayInput'];
$gender = $_POST['gender'];
$address = $_POST['addressInput'];
$phone = $_POST['phoneInput'];
$bankAccount = $_POST['accInput'];
$profilePic = "images/iconuser.png";

$age = (new DateTime($birthday))->diff(new DateTime())->y;
if ($age < 16) {
    echo "<p style='text-align:center; color:red;'>You must be at least 16 years old to register.</p>";
    echo "<meta http-equiv='refresh' content='2;URL=signup.php'>";
    exit();
}


if (isset($_FILES['profileInput']) && $_FILES['profileInput']['error'] == 0)
    {
        $uploadDir = 'images/';
        $originalName = basename($_FILES['profileInput']['name']);
        $newFileName = uniqid('img_') . '_' . $originalName;
        $uploadPath = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES['profileInput']['tmp_name'], $uploadPath))
        {
            $profilePic = $uploadPath;
        }
        else 
        {
            echo "<p style='text-align:center; color:red;'>Image upload failed.</p>";
        }

    }
    


// Hash password sebelum simpan
$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);


// Masukkan ke dalam database
$sql = "INSERT INTO user (username, password, phone_number, role, birthday, address, gender, name, bank_account, user_image)
        VALUES ('$username', '$hashedPassword', '$phone', '$role', '$birthday', '$address', '$gender', '$name', '$bankAccount', '$profilePic')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    echo "<meta http-equiv='refresh' content='2;URL=login.php'>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>