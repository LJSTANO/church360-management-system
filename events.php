<?php
// Connect to your database
include 'connect.php';

// Fetch events from the database
$query = "SELECT * FROM events";
$result = mysqli_query($conn, $query);

// Check if there are any events
if (mysqli_num_rows($result) > 0) {
    // Events exist, display them
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Events - Church360 Management System</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- Custom CSS -->
        <style>
            body {
                background-color:#e0eafc;
            }
            .container {
                margin-top: 50px;
            }
            .table {
                background-color: #343a40;
                color: #fff;
            }
            .table th, .table td {
                border-color: #a8c0ff;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2 class="mt-6 text-center text-BLUE">Upcoming Events</h2>
            <table class="table mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Event Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Location</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through each event and display its details
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['event_name'] . "</td>";
                        echo "<td>" . $row['event_date'] . "</td>";
                        echo "<td>" . $row['location'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
    <?php
} else {
    // No events found
    echo "No events found.";
}

// Close the database connection
mysqli_close($conn);
?>
