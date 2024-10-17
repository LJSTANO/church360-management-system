<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birthdays</title>
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
        }
        table {
            background-color: #cdd8f3; /* Soft blue background */
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #0000FF; /* Deep blue background for table header */
            color: #ffffff; /* White text for table header */
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <a class="navbar-brand text-white" href="#">Birthdays</a>
    </nav>

    <!-- Form -->
    <div class="container mt-4">
        <h2 class="text-center">Add Birthday</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" id="first_name" name="first_name">
            </div>
            <div class="form-group">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- PHP Code to Display Birthdays -->
    <div class="container mt-4">
        <h2 class="text-center">Upcoming Birthdays</h2>
        <?php
        // MySQL server configuration
        $servername = "localhost";
        $username = "root";
        $password = ""; // Add your database password here
        $dbname = "CHURCH360"; // Change to your actual database name

        try {
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                throw new Exception("Connection failed: " . $conn->connect_error);
            }

            // Query to select members whose birthdays are within the next 2 days
            $sql = "SELECT first_name, date_of_birth FROM members ORDER BY DATE_FORMAT(date_of_birth, '%m-%d')";
            $result = $conn->query($sql);

            // Check if there are any upcoming birthdays
            if ($result && $result->num_rows > 0) {
                echo '<table class="table table-bordered">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>First Name</th>';
                echo '<th>Date of Birth</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = $result->fetch_assoc()) {
                    $first_name = $row['first_name'];
                    $dob = date("F j", strtotime($row['date_of_birth'])); // Format date of birth as Month Day
                    echo "<tr>";
                    echo "<td>$first_name</td>";
                    echo "<td>$dob</td>";
                    echo "</tr>";
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo "<p class='text-center'>No upcoming birthdays.</p>";
            }

            // Close connection
            $conn->close();
        } catch (Exception $e) {
            echo "<div class='alert alert-danger' role='alert'>";
            echo "Error: " . $e->getMessage();
            echo "</div>";
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
