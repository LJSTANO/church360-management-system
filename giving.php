<?php
// Include the database connection file
include 'connect.php';

// Check for connection errors
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch givings from the database including member details
$query = "SELECT * FROM givingstithes";
$result = mysqli_query($conn, $query);

// Check for query execution errors
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Check if there are any givings
if (mysqli_num_rows($result) > 0) {
    // Givings exist, display them
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Giving - Church360 Management System</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <h2 class="mt-5">Giving Records</h2>
            <table class="table mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Member ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Giving Type</th>
                        <th scope="col">Giving Date</th>
                        <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through each giving record and display its details
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['member_id'] . "</td>";
                        echo "<td>" . $row['FirstName'] . "</td>";
                        echo "<td>" . $row['giving_type'] . "</td>";
                        echo "<td>" . $row['giving_date'] . "</td>";
                        echo "<td>" . $row['amount'] . "</td>";
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
    // No givings found
    echo "No giving records found.";
}

// Close the database connection
mysqli_close($conn);
?>
