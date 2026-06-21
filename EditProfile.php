<?php 
// Mesti diletakkan di baris pertama untuk mengaktifkan memori session
session_start(); 

// 1. Semak peranan (role) pengguna daripada session
$role = isset($_SESSION['role']) ? strtolower($_SESSION['role']) : 'worker';

// 2. Ambil data sedia ada dari session berdasarkan role untuk dimasukkan ke dalam value input
if ($role === 'admin') {
    $name     = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : '';
    $birthday = isset($_SESSION['admin_birthday']) ? $_SESSION['admin_birthday'] : '';
    $gender   = isset($_SESSION['admin_gender']) ? $_SESSION['admin_gender'] : '';
    $address  = isset($_SESSION['admin_address']) ? $_SESSION['admin_address'] : '';
    $phone    = isset($_SESSION['admin_phone']) ? $_SESSION['admin_phone'] : '';
    $role_title = "Admin";

} elseif ($role === 'owner') {
    $name     = isset($_SESSION['owner_name']) ? $_SESSION['owner_name'] : '';
    $birthday = isset($_SESSION['owner_birthday']) ? $_SESSION['owner_birthday'] : '';
    $gender   = isset($_SESSION['owner_gender']) ? $_SESSION['owner_gender'] : '';
    $address  = isset($_SESSION['owner_address']) ? $_SESSION['owner_address'] : '';
    $phone    = isset($_SESSION['owner_phone']) ? $_SESSION['owner_phone'] : '';
    $role_title = "Owner";

} else { // Worker
    $name     = isset($_SESSION['worker_name']) ? $_SESSION['worker_name'] : '';
    $birthday = isset($_SESSION['worker_birthday']) ? $_SESSION['worker_birthday'] : '';
    $gender   = isset($_SESSION['worker_gender']) ? $_SESSION['worker_gender'] : '';
    $address  = isset($_SESSION['worker_address']) ? $_SESSION['worker_address'] : '';
    $phone    = isset($_SESSION['worker_phone']) ? $_SESSION['worker_phone'] : '';
    $bank     = isset($_SESSION['worker_bank']) ? $_SESSION['worker_bank'] : '';
    $role_title = "Worker";
}

// 3. Proses simpan data apabila butang "Save Changes" ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($role === 'admin') {
        $_SESSION['admin_name']     = $_POST['nameInput'];
        $_SESSION['admin_birthday'] = $_POST['birthdayInput'];
        $_SESSION['admin_gender']   = isset($_POST['gender']) ? $_POST['gender'] : '';
        $_SESSION['admin_address']  = $_POST['addressInput'];
        $_SESSION['admin_phone']    = $_POST['phoneInput'];

    } elseif ($role === 'owner') {
        $_SESSION['owner_name']     = $_POST['nameInput'];
        $_SESSION['owner_birthday'] = $_POST['birthdayInput'];
        $_SESSION['owner_gender']   = isset($_POST['gender']) ? $_POST['gender'] : '';
        $_SESSION['owner_address']  = $_POST['addressInput'];
        $_SESSION['owner_phone']    = $_POST['phoneInput'];

    } else { // Worker
        $_SESSION['worker_name']     = $_POST['nameInput'];
        $_SESSION['worker_birthday'] = $_POST['birthdayInput'];
        $_SESSION['worker_gender']   = isset($_POST['gender']) ? $_POST['gender'] : '';
        $_SESSION['worker_address']  = $_POST['addressInput'];
        $_SESSION['worker_phone']    = $_POST['phoneInput'];
        $_SESSION['worker_bank']     = $_POST['bankInput'];
    }
    
    // Auto-redirect balik ke halaman profil tunggal kita
    header("Location: profile.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit <?php echo $role_title; ?> Profile - Hustle</title>
    <link rel="stylesheet" href="personal-style.css?v=2" type="text/css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap');
    </style>
</head>

<body id="backgroundColor">

    <div id="formGroup">

        <div class="imgIcon">
            <img src="images/iconuser.png" alt="User Icon">
        </div>

        <h1>Personal Information</h1>

        <form method="POST" action="">

            <div class="formSection">
                <label>Full name</label>
                <input type="text" id="nameInput" name="nameInput" required placeholder="e.g. Amelia Henderson" 
                       value="<?php echo htmlspecialchars($name); ?>">
            </div>

            <div class="formSection">
                <label>Birthday</label>
                <input type="date" id="birthdayInput" name="birthdayInput" required 
                       value="<?php echo htmlspecialchars($birthday); ?>">
            </div>

            <div class="formGender">
                <label>Gender</label>
                <div class="radioGroup">
                    <input type="radio" name="gender" id="male" value="Male" 
                           <?php echo ($gender == 'Male') ? 'checked' : ''; ?>> 
                    <span class="radio-text">Male</span>
                    
                    <input type="radio" name="gender" id="female" value="Female" 
                           <?php echo ($gender == 'Female') ? 'checked' : ''; ?>> 
                    <span class="radio-text">Female</span>
                </div>
            </div>

            <div class="formSection">
                <label>Full address</label>
                <input type="text" id="addressInput" name="addressInput" required 
                       value="<?php echo htmlspecialchars($address); ?>">
            </div>

            <div class="formSection">
                <label>Phone number</label>
                <input type="text" id="phoneInput" name="phoneInput" required placeholder="e.g. +0123456789" 
                       value="<?php echo htmlspecialchars($phone); ?>">
            </div>

            <?php if ($role === 'worker'): ?>
                <div class="formSection">
                    <label>Bank Account</label>
                    <input type="text" id="bankInput" name="bankInput" required placeholder="e.g. Maybank 164123456789" 
                           value="<?php echo htmlspecialchars($bank); ?>">
                </div>
            <?php endif; ?>

            <button type="submit" class="save-changes-btn">Save Changes</button>

        </form>

    </div>

</body>
</html>