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
    if (session_status() === PHP_SESSION_NONE) 
    {
        session_start();
    }
    include('head.php');
    require_once('connect.php');

    if (isset($_SESSION['username'])) 
    {
        $username = $_SESSION['username'];
        $searchUser = isset($_GET['searchUser']) ? trim($_GET['searchUser']) : '';
        $filterCategory = isset($_GET['filterCategory']) ? trim($_GET['filterCategory']) : '';
        $filterDistrict = isset($_GET['filterDistrict']) ? trim($_GET['filterDistrict']) : '';

        $sql = "SELECT gd.*, g.gig_name, c.category_name
                FROM gig_detail gd 
                INNER JOIN gig g ON gd.GIG_ID = g.GIG_ID
                LEFT JOIN category c ON gd.CATEGORY_ID = c.CATEGORY_ID
                WHERE g.visibility = 'visible' AND gd.status = 'pending'";
        $result = $conn->query($sql);

        $params = [];
        $types = "";

            if (!empty($searchUser)) 
            {
                $sql .= " AND g.gig_name LIKE ?";
                $params[] = "%" . $searchUser . "%";
                $types .= "s";
            }

            if (!empty($filterCategory)) 
            {
                $sql .= " AND c.category_name = ?";
                $params[] = $filterCategory;
                $types .= "s";
            }

            if (!empty($filterDistrict)) 
            {
                $sql .= " AND gd.location LIKE ?";
                $params[] = "%" . $filterDistrict . "%";
                $types .= "s";
            }

            $stmt = $conn->prepare($sql);
            if (!empty($params)) 
            {
                $stmt->bind_param($types, ...$params);
            }
            $stmt->execute();
            $result = $stmt->get_result();
    ?>

    <div class="content-container">
        <div class="search-filter-container">
            <form action="" method="GET">
                <div class="search-section">
                    <label for="searchUser" class="accessibility">Username</label>
                    <input type="search" id="searchUser" name="searchUser" placeholder="Search by gig name..." value="<?php echo htmlspecialchars($searchUser); ?>">
                </div>

                <div class="filter-section">
                    <label for="filterCategory" class="accessibility">Category</label>
                    <select id="filterCategory" name="filterCategory">
                        <option value="" <?php echo empty($filterCategory) ? 'selected' : ''; ?>>Category</option>
                        <option value="Cleaning" <?php echo $filterCategory == 'Cleaning' ? 'selected' : ''; ?>>Cleaning</option>
                        <option value="Running Errands" <?php echo $filterCategory == 'Running Errands' ? 'selected' : ''; ?>>Running Errands</option>
                        <option value="Home Fixing" <?php echo $filterCategory == 'Home Fixing' ? 'selected' : ''; ?>>Home Fixing</option>
                        <option value="Gardening" <?php echo $filterCategory == 'Gardening' ? 'selected' : ''; ?>>Gardening</option>
                        <option value="Tutoring" <?php echo $filterCategory == 'Tutoring' ? 'selected' : ''; ?>>Tutoring</option>
                        <option value="Caregiving" <?php echo $filterCategory == 'Caregiving' ? 'selected' : ''; ?>>Caregiving</option>
                        <option value="Other" <?php echo $filterCategory == 'Other' ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>

                <div class="filter-section">
                    <label for="filterDistrict" class="accessibility">District</label>
                    <select id="filterDistrict" name="filterDistrict">
                        <option value="" <?php echo empty($filterCategory) ? 'selected' : ''; ?>>District</option>
                        <option value="Alor Gajah" <?php echo $filterDistrict == 'Alor Gajah' ? 'selected' : ''; ?>>Alor Gajah</option>
                        <option value="Jasin" <?php echo $filterDistrict == 'Jasin' ? 'selected' : ''; ?>>Jasin</option>
                        <option value="Melaka Tengah" <?php echo $filterDistrict == 'Melaka Tengah' ? 'selected' : ''; ?>>Melaka Tengah</option>
                    </select>
                </div>  

                <button type="submit">Search</button>
            </form>
        </div>

        <?php
        if ($result && $result->num_rows > 0) 
        {
            while ($row = $result->fetch_assoc()) 
            {
        ?>
        
        <div class="list-container">
            <ul class="gig-list">
                <li class="item-container">
                    <a href="job-details.php?id=<?php echo $row['GIG_ID']; ?>">
                    <div class="gig-left">
                        <div class="gig-img">
                            <img src="<?php echo getCategoryImage($row['category_name'] ?? ''); ?>"
                            alt="<?php echo htmlspecialchars($row['category_name'] ?? ''); ?>">
                        </div>

                        <div class="gig-info">
                            <p class="gig-name"><?php echo htmlspecialchars($row['gig_name']); ?></p>
                            <p class="gig-salary">RM <?php echo htmlspecialchars($row['salary'])?></p>                            
                        </div>
                    </div>

                    <div class="gig-right">
                        <p class="gig-filter"><?php echo htmlspecialchars($row['category_name'])?></p>
                        <p class="gig-filter"><?php $address_parts = explode(',', $row['location']); echo htmlspecialchars(trim(end($address_parts))); ?></p>
                    </div>
                    </a>
                </li>
            </ul>
        </div>

        <?php 
             }} else 
            {
                echo "<p style='text-align:center; padding-top:15px'>No Gig Found.</p>";
            }
            } else 
            {
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