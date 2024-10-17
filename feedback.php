<?php
include 'connect.php'; // Include your database connection script

// Fetch messages from database
$sql = "SELECT * FROM contact_messages";
$result = $conn->query($sql);

$messages = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Church360 Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #e0eafc; /* Soft blue background */
            font-family: 'Arial', sans-serif; /* Change font to Arial */
        }
        .container {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .card {
            background-color: #cdd8f3; /* Soft blue background */
            border: none;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #a8c0ff; /* Light blue background for card header */
            border-bottom: none;
            border-radius: 10px 10px 0 0;
            color: #333; /* Dark text color */
            font-weight: bold;
        }
        .card-body {
            color: #333; /* Dark text color */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Feedback Messages</h2>
        <?php foreach ($messages as $key => $message): ?>
            <div class="card">
                <div class="card-header">Message from <?php echo $message['name']; ?></div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $message['subject']; ?></h5>
                    <p class="card-text"><?php echo $message['message']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
