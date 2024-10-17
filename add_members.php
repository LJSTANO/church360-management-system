<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // If not logged in, redirect to the admin login page
    header("Location: admin_login.php");
    exit;
}

// Include database connection
include 'connect.php';

// Initialize variables
$first_name = $last_name = $gender = $date_of_birth = $residence = $ministry = $mobile = $email = $password = '';
$errors = array();

// Add member
if (isset($_POST['add_member'])) {
    // Retrieve member details from form if they are set
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $date_of_birth = isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : '';
    $residence = isset($_POST['residence']) ? $_POST['residence'] : '';
    $ministry = isset($_POST['ministry']) ? $_POST['ministry'] : '';
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate form data
    if (empty($first_name) || empty($last_name) || empty($gender) || empty($date_of_birth) || empty($residence) || empty($ministry) || empty($mobile) || empty($email) || empty($password)) {
        $errors[] = "All fields are required.";
    } else {
        // Add member to database
        $sql = "INSERT INTO Members (first_name, last_name, gender, date_of_birth, residence, ministry, mobile, email, password) 
                VALUES ('$first_name', '$last_name', '$gender', '$date_of_birth', '$residence', '$ministry', '$mobile', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            $success_message = "Member added successfully.";
            // Clear form fields after successful addition
            $first_name = $last_name = $gender = $date_of_birth = $residence = $ministry = $mobile = $email = $password = '';
        } else {
            $errors[] = "Error adding member: " . mysqli_error($conn);
        }
    }
}

// Delete member
if (isset($_POST['delete_member'])) {
    $member_id = $_POST['member_id'];

    // Delete member from database
    $sql = "DELETE FROM Members WHERE id='$member_id'";
    if (mysqli_query($conn, $sql)) {
        $success_message = "Member deleted successfully.";
    } else {
        $errors[] = "Error deleting member: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Members</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #e6f2ff; /* Soft blue color */
        }
        .container {
            margin-top: 50px;
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
        <h2 class="text-center">Add Member</h2>
        <?php if (!empty($errors)) { ?>
            <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach ($errors as $error) { ?>
                        <li><?php echo $error; ?></li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>
        <?php if (isset($success_message)) { ?>
            <div class="alert alert-success" role="alert"><?php echo $success_message; ?></div>
        <?php } ?>
        <form method="post">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" class="form-control" required>
                    <option value="Male" <?php if ($gender == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($gender == 'Female') echo 'selected'; ?>>Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="
                date_of_birth">Date of Birth:</label>
                <input type="date" name="date_of_birth" class="form-control" value="<?php echo $date_of_birth; ?>" required>
            </div>
            <div class="form-group">
                <label for="residence">Residence:</label>
                <input type="text" name="residence" class="form-control" value="<?php echo $residence; ?>" required>
            </div>
            <div class="form-group">
                <label for="ministry">Ministry:</label>
                <input type="text" name="ministry" class="form-control" value="<?php echo $ministry; ?>" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile:</label>
                <input type="text" name="mobile" class="form-control" value="<?php echo $mobile; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" required>
            </div>
            <button type="submit" name="add_member" class="btn btn-primary">Add Member</button>
        </form>

        <h3 class="mt-5">Delete Member</h3>
        <form method="post">
            <div class="form-group">
                <label for="member_id">Member ID:</label>
                <input type="text" name="member_id" class="form-control" required>
            </div>
            <button type="submit" name="delete_member" class="btn btn-danger">Delete Member</button>
        </form>
    </div>
</body>
</html>
