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

    ?>
    <header>
        <div class="imgLogo"><img src="images/logo.svg" alt="Hustle Logo"></div>
    </header>
    <main>
        <h2>Gig Category's Trends</h2>
        <p>based on the most applied and posted gig by category</p>

        <div class="button-container">
            <button><a href="progress.php">Back</a></button>
            <button onclick="window.print()">Save as PDF</button>
        </div>
    </main>
</body>
</html>