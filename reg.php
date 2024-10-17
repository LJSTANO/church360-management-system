<?php
session_start();
include 'connect.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $residence = $_POST['residence'];
    $ministry = $_POST['ministry'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Insert into database - You need to adjust this query based on your table structure
    $sql = "INSERT INTO Members (first_name, last_name, gender, date_of_birth, residence, ministry, mobile, email, password) 
            VALUES ('$fname', '$lname', '$gender', '$dob', '$residence', '$ministry', '$mobile', '$email', '$password')";
    
    // Execute query
    if ($conn->query($sql) === TRUE) {
        // Registration successful
        $_SESSION['email'] = $email; // Store user email in session
        echo '<script>alert("Signup successful. Redirecting to dashboard..."); window.location.href = "dashboard.php";</script>';
        exit;
    } else {
        // Registration failed
        echo '<script>alert("Error: ' . $conn->error . '"); window.location.href = "signup.php";</script>';
        exit;
    }
} else {
    // Redirect to signup page if accessed directly without form submission
    header("Location: signup.php");
    exit;
}
?>
