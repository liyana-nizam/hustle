<?php
session_start();

if(isset($_POST['submit'])){

    $_SESSION['job_name'] = $_POST['job_name'];
    $_SESSION['category'] = $_POST['CATEGORY_ID'];
    $_SESSION['description'] = $_POST['job_description'];
    $_SESSION['district'] = $_POST['district'];
    $_SESSION['location'] = $_POST['location'];
    $_SESSION['gig_date'] = $_POST['gig_date'];
    $_SESSION['frequency'] = $_POST['frequency'];
    $_SESSION['salary'] = $_POST['salary'];
    $_SESSION['posted'] = true; 

    header("Location: job-details.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hustle</title>
    <link rel="stylesheet" href="gigpost-style.css">
</head>
<body>

<?php include('head.php'); ?>

<main class="form-container">
    <h2>Post a Gig</h2>

    <form id="gigForm" method="POST">

        <input type="hidden" id="GIG_ID" name="GIG_ID" value="101">
        <input type="hidden" id="status" name="status" value="Pending">

        <div class="form-group">
            <label for="job_name">Job Name</label>
            <input type="text" id="job_name" name="job_name" placeholder="Maid" required>
        </div>

        <div class="row-2col">

            <div class="form-group">
                <label for="CATEGORY_ID">Job Category</label>
                <select id="CATEGORY_ID" name="CATEGORY_ID" class="custom-select" required>
                    <option value="" disabled selected>Category</option>
                    <option value="Cleaning">Cleaning</option>
                    <option value="RunningErrands">Running Errands</option>
                    <option value="HomeFixing">Home Fixing</option>
                    <option value="Gardening">Gardening</option>
                    <option value="Tutoring">Tutoring</option>
                    <option value="Caregiving">Caregiving</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="job_description">Job Description</label>
                <textarea id="job_description" name="job_description" placeholder="Write your text here...."></textarea>
            </div>
        </div>

        <div class="row-2col">
        <div class="form-group">
            <label for="district">District</label>
                <select id="district" name="district" class="custom-select">
                    <option value="" disabled selected>District</option>
                    <option value="Melaka Tengah">Melaka Tengah</option>
                    <option value="Alor Gajah">Alor Gajah</option>
                    <option value="Jasin">Jasin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" maxlength="100" placeholder="Lot 15, Jalan Hang Tuah, 75300 Melaka Tengah, Melaka" required>
            </div>
        </div>

        <div class="row-equal">
            <div class="form-group">
                <label for="gig_date">Gig Date & Time</label>
                <input type="datetime-local" id="gig_date" name="gig_date" required>
            </div>

            <div class="form-group">
                <label for="frequency">Frequency</label>
                <select id="frequency" name="frequency" required>
                <option value="One-time">One-time</option>
                <option value="Daily">Daily</option>
                <option value="Weekly">Weekly</option>
                </select>
            </div>

        </div>
        <div class="form-group">
            <label for="salary">Salary (RM)</label>
            <input type="number" id="salary" name="salary" step="0.01" min="0" placeholder="40.00" required>
        </div>

    <div class="submit-container">
    <button type="submit" name="submit" class="btn-submit">Post</button>
    </div>
    </form>
</main>

<?php include('footer.php'); ?>

</body>
</html>