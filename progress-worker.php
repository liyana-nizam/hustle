<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Worker - Hustle</title>
    <link rel="stylesheet" href="progress-style.css" type="text/css">

</head>

<body>
    <?php include('header-worker.php') ?>

    <div class="content-container">
        <h1 class="main-title">Gig Progress</h1>

        <div class="gig-board">

            <div class="column">
                <h2 class="column-title">Pending</h2>

                <div class="gig-card">
                    <a href="job-details-worker.php" class="card-clickable-overlay"></a>

                    <div class="card-header">
                        <div class="gig-img"><img src="images/cleaning.png" alt="Gig Photo"></div>
                        <div class="job-details">
                            <h3>Need Help with Laundry</h3>
                            <p class="salary">RM 20</p>
                        </div>
                    </div>
                    <div class="card-tags">
                        <span class="tag">Cleaning</span>
                        <span class="tag">Melaka Tengah</span>
                    </div>
                    <div class="card-actions single-action-right">
                        <button class="action-btn">Delete</button>
                    </div>
                </div>

                <div class="gig-card">
                    <a href="job-details-worker.php" class="card-clickable-overlay"></a>
                    <div class="card-header">
                        <div class="gig-img"><img src="images/errands.png" alt="Gig Photo"></div>
                        <div class="job-details">
                            <h3>Need a Groceries Runner</h3>
                            <p class="salary">RM 40</p>
                        </div>
                    </div>
                    <div class="card-tags">
                        <span class="tag">Running Errands</span>
                        <span class="tag">Alor Gajah</span>
                    </div>
                    <div class="card-actions single-action-right">
                        <button class="action-btn">Delete</button>
                    </div>
                </div>
            </div>

            <div class="column">
                <h2 class="column-title">Ongoing</h2>

                <div class="gig-card">
                    <a href="job-details-worker.php" class="card-clickable-overlay"></a>

                    <div class="card-header">
                        <div class="gig-img"><img src="images/cleaning.png" alt="Gig Photo"></div>
                        <div class="job-details">
                            <h3>Need Help with Laundry</h3>
                            <p class="salary">RM 20</p>
                        </div>
                    </div>
                    <div class="card-tags">
                        <span class="tag">Cleaning</span>
                        <span class="tag">Melaka Tengah</span>
                    </div>
                    
                     <div class="card-actions single-action-right">
                        <a href="workerProof.php">
                            <button class="action-btn">Complete</button></a>
                    </div>
                </div>
            </div>

            <div class="column">
                <h2 class="column-title">Completed</h2>

                <div class="gig-card">
                    <a href="job-details-worker.php" class="card-clickable-overlay"></a>

                    <div class="card-header">
                        <div class="gig-img"><img src="images/cleaning.png" alt="Gig Photo"></div>
                        <div class="job-details">
                            <h3>Need Help with Laundry</h3>
                            <p class="salary">RM 20</p>
                        </div>
                    </div>
                    <div class="card-tags">
                        <span class="tag">Cleaning</span>
                        <span class="tag">Melaka Tengah</span>
                    </div>
                    <div class="card-actions single-action-right">
                        <a href="ViewPayment-worker.php">
                            <button class="action-btn">View Payment</button>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php include('footer-worker.php'); ?>
</body>

</html>