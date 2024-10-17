<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mpesa Push</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .info {
            width: 100%;
            padding: 0.5rem;
            margin-top: 1rem;
            margin-bottom: 1rem;
            background: rgba(0,0,0,0.65);
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="icon-container">
            <i class="fas fa-hand-holding-dollar"></i>
        </div>
        <h2>Confirm Payment</h2>
        <div class="info">
            <blockquote class="text-center text-light">
                After receiving the payment confirmation message. press "Confirm Payment"
                to finish making your order
            </blockquote>
        </div>
        <a href="APIs/status.php" class="btn btn-primary w-100"><i class="fas fa-check-circle"></i> Confirm Payment</a>
    </div>
    <script src="js/init.js"></script>
    <script src="js/jquery.dataTables.js"></script>
</body>
</html>