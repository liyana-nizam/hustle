<?php
$servername = "localhost:3307";
$username = "root";
$password = "root123";
$dbname = "hustle";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (!function_exists('getCategoryImage')) {
    function getCategoryImage($category)
    {
        if ($category == 'Cleaning') {
            return 'images/cleaning.png';
        } elseif ($category == 'Running Errands') {
            return 'images/errands.png';
        } elseif ($category == 'Home Fixing') {
            return 'images/fixing.png';
        } elseif ($category == 'Gardening') {
            return 'images/gardening.png';
        } elseif ($category == 'Tutoring') {
            return 'images/tutoring.png';
        } elseif ($category == 'Caregiving') {
            return 'images/caregiving.png';
        } else {
            return 'images/other.png';
        }
    }
}
