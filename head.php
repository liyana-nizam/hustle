<?php
include('connect.php');
$role = $_SESSION['role'];
$currentPage = basename($_SERVER['PHP_SELF']);
?>

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
            <?php if ($role == 'admin'){ ?>
            <ul class="hLeft-container">
                <li><a href="progress-admin.php" class="<?php if ($currentPage == 'progress-admin.php') echo "current"; ?>">Gig Progress</a></li>
                <li><a href="admin-list-users.php" class="<?php if ($currentPage == 'admin-list-users.php') echo "current"; ?>">List Users</a></li>
                <li><a href="admin-list-gigs.php" class="<?php if ($currentPage == 'admin-list-gigs.php') echo "current"; ?>">List Gigs</a></li>
            </ul>
            <ul class="hRight-container">
                <li><a href="noti-admin.php"><img src="images/notification.png" alt="Notification"></a></li>
                <li><a href="profile-admin.php" class="<?php if ($currentPage == 'profile-admin.php') echo "current"; ?>">Admin</a></li>
                <li><a href="index.html">Log Out</a></li>
            </ul>
            <?php } elseif($role == 'gig worker'){ ?>
            <ul class="hLeft-container">
                <li><a href="progress-worker.php" class="<?php if ($currentPage == 'progress-worker.php') echo "current"; ?>">Gig Progress</a></li>
                <li><a href="worker-find-gigs.php" class="<?php if ($currentPage == 'worker-find-gigs.php') echo "current"; ?>">Find Gigs</a></li>
            </ul>
            <ul class="hRight-container">
                <li><a href="noti-worker.php"><img src="images/notification.png" alt="Notification"></a></li>
                <li><a href="profile-worker.php" class="<?php if ($currentPage == 'profile-worker.php') echo "current"; ?>">Gig Worker</a></li>
                <li><a href="index.html">Log Out</a></li>
            </ul>
            <?php } elseif($role == 'gig owner') {?>
            <ul class="hLeft-container">
                <li><a href="progress-owner.php" class="<?php if ($currentPage == 'progress-owner.php') echo "current"; ?>">Gig Progress</a></li>
                <li><a href="gig_post.php" class="<?php if ($currentPage == 'gig_post.php') echo "current"; ?>">Post a Gig</a></li>
            </ul>
            <ul class="hRight-container">
                <li><a href="noti-owner.php"><img src="images/notification.png" alt="Notification"></a></li>
                <li><a href="profile-owner.php" class="<?php if ($currentPage == 'profile-owner.php') echo "current"; ?>">Gig Owner</a></li>
                <li><a href="index.html">Log Out</a></li>
            </ul>
            <?php } ?>
        </nav>
    </header>
</body>
</html>