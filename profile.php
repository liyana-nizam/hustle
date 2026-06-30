<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please Login First!'); window.location.href='login.php';</script>";
    exit();
}

require_once('connect.php');



$role         = '';
$role_display = '';
$edit_link    = '';
$name         = '';
$birthday     = '';
$gender       = '';
$address      = '';
$phone        = '';
$bank         = '';
$picture      = '';
$average_rating = 0;
$user_id      = null;


$username_session = $_SESSION['username'];
$sql_user = "SELECT * FROM user WHERE username = '$username_session'";
$result_user = $conn->query($sql_user);

if ($result_user && $result_user->num_rows > 0) {
    $user_data = $result_user->fetch_assoc();

   
    $user_id  = $user_data['USER_ID'];

    $role     = strtolower(trim($user_data['role']));
    $name     = $user_data['name'];
    $birthday = date('d M Y', strtotime($user_data['birthday']));
    $gender   = $user_data['gender'];
    $address  = $user_data['address'];
    $phone    = $user_data['phone_number'];

    $bank     = !empty($user_data['bank_account']) ? $user_data['bank_account'] : "Belum Ditetapkan";
    $picture = (!empty($user_data['user_image']) && file_exists($user_data['user_image'])) ? $user_data['user_image'] : 'images/iconuser.png';

    $_SESSION['role'] = $role;

    
    $average_rating = 0;

    if ($role === 'worker' || $role === 'gig worker') {
        $sql_all_stars = "SELECT star FROM gig_application WHERE USER_ID = '$user_id' AND app_status = 'approved'";
        $result_stars = $conn->query($sql_all_stars);

        if ($result_stars && $result_stars->num_rows > 0) {
            $total_stars = 0;
            $total_completed_gigs = $result_stars->num_rows;

            while ($row_star = $result_stars->fetch_assoc()) {
                $total_stars += intval($row_star['star']);
            }

            $raw_average = $total_stars / $total_completed_gigs;
            $average_rating = round($raw_average);
        }
    }
}


if ($role === 'admin') {
    $currentTab = 'profile-admin.php';
    $role_display = "admin";
    $edit_link    = 'EditProfile.php';
} elseif ($role === 'gig owner' || $role === 'owner') {
    $currentTab = 'profile-owner.php';
    $role_display = "gig owner";
    $edit_link    = 'EditProfile.php';
} else {
    $currentTab = 'profile-worker.php';
    $role_display = "gig Worker";
    $edit_link    = 'EditProfile.php';
}


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
                    <img src="<?php echo htmlspecialchars($picture);?>">
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
                        <a href="list-user-rating.php?id=<?php echo $user_id; ?>" class="rating-stars-link" style="text-decoration: none; display: inline-block;">
                        <div class="rating-stars-box">
                            <?php
                            //gambar star ikut average
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $average_rating) {
                                    echo '<img src="images/star.png" alt="Star" class="star-icon">';
                                }
                            }

                            if ($average_rating == 0) {
                                echo "<span style='color: #888; font-size: 14px;'>Apply job to get rating from your Gig Owner</span>";
                            }
                            ?>
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