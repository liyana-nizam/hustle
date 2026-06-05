<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payment - Hustle</title>
    <link rel="stylesheet" href="ViewPayment.css?v=2" type="text/css">
</head>

<body>
    <?php include('header-worker.php'); ?>

    <div class="payment-container">

        <a href="progress-worker.php" class="back-link">
            <img src="images/back.png" alt="Back" class="back-icon">
            View Payment
        </a>

        <div class="payment-job-card">
            <div class="job-card-left">
                <div class="job-avatar"></div>
                <div class="job-details">
                    <h3>Job Title</h3>
                    <p class="salary">Salary</p>
                </div>
            </div>
            <div class="job-card-tags">
                <span class="payment-tag">Category</span>
                <span class="payment-tag">District</span>
            </div>
        </div>

        <div class="payment-proof-section">
            <h2 class="section-title">Payment Proof</h2>

            <div class="proof-file-row">
                <span class="file-name">Job Title.jpg</span>
                <a href="uploads/payment-proof-sample.jpg" target="_blank" class="view-proof-btn">View</a>
            </div>
        </div>

    </div>

    <?php include('footer-worker.php'); ?>
</body>

</html>