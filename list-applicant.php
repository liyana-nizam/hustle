<?php
session_start();
require_once('connect.php');

$gig_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Handle approve/reject
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['approve_user_id'])) {
        $approve_user = intval($_POST['approve_user_id']);
        $conn->query("UPDATE gig_application SET app_status = 'approved' WHERE USER_ID = $approve_user AND GIG_ID = $gig_id");
        $conn->query("UPDATE gig_detail SET status = 'ongoing' WHERE GIG_ID = $gig_id");
    }
    if (isset($_POST['reject_user_id'])) {
        $reject_user = intval($_POST['reject_user_id']);
        $conn->query("UPDATE gig_application SET app_status = 'rejected' WHERE USER_ID = $reject_user AND GIG_ID = $gig_id");
    }
}

// Get all applicants for this gig
$sql = "SELECT u.user_id, u.username, u.user_image, ga.app_status 
        FROM gig_application ga
        LEFT JOIN user u ON ga.USER_ID = u.user_id
        WHERE ga.GIG_ID = $gig_id";

$result = $conn->query($sql);
?>

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
    <?php include('head.php')?>
    <div class="content-container">
    <?php if($result->num_rows > 0): ?>
        <div class="list-container">
            <ul class="user-list">
                <?php while($row = $result->fetch_assoc()): ?>
                    <li class="item-container">
                        <a href="profile-user.php?id=<?php echo $row['user_id']; ?>">
                            
                            <div class="user-left">
                                <div class="user-img">
                                    <?php
                                        $user_pic = (!empty($row['user_image']) && file_exists($row['user_image'])) ?
                                        $row['user_image'] : 'images/iconuser.png';
                                    ?>
                                    <img src="<?php echo htmlspecialchars($user_pic); ?>" alt="Icon User">
                                </div>

                                <div class="user-info">
                                    <p class="user-name"><?php echo htmlspecialchars($row['username']); ?></p>
                                </div>
                            </div>

                            <div class="user-right">
                                <?php if($row['app_status'] == 'pending'): ?>
                                    <form method="POST" style="display: contents;" onsubmit="return confirm('Are you sure you want to approve this gig worker?');">
                                        <input type="hidden" name="approve_user_id" value="<?php echo $row['user_id']; ?>">
                                        <button type="submit">Approve</button>
                                    </form>

                                    <form method="POST" style="display: contents;" onsubmit="return confirm('Are you sure you want to reject this gig worker?');">
                                        <input type="hidden" name="reject_user_id" value="<?php echo $row['user_id']; ?>">
                                        <button type="submit">Reject</button>
                                    </form>

                                <?php elseif($row['app_status'] == 'approved'): ?>
                                    <p class="user-filter">Approved</p>

                                <?php elseif($row['app_status'] == 'rejected'): ?>
                                    <p class="user-filter">Rejected</p>

                                <?php endif; ?>
                            </div>

                        </a>
                    </li>
                <?php endwhile; ?>

            </ul>
        </div>
    <?php else: ?>
        <div class="list-container">
            <ul class="user-list">
                <li class="item-container">
                    <a>
                        <div class="user-left">
                            <p>No applicants yet.</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    <?php endif; ?>
</div>
    <?php include('footer.php') ?>
</body>
</html>