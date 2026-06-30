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

    $username = $_SESSION['username'];
    $role = $_SESSION['role'];

    $query_id = "SELECT USER_ID FROM user WHERE username = '$username'";
    $result_id = $conn->query($query_id);

    $userID = 0;
    if ($result_id && $result_id->num_rows > 0) {
        $user_row = $result_id->fetch_assoc();
        $userID = intval($user_row['USER_ID']);
    }

    $notifications = [];

    if ($role == 'gig owner'){

    $query = "SELECT 'Application' AS noti_type, ga.GIG_ID,
                      CONCAT(u.username, ' applied to your gig ', g.gig_name, '.') AS message
              FROM gig_application ga
              JOIN gig g ON ga.GIG_ID = g.GIG_ID
              JOIN user u ON ga.USER_ID = u.USER_ID
              WHERE g.USER_ID = '$userID' AND ga.app_status = 'pending'
              
              UNION ALL
              
              SELECT 'Comment' AS noti_type, c.GIG_ID,
                      CONCAT(u.username, ' commented: \"', c.content, '\"') AS message
              FROM comment c
              JOIN gig g ON c.GIG_ID = g.GIG_ID
              JOIN user u ON c.USER_ID = u.USER_ID
              WHERE g.USER_ID = '$userID' AND c.USER_ID != '$userID'
              
              UNION ALL
              
              SELECT 'Gig Completion' AS noti_type, ga.GIG_ID,
                      CONCAT(u.username, ' has marked the gig ', g.gig_name, ' as completed. Please review the completion.') AS message
                      FROM gig_application ga
                      JOIN gig g ON ga.GIG_ID = g.GIG_ID
                      JOIN user u ON ga.USER_ID = u.USER_ID
                      WHERE g.USER_ID = '$userID'
                      AND ga.proof != ''";

    $result = $conn->query($query);
    
    if ($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $notifications[] = $row;
        }
    }
    }

    elseif ($role == 'gig worker'){

    $query = "SELECT 'Application' AS noti_type, ga.GIG_ID, 
                      CONCAT(u.username, ' approved your gig application for ', g.gig_name, '.') AS message
              FROM gig_application ga
              JOIN gig g ON ga.GIG_ID = g.GIG_ID
              JOIN user u ON g.USER_ID = u.USER_ID
              WHERE ga.USER_ID = '$userID' AND ga.app_status = 'approved'
              
              UNION ALL
              
              SELECT 'Application' AS noti_type, ga.GIG_ID,
                      CONCAT(u.username, ' rejected your gig application for ', g.gig_name, '.') AS message
              FROM gig_application ga
              JOIN gig g ON ga.GIG_ID = g.GIG_ID
              JOIN user u ON g.USER_ID = u.USER_ID
              WHERE ga.USER_ID = '$userID' AND ga.app_status = 'rejected'
              
              UNION ALL
              
              SELECT 'Comment' AS noti_type, c.GIG_ID,
                      CONCAT(u_author.username, ' mentioned you in a comment: \"', c.content, '\"') AS message
              FROM comment c
              JOIN user u_author ON c.USER_ID = u_author.USER_ID
              WHERE c.USER_ID != '$userID'
              AND c.content LIKE '%@$username%'
              
              UNION ALL
              
              SELECT 'Gig Completion' AS noti_type, ga.GIG_ID,
                      CONCAT(u.username, ' has confirmed your payment and leave rating for the gig ', g.gig_name, '.') AS message
              FROM gig_application ga
              JOIN gig g ON ga.GIG_ID = g.GIG_ID
              JOIN user u ON g.USER_ID = u.USER_ID
              WHERE ga.USER_ID = '$userID'
              AND ga.payment_proof != ''";

    $result = $conn->query($query);
    
    if ($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $notifications[] = $row;
        }
    }
    }

    elseif ($role == 'admin'){

    $query = "SELECT 'Comment' AS noti_type, c.GIG_ID,
                      CONCAT(u_author.username, ' mentioned you in a comment: \"', c.content, '\"') AS message
              FROM comment c
              JOIN user u_author ON c.USER_ID = u_author.USER_ID
              WHERE c.USER_ID != '$userID'
              AND c.content LIKE '%@$username%'";

    $result = $conn->query($query);
    
    if ($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $notifications[] = $row;
        }
    }
    }

    ?>

    <div class="content-container">
        <div class="notifications-wrapper">
            <div class="notifications-header">
                <h1 class="notications-title">Notifications</h1>
                <hr class="title-divider">
            </div>

            <?php foreach ($notifications as $item){ ?>
            <div class="notification-list">
                <a href="job-details.php?id=<?php echo $item['GIG_ID']; ?>" class="notification-link">
                    <div class="notification-card">
                        <div class="badge-row">
                            <span class="status-badge"><?php echo htmlspecialchars($item['noti_type']); ?></span>
                        </div>
                        <p class="notification-text">
                            <?php echo htmlspecialchars($item['message']); ?>
                        </p>
                    </div></a>
            </div>
            <?php } ?>
            <?php if (empty($notifications)){ ?>
             <div class="notification-list">
                    <div class="notification-card">
                        <p class="notification-text">
                            No new notification.
                        </p>
                    </div>
             </div>       
            <?php } ?>
        </div>
    </div>

    <?php $conn->close(); 
    include("footer.php"); ?>
    
</body>
</html>