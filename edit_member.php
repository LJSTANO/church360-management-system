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

// Check if member ID is provided in the URL
if(isset($_GET['id'])) {
    // Get member ID from the URL
    $id = sanitize($_GET['id']);

    // Fetch member details from the database
    $query = "SELECT * FROM members WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1) {
        // Member found, display the edit form
        $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Member - Church360 Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Edit Member Details</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label>Last Name:</label>
                <input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name']; ?>">
            </div>
            <div class="form-group">
                <label>First Name:</label>
                <input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name']; ?>">
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <select class="form-control" name="gender">
                    <option value="Male" <?php if($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                </select>
            </div>
            <div class="form-group">
                <label>Date of Birth:</label>
                <input type="date" class="form-control" name="date_of_birth" value="<?php echo $row['date_of_birth']; ?>">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>">
            </div>
            <div class="form-group">
                <label>Residence:</label>
                <input type="text" class="form-control" name="residence" value="<?php echo $row['residence']; ?>">
            </div>
            <div class="form-group">
                <label>Ministry:</label>
                <input type="text" class="form-control" name="ministry" value="<?php echo $row['ministry']; ?>">
            </div>
            <div class="form-group">
                <label>Mobile:</label>
                <input type="text" class="form-control" name="mobile" value="<?php echo $row['mobile']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
    } else {
        // Member not found
        echo "Member not found.";
    }
} else {
    // Member ID not provided
    echo "Member ID not provided.";
}

// Close the database connection
mysqli_close($conn);
?>
