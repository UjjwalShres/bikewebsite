<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php

    $DB_HOST = 'localhost';
    $DB_USERNAME = 'ujjwal';
    $DB_PASS = '123456';
    $DB_NAME = 'user';

    $conn = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASS, "$DB_NAME");

    if (!$conn) {
        echo 'ERROR:';
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM bikedetails WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);


    ?>
    <div class="bike-display-container">
        <div class="bike-card">
            <img src="<?php echo $data['imagepath']; ?>" alt="bike-image">
            <h3><?php echo $data['bikename']; ?></h3>
            <p class="p-cc"><?php echo $data['cc'] . ' CC'; ?></p>
            <p class="p-company"><?php echo $data['company']; ?></p>
        </div>
    </div>
    <a href="index.php">Back to home page</a>
</body>

</html>