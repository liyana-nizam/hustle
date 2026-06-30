<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('connect.php');
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user_id = intval($_GET['id']);

    $sql = "SELECT * from user WHERE USER_ID='$user_id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

       
        $average_rating = 0;
        $role_check = strtolower(trim($row['role']));

        if ($role_check === 'worker' || $role_check === 'gig worker') {
            $sql_all_stars = "SELECT star FROM gig_application 
                   WHERE USER_ID = '$user_id' 
                   AND app_status = 'approved' 
                   AND star IS NOT NULL AND star > 0";
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
     

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo htmlspecialchars($row['username']); ?>'s Profile - Hustle</title>
            <link rel="stylesheet" href="profile-style.css?v=5" type="text/css">
        </head>

        <body>
            <?php include('head.php'); ?>
            <div class="profile-main-container">

                <h1 class="profile-page-title"><?php echo htmlspecialchars($row['username']); ?>'s Profile</h1>

                <div class="profile-content-layout">

                    <div class="profile-avatar-column">
    <div class="profile-icon-circle">
        <?php
            $user_pic = (!empty($row['user_image']) && file_exists($row['user_image'])) ?
            $row['user_image'] : 'images/iconuser.png';
        ?>
        <img src="<?php echo htmlspecialchars($user_pic); ?>" alt="Profile Picture">
    </div>
</div>

                    <div class="profile-info-column">

                        <div class="profile-details-box">
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
                            <p><strong>Birthday:</strong> <?php echo htmlspecialchars($row['birthday']); ?></p>
                            <p><strong>Gender:</strong> <?php echo htmlspecialchars($row['gender']); ?></p>
                            <p><strong>Address:</strong> <?php echo htmlspecialchars($row['address']); ?></p>
                            <p><strong>Phone:</strong> <?php echo htmlspecialchars($row['phone_number']); ?></p>

                            <?php if ($role_check === 'worker' || $role_check === 'gig worker'): ?>
                                <p><strong>Bank Account:</strong> <?php echo htmlspecialchars($row['bank_account']); ?></p>
                            <?php endif; ?>

                            <p><strong>Role:</strong> <?php echo htmlspecialchars($row['role']); ?></p>
                        </div>

                        <div class="profile-footer-row">
                            <?php if ($role_check === 'worker' || $role_check === 'gig worker'): ?>
                                <a href="list-user-rating.php?id=<?php echo $user_id; ?>" class="rating-stars-link" style="text-decoration: none; display: inline-block;">
                                    <div class="rating-stars-box">
                                        <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $average_rating) {
                                                echo '<img src="images/star.png" alt="Star" class="star-icon">';
                                            }
                                        }

                                        if ($average_rating == 0) {
                                            echo "<span style='color: #888; font-size: 14px;'>No rating yet</span>";
                                        }
                                        ?>
                                    </div>
                                </a>
                            <?php endif; ?>
                        <?php }
                } ?>
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