<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="noti-style.css" type="text/css">
</head>

<body>
    <?php 
    if(session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }
    include("head.php"); 
    require_once('connect.php');
    ?>

    <div class="admin-comtainer">
        <div class="notifications-wrapper">
            <div class="notifications-header">
                <h1 class="notications-title">Notifications</h1>
                <hr class="title-divider">
            </div>

            <div class="notification-list">
                    <div class="notification-card">
                        <div class="badge-row">
                            <span class="status-badge">Notification</span>
                        </div>
                        <?php if ($role == 'gig owner'){ ?>
                        <p class="notification-text">
                            Need Help with Laundry job application has been submitted by a worker, you can view the application details and approve or disapprove the application.
                        </p>

                        <div class="action-buttons">
                            <button class="btn-approve">Approve</button>
                            <button class="btn-disapprove">Disapprove</button>
                        </div>

                        <?php } else{ ?>
                            <p class="notification-text">
                            This is a sample notification.
                            </p>    
                        <?php } ?>
                        </p>
                    </div>
            </div>
        </div>
    </div>

    <?php $conn->close(); 
    include("footer.php"); ?>
    
</body>
</html>