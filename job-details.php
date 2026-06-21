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

<?php include('head.php'); ?>

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
                <h3><?php echo $_SESSION['job_name'] ?? ''; ?></h3>
                <p>RM <?php echo $_SESSION['salary'] ?? ''; ?></p>
            </div>

        </div>

        <div class="gig-tags">
            <span><?php echo $_SESSION['category'] ?? ''; ?></span>
            <span><?php echo $_SESSION['district'] ?? ''; ?></span>
        </div>

    </div>

    <h3 class="view-title">View Details</h3>

    <div class="description-box">

        <h4>Job Description</h4>
        <p><?php echo $_SESSION['description'] ?? ''; ?></p>

        <br>

        <h4>Location</h4>
        <p><?php echo $_SESSION['location'] ?? ''; ?></p>

        <br>

        <h4>Gig Date & Time</h4>
        <p><?php echo $_SESSION['gig_date'] ?? ''; ?></p>

        <br>

        <h4>Frequency</h4>
        <p><?php echo $_SESSION['frequency'] ?? ''; ?></p>

    </div>

    <!-- OWNER BUTTON -->
    <?php if($role == 'gig owner'): ?>
    <div class="apply-section">
        <button id="editBtn" onclick="editGig()">Edit Details</button>
    </div>
    <?php endif; ?>

    <!-- WORKER BUTTON -->
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

function editGig(){
    window.location.href = "edit-details.php";
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

<?php include('footer.php'); ?>

</body>
</html>