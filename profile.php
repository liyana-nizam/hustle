<?php
// 1. Pastikan session bermula dengan selamat
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Tambahan keselamatan: Jika user belum login, tendang balik ke login.php
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Sila log masuk terlebih dahulu!'); window.location.href='login.php';</script>";
    exit();
}

include('connect.php');

// 2. AMBIL DATA TERBARU TERUS DARI DATABASE BERDASARKAN USERNAME LOG MASUK
$username_session = $_SESSION['username'];
$sql_user = "SELECT * FROM user WHERE username = '$username_session'";
$result_user = $conn->query($sql_user);

if ($result_user && $result_user->num_rows > 0) {
    $user_data = $result_user->fetch_assoc();

    // Setkan maklumat daripada pangkalan data ke dalam pembolehubah 
    $role     = strtolower(trim($user_data['role']));
    $name     = $user_data['name'];
    $birthday = date('d M Y', strtotime($user_data['birthday']));
    $gender   = $user_data['gender'];
    $address  = $user_data['address'];
    $phone    = $user_data['phone_number'];

    $bank     = !empty($user_data['bank_account']) ? $user_data['bank_account'] : "Belum Ditetapkan";
    // Simpan role ke dalam session supaya head.php tidak error lagi
    $_SESSION['role'] = $role;
} else {
    // Jika data tidak dijumpai atas sebab teknikal
    $role = 'gig worker';
    $name = $birthday = $gender = $address = $phone = "-";
}

// 3. Logik penentuan tab mengikut peranan
if ($role === 'admin') {
    $currentTab = 'profile-admin.php';
    $role_display = "Admin";
    $edit_link    = 'EditProfile.php';
} elseif ($role === 'gig owner' || $role === 'owner') {
    $currentTab = 'profile-owner.php';
    $role_display = "Owner";
    $edit_link    = 'EditProfile.php';
} else {
    $currentTab = 'profile-worker.php';
    $role_display = "Gig Worker";
    $edit_link    = 'EditProfile.php';
}

// 4. Panggil head.php SELEPAS data role berjaya disetkan di atas
include('head.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $role_display; ?>'s Profile - Hustle</title>
    <link rel="stylesheet" href="profile-style.css?v=5" type="text/css">
</head>

<body>
    <div class="profile-main-container">

        <h1 class="profile-page-title">User's Profile</h1>

        <div class="profile-content-layout">

            <div class="profile-avatar-column">
                <div class="profile-icon-circle">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>

            <div class="profile-info-column">

                <div class="profile-details-box">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
                    <p><strong>Birthday:</strong> <?php echo htmlspecialchars($birthday); ?></p>
                    <p><strong>Gender:</strong> <?php echo htmlspecialchars($gender); ?></p>
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($address); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>

                    <?php if ($role === 'worker' || $role === 'gig worker'): ?>
                        <p><strong>Bank Account:</strong> <?php echo htmlspecialchars($bank); ?></p>
                    <?php endif; ?>

                    <p><strong>Role:</strong> <?php echo $role_display; ?></p>
                </div>

                <div class="profile-footer-row">
                    <?php if ($role === 'worker' || $role === 'gig worker'): ?>
                        <div class="rating-stars-box">
                            <img src="images/star.png" alt="Star" class="star-icon">
                            <img src="images/star.png" alt="Star" class="star-icon">
                            <img src="images/star.png" alt="Star" class="star-icon">
                            <img src="images/star.png" alt="Star" class="star-icon">
                            <img src="images/star.png" alt="Star" class="star-icon">
                        </div>
                    <?php endif; ?>

                    <a href="<?php echo $edit_link; ?>" class="profile-edit-btn">Edit</a>
                </div>

            </div>

        </div>

    </div>

    <?php
    if (isset($conn)) {
        $conn->close();
    }
    include('footer.php');
    ?>
</body>

</html>