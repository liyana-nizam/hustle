<?php
session_start();

if(isset($_POST['save'])){

    $_SESSION['job_name'] = $_POST['job_name'];
    $_SESSION['category'] = $_POST['CATEGORY_ID'];
    $_SESSION['description'] = $_POST['job_description'];
    $_SESSION['district'] = $_POST['district'];
    $_SESSION['location'] = $_POST['location'];
    $_SESSION['gig_date'] = $_POST['gig_date'];
    $_SESSION['frequency'] = $_POST['frequency'];
    $_SESSION['salary'] = $_POST['salary'];

    header("Location: job-details-owner.php");
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

<?php include('header-owner.php'); ?>

<main class="form-container">
    <h2>Edit Gig Details</h2>

    <form method="POST">

        <div class="form-group">
            <label for="job_name">Job Name</label>
            <input type="text" id="job_name" name="job_name" value="<?php echo $_SESSION['job_name'] ?? ''; ?>" required>
        </div>

        <div class="row-2col">
            <div class="form-group">
            <label for="CATEGORY_ID">Job Category</label>
            <select id="CATEGORY_ID" name="CATEGORY_ID" class="custom-select" required>
            <option value="Cleaning"
            <?php if(($_SESSION['category'] ?? '') == 'Cleaning') echo 'selected'; ?>>Cleaning</option>

            <option value="RunningErrands"
            <?php if(($_SESSION['category'] ?? '') == 'RunningErrands') echo 'selected'; ?>>Running Errands</option>

            <option value="HomeFixing"
            <?php if(($_SESSION['category'] ?? '') == 'HomeFixing') echo 'selected'; ?>>Home Fixing</option>

            <option value="Gardening"
            <?php if(($_SESSION['category'] ?? '') == 'Gardening') echo 'selected'; ?>>Gardening</option>

            <option value="Tutoring"
            <?php if(($_SESSION['category'] ?? '') == 'Tutoring') echo 'selected'; ?>>Tutoring</option>

            <option value="Caregiving"
            <?php if(($_SESSION['category'] ?? '') == 'Caregiving') echo 'selected'; ?>>Caregiving</option>

            <option value="Other"
            <?php if(($_SESSION['category'] ?? '') == 'Other') echo 'selected'; ?>>Other</option>
            </select>
            </div>

            <div class="form-group">
                <label for="job_description">Job Description</label>
                <textarea id="job_description" name="job_description"><?php echo $_SESSION['description'] ?? ''; ?></textarea>
            </div>
        </div>

        <div class="row-2col">
            <div class="form-group">
                <label for="district">District</label>
                <select id="district" name="district" class="custom-select">
                <option value="Melaka Tengah"
                <?php if(($_SESSION['district'] ?? '') == 'Melaka Tengah') echo 'selected'; ?>>Melaka Tengah</option>
                <option value="Alor Gajah"
                <?php if(($_SESSION['district'] ?? '') == 'Alor Gajah') echo 'selected'; ?>>Alor Gajah</option>
                <option value="Jasin"
                <?php if(($_SESSION['district'] ?? '') == 'Jasin') echo 'selected'; ?>>Jasin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text"
                id="location" name="location" maxlength="100" value="<?php echo $_SESSION['location'] ?? ''; ?>"required>
            </div>

        </div>

        <div class="row-equal">
            <div class="form-group">
                <label for="gig_date">Gig Date & Time</label>
                <input type="datetime-local" id="gig_date" name="gig_date" value="<?php echo $_SESSION['gig_date'] ?? ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="frequency">Frequency</label>
                <select id="frequency" name="frequency" required>

                <option value="One-time"
                <?php if(($_SESSION['frequency'] ?? '') == 'One-time') echo 'selected'; ?>>One-time</option>
                <option value="Daily"
                <?php if(($_SESSION['frequency'] ?? '') == 'Daily') echo 'selected'; ?>>Daily</option>
                <option value="Weekly"
                <?php if(($_SESSION['frequency'] ?? '') == 'Weekly') echo 'selected'; ?>>Weekly</option>
                </select>
            </div>

        </div>

        <div class="form-group">
            <label for="salary">Salary (RM)</label>

            <input type="number" id="salary" name="salary" step="0.01" min="0" value="<?php echo $_SESSION['salary'] ?? ''; ?>" required>
        </div>

        <div class="submit-container">
            <button type="submit" name="save" class="btn-submit"> Save Changes</button>
        </div>

    </form>

</main>

<?php include('footer-owner.php'); ?>

</body>
</html>