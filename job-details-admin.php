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

<?php include('header-worker.php'); ?>

<div class="details-container">

    <div class="back-btn">
        <a href="progress-admin.php">
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
                <h3><?php echo $_SESSION['job_name'] ?? 'Need Help with Laundry'; ?></h3>
                <p>RM <?php echo $_SESSION['salary'] ?? '20'; ?></p>
            </div>

        </div>
        <div class="gig-tags">
            <span><?php echo $_SESSION['category'] ?? 'Cleaning'; ?></span>
            <span><?php echo $_SESSION['district'] ?? 'Melaka Tengah'; ?></span>
        </div>

    </div>

    <h3 class="view-title">Views details</h3>
    <div class="description-box">

        <h4>Job Description</h4>
        <p><?php echo $_SESSION['description'] ?? 'Need a maid to help clean a laundry'; ?></p>

        <br>

        <h4>Location</h4>
        <p><?php echo $_SESSION['location'] ?? 'Lot 15, Jalan Hang Tuah, 75300 Melaka Tengah, Melaka'; ?></p>

        <br>

        <h4>Gig Date & Time</h4>
        <p><?php echo $_SESSION['gig_date'] ?? '20 June 2026, 10:00 AM'; ?></p>

        <br>

        <h4>Frequency</h4>
        <p><?php echo $_SESSION['frequency'] ?? 'One-time'; ?></p>
    </div>
    <div class="apply-section">
        <button id="applyBtn">Apply</button>
    </div>

    <hr> <!--separate content-->

    <div class="comment-section">
        <img src="images/comment.png" alt="Back" class="icon">
        <input type="text" placeholder="  Write a Comment.....">
    </div>
</div>
<script>
document.getElementById("applyBtn").addEventListener("click", function () {
    alert("Applied for this gig successfully!");
    this.innerHTML = "Applied";
    this.disabled = true;
});

</script>
<?php include('footer-worker.php'); ?>
</body>
</html>