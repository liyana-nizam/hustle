<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hustle</title>
    <link rel="stylesheet" href="details-style.css">
</head>
<body>

<?php 
include('head.php'); 
include('connect.php');

$role = $_SESSION['role'] ?? 'gig worker';
$gig_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$username = $_SESSION['username'] ?? '';
$user_result = $conn->query("SELECT user_id FROM user WHERE username = '$username'");
$user_row = $user_result->fetch_assoc();
$user_id = $user_row['user_id'] ?? 0;

// Check if already applied
$already_applied = false;
$check_applied = $conn->query("SELECT USER_ID FROM gig_application WHERE USER_ID = $user_id AND GIG_ID = $gig_id");
if ($check_applied->num_rows > 0) {
    $already_applied = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['apply_gig_id'])) {
    $gig_id_apply = intval($_POST['apply_gig_id']);

    $check = $conn->query("SELECT USER_ID FROM gig_application WHERE USER_ID = $user_id AND GIG_ID = $gig_id_apply");

    if ($check->num_rows > 0) {
        echo "<script>alert('You already applied for this gig.');</script>";
    } else {
        $conn->query("INSERT INTO gig_application (USER_ID, GIG_ID, app_status) VALUES ($user_id, $gig_id_apply, 'pending')");
        echo "<script>alert('Applied successfully!');</script>";
    }
}
?>

<?php
    // Get the dynamic gig ID from the URL string
    

    
    $sql = "SELECT g.GIG_ID, g.gig_name, g.description, c.category_name, gd.location, gd.salary, gd.status, gd.gig_date, gd.frequency 
            FROM gig g
            LEFT JOIN gig_detail gd ON g.GIG_ID = gd.GIG_ID
            LEFT JOIN category c ON gd.CATEGORY_ID = c.category_id
            WHERE g.GIG_ID = $gig_id";

    $sql2 = "SELECT u.username AS gig_owner 
            FROM gig g
            LEFT JOIN user u ON g.user_id = u.user_id
            WHERE g.GIG_ID = $gig_id";
            
    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);
    // Fetch the row data to display below
    $row = $result->fetch_assoc();
    $gig_owner = $result2->fetch_assoc();
?>

<div class="details-container">

    <div class="back-btn">
        <a href="progress.php">
            <img src="images/back.png" alt="Back" class="icon">
        </a>
    </div>

    <div class="details-tab">
        Details
    </div>

    <div class="gig-card">

        <div class="gig-left">

            <div class="profile-circle"></div>

            <div class="gig-info">
                <h3><?php echo htmlspecialchars($row['gig_name'] ?? ''); ?></h3>
                <p>RM <?php echo htmlspecialchars($row['salary'] ?? ''); ?></p>
            </div>

        </div>

        <div class="gig-tags">
            <span><?php echo htmlspecialchars($row['category_name'] ?? ''); ?></span>
            <span>
                <?php 
                // Extracts "Melaka Tengah" dynamically if location is "Lot 15, Jalan Hang Tuah, Melaka Tengah"
                $loc_parts = explode(',', $row['location'] ?? '');
                echo htmlspecialchars(isset($loc_parts[2]) ? trim($loc_parts[2]) : (end($loc_parts) ?: '')); 
                ?>
            </span>
        </div>

    </div>

    <h3 class="view-title">View Details</h3>

    <div class="description-box">

        <h3>Job Description:</h3>
        <p><?php echo nl2br(htmlspecialchars($row['description'] ?? '')); ?></p>

        <br>

        <h3>Location:</h3>
        <p><?php echo htmlspecialchars($row['location'] ?? ''); ?></p>

        <br>

        <h3>Gig Date & Time:</h3>
        <p><?php echo htmlspecialchars($row['gig_date'] ?? ''); ?></p>

        <br>

        <h3>Frequency:</h3>
        <p><?php echo htmlspecialchars($row['frequency'] ?? ''); ?></p>

        <br>
        
        <h3>Posted By:</h3>
        <p><?php echo htmlspecialchars($gig_owner['gig_owner'] ?? ''); ?></p>

    </div>

    <?php if($role == 'gig owner'): ?>
    <div class="apply-section">
        <button id="editBtn" onclick="editGig(<?php echo $gig_id; ?>)">Edit Details</button>
    </div>
    <?php endif; ?>

<?php if($role == 'gig worker'): ?>
<div class="apply-section">
    <form method="POST">
        <input type="hidden" name="apply_gig_id" value="<?php echo $gig_id; ?>">
        <button type="submit" id="applyBtn" <?php echo $already_applied ? 'disabled' : ''; ?>>
            <?php echo $already_applied ? 'Applied' : 'Apply'; ?>
        </button>
    </form>
</div>
<?php endif; ?>

    <hr>

    <div class="comment-section">
        <img src="images/comment.png" alt="Comment" class="icon">
        <input type="text" placeholder="Write a Comment.....">
    </div>

</div>

<script>

function editGig(id){
    window.location.href = "edit-details.php?id=" + id;
}


</script>

<?php 
$conn->close();
include('footer.php'); 
?>

</body>
</html>