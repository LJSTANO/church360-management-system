<?php
// Include the database connection file
include 'connect.php';
// Include PhpSpreadsheet autoload file
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

// Check if delete button is clicked
if (isset($_POST['delete'])) {
    $delete_id = sanitize($_POST['delete_id']);
    // Delete member from the database
    $delete_query = "DELETE FROM members WHERE id='$delete_id'";
    $delete_result = mysqli_query($conn, $delete_query);
    if ($delete_result) {
        echo '<script>alert("Member deleted successfully!");</script>';
    } else {
        echo '<script>alert("Error deleting member. Please try again.");</script>';
    }
}

// Fetch members from the database
$query = "SELECT * FROM members";
$result = mysqli_query($conn, $query);

// Create a new PhpSpreadsheet instance
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set column headers
$sheet->setCellValue('A1', 'Last Name');
$sheet->setCellValue('B1', 'First Name');
$sheet->setCellValue('C1', 'Gender');
$sheet->setCellValue('D1', 'Date of Birth');
$sheet->setCellValue('E1', 'Email');
$sheet->setCellValue('F1', 'Residence');
$sheet->setCellValue('G1', 'Ministry');
$sheet->setCellValue('H1', 'Mobile');
$sheet->setCellValue('I1', 'Password');

// Output data into the spreadsheet
$row = 2; // Start from row 2
while ($data = mysqli_fetch_array($result)) {
    $sheet->setCellValue('A' . $row, $data['last_name']);
    $sheet->setCellValue('B' . $row, $data['first_name']);
    $sheet->setCellValue('C' . $row, $data['gender']);
    $sheet->setCellValue('D' . $row, $data['date_of_birth']);
    $sheet->setCellValue('E' . $row, $data['email']);
    $sheet->setCellValue('F' . $row, $data['residence']);
    $sheet->setCellValue('G' . $row, $data['ministry']);
    $sheet->setCellValue('H' . $row, $data['mobile']);
    $sheet->setCellValue('I' . $row, $data['password']);
    $row++;
}

// Save the all members spreadsheet
$all_filename = 'all_members_report.xlsx';
$writer = new Xlsx($spreadsheet);
$writer->save($all_filename);

// Reset result pointer and filter for male members
mysqli_data_seek($result, 0);
$row = 2; // Start from row 2
while ($data = mysqli_fetch_array($result)) {
    if ($data['gender'] == 'Male') {
        $sheet->setCellValue('A' . $row, $data['last_name']);
        $sheet->setCellValue('B' . $row, $data['first_name']);
        $sheet->setCellValue('C' . $row, $data['gender']);
        $sheet->setCellValue('D' . $row, $data['date_of_birth']);
        $sheet->setCellValue('E' . $row, $data['email']);
        $sheet->setCellValue('F' . $row, $data['residence']);
        $sheet->setCellValue('G' . $row, $data['ministry']);
        $sheet->setCellValue('H' . $row, $data['mobile']);
        $sheet->setCellValue('I' . $row, $data['password']);
        $row++;
    }
}

// Save the male members spreadsheet
$male_filename = 'male_members_report.xlsx';
$writer = new Xlsx($spreadsheet);
$writer->save($male_filename);

// Reset result pointer and filter for female members
mysqli_data_seek($result, 0);
$row = 2; // Start from row 2
while ($data = mysqli_fetch_array($result)) {
    if ($data['gender'] == 'Female') {
        $sheet->setCellValue('A' . $row, $data['last_name']);
        $sheet->setCellValue('B' . $row, $data['first_name']);
        $sheet->setCellValue('C' . $row, $data['gender']);
        $sheet->setCellValue('D' . $row, $data['date_of_birth']);
        $sheet->setCellValue('E' . $row, $data['email']);
        $sheet->setCellValue('F' . $row, $data['residence']);
        $sheet->setCellValue('G' . $row, $data['ministry']);
        $sheet->setCellValue('H' . $row, $data['mobile']);
        $sheet->setCellValue('I' . $row, $data['password']);
        $row++;
    }
}

// Save the female members spreadsheet
$female_filename = 'female_members_report.xlsx';
$writer = new Xlsx($spreadsheet);
$writer->save($female_filename);

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
<body style="background-color: #e0eafc;">
    <div class="container" style="background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);">
        <h2 class="mt-5" style="color: #007bff;">Manage Member Accounts</h2>
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
                    <th scope="col">Password</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Reset result pointer
                mysqli_data_seek($result, 0);
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
                    echo "<td>" . $row['password'] . "</td>";
                    echo "<td>
                            <button class='btn btn-primary' onclick='editMember(" . $row['id'] . ")'>Edit</button>
                            <form method='post' style='display: inline;'>
                                <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                                <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                            </form>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="mb-3">
            <a href="<?php echo $male_filename; ?>" class="btn btn-info" style="background-color: #007bff; border-color: #007bff;">Print Male Members</a>
            <a href="<?php echo $female_filename; ?>" class="btn btn-info" style="background-color: #007bff; border-color: #007bff;">Print Female Members</a>
            <a href="<?php echo $all_filename; ?>" class="btn btn-info" style="background-color: #007bff; border-color: #007bff;">Print All Members</a>
        </div>
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
// Close the database connection
mysqli_close($conn);
?>
