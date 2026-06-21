<?php
session_start();
include('connect.php');

     $job_name = $_POST['job_name'];
     $category = $_POST['CATEGORY_ID'];
     $description = $_POST['job_description'];
     $location = $_POST['location'] . ", " . $_POST['district'];
     $gig_date = $_POST['gig_date'];
     $frequency = $_POST['frequency'];
     $salary = $_POST['salary'];

if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];

    $sql = "SELECT user_id FROM user WHERE username='$username'";
    $result = $conn->query($sql);
    $user_id = $result->fetch_assoc()['user_id'];


$sql1 = "INSERT INTO gig ( gig_name, description, user_id)
        VALUES ('$job_name', '$description', '$user_id')";

if ($conn->query($sql1) === TRUE) {
    $gig_id = $conn->insert_id;
    $sql2 = "SELECT category_id FROM category WHERE category_name='$category'";
    $result2 = $conn->query($sql2);
    $category_id = $result2->fetch_assoc()['category_id'];
$sql3 = "INSERT INTO gig_detail (gig_id, category_id, location, salary, status, gig_date, frequency)
        VALUES ('$gig_id', '$category_id', '$location','$salary', 'Pending', '$gig_date', '$frequency')";
if ($conn->query($sql3) === TRUE) {
    echo "New record created successfully";
    echo "<meta http-equiv='refresh' content='2;URL=job-details.php?id=" . $gig_id . "'>";
} else {
    echo "Error: " . $conn->error;
}
}
} else {
    echo "User not logged in.";
}

$conn->close();
?>