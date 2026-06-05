<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hustle</title>
    <link rel="stylesheet" href="base.css" type="text/css">
</head>
<body>
    <header>
        <div class="imgLogo"><img src="images/logo.svg" alt="Hustle Logo"></div>
        <nav>
            <?php $currentPage = basename($_SERVER['PHP_SELF']);?>
            <ul class="hLeft-container">
                <li><a href="progress-owner.php" class="<?php if ($currentPage === 'progress-owner.php') echo "current"; ?>">Gig Progress</a></li>
                <li><a href="gig_post.php" class="<?php if ($currentPage === 'gig_post.php') echo "current"; ?>">Post a Gig</a></li>
            </ul>
            <ul class="hRight-container">
                <li><a href="noti-owner.php"><img src="images/notification.png" alt="Notification"></a></li>
                <li><a href="profile-owner.php" class="<?php if ($currentPage === 'profile-owner.php') echo "current"; ?>">Gig Owner</a></li>
                <li><a href="">Log Out</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>