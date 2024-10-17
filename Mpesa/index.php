<?php
    include 'APIs/express-stk.php';
?>

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
</head>
<body>
    <div class="form-container">
        <div class="icon-container">
            <i class="fas fa-envelope"></i>
        </div>
        <h2>Pay Through Mpesa</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <input type="hidden" name="orderNo" id="" value="#02JD1213R">
            <div class="form-group mb-2">
                <input type="tel" name="phone_number" id="" class="form-control" placeholder="input phone number">
            </div>
            <div class="form-group mb-2">
                <input type="number" name="amount" id="" class="form-control" placeholder="input Amount to pay">
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;&nbsp;send</button>
        </form>
    </div>
    <script src="js/init.js"></script>
    <script src="js/jquery.dataTables.js"></script>
</body>
</html>