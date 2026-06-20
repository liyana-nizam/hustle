<?php
$role = $_SESSION['role']; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Worker Hustle</title>
    <link rel="stylesheet" href="base.css" type="text/css">
</head>
<body>
    <footer>
        <div class="footer-container">
            <div class="left-footer">
                <img src="images/logo.svg" alt="Hustle Logo">
            </div>
            <div class="right-footer">
                <p class="first-line">Navigation</p>
                <ul>
                <?php if ($role == 'admin'){ ?>
                    <li><a href="progress-admin.php">Gig Progress</a></li>
                    <li><a href="admin-list-users.php">List Users</a></li>
                    <li><a href="admin-list-gigs.php">List Gigs</a></li>
                    <li><a href="profile-admin.php">Profile</a></li>
                <?php } elseif($role == 'gig worker'){ ?>
                    <li><a href="progress-worker.php">Gig Progress</a></li>
                    <li><a href="worker-find-gigs.php">Find Gigs</a></li>
                    <li><a href="profile-worker.php">Profile</a></li>
                <?php } elseif($role == 'gig owner') {?>
                    <li><a href="progress-owner.php">Gig Progress</a></li>
                    <li><a href="gig_post.php">Post a Gig</a></li>
                    <li><a href="profile-owner.php">Profile</a></li>
                <?php } ?>
                </ul>
            </div>
        </div>
        <div class="copyright-container">
            <p>&copy; 2026 Hustle. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>