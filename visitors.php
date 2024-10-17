<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitors - Church360 Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa; /* Soft blue color */
            background-image: url('images/welcome_to_church.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            padding-top: 100px;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .footer {
            background-color: #e0eafc; /* Soft blue background */
            color: #333; /* Dark text color */
            padding: 20px 0;
            text-align: center;
            font-family: 'Arial', sans-serif; /* Change font to Arial */
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
        }
    </style>
</head>
<body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Church360</a>
            <!-- Add your navigation links here -->
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Visitors</div>
                    <div class="card-body">
                        <!-- Visitor form -->
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="contact_info">Contact Info:</label>
                                <input type="text" name="contact_info" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="purpose">Purpose:</label>
                                <input type="text" name="purpose" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="visit_date">Visit Date:</label>
                                <input type="date" name="visit_date" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <?php
                        // Include the database connection file
                        include 'connect.php';

                        // Check for connection errors
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        // Check if form is submitted
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            // Get form data and sanitize it
                            $name = mysqli_real_escape_string($conn, $_POST['name']);
                            $contact_info = mysqli_real_escape_string($conn, $_POST['contact_info']);
                            $purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
                            $visit_date = mysqli_real_escape_string($conn, $_POST['visit_date']);

                            // Insert visitor details into the database
                            $insert_query = "INSERT INTO visitors (name, contact_info, purpose, visit_date) VALUES ('$name', '$contact_info', '$purpose', '$visit_date')";
                            $insert_result = mysqli_query($conn, $insert_query);

                            if ($insert_result) {
                                // Visitor record inserted successfully
                                echo '<div class="alert alert-success mt-3" role="alert">Thank you for visiting!</div>';
                            } else {
                                // Error inserting visitor record
                                echo '<div class="alert alert-danger mt-3" role="alert">Error submitting visitor information. Please try again.</div>';
                            }
                        }

                        // Close the database connection
                        mysqli_close($conn);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Our hope and prayer for visitors and regular attendees today is that our interactions here today will, indeed, bring glory to God.</p>
    </div>

    <!-- Bootstrap JS -->
    <!-- Bootstrap JS scripts here -->
</body>
</html>
