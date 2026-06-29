<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hustle</title>
    <link rel="stylesheet" href="base.css" type="text/css">
    <link rel="stylesheet" href="list-style.css" type="text/css">
</head>
<body>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include('head.php');
    require_once('connect.php');

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        
        $worker_id = isset($_GET['id']) ? intval($_GET['id']) : 0;


$sql = "SELECT 
            u.username AS owner_name,
            g.gig_name,
            ga.feedback_message,
            ga.star,
            u.user_image
        FROM 
            gig_application ga
        INNER JOIN 
            gig g ON ga.GIG_ID = g.GIG_ID
        INNER JOIN 
            user u ON g.USER_ID = u.USER_ID
        WHERE 
            ga.USER_ID = ? 
            AND ga.app_status = 'approved'
            AND ga.star IS NOT NULL 
            AND ga.star > 0"; 

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $worker_id);
        $stmt->execute();
        $result = $stmt->get_result();
    ?>
    <div class="content-container">
        <div class="list-container">
            <ul class="user-list">
                <?php
                if ($result && $result->num_rows > 0) {
                     while ($row = $result->fetch_assoc()) {
                ?>
                <li class="item-container">
                    <a href="#">
                        <div class="user-left" style="align-items: flex-start;">
                            <div class="user-img">
                                 <?php 
                            $user_pic = (!empty($row['user_image']) && file_exists($row['user_image'])) ? 
                            $row['user_image'] : 'images/iconuser.png';
                            ?>

                            <img src="<?php echo htmlspecialchars($user_pic); ?>" alt="Icon User">

                            </div>
                            <div class="user-info" style="display: flex; flex-direction: column; gap: 4px;">
                                <p class="user-name" style="font-weight: bold; margin: 0;">
                                    <?php echo htmlspecialchars($row['owner_name']) ?>
                                </p> 
                                
                                <p class="gig-job-title" style="margin: 0; color: rgb(150, 0, 66); font-size: 15px; font-style: italic; font-weight: 500;">
                                    <?php echo htmlspecialchars($row['gig_name']) ?>
                                </p>

                                <p class="user-feedback-msg" style="margin: 4px 0 0 0; color: #555; font-size: 14px; line-height: 1.4;">
                                    <?php echo htmlspecialchars($row['feedback_message']) ?>
                                </p>
                            </div>
                        </div>

                        <div class="user-right">
                            <p class="user-filter" style="font-weight: bold; margin: 0; background-color: transparent;">
                                <?php echo htmlspecialchars($row['star']) ?> / 5
                            </p>
                        </div>
                    </a>
                </li>
                <?php 
                     }} else {
                        echo "<p style='text-align:center; padding-top:15px; color: rgb(150, 0, 66);'>No rating or feedback has been received from the gig owner yet.</p>";
                    }
                ?>
            </ul>
        </div>
    </div>
    <?php
        if (isset($stmt)) {
            $stmt->close();
        }
    } else {
        echo "<div class='content-container'><p style='text-align:center;'>You must be logged in to view profile.</p></div>";
    }
    $conn->close();
    include('footer.php');
    ?>
</body>
</html>