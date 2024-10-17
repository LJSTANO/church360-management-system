<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Church360 Management System</title>
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
        .feature {
            background-color: #cdd8f3; /* Soft blue background */
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .feature h2 {
            margin-top: 0;
        }
        .feature ul {
            list-style-type: none;
            padding: 0;
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
            <a class="navbar-brand" href="#">Church360</a>
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
                        <a class="nav-link" href="#">Birthdays</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="visitors.php">Visitors</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="feature text-center">
                    <h2>Giving</h2>
                    <ul>
                        <li><a href="add_giving.php" class="text-dark">All Givings</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="feature text-center">
                    <h2>Events</h2>
                    <ul>
                        <li><a href="events.php" class="text-dark">View Upcoming Events</a></li>
                        <li><a href="birthdays.php" class="text-dark">View Upcoming Birthdays</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="feature text-center">
                    <h2>Visitors</h2>
                    <ul>
                        <li><a href="visitors.php" class="text-dark">Add Visitor details</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="feature text-center">
                    <h2>System Account</h2>
                    <ul>
                        <li><a href="manage_account.php" class="text-dark">View and edit account information</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p id="footer-text">This is where Humanity Meets Divinity</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const footerTexts = [
            "Bringing the Community Closer to God",
            "Empowering the Faithful, Transforming Lives",
            "Uniting in Faith, Serving with Love",
            "Where Every Soul Finds Peace and Purpose"
        ];

        let index = 0;

        function changeFooterText() {
            document.getElementById('footer-text').textContent = footerTexts[index];
            index = (index + 1) % footerTexts.length;
        }

        setInterval(changeFooterText, 30000); // Change text every 30 seconds
    </script>
</body>
</html>
