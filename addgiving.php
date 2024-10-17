<?php
// Include database connection
include 'connect.php';

// Initialize variables
$member_id = $amount = $giving_date = '';
$errors = array();

// Fetch members for dropdown
$sql_members = "SELECT id, first_name FROM Members";
$result_members = mysqli_query($conn, $sql_members);

// Add giving record
if (isset($_POST['add_giving'])) {
    // Retrieve giving details from form
    $member_id = $_POST['member_id'];
    $amount = $_POST['amount'];
    $giving_date = $_POST['giving_date'];

    // Validate form data
    if (empty($member_id) || empty($amount) || empty($giving_date)) {
        $errors[] = "All fields are required.";
    } else {
        // Add giving record to database
        $sql = "INSERT INTO givingstithes (member_id, amount, giving_date) VALUES ('$member_id', '$amount', '$giving_date')";
        if (mysqli_query($conn, $sql)) {
            $success_message = "Giving record added successfully.";
            // Clear form fields after successful addition
            $member_id = $amount = $giving_date = '';
        } else {
            $errors[] = "Error adding giving record: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Giving Record - Church360 Management System</title>
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
        h2 {
            color: #333; /* Dark text color */
        }
        .form-control {
            border-color: #333; /* Dark border color */
        }
        .btn-primary {
            background-color: #333; /* Dark button background color */
            border-color: #333; /* Dark button border color */
        }
        .btn-primary:hover {
            background-color: #1a1a1a; /* Darker button background color on hover */
            border-color: #1a1a1a; /* Darker button border color on hover */
        }
        .alert {
            background-color: #cdd8f3; /* Light blue alert background color */
            border-color: #333; /* Dark border color */
            color: #333; /* Dark text color */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Add Giving Record</h2>
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
                <label>Member First Name:</label>
                <select name="member_id" class="form-control" required>
                    <option value="">Select Member</option>
                    <?php while ($row_member = mysqli_fetch_assoc($result_members)) { ?>
                        <option value="<?php echo $row_member['id']; ?>"><?php echo $row_member['first_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Amount:</label>
                <input type="text" name="amount" class="form-control" value="<?php echo $amount; ?>" required>
            </div>
            <div class="form-group">
                <label>Giving Date:</label>
                <input type="date" name="giving_date" class="form-control" value="<?php echo $giving_date; ?>" required>
            </div>
            <button type="submit" name="add_giving" class="btn btn-primary">Add Giving Record</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
