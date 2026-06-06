<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications Owner - Hustle</title>
    <link rel="stylesheet" href="noti-style.css?v=2" type="text/css">
</head>

<body>
    <?php include('header-owner.php'); ?>

    <div class="admin-container">

        <div class="notifications-wrapper">

            <div class="notifications-header">
                <h1 class="notifications-title">Notifications</h1>
                <hr class="title-divider">
            </div>

            <div class="notifications-list">

                <div class="notification-card">
                    <div class="badge-row">
                        <span class="status-badge">Notification</span>
                    </div>

                    <!-- New wrapper to separate text from buttons -->
                    <div class="notification-content-wrapper">
                        <p class="notification-text">
                            Need Help with Laundry job application has been submitted by a worker, you can view the application details and approve or disapprove the application.
                        </p>

                        <!-- New Action Buttons Container -->
                        <div class="action-buttons">
                            <button class="btn-approve">Approve</button>
                            <button class="btn-disapprove">Disapprove</button>
                        </div>
                    </div>
                </div>




            </div>

        </div>
    </div>

    <?php include('footer-owner.php'); ?>
</body>

</html>