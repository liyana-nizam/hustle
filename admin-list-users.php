<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hustle</title>
    <link rel="stylesheet" href="base.css" type="text/css">
    <link rel="stylesheet" href="list-style.css" type="text/css">
</head>
<body>
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    include('head.php');
    include('connect.php');

    if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];

            $searchUser = isset($_GET['searchUser']) ? trim($_GET['searchUser']) : '';
            $filterRole = isset($_GET['filterRole']) ? trim($_GET['filterRole']) : '';

            $sql = "SELECT * from user WHERE 1 = 1";
            $result = $conn->query($sql);

            $params = [];
            $types = "";

            if (!empty($searchUser)) {
                $sql .= " AND username LIKE ?";
                $params[] = "%" . $searchUser . "%";
                $types .= "s";
            }

            if (!empty($filterRole)) {
                $sql .= " AND role LIKE ?";
                $params[] = "%" . $filterRole . "%";
                $types .= "s";
            }

            $stmt = $conn->prepare($sql);
            if (!empty($params)) {
                $stmt->bind_param($types, ...$params);
            }
            $stmt->execute();
            $result = $stmt->get_result();
    ?>
    <div class="content-container">
        <!-- Search Bar & Filter -->        
        <div class="search-filter-container">
            <form action="" method="GET">
                <div class="search-section">
                    <label for="searchUser" class="accessibility">Username</label>
                    <input type="search" id="searchUser" name="searchUser" placeholder="Search by username..." value="<?php echo htmlspecialchars($searchUser); ?>">
                </div>
                <div class="filter-section">
                    <label for="filterRole" class="accessibility">Role</label>
                    <select id="filterRole" name="filterRole">
                        <option value="" <?php echo empty($filterCategory) ? 'selected' : ''; ?>>Role</option>
                        <option value="Gig Worker" <?php echo $filterRole == 'Gig Worker' ? 'selected' : ''; ?>>Gig Worker</option>
                        <option value="Gig Owner" <?php echo $filterRole == 'Gig Owner' ? 'selected' : ''; ?>>Gig Owner</option>
                        <option value="Admin" <?php echo $filterRole == 'Admin' ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>
                <button type="submit">Search</button>
            </form>
        </div>
        <?php
        if ($result && $result->num_rows > 0) {
             while ($row = $result->fetch_assoc()) {
        ?>
        <!-- List of User -->
        <div class="list-container">
            <ul class="user-list">
                <li class="item-container">
                    <a href="profile-user.php?id=<?php echo $row['USER_ID']; ?>">
                    <div class="user-left">
                        <div class="user-img"><img src="" alt="Icon User"></div>
                        <div class="user-info">
                            <p class="user-name"><?php echo htmlspecialchars($row['username']) ?></p>                           
                        </div>
                    </div>
                    <div class="user-right">
                        <p class="user-filter"><?php echo htmlspecialchars($row['role']) ?></p>
                    </div>
                    </a>
                </li>
            </ul>
        </div>
        <?php 
             }} else {
                echo "<p style='text-align:center; padding-top:15px'>No User Found.</p>";
            }
        } else {
            echo "<p style='text-align:center;'>You must be logged in to view profile.</p>";
        }
        ?>
    </div>
    <?php
    $conn->close();
    include('footer.php') 
    ?>
</body>
</html>