<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include "navbar.php";
    include "database.php";

    // to show all the bike details in card
    // $sql = "SELECT * FROM bikedetails";
    // $result = mysqli_query($conn, $sql);
    // $details = mysqli_fetch_all($result, MYSQLI_ASSOC);


    //search bar logic
    if (isset($_POST['search'])) {
        $company = $_POST['company'];
        $cc = $_POST['cc'];
        if (empty($_POST['bikename'])) {
            $bikename = 'all';
        } else {
            $bikename = $_POST['bikename'];
        }

        if ($company && $bikename && $cc) {
            switch ([$company, $bikename, $cc]) {
                case ['all', 'all', 'all']:
                    echo 'no input: default search';
                    $sql = "SELECT * FROM bikedetails";
                    $result = mysqli_query($conn, $sql);
                    $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    break;

                case [$company, 'all', 'all']:
                    $sql = "SELECT * FROM bikedetails WHERE $company";
                    $result = mysqli_query($conn, $sql);
                    $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    break;

                case [$company != 'all', $bikename, 'all']:
                    $sql = "SELECT * FROM bikedetails WHERE bikename = '$bikename' AND $company";
                    $result = mysqli_query($conn, $sql);
                    $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    break;

                case [$company != 'all', $bikename != 'all', $cc]:
                    $sql = "SELECT * FROM bikedetails WHERE bikename = '$bikename' AND $company AND $cc";
                    $result = mysqli_query($conn, $sql);
                    $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    break;

                case ['all', $bikename != 'all', $cc != 'all']:
                    $sql = "SELECT * FROM bikedetails WHERE bikename = '$bikename' AND $cc";
                    $result = mysqli_query($conn, $sql);
                    $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    break;

                case ['all', 'all', $cc]:
                    $sql = "SELECT * FROM bikedetails WHERE $cc";
                    $result = mysqli_query($conn, $sql);
                    $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    break;

                case ['all', $bikename, 'all']:
                    $sql = "SELECT * FROM bikedetails WHERE bikename = '$bikename'";
                    $result = mysqli_query($conn, $sql);
                    $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    break;

                case [$company, 'all', $cc]:
                    $sql = "SELECT * FROM bikedetails WHERE $company AND $cc";
                    $result = mysqli_query($conn, $sql);
                    $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
                    break;
            }
        }
    } else {
        // if search button is not clicked (at the start of page load)
        $sql = "SELECT * FROM bikedetails";
        $result = mysqli_query($conn, $sql);
        $details = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }



    ?>
    <div class="home-container">
        <h1>your trusted neighborhood bike store</h1>
    </div>

    <!-- Search bar section -->
    <div class="search-container">
        <form class="search-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <select name="company" id="company">
                <option value="all">company</option>
                <option value="company = 'honda'">Honda</option>
                <option value="company = 'yamaha'">YAHAMA</option>
                <option value="company = 'tvs'">TVS</option>
                <option value="company = 'hero'">Hero</option>
                <option value="company = 'suzuki'">Suzuki</option>
                <option value="company = 'royalEnfield'">Royal Enfield</option>
                <option value="company = 'bajaj'">BAJAJ</option>
            </select>
            <input type="text" name="bikename" placeholder="Bike name">

            <select name="cc" id="cc">
                <option value="all">CC</option>
                <option value="cc = 125">125</option>
                <option value="cc = 150">150</option>
                <option value="cc = 200">200</option>
                <option value="cc = 250">250</option>
                <option value="cc = 300">300</option>
                <option value="cc = 350">350</option>
            </select>

            <button type="submit" name="search">Search</button>
        </form>
    </div>

    <!-- Display bike details section -->
    <div class="bike-display-container">

        <?php foreach ($details as $items) : ?>
            <div class="bike-card">
                <img src="<?php echo $items['imagepath']; ?>" alt="bike-image">
                <h3><?php echo $items['bikename']; ?></h3>
                <p class="p-cc"><?php echo $items['cc'] . ' CC'; ?></p>
                <p class="p-company"><?php echo $items['company']; ?></p>
            </div>
        <?php endforeach; ?>

    </div>

    <?php include 'footer.php'; ?>
</body>

</html>