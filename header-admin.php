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
                <li><a href="progress-admin.php" class="<?php if ($currentPage === 'progress-admin.php') echo "current"; ?>">Gig Progress</a></li>
                <li><a href="admin-list-users.php" class="<?php if ($currentPage === 'admin-list-users.php') echo "current"; ?>">List Users</a></li>
                <li><a href="admin-list-gigs.php" class="<?php if ($currentPage === 'admin-list-gigs.php') echo "current"; ?>">List Gigs</a></li>
            </ul>
            <ul class="hRight-container">
                <li><a href="noti-admin.php"><img src="images/notification.png" alt="Notification"></a></li>
                <li><a href="profile-admin.php" class="<?php if ($currentPage === 'profile-admin.php') echo "current"; ?>">Admin</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>