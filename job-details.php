<?php
session_start();

$role = $_SESSION['role'] ?? 'gig worker';

if(isset($_SESSION['posted'])){
    echo "<script>alert('Gig Posted Successfully!');</script>";
    unset($_SESSION['posted']);
}
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
?>

<?php
    // Get the dynamic gig ID from the URL string
    $gig_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    
    $sql = "SELECT g.GIG_ID, g.gig_name, g.description, c.category_name, gd.location, gd.salary, gd.status, gd.gig_date, gd.frequency 
            FROM gig g
            LEFT JOIN gig_detail gd ON g.GIG_ID = gd.GIG_ID
            LEFT JOIN category c ON gd.CATEGORY_ID = c.category_id
            WHERE g.GIG_ID = $gig_id";
            
    $result = $conn->query($sql);
    
    // Fetch the row data to display below
    $row = $result->fetch_assoc();
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

        <h4>Job Description</h4>
        <p><?php echo nl2br(htmlspecialchars($row['description'] ?? '')); ?></p>

        <br>

        <h4>Location</h4>
        <p><?php echo htmlspecialchars($row['location'] ?? ''); ?></p>

        <br>

        <h4>Gig Date & Time</h4>
        <p><?php echo htmlspecialchars($row['gig_date'] ?? ''); ?></p>

        <br>

        <h4>Frequency</h4>
        <p><?php echo htmlspecialchars($row['frequency'] ?? ''); ?></p>

    </div>

    <?php if($role == 'gig owner'): ?>
    <div class="apply-section">
        <button id="editBtn" onclick="editGig(<?php echo $gig_id; ?>)">Edit Details</button>
    </div>
    <?php endif; ?>

    <?php if($role == 'gig worker'): ?>
    <div class="apply-section">
        <button id="applyBtn">Apply</button>
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

const applyBtn = document.getElementById("applyBtn");

if(applyBtn){
    applyBtn.addEventListener("click", function(){
        alert("Applied for this gig successfully!");
        this.innerHTML = "Applied";
        this.disabled = true;
    });
}

</script>

<?php 
$conn->close();
include('footer.php'); 
?>

</body>
</html>