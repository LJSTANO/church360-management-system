<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_fname = $_POST['email_or_fname'];
    $password = $_POST['password'];

    // Check if the input is an email address
    if (filter_var($email_or_fname, FILTER_VALIDATE_EMAIL)) {
        $condition = "email='$email_or_fname'";
    } else {
        $condition = "first_name='$email_or_fname'";
    }

    // Check if the email/first name and password match
    $query = "SELECT * FROM members WHERE $condition AND password='$password'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Login successful, store email in session and redirect to dashboard
        $_SESSION['email'] = $row['email'];
        header('Location: dashboard.php');
        exit();
    } else {
        // Login failed, display an error message
        echo '<script>
                setTimeout(function(){
                    alert("Incorrect email/first name or password. Please try again.");
                    window.location.href = "login.php";
                }, 2000);
              </script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Church360 Management System</title>
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
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Login</h2>
                <form method="post">
                    <div class="form-group">
                        <label for="email_or_fname">Email or First Name:</label>
                        <input type="text" name="email_or_fname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <div class="input-group">
                            <input id="password" type="password" name="password" class="form-control" required>
                            <div class="input-group-append">
                                <button id="show_password" class="btn btn-outline-secondary" type="button">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#show_password').click(function(){
                var passwordField = $('#password');
                var passwordFieldType = passwordField.attr('type');
                if(passwordFieldType == 'password'){
                    passwordField.attr('type', 'text');
                    $(this).html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
                } else {
                    passwordField.attr('type', 'password');
                    $(this).html('<i class="fa fa-eye" aria-hidden="true"></i>');
                }
            });
        });
    </script>
</body>
</html>
