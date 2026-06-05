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
                <li><a href="progress-worker.php" class="<?php if ($currentPage === 'progress-worker.php') echo "current"; ?>">Gig Progress</a></li>
                <li><a href="worker-find-gigs.php" class="<?php if ($currentPage === 'worker-find-gigs.php') echo "current"; ?>">Find Gigs</a></li>
            </ul>
            <ul class="hRight-container">
                <li><a href="noti-worker.php"><img src="images/notification.png" alt="Notification"></a></li>
                <li><a href="profile-worker.php" class="<?php if ($currentPage === 'profile-worker.php') echo "current"; ?>">Gig Worker</a></li>
                <li><a href="">Log Out</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>