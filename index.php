<!DOCTYPE html>
<html>
<head>
    <title>Church360 Management System</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0eaf0; /* Soft blue background */
            padding: 50px;
            text-align: center;
            margin-bottom: 50px; /* Space for footer */
        }

        h2 {
            color: #4e8fd0; /* Soft blue heading color */
        }

        p {
            font-size: 18px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
        }

        .btn-custom {
            background-color: #4e8fd0; /* Soft blue button */
            color: white;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #357ebd; /* Darker blue on hover */
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #4e8fd0; /* Soft blue footer background */
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to Church360 Management System</h2>
        <p>Please select an option:</p>
        <ul>
            <li><a href="signup.php" class="btn btn-custom">Sign Up</a> - Register as a new member</li>
            <li><a href="login.php" class="btn btn-custom">Login</a> - Existing members can log in</li>
        </ul>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p> Nor height, nor depth, nor any other creature, shall be able to separate us from the love of God, which is in Christ Jesus our Lord. - Romans 8:39</p>
    </div>
</body>
</html>
