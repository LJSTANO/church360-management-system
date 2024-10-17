<?php
include 'connect.php'; // Include your database connection script

$message_sent = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format";
    } else {
        // Insert into database
        $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
        if ($conn->query($sql) === TRUE) {
            $message_sent = true;
        } else {
            $error = "Failed to send message. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Church360 Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            font-family: 'Arial', sans-serif; /* Change font to Arial */
        }
        .container {
            margin-top: 50px;
            margin-bottom: 50px;
            background-color: #cdd8f3; /* Soft blue background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Light shadow */
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            background-color: #fff; /* White background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Light shadow */
        }
        label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff; /* Blue button color */
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
        .footer {
            background-color: #cdd8f3; /* Soft blue background */
            color: #333; /* Dark text color */
            padding: 10px 0;
            text-align: center;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            font-family: 'Arial', sans-serif; /* Change font to Arial */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Contact Us</h2>
        <?php if ($message_sent): ?>
            <div class="alert alert-success" role="alert">
                Message sent and saved successfully!
            </div>
        <?php elseif (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>

    <div class="footer">
        <p>Email: church360@gmail.com | Phone: 0742609790</p>
        <p>This far the Lord has helped us</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
