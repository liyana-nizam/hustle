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
    require_once('connect.php');

    $role = $_SESSION['role'] ?? '';

    if (!isset($_SESSION['username'])) {
        die("Please log in to view your gigs.");
    }

    $username = $_SESSION['username'];
    $sql = "SELECT * from user where username = '$username'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['USER_ID'];
    }
    ?>

    <div class="content-container">

        <div class="title-action-section">
            <h1 class="main-title">Gig Progress</h1>
            <?php if ($role == 'admin') {
            ?>
                <div class="action-buttons">
                    <button class="action-btn"> <a href="view-report.php">View Report</a></button>
                </div>
            <?php
            } ?>
        </div>

        <div class="gig-board">

            <div class="column">
                <h2 class="column-title">Pending</h2>
                <?php
                if ($role === "admin") {
                    $sql_pending = "SELECT gd.*, g.gig_name, g.description, g.visibility, c.category_name
                                        FROM gig_detail gd 
                                        INNER JOIN gig g ON gd.GIG_ID = g.GIG_ID 
                                        LEFT JOIN category c ON gd.CATEGORY_ID = c.CATEGORY_ID
                                        WHERE gd.status = 'Pending'";
                } elseif ($role === "gig owner") {
                    $sql_pending = "SELECT gd.*, g.gig_name, g.description, g.visibility, c.category_name
                                        FROM gig_detail gd 
                                        INNER JOIN gig g ON gd.GIG_ID = g.GIG_ID 
                                        LEFT JOIN category c ON gd.CATEGORY_ID = c.CATEGORY_ID
                                        WHERE gd.status = 'Pending' AND g.user_id = '$user_id'";
                } else {

                    $sql_pending = "SELECT gd.*, g.gig_name, g.description, g.visibility, c.category_name
    FROM gig_detail gd 
    INNER JOIN gig g ON gd.GIG_ID = g.GIG_ID 
    LEFT JOIN category c ON gd.CATEGORY_ID = c.CATEGORY_ID
    INNER JOIN gig_application ga ON g.GIG_ID = ga.GIG_ID
    WHERE gd.status = 'Pending' AND ga.user_id = '$user_id'
    AND ga.app_status NOT IN ('rejected', 'cancelled')";
                }


                $result_pending = $conn->query($sql_pending);

                if ($result_pending && $result_pending->num_rows > 0) {
                    while ($row = $result_pending->fetch_assoc()) {
                        $is_hidden = ($row['visibility'] ?? 'visible') == 'hidden';
                        $card_class = 'gig-card';
                        $badge = '';

                        if ($role === 'gig owner' && $is_hidden) {
                            $card_class .= ' gig-hidden';
                            $badge = '<span class="hidden-badge">Hidden</span>';
                        } elseif ($role === 'gig worker' && $is_hidden) {
                            $card_class .= ' gig-no-longer';
                            $badge = '<span class="hidden-badge no-longer-badge">No Longer Needed</span>';
                        }
                ?>
                        <div class="<?php echo $card_class; ?>">
                            <a href="job-details.php?id=<?php echo $row['GIG_ID']; ?>" class="card-clickable-overlay"></a>
                            <?php echo $badge; ?>
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
                                <span class="tag"><?php $address_parts = explode(',', $row['location']);
                                                    echo htmlspecialchars(trim(end($address_parts))); ?></span>
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
                if ($role === "admin") {
                    $sql_ongoing = "SELECT gd.*, g.gig_name, g.description, g.visibility, c.category_name
                                    FROM gig_detail gd 
                                    INNER JOIN gig g ON gd.GIG_ID = g.GIG_ID 
                                    LEFT JOIN category c ON gd.CATEGORY_ID = c.CATEGORY_ID
                                    WHERE gd.status = 'Ongoing'";
                } elseif ($role === "gig owner") {
                    $sql_ongoing = "SELECT gd.*, g.gig_name, g.description, g.visibility, c.category_name
                                    FROM gig_detail gd 
                                    INNER JOIN gig g ON gd.GIG_ID = g.GIG_ID 
                                    LEFT JOIN category c ON gd.CATEGORY_ID = c.CATEGORY_ID
                                    WHERE gd.status = 'Ongoing' AND g.user_id = '$user_id'";
                } else {
                    $sql_ongoing = "SELECT gd.*, g.gig_name, g.description, g.visibility, c.category_name
                FROM gig_detail gd 
                INNER JOIN gig g ON gd.GIG_ID = g.GIG_ID 
                LEFT JOIN category c ON gd.CATEGORY_ID = c.CATEGORY_ID
                INNER JOIN gig_application ga ON g.GIG_ID = ga.GIG_ID
                WHERE gd.status = 'Ongoing' AND ga.user_id = '$user_id'
                AND ga.app_status = 'approved'";
                }

                $result_ongoing = $conn->query($sql_ongoing);

                if ($result_ongoing && $result_ongoing->num_rows > 0) {
                    while ($row = $result_ongoing->fetch_assoc()) {
                        $is_hidden = ($row['visibility'] ?? 'visible') == 'hidden';
                        $card_class = 'gig-card';
                        $badge = '';

                        if ($role === 'gig owner' && $is_hidden) {
                            $card_class .= ' gig-hidden';
                            $badge = '<span class="hidden-badge">Hidden</span>';
                        } elseif ($role === 'gig worker' && $is_hidden) {
                            $card_class .= ' gig-no-longer';
                            $badge = '<span class="hidden-badge no-longer-badge">No Longer Needed</span>';
                        }
                ?>
                        <div class="<?php echo $card_class; ?>">
                            <a href="job-details.php?id=<?php echo $row['GIG_ID']; ?>" class="card-clickable-overlay"></a>
                            <?php echo $badge; ?>
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
                                <span class="tag"><?php $address_parts = explode(',', $row['location']);
                                                    echo htmlspecialchars(trim(end($address_parts))); ?></span>
                                <?php if ($role == 'gig worker') { ?>
                                    <a href="workerProof.php?id=<?php echo $row['GIG_ID']; ?>" class="tag complete-btn">Complete</a>
                                <?php } ?>
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
                if ($role === "admin") {
                    $sql_completed = "SELECT gd.*, g.gig_name, g.description, g.visibility, c.category_name
                                      FROM gig_detail gd 
                                      INNER JOIN gig g ON gd.GIG_ID = g.GIG_ID
                                      LEFT JOIN category c ON gd.CATEGORY_ID = c.CATEGORY_ID
                                      WHERE gd.status = 'Completed'";
                } elseif ($role === "gig owner") {
                    $sql_completed = "SELECT gd.*, g.gig_name, g.description, g.visibility, c.category_name
                                      FROM gig_detail gd 
                                      INNER JOIN gig g ON gd.GIG_ID = g.GIG_ID 
                                      LEFT JOIN category c ON gd.CATEGORY_ID = c.CATEGORY_ID
                                      WHERE gd.status = 'Completed' AND g.user_id = '$user_id'";
                } else {
                    $sql_completed = "SELECT gd.*, g.gig_name, g.description, g.visibility, c.category_name
                                      FROM gig_detail gd 
                                      INNER JOIN gig g ON gd.GIG_ID = g.GIG_ID 
                                      LEFT JOIN category c ON gd.CATEGORY_ID = c.CATEGORY_ID
                                      INNER JOIN gig_application ga ON g.GIG_ID = ga.GIG_ID
                                      WHERE gd.status = 'Completed' AND ga.user_id = '$user_id'";
                }

                $result_completed = $conn->query($sql_completed);

                if ($result_completed && $result_completed->num_rows > 0) {
                    while ($row = $result_completed->fetch_assoc()) {
                        $is_hidden = ($row['visibility'] ?? 'visible') == 'hidden';
                        $card_class = 'gig-card';
                        $badge = '';
                        if ($role === 'gig owner' && $is_hidden) {
                            $card_class .= ' gig-hidden';
                            $badge = '<span class="hidden-badge">Hidden</span>';
                        } elseif ($role === 'gig worker' && $is_hidden) {
                            $card_class .= ' gig-no-longer';
                            $badge = '<span class="hidden-badge no-longer-badge">No Longer Needed</span>';
                        }
                ?>
                        <?php
                        $current_time = date('Y-m-d H:i:s');
                        $is_overdue = $current_time > $row['due'];
                        $card_overdue_class = $is_overdue ? ' overdue-card' : '';
                        ?>
                        <div class="<?php echo $card_class . $card_overdue_class; ?>">
                            <a href="job-details.php?id=<?php echo $row['GIG_ID']; ?>" class="card-clickable-overlay"></a>
                            <?php echo $badge; ?>
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
                                <span class="tag"><?php $address_parts = explode(',', $row['location']);
                                                    echo htmlspecialchars(trim(end($address_parts))); ?></span>

                                <?php if ($role == 'gig worker') { ?>
                                    <a href="ViewPayment-worker.php?id=<?php echo $row['GIG_ID']; ?>" class="tag complete-btn">View Payment</a>
                                <?php } elseif ($role == 'gig owner') { ?>
                                    <a href="ViewPayment-worker.php?id=<?php echo $row['GIG_ID']; ?>" class="tag complete-btn">Payment</a>
                                <?php } elseif ($role == 'admin') { ?>
                                    <a href="ViewPayment-worker.php?id=<?php echo $row['GIG_ID']; ?>" class="tag complete-btn">View Details</a>
                                <?php } ?>
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