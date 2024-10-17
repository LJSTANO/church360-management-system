<?php
// Include the database connection file
include 'connect.php';

// Function to sanitize input data
function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if form is submitted for member update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $id = sanitize($_POST['id']);
    $last_name = sanitize($_POST['last_name']);
    $first_name = sanitize($_POST['first_name']);
    $gender = sanitize($_POST['gender']);
    $date_of_birth = sanitize($_POST['date_of_birth']);
    $email = sanitize($_POST['email']);
    $residence = sanitize($_POST['residence']);
    $ministry = sanitize($_POST['ministry']);
    $mobile = sanitize($_POST['mobile']);

    // Update member details in the database
    $update_query = "UPDATE members SET last_name='$last_name', first_name='$first_name', gender='$gender', date_of_birth='$date_of_birth', email='$email', residence='$residence', ministry='$ministry', mobile='$mobile' WHERE id='$id'";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo '<script>alert("Member details updated successfully!");</script>';
    } else {
        echo '<script>alert("Error updating member details. Please try again.");</script>';
    }
}

// Fetch members from the database
$query = "SELECT * FROM members";
$result = mysqli_query($conn, $query);

// Check if there are any members
if (mysqli_num_rows($result) > 0) {
    // Members exist, display them
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Accounts - Church360 Management System</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <h2 class="mt-5">Manage Member Accounts</h2>
            <table class="table mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Date of Birth</th>
                        <th scope="col">Email</th>
                        <th scope="col">Residence</th>
                        <th scope="col">Ministry</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through each member and display their details
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['last_name'] . "</td>";
                        echo "<td>" . $row['first_name'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td>" . $row['date_of_birth'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['residence'] . "</td>";
                        echo "<td>" . $row['ministry'] . "</td>";
                        echo "<td>" . $row['mobile'] . "</td>";
                        echo "<td><button class='btn btn-primary' onclick='editMember(" . $row['id'] . ")'>Edit</button></td>";
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

        <!-- JavaScript to handle member editing -->
        <script>
            function editMember(id) {
                // Redirect to edit page with member ID as parameter
                window.location.href = "edit_member.php?id=" + id;
            }
        </script>
    </body>
    </html>
    <?php
} else {
    // No members found
    echo "No member accounts found.";
}

// Close the database connection
mysqli_close($conn);
?>
