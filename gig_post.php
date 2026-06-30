<?php
session_start();
require_once('connect.php');

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

    <form id="gigForm" method="POST" action="post-gig.php">

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
                    <option value="Running Errands">Running Errands</option>
                    <option value="Home Fixing">Home Fixing</option>
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
                <select id="district" name="district" class="custom-select" required>
                    <option value="" disabled selected>District</option>
                    <option value="Melaka Tengah">Melaka Tengah</option>
                    <option value="Alor Gajah">Alor Gajah</option>
                    <option value="Jasin">Jasin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" maxlength="100" placeholder="Lot 15, Jalan Hang Tuah" required>
            </div>
        </div>

        <div class="row-equal">
            <div class="form-group">
                <label for="gig_date">Gig Date & Time</label>
                <input type="datetime-local" id="gig_date" name="gig_date" required>
            </div>

            <div class="form-group">
                <label for="due">Due</label>
                <input type="datetime-local" id="due" name="due" required>


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

<?php 
include('footer.php'); 
$conn->close();
?>

<script>
    const gigDateInput = document.getElementById('gig_date');
    const dueInput = document.getElementById('due');

    const now = new Date();
    // Format to YYYY-MM-DDTHH:MM (required format for datetime-local)
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');

    const minDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
    gigDateInput.min = minDateTime;

// Due date must be at least 1 hour after gig date
    gigDateInput.addEventListener('change', function() {
        if (gigDateInput.value) {
            const gigDate = new Date(gigDateInput.value);
            gigDate.setHours(gigDate.getHours() + 1); // at least 1 hour after

            const year = gigDate.getFullYear();
            const month = String(gigDate.getMonth() + 1).padStart(2, '0');
            const day = String(gigDate.getDate()).padStart(2, '0');
            const hours = String(gigDate.getHours()).padStart(2, '0');
            const minutes = String(gigDate.getMinutes()).padStart(2, '0');

            dueInput.min = `${year}-${month}-${day}T${hours}:${minutes}`;

            if (dueInput.value && dueInput.value <= gigDateInput.value) {
                dueInput.value = '';
            }
        }
    });
</script>
</body>
</html>