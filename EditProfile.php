<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Sekatan keselamatan: Jika belum login, hantar ke login.php
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('connect.php');
$username_session = $_SESSION['username'];

$sql_select = "SELECT * FROM user WHERE username = '$username_session'";
$result_select = $conn->query($sql_select);
$user = $result_select->fetch_assoc();

// A. COMMAND UPDATE AUTOMATIK APABILA USER KLIK SAVE CHANGES
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = $conn->real_escape_string($_POST['nameInput']);
    $birthday = $conn->real_escape_string($_POST['birthdayInput']);
    $gender   = $conn->real_escape_string($_POST['gender']);
    $address  = $conn->real_escape_string($_POST['addressInput']);
    $phone    = $conn->real_escape_string($_POST['phoneInput']);
    
    if (isset($_FILES['profileInput']) && $_FILES['profileInput']['error'] === 0) 
    {
        $uploadDir = 'images/';
        $originalName = basename($_FILES['profileInput']['name']);
        $newFileName = uniqid('img_') . '_' . $originalName;
        $uploadPath = $uploadDir . $newFileName;

        if (move_uploaded_file($_FILES['profileInput']['tmp_name'], $uploadPath)) 
        {
            $picture = $uploadPath;
        }
        else
        {
            $picture = $user['user_image'];
        }

    } 
    else 
    {
    $picture = $user['user_image'];
    }
    

    
    // 1. Ambil data sedia ada dahulu untuk tahu role pengguna semasa
    $sql_check = "SELECT role FROM user WHERE username = '$username_session'";
    $res_check = $conn->query($sql_check);
    $user_check = $res_check->fetch_assoc();
    $current_role = strtolower(trim($user_check['role']));

    // 2. Bina arahan SQL secara dinamik
    if ($current_role === 'worker' || $current_role === 'gig worker') {
        // Jika Gig Worker, kemas kini semua termasuk bank account
        $bank = isset($_POST['bankInput']) ? $conn->real_escape_string($_POST['bankInput']) : '';
        $sql_update = "UPDATE user SET 
                        name = '$name', 
                        birthday = '$birthday', 
                        gender = '$gender', 
                        address = '$address', 
                        phone_number = '$phone', 
                        bank_account = '$bank',
                        user_image = '$picture' 
                      WHERE username = '$username_session'";
    } else {
        // Jika Admin atau Gig Owner, KEKALKAN data bank lama (jangan usik kolum bank_account)
        $sql_update = "UPDATE user SET 
                        name = '$name', 
                        birthday = '$birthday', 
                        gender = '$gender', 
                        address = '$address', 
                        phone_number = '$phone',
                        user_image = '$picture'
                      WHERE username = '$username_session'";
    }
   if ($conn->query($sql_update) === TRUE) {
        echo "<script>alert('Information successfully updated!'); window.location.href='profile.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Ambil role user untuk kawalan paparan seketika lagi
$role = strtolower(trim($user['role']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Personal Information</title>
    <link rel="stylesheet" href="signup-style.css"> 
    <style>@import url('https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap');</style>
</head>
<body id="backgroundColor">

    <div id="formGroup" style="margin-top: 50px;">
        <div class="imgIcon">
            <img src="images/iconuser.png" alt="User Icon">  
        </div>

        <h1>Personal Information</h1>

        <form action="EditProfile.php" method="POST" enctype="multipart/form-data">

            <div class="formSection">
                <label>Full name</label>
                <input type="text" name="nameInput" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>

            <div class="formSection">
                <label>Birthday</label>
                <input type="date" name="birthdayInput" value="<?php echo htmlspecialchars($user['birthday']); ?>" required>
            </div>

            <div class="formRole">
              <label>Gender</label>
              <div class="roleOptions">
                <input type="radio" name="gender" value="male" <?php echo ($user['gender'] == 'male') ? 'checked' : ''; ?> required>Male
                <input type="radio" name="gender" value="female" <?php echo ($user['gender'] == 'female') ? 'checked' : ''; ?> required>Female
              </div>
            </div>

            <div class="formSection">
                <label>Full address</label>
                <input type="text" name="addressInput" value="<?php echo htmlspecialchars($user['address']); ?>" required>
            </div>

            <div class="formSection">
                <label>Phone number</label>
                <input type="tel" name="phoneInput" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
            </div>

            <div class="formSection">
                <label>Profile Picture</label>
                <input type="file" id="profileInput" name="profileInput" accept="image/*">
            </div>

            <?php if ($role === 'worker' || $role === 'gig worker'): ?>
                <div class="formSection">
                    <label>Bank Account</label>
                    <input type="text" name="bankInput" placeholder="e.g. Maybank 164123456789" value="<?php echo htmlspecialchars($user['bank_account'] ?? ''); ?>">
                </div>
            <?php endif; ?>

            <button type="submit" >Save Changes</button>

        </form>
    </div>

</body>
</html>