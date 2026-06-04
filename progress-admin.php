<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Admin - Hustle</title>
    <link rel="stylesheet" href="progress-style.css" type="text/css">
</head>
<body>
    <?php include('header-admin.php'); ?>
    
    <div class="admin-container">
        
        <div class="title-action-section">
            <h1 class="main-title">Gig Progress</h1>
            <div class="action-buttons">
                <button class="action-btn">Download Report</button>
                <button class="action-btn">Display Graph</button>
            </div>
        </div>

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
                </div>
            </div>

        </div> </div> <?php include('footer-admin.php'); ?>
</body>
</html>