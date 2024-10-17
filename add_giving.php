<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giving - Church360 Management System</title>
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
                <h2 class="text-center">Giving</h2>
                <!-- Image -->
                <img src="images/offertories.jpg" alt="Offertories Image" class="img-fluid mb-3">
                
                <?php
                // Include the database connection file
                include 'connect.php';

                // Function to sanitize input data
                function sanitize($data) {
                    return htmlspecialchars(stripslashes(trim($data)));
                }

                // Check if form is submitted for giving
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Get form data and sanitize it
                    $fname = sanitize($_POST['fname']);
                    $giving_type = sanitize($_POST['giving_type']);
                    $amount = sanitize($_POST['amount']);

                    // Insert giving details into the database
                    $insert_query = "INSERT INTO givingstithes (FirstName, giving_type, amount) VALUES ('$fname', '$giving_type', '$amount')";
                    $insert_result = mysqli_query($conn, $insert_query);

                    if ($insert_result) {
                        echo '<div class="alert alert-success" role="alert">Giving recorded successfully!</div>';
                        // Redirect to index_1.php
                        header("location: index_1.php");
                        exit; // Ensure no further output is sent
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Error recording giving. Please try again.</div>';
                    }
                }
                ?>

                <form method="post">
                    <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="text" name="fname" class="form-control" required>
                    </div>
                    <!-- Add other input fields for member details -->
                    <div class="form-group">
                        <label for="giving_type">Type of Giving:</label>
                        <select name="giving_type" class="form-control" required>
                            <option value="Tithe">Tithe</option>
                            <option value="Offering">Offering</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <input type="number" name="amount" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
