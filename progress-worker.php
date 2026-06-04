<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Worker - Hustle</title>
    <link rel="stylesheet" href="base.css" type="text/css">
    <link rel="stylesheet" href="progress-style.css" type="text/css">

</head>

<body>
    <?php include('header-admin.php') ?>

    <div class="admin-container">
        <h1 class="main-title">Gig Progress</h1>

        <div class="gig-board">

            <div class="column">
                <h2 class="column-title">Pending</h2>

                <div class="gig-card">
                    <div class="card-header">
                        <div class="avatar"></div>
                        <div class="job-details">
                            <h3>Job Title</h3>
                            <p class="salary">Salary</p>
                        </div>
                    </div>
                    <div class="card-tags">
                        <span class="tag">Category</span>
                        <span class="tag">District</span>
                    </div>
                    <div class="card-actions">
                        <button class="delete-btn">Delete</button>
                    </div>
                </div>

                <div class="gig-card">
                    <div class="card-header">
                        <div class="avatar"></div>
                        <div class="job-details">
                            <h3>Job Title</h3>
                            <p class="salary">Salary</p>
                        </div>
                    </div>
                    <div class="card-tags">
                        <span class="tag">Category</span>
                        <span class="tag">District</span>
                    </div>
                    <div class="card-actions">
                        <button class="delete-btn">Delete</button>
                    </div>
                </div>
            </div>

            <div class="column">
                <h2 class="column-title">Ongoing</h2>

                <div class="gig-card">
                    <div class="card-header">
                        <div class="avatar"></div>
                        <div class="job-details">
                            <h3>Job Title</h3>
                            <p class="salary">Salary</p>
                        </div>
                    </div>
                    <div class="card-tags">
                        <span class="tag">Category</span>
                        <span class="tag">District</span>
                    </div>
                    <div class="card-actions">
                        <button class="delete-btn">Delete</button>
                    </div>
                </div>
            </div>

            <div class="column">
                <h2 class="column-title">Completed</h2>

                <div class="gig-card">
                    <div class="card-header">
                        <div class="avatar"></div>
                        <div class="job-details">
                            <h3>Job Title</h3>
                            <p class="salary">Salary</p>
                        </div>
                    </div>
                    <div class="card-tags">
                        <span class="tag">Category</span>
                        <span class="tag">District</span>
                    </div>
                    <div class="card-actions">
                        <button class="delete-btn">Delete</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php include('footer-admin.php'); ?>
</body>

</html>