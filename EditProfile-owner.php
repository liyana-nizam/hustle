
<?php
// Mesti diletakkan di baris pertama untuk mengaktifkan memori session
session_start(); 

// Proses simpan data apabila butang "Save Changes" ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['owner_name']    = $_POST['nameInput'];
    $_SESSION['owner_birthday']= $_POST['birthdayInput'];
    $_SESSION['owner_gender']  = isset($_POST['gender']) ? $_POST['gender'] : '';
    $_SESSION['owner_address'] = $_POST['addressInput'];
    $_SESSION['owner_phone']   = $_POST['phoneInput'];
    
    // Auto-redirect balik ke halaman profil
    header("Location: profile-owner.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Owner Profile - Hustle</title>
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

        <!-- Menukar onsubmit JavaScript kepada kaedah POST PHP -->
        <form method="POST" action="">

            <div class="formSection">
                <label>Full name</label>
                <input type="text" id="nameInput" name="nameInput" required placeholder="e.g. Amelia Henderson" 
                       value="<?php echo isset($_SESSION['owner_name']) ? htmlspecialchars($_SESSION['owner_name']) : ''; ?>">
            </div>

            <div class="formSection">
                <label>Birthday</label>
                <input type="date" id="birthdayInput" name="birthdayInput" required 
                       value="<?php echo isset($_SESSION['owner_birthday']) ? htmlspecialchars($_SESSION['owner_birthday']) : ''; ?>">
            </div>

            <div class="formGender">
                <label>Gender</label>
                <div class="radioGroup">
                    <input type="radio" name="gender" id="male" value="Male" 
                           <?php echo (isset($_SESSION['owner_gender']) && $_SESSION['owner_gender'] == 'Male') ? 'checked' : ''; ?>> 
                    <span class="radio-text">Male</span>
                    
                    <input type="radio" name="gender" id="female" value="Female" 
                           <?php echo (isset($_SESSION['owner_gender']) && $_SESSION['owner_gender'] == 'Female') ? 'checked' : ''; ?>> 
                    <span class="radio-text">Female</span>
                </div>
            </div>

            <div class="formSection">
                <label>Full address</label>
                <input type="text" id="addressInput" name="addressInput" required 
                       value="<?php echo isset($_SESSION['owner_address']) ? htmlspecialchars($_SESSION['owner_address']) : ''; ?>">
            </div>

            <div class="formSection">
                <label>Phone number</label>
                <input type="text" id="phoneInput" name="phoneInput" required placeholder="e.g. +0123456789" 
                       value="<?php echo isset($_SESSION['owner_phone']) ? htmlspecialchars($_SESSION['owner_phone']) : ''; ?>">
            </div>

            <button type="submit" class="save-changes-btn">Save Changes</button>

        </form>

    </div>

</body>
</html>