<?php
session_start();

// Hardcoded admin credentials
$admin_name = "Kaguru";
$admin_email = "kagurustanley@gmail.com";
$admin_password = "1234567";

// Check if the admin is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    // Admin is already logged in, redirect to the dashboard or admin panel
    header("Location: dashboard.php");
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verify admin credentials
    if ($email === $admin_email && $password === $admin_password) {
        // Admin credentials are correct, set session variables to mark admin as logged in
        $_SESSION['admin_logged_in'] = true;
        
        // Redirect to the dashboard or admin panel
        header("Location: dashboard.php");
        exit;
    } else {
        // Invalid credentials, display error message
        $error_message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Admin Login</h2>
                <?php if (isset($error_message)) { ?>
                    <div class="alert alert-danger" role="alert"><?php echo $error_message; ?></div>
                <?php } ?>
                <form method="post">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
