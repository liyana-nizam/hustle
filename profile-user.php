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
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>

                    <div class="profile-info-column">

                        <div class="profile-details-box">
                            <p><strong>Name:</strong> <?php echo htmlspecialchars($row['name']); ?></p>
                            <p><strong>Birthday:</strong> <?php echo htmlspecialchars($row['birthday']); ?></p>
                            <p><strong>Gender:</strong> <?php echo htmlspecialchars($row['gender']); ?></p>
                            <p><strong>Address:</strong> <?php echo htmlspecialchars($row['address']); ?></p>
                            <p><strong>Phone:</strong> <?php echo htmlspecialchars($row['phone_number']); ?></p>

                            <?php if (htmlspecialchars($row['role']) === 'gig worker'): ?>
                                <p><strong>Bank Account:</strong> <?php echo htmlspecialchars($row['bank_account']); ?></p>
                            <?php endif; ?>

                            <p><strong>Role:</strong> <?php echo htmlspecialchars($row['role']); ?></p>
                        </div>

                        <div class="profile-footer-row">
                            <?php if (htmlspecialchars($row['role']) === 'gig worker'): ?>
                                <a href="list-user-rating.php?id=<?php echo $user_id; ?>" class="rating-stars-link" style="text-decoration: none; display: inline-block;">
                                    <div class="rating-stars-box">
                                        <img src="images/star.png" alt="Star" class="star-icon">
                                        <img src="images/star.png" alt="Star" class="star-icon">
                                        <img src="images/star.png" alt="Star" class="star-icon">
                                        <img src="images/star.png" alt="Star" class="star-icon">
                                        <img src="images/star.png" alt="Star" class="star-icon">
                                    </div>
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