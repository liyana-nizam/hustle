<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress - Hustle</title>
    <link rel="stylesheet" href="progress-style.css" type="text/css">
</head>

<body>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include('head.php');
    include('connect.php');

    $role = $_SESSION['role'] ?? '';
    ?>

    <div class="content-container">

        <div class="title-action-section">
            <h1 class="main-title">Gig Progress</h1>
            <?php if ($role == 'admin'){ ?>
            <div class="action-buttons">
                <button class="action-btn">Download Report</button>
                <button class="action-btn">Display Graph</button>
            </div>
            <?php } ?>
        </div>

        <div class="gig-board">

            <div class="column">
                <h2 class="column-title">Pending</h2>
                <?php
                // JOIN query combining gig and gig_detail based on GIG_ID
                $sql_pending = "SELECT gd.*, g.gig_name, g.description, c.category_name
                                FROM gig_detail gd 
                                INNER JOIN gig g ON gd.GIG_ID = g.GIG_ID 
                                LEFT JOIN category c ON gd.CATEGORY_ID = c.CATEGORY_ID
                                WHERE gd.status = 'Pending'";
                $result_pending = $conn->query($sql_pending);

                if ($result_pending && $result_pending->num_rows > 0) {
                    while($row = $result_pending->fetch_assoc()) {
                ?>
                        <div class="gig-card">
                            <a href="job-details.php?id=<?php echo $row['GIG_ID']; ?>" class="card-clickable-overlay"></a>
                            <div class="card-header">
                                <div class="gig-img">
                                    <img src="<?php echo getCategoryImage($row['category_name'] ?? ''); ?>"
                                    alt="<?php echo htmlspecialchars($row['category_name'] ?? ''); ?>">
                                </div>
                                <div class="job-details">
                                    <h3><?php echo htmlspecialchars($row['gig_name']); ?></h3>
                                    <p class="salary">RM <?php echo htmlspecialchars($row['salary']); ?></p>
                                </div>
                            </div>
                            <div class="card-tags">
                                <span class="tag"><?php echo htmlspecialchars($row['category_name'] ?? ''); ?></span>
                                <span class="tag"><?php $address_parts = explode(',', $row['location']); echo htmlspecialchars(trim(end($address_parts))); ?></span>
                                
                            </div>
                        </div>
                <?php 
                    }
                } else {
                    echo "<p class='no-gigs'>No pending gigs.</p>";
                }
                ?>
            </div>

            <div class="column">
                <h2 class="column-title">Ongoing</h2>
                <?php
                $sql_ongoing = "SELECT gd.*, g.gig_name, g.description, c.category_name
                                FROM gig_detail gd 
                                INNER JOIN gig g ON gd.GIG_ID = g.GIG_ID 
                                LEFT JOIN category c ON gd.CATEGORY_ID = c.CATEGORY_ID
                                WHERE gd.status = 'Ongoing'";
                $result_ongoing = $conn->query($sql_ongoing);

                if ($result_ongoing && $result_ongoing->num_rows > 0) {
                    while($row = $result_ongoing->fetch_assoc()) {
                ?>
                        <div class="gig-card">
                            <a href="job-details.php?id=<?php echo $row['GIG_ID']; ?>" class="card-clickable-overlay"></a>
                            <div class="card-header">
                                <div class="gig-img">
                                    <img src="<?php echo getCategoryImage($row['category_name'] ?? ''); ?>"
                                    alt="<?php echo htmlspecialchars($row['category_name'] ?? ''); ?>">
                                </div>
                                <div class="job-details">
                                    <h3><?php echo htmlspecialchars($row['gig_name']); ?></h3>
                                    <p class="salary">RM <?php echo htmlspecialchars($row['salary']); ?></p>
                                </div>
                            </div>
                            <div class="card-tags">
                                <span class="tag"><?php echo htmlspecialchars($row['category_name'] ?? ''); ?></span>
                                <span class="tag"><?php $address_parts = explode(',', $row['location']); echo htmlspecialchars(trim(end($address_parts))); ?></span>
                                <a href="workerProof.php?id=<?php echo $row['GIG_ID']; ?>" class="tag complete-btn">Complete</a>
                                
                            </div>
                        </div>
                <?php 
                    }
                } else {
                    echo "<p class='no-gigs'>No ongoing gigs.</p>";
                }
                ?>
            </div>

            <div class="column">
                <h2 class="column-title">Completed</h2>
                <?php
                $sql_completed = "SELECT gd.*, g.gig_name, g.description, c.category_name
                                  FROM gig_detail gd 
                                  INNER JOIN gig g ON gd.GIG_ID = g.GIG_ID
                                  LEFT JOIN category c ON gd.CATEGORY_ID = c.CATEGORY_ID
                                  WHERE gd.status = 'Completed'";
                $result_completed = $conn->query($sql_completed);

                if ($result_completed && $result_completed->num_rows > 0) {
                    while($row = $result_completed->fetch_assoc()) {
                ?>
                        <div class="gig-card">
                            <a href="job-details.php?id=<?php echo $row['GIG_ID']; ?>" class="card-clickable-overlay"></a>
                            <div class="card-header">
                                <div class="gig-img">
                                    <img src="<?php echo getCategoryImage($row['category_name'] ?? ''); ?>"
                                    alt="<?php echo htmlspecialchars($row['category_name'] ?? ''); ?>">
                                </div>
                                <div class="job-details">
                                    <h3><?php echo htmlspecialchars($row['gig_name']); ?></h3>
                                    <p class="salary">RM <?php echo htmlspecialchars($row['salary']); ?></p>
                                </div>
                            </div>
                            <div class="card-tags">
                                <span class="tag"><?php echo htmlspecialchars($row['category_name'] ?? ''); ?></span>
                                <span class="tag"><?php $address_parts = explode(',', $row['location']); echo htmlspecialchars(trim(end($address_parts))); ?></span>
                                <span class="tag"><?php echo htmlspecialchars($row['status']); ?></span>
                            </div>
                        </div>
                <?php 
                    }
                } else {
                    echo "<p class='no-gigs'>No completed gigs.</p>";
                }
                ?>
            </div>

        </div>
    </div> 
    <?php
    $conn->close(); 
    include('footer.php'); 
    ?>
</body>

</html>