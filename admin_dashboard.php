=<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Church360 Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-image: url('images/church360.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Arial', sans-serif; /* Change font to Arial */
        }
        .navbar {
            background-color: #e0eafc; /* Soft blue background */
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #333; /* Dark text color */
            font-family: 'Arial', sans-serif; /* Change font to Arial */
        }
        .navbar-brand {
            font-size: 24px;
        }
        .navbar-nav {
            font-size: 18px;
        }
        .container {
            margin-top: 80px;
        }
        .card {
            background-color: #cdd8f3; /* Soft blue background */
            border: none;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #a8c0ff; /* Light blue background for card header */
            border-bottom: none;
            border-radius: 10px 10px 0 0;
            color: #333; /* Dark text color */
            font-weight: bold;
        }
        .card-body {
            color: #333; /* Dark text color */
        }
        .footer {
            background-color: #e0eafc; /* Soft blue background */
            color: #333; /* Dark text color */
            padding: 10px 0;
            text-align: center;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            font-family: 'Arial', sans-serif; /* Change font to Arial */
        }
        .footer p {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">Church360 Admin</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Giving</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Manage Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_birthday.php">Birthdays</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="visitors.php">Visitors Form</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="logout.php">Logout</a>
                    </li>
                    <!-- New navbar item for Feedback -->
                    <li class="nav-item">
                        <a class="nav-link" href="feedback.php">Feedback</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Events</div>
                    <div class="card-body">
                        <a href="events.php" class="btn btn-primary btn-block">View Events</a>
                        <a href="add_event.php" class="btn btn-success btn-block">Add New Event</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Giving</div>
                    <div class="card-body">
                        <a href="giving_report.php" class="btn btn-primary btn-block">Manage Givings</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">System Account</div>
                    <div class="card-body">
                        <a href="manage_account.php" class="btn btn-primary btn-block">View and Edit Account</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Visitors</div>
                    <div class="card-body">
                        <a href="visitors_admin.php" class="btn btn-primary btn-block">View Visitors</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Birthdays</div>
                    <div class="card-body">
                        <a href="add_birthday.php" class="btn btn-primary btn-block">View birthdays</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Author: Stanley | Contact: 0742609790 | Email: kagurustanley@gmail.com</p>
        <p>This is where Humanity Meets Divinity</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
