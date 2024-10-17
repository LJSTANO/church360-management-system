<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $residence = $_POST['residence'];
    $ministry = $_POST['ministry'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email already exists
    $email_check_query = "SELECT COUNT(*) FROM members WHERE email='$email'";
    $email_check_result = mysqli_query($conn, $email_check_query);
    $email_count = mysqli_fetch_array($email_check_result)[0];

    if ($email_count > 0) {
        // Email already exists, display an error message
        echo "Error: This email is already registered.";
    } else {
        // Email is unique, proceed with sign-up process
        // Insert into database
        $sql = "INSERT INTO members (first_name, last_name, gender, date_of_birth, residence, ministry, mobile, email, password) 
                VALUES ('$fname', '$lname', '$gender', '$dob', '$residence', '$ministry', '$mobile', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['email'] = $email;
            echo '<script>
                    setTimeout(function(){
                        alert("Signup successful!");
                        window.location.href = "dashboard.php";
                    }, 2000);
                  </script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Church360 Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #e6f2ff; /* Soft blue color */
        }
        .container {
            margin-top: 100px;
        }
        form {
            background-color: rgba(255, 255, 255, 0.5);
            padding: 20px;
            border-radius: 10px;
        }
        label {
            font-weight: bold;
        }
        .welcome-note {
            text-align: center;
            margin-bottom: 20px;
            background-color: #6488ea; /* deepblue*/
            color: #721c24; /* deepblue */
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="welcome-note">
                    <h2>Welcome to Church360 Management System</h2>
                    <p>Sign up to manage your church activities with ease.</p>
                </div>
                <h2 class="text-center">Signup</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="text" name="fname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name:</label>
                        <input type="text" name="lname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <select name="gender" class="form-control" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" name="dob" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="residence">Residence:</label>
                        <input type="text" name="residence" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="ministry">Ministry:</label>
                        <input type="text" name="ministry" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile Number:</label>
                        <input type="text" name="mobile" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Signup</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
