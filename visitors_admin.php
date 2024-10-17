<?php
// Include the database connection file
include 'connect.php';
// Include PhpSpreadsheet autoload file
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Initialize variables
$id = 0;
$name = '';
$contact_info = '';
$purpose = '';
$visit_date = '';
$update = false;

// If the Edit button is clicked
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($conn, "SELECT * FROM visitors WHERE id=$id");

    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $name = $n['name'];
        $contact_info = $n['contact_info'];
        $purpose = $n['purpose'];
        $visit_date = $n['visit_date'];
    }
}

// If the Add or Update button is clicked
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $contact_info = $_POST['contact_info'];
    $purpose = $_POST['purpose'];
    $visit_date = $_POST['visit_date'];

    mysqli_query($conn, "INSERT INTO visitors (name, contact_info, purpose, visit_date) VALUES ('$name', '$contact_info', '$purpose', '$visit_date')");
    header('location: index.php'); // Redirect to the visitors form after adding a record
    exit(); // Stop further execution after redirect
}

// If the Update button is clicked
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $contact_info = $_POST['contact_info'];
    $purpose = $_POST['purpose'];
    $visit_date = $_POST['visit_date'];

    mysqli_query($conn, "UPDATE visitors SET name='$name', contact_info='$contact_info', purpose='$purpose', visit_date='$visit_date' WHERE id=$id");
    header('location: index.php'); // Redirect to the visitors form after updating a record
    exit(); // Stop further execution after redirect
}

// If the Delete button is clicked
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM visitors WHERE id=$id");
    header('location: index.php'); // Redirect to the visitors form after deleting a record
    exit(); // Stop further execution after redirect
}

// Fetch visitor data from the database
$query = "SELECT * FROM visitors";
$result = mysqli_query($conn, $query);

// Create a new PhpSpreadsheet instance
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set column headers
$sheet->setCellValue('A1', 'Name');
$sheet->setCellValue('B1', 'Contact Info');
$sheet->setCellValue('C1', 'Purpose');
$sheet->setCellValue('D1', 'Visit Date');

// Output data into the spreadsheet
$row = 2; // Start from row 2
while ($data = mysqli_fetch_array($result)) {
    $sheet->setCellValue('A' . $row, $data['name']);
    $sheet->setCellValue('B' . $row, $data['contact_info']);
    $sheet->setCellValue('C' . $row, $data['purpose']);
    $sheet->setCellValue('D' . $row, $data['visit_date']);
    $row++;
}

// Save the spreadsheet to a file
$filename = 'visitors_report.xlsx';
$writer = new Xlsx($spreadsheet);
$writer->save($filename);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitors Form - Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #e0eafc; /* Soft blue background */
        }
        .container {
            margin-top: 50px;
            background-color: #ffffff; /* White container background */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Soft shadow */
        }
        .btn-primary {
            background-color: #007bff; /* Appealing blue button */
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker shade on hover */
            border-color: #0056b3;
        }
        .btn-danger {
            background-color: #dc3545; /* Danger button color */
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #bd2130; /* Darker shade on hover */
            border-color: #bd2130;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Display visitor records -->
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact Info</th>
                    <th>Purpose</th>
                    <th>Visit Date</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM visitors");
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['contact_info']."</td>";
                    echo "<td>".$row['purpose']."</td>";
                    echo "<td>".$row['visit_date']."</td>";
                    echo "<td><a href='index.php?edit=".$row['id']."' class='btn btn-info'>Edit</a></td>";
                    echo "<td><a href='index.php?delete=".$row['id']."' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Visitor form -->
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label for="contact_info">Contact Info:</label>
                <input type="text" name="contact_info" class="form-control" value="<?php echo $contact_info; ?>" required>
            </div>
            <div class="form-group">
                <label for="purpose">Purpose:</label>
                <input type="text" name="purpose" class="form-control" value="<?php echo $purpose; ?>" required>
            </div>
            <div class="form-group">
                <label for="visit_date">Visit Date:</label>
                <input type="date" name="visit_date" class="form-control" value="<?php echo $visit_date; ?>" required>
            </div>
            <?php if ($update == true): ?>
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            <?php else: ?>
                <button type="submit" class="btn btn-primary" name="save">Add</button>
            <?php endif ?>
        </form>
        <!-- Download Spreadsheet button -->
        <div class="mt-3">
            <a href="<?php echo $filename; ?>" class="btn btn-success">Print Visitors</a>
        </div>
    </div>
</body>
</html>
