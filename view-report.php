<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hustle's Report</title>
    <link rel="stylesheet" href="report-style.css" type="text/css">
</head>
<body>
    <?php
    include('connect.php');

    $query = "SELECT c.category_name, COUNT(DISTINCT gd.GIG_ID) AS posted_gig, COUNT(ga.GIG_ID) AS applied_gig
              FROM category c
              LEFT JOIN gig_detail gd ON c.CATEGORY_ID = gd.CATEGORY_ID
              LEFT JOIN gig_application ga ON gd.GIG_ID = ga.GIG_ID
              GROUP BY c.category_name
              ORDER BY posted_gig DESC;";

    $result = $conn->query($query);

    $mysqlData = [];
    $maxVal = 0;

    $totalApplied = 0;
    $totalPosted = 0;

    if ($result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $mysqlData[] = $row;

            $totalPosted += $row['posted_gig'];
            $totalApplied += $row['applied_gig'];

            if ($row['applied_gig'] > $maxVal) $maxVal = $row['applied_gig'];
            if ($row['posted_gig'] > $maxVal)  $maxVal = $row['posted_gig'];
        }
    }
    $conn->close();

    ?>
    <header>
        <div class="imgLogo"><img src="images/logo.svg" alt="Hustle Logo"></div>
    </header>
    <main>
        <h2>Gig Category's Trends</h2>
        <p style="color: gray;">based on the most applied and posted gig by category</p>

        <div class="chart-hint">
            <div class="hint">
                <p class="hint-dot" style="background-color: rgb(150, 0, 66);"></p>
                <p class="hint-text">Gigs Posted</p>
            </div>
            <div class="hint">
                <p class="hint-dot" style="background-color: rgb(243, 163, 188);"></p>
                <p class="hint-text">Gigs Applied</p>
            </div>
        </div>

        <div class="chart-container">
            <?php foreach ($mysqlData as $item):
            $appliedPercentage = $maxVal > 0 ? ($item['applied_gig'] / $maxVal) * 100 : 0;
            $postedPercentage  = $maxVal > 0 ? ($item['posted_gig'] / $maxVal) * 100 : 0;
            ?>

            <div class="chart-row">
                <div class="category-name" title="<?php echo htmlspecialchars($item['category_name']); ?>">
                    <?php echo htmlspecialchars($item['category_name']); ?>
            </div>
            <div class="bar-container">
                <div class="bar-wrapper">
                    <div class="coloured-bar" style="width: <?php echo $postedPercentage; ?>%; background-color: rgb(150, 0, 66);"></div>
                    <div class="bar-value"><?php echo $item['posted_gig']; ?></div>
                </div>
                <div class="bar-wrapper">
                    <div class="coloured-bar" style="width: <?php echo $appliedPercentage; ?>%; background-color: rgb(243, 163, 188);"></div>
                    <div class="bar-value"><?php echo $item['applied_gig']; ?></div>
                </div>
            </div>
            </div>
            <?php endforeach ?>
        </div>

        <div class="summary-container">
            <?php $applicationRate = $totalPosted > 0 ? round(($totalApplied / $totalPosted) * 100) : 0; ?>
            <p>The chart above illustrates the distribution of gigs posted versus gigs applied for across seven distinct categories within the Hustle system. 
                A total of <?php echo $totalPosted ?> gigs were posted, 
                attracting a total of <?php echo $totalApplied ?> applications, 
                resulting in an overall application rate of <?php echo $applicationRate ?>%</p>
        </div>

        <div class="button-container">
            <button><a href="progress.php">Back</a></button>
            <button onclick="window.print()">Save as PDF</button>
        </div>
    </main>
</body>
</html>