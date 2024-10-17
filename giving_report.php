<?php
// Include PhpSpreadsheet autoload file
require 'vendor/autoload.php';

// MySQL server configuration
$servername = "localhost";
$username = "root";
$password = ""; // Add your database password here
$dbname = "CHURCH360"; // Change to your actual database name

try {
    // Create a new PhpSpreadsheet instance
    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set column headers
    $sheet->setCellValue('A1', 'Member ID');
    $sheet->setCellValue('B1', 'Amount');
    $sheet->setCellValue('C1', 'Giving Date');
    $sheet->setCellValue('D1', 'Giving Type');
    $sheet->setCellValue('E1', 'First Name');

    // Create a new MySQL connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Fetch givings data from the database
    $query = "SELECT * FROM givingstithes";
    $result = $conn->query($query);

    // Check if there are any givings
    if ($result && $result->num_rows > 0) {
        $givings = [];
        $totals = ['Tithe' => 0, 'Offering' => 0, 'Other' => 0];

        // Output data into the spreadsheet
        $row = 2; // Start from row 2
        while ($data = $result->fetch_assoc()) {
            $sheet->setCellValue('A' . $row, $data['member_id']);
            $sheet->setCellValue('B' . $row, $data['amount']);
            $sheet->setCellValue('C' . $row, $data['giving_date']);
            $sheet->setCellValue('D' . $row, $data['giving_type']);
            $sheet->setCellValue('E' . $row, $data['FirstName']);
            
            // Calculate totals
            $totals[$data['giving_type']] += $data['amount'];

            $givings[] = $data;
            $row++;
        }

        // Save the spreadsheet to a file
        $writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'givings_report.xlsx'; // File name for the Excel file
        $writer->save($filename);

        // Generate Excel files for each giving type
        foreach ($totals as $type => $total) {
            if ($total > 0) {
                $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();

                // Set column headers
                $sheet->setCellValue('A1', 'Member ID');
                $sheet->setCellValue('B1', 'Amount');
                $sheet->setCellValue('C1', 'Giving Date');
                $sheet->setCellValue('D1', 'Giving Type');
                $sheet->setCellValue('E1', 'First Name');

                $row = 2; // Start from row 2
                foreach ($givings as $data) {
                    if ($data['giving_type'] === $type) {
                        $sheet->setCellValue('A' . $row, $data['member_id']);
                        $sheet->setCellValue('B' . $row, $data['amount']);
                        $sheet->setCellValue('C' . $row, $data['giving_date']);
                        $sheet->setCellValue('D' . $row, $data['giving_type']);
                        $sheet->setCellValue('E' . $row, $data['FirstName']);
                        $row++;
                    }
                }

                $writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
                $type_filename = 'givings_' . strtolower($type) . '_report.xlsx';
                $writer->save($type_filename);
            }
        }

        // Close MySQL connection
        $conn->close();
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Givings Report CHURCH360- Church360 Management System</title>
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
            background-color: #a8c0ff; /* Light blue background for table header */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">Church360</a>
            <!-- Navigation Links -->
        </div>
    </nav>

    <div class="container">
        <h2 class="text-center mt-4 mb-4">Givings Report CHURCH360</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Member ID</th>
                        <th>Amount</th>
                        <th>Giving Date</th>
                        <th>Giving Type</th>
                        <th>First Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($givings)) {
                        foreach ($givings as $data) {
                            echo "<tr>";
                            echo "<td>".$data["member_id"]."</td>";
                            echo "<td>".$data["amount"]."</td>";
                            echo "<td>".$data["giving_date"]."</td>";
                            echo "<td>".$data["giving_type"]."</td>";
                            echo "<td>".$data["FirstName"]."</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No givings found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Displaying Totals for each giving type -->
        <div class="mt-4">
            <h4 class="text-center">Givings Totals</h4>
            <ul class="list-group">
                <?php foreach ($totals as $type => $total): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $type; ?>
                        <span class="badge badge-primary badge-pill"><?php echo $total; ?></span>
                        <?php if ($total > 0): ?>
                            <a href="<?php echo 'givings_' . strtolower($type) . '_report.xlsx'; ?>" class="btn btn-primary">Print <?php echo $type; ?></a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
                <?php if (!empty($filename)): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        All Givings
                        <span class="badge badge-primary badge-pill"><?php echo array_sum($totals); ?></span>
                        <a href="<?php echo $filename; ?>" class="btn btn-primary">Print All Givings</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
