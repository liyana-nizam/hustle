<?php 
// Mesti diletakkan di baris pertama untuk membaca data session
session_start(); 

// Semak data, jika belum diisi, letakkan nilai default / kosong
$name     = isset($_SESSION['worker_name']) ? $_SESSION['worker_name'] : "-";
$birthday = isset($_SESSION['worker_birthday']) ? $_SESSION['worker_birthday'] : "-";
$gender   = isset($_SESSION['worker_gender']) ? $_SESSION['worker_gender'] : "-";
$address  = isset($_SESSION['worker_address']) ? $_SESSION['worker_address'] : "-";
$phone    = isset($_SESSION['worker_phone']) ? $_SESSION['worker_phone'] : "-";
$bank     = isset($_SESSION['worker_bank']) ? $_SESSION['worker_bank'] : "-"; // <-- TAMBAH INI
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Worker's Profile - Hustle</title>
    <link rel="stylesheet" href="profile-style.css?v=5" type="text/css">
</head>

<body>
    <?php include('header-worker.php'); ?>

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
                    <p><strong>Bank Account:</strong> <?php echo htmlspecialchars($bank); ?></p>
                    <p><strong>Role:</strong> Gig Worker</p>
                </div>

                <div class="profile-footer-row">
                    <div class="rating-stars-box">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                    </div>
                    <a href="EditProfile-worker.php" class="profile-edit-btn">Edit</a>
                </div>

            </div>

        </div>

    </div>

    <?php include('footer-worker.php'); ?>
</body>

</html>