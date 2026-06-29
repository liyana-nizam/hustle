<?php
session_start();
require_once('connect.php');


if (!isset($_SESSION['username'])) {
    die("Error: You must be logged in to edit posts.");
}

$username = $_SESSION['username'];

$user_sql = "SELECT user_id FROM user WHERE username='$username'";
$user_result = $conn->query($user_sql);
if ($user_result->num_rows === 0) {
    die("Error: User session invalid.");
}
$logged_in_user = $user_result->fetch_assoc()['user_id'];



if (!isset($_GET['id'])) {
    die("Error: No gig ID specified.");
}
$gig_id = intval($_GET['id']);



$fetch_sql = "SELECT g.*, gd.* FROM gig g 
              JOIN gig_detail gd ON g.GIG_ID = gd.GIG_ID 
              WHERE g.GIG_ID = '$gig_id' AND g.USER_ID = '$logged_in_user'";

$fetch_result = $conn->query($fetch_sql);


if ($fetch_result->num_rows === 0) {
    die("Error: You do not have permission to edit this post, or it does not exist.");
}

$gig = $fetch_result->fetch_assoc();


$full_location = $gig['location'] ?? '';
$location_parts = explode(', ', $full_location);
$current_location = $location_parts[0] ?? '';
$current_district = $location_parts[1] ?? '';



if (isset($_POST['save'])) {
    
    // Clean inputs to avoid basic database errors
    $job_name    = mysqli_real_escape_string($conn, $_POST['job_name']);
    $category    = mysqli_real_escape_string($conn, $_POST['CATEGORY_ID']);
    $description = mysqli_real_escape_string($conn, $_POST['job_description']);
    $location    = mysqli_real_escape_string($conn, $_POST['location'] . ", " . $_POST['district']);
    $gig_date    = mysqli_real_escape_string($conn, $_POST['gig_date']);
    $due   = mysqli_real_escape_string($conn, $_POST['due']);
    $salary      = mysqli_real_escape_string($conn, $_POST['salary']);


    $cat_sql = "SELECT category_id FROM category WHERE category_name='$category'";
    $cat_result = $conn->query($cat_sql);
    if ($cat_result->num_rows > 0) {
        $category_id = $cat_result->fetch_assoc()['category_id'];
    } else {
        $category_id = $gig['CATEGORY_ID']; // Fallback to current if not found
    }

    
    $sql_update1 = "UPDATE gig SET 
                    gig_name = '$job_name', 
                    description = '$description' 
                    WHERE GIG_ID = '$gig_id' AND USER_ID = '$logged_in_user'";

    // Update table gig_detail
    $sql_update2 = "UPDATE gig_detail SET 
                    category_id = '$category_id', 
                    location = '$location', 
                    salary = '$salary', 
                    gig_date = '$gig_date', 
                    due = '$due' 
                    WHERE GIG_ID = '$gig_id'";

    // Execute updates
    if ($conn->query($sql_update1) === TRUE && $conn->query($sql_update2) === TRUE) {
        echo "Changes saved successfully!";
        echo "<meta http-equiv='refresh' content='2;URL=job-details.php?id=" . $gig_id . "'>";
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hustle - Edit Gig</title>
    <link rel="stylesheet" href="gigpost-style.css">
</head>
<body>

<?php include('head.php'); ?>

<main class="form-container">
    <h2>Edit Gig Details</h2>

    <form method="POST">

        <div class="form-group">
            <label for="job_name">Job Name</label>
            <input type="text" id="job_name" name="job_name" value="<?php echo htmlspecialchars($gig['gig_name'] ?? ''); ?>" required>
        </div>

        <div class="row-2col">
            <div class="form-group">
            <label for="CATEGORY_ID">Job Category</label>
            <select id="CATEGORY_ID" name="CATEGORY_ID" class="custom-select" required>
                <option value="Cleaning" <?php if(($gig['category_id'] ?? '') == '1') echo 'selected'; ?>>Cleaning</option>
                <option value="RunningErrands" <?php if(($gig['category_id'] ?? '') == '2') echo 'selected'; ?>>Running Errands</option>
                <option value="HomeFixing" <?php if(($gig['category_id'] ?? '') == '3') echo 'selected'; ?>>Home Fixing</option>
                <option value="Gardening" <?php if(($gig['category_id'] ?? '') == '4') echo 'selected'; ?>>Gardening</option>
                <option value="Tutoring" <?php if(($gig['category_id'] ?? '') == '5') echo 'selected'; ?>>Tutoring</option>
                <option value="Caregiving" <?php if(($gig['category_id'] ?? '') == '6') echo 'selected'; ?>>Caregiving</option>
                <option value="Other" <?php if(($gig['category_id'] ?? '') == '7') echo 'selected'; ?>>Other</option>
            </select>
            </div>

            <div class="form-group">
                <label for="job_description">Job Description</label>
                <textarea id="job_description" name="job_description"><?php echo htmlspecialchars($gig['description'] ?? ''); ?></textarea>
            </div>
        </div>

        <div class="row-2col">
            <div class="form-group">
                <label for="district">District</label>
                <select id="district" name="district" class="custom-select">
                    <option value="Melaka Tengah" <?php if($current_district == 'Melaka Tengah') echo 'selected'; ?>>Melaka Tengah</option>
                    <option value="Alor Gajah" <?php if($current_district == 'Alor Gajah') echo 'selected'; ?>>Alor Gajah</option>
                    <option value="Jasin" <?php if($current_district == 'Jasin') echo 'selected'; ?>>Jasin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" maxlength="100" value="<?php echo htmlspecialchars($current_location); ?>" required>
            </div>
        </div>

        <div class="row-equal">
            <div class="form-group">
                <label for="gig_date">Gig Date & Time</label>
                <input type="datetime-local" id="gig_date" name="gig_date" value="<?php echo date('Y-m-d\TH:i', strtotime($gig['gig_date'] ?? '')); ?>" required>
            </div>

            <div class="form-group">
                <label for="due">Due</label>
                <input type="datetime-local" id="due" name="due" value="<?php echo date('Y-m-d\TH:i', strtotime($gig['due'] ?? '')); ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="salary">Salary (RM)</label>
            <input type="number" id="salary" name="salary" step="0.01" min="0" value="<?php echo htmlspecialchars($gig['salary'] ?? ''); ?>" required>
        </div>

        <div class="submit-container">
            <button type="submit" name="save" class="btn-submit"> Save Changes</button>
        </div>

    </form>
</main>

<?php include('footer.php'); ?>

</body>
</html>