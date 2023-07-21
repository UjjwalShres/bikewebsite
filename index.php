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

    //pagination
    $sql = "SELECT * FROM bikedetails";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);
    $page = $rows / 4;
    if ($page != round($page)) {
        $page = round($page) + 1;
    }
    if (!isset($_GET['id'])) {
        $limit = 'LIMIT 4';
    } else {
        $page_number = $_GET['id'];
    }

    if (isset($page_number)) {
        $page_start = ($page_number - 1) * 4 . ', 4';
        $limit = 'LIMIT ' . $page_start;
    } else {
        $page_number = 1;
        $page_start = '';
        $limit = 'LIMIT 4';
    }






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
                    $sql = "SELECT * FROM bikedetails $limit";
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
        $sql = "SELECT * FROM bikedetails $limit";
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
            <a href="singlepage.php?id=<?php echo $items['id']; ?>">
                <div class="bike-card">
                    <img src="<?php echo $items['imagepath']; ?>" alt="bike-image">
                    <h3><?php echo $items['bikename']; ?></h3>
                    <p class="p-cc"><?php echo $items['cc'] . ' CC'; ?></p>
                    <p class="p-company"><?php echo $items['company']; ?></p>
                </div>
            </a>

        <?php endforeach; ?>


    </div>
    <div class="pagination-container">
        <p style="color: #fa823f; text-align: center; margin-top: 0;">Page <?php echo $page_number; ?></p>
        <div class="pagebtn-container">
            <!-- pagination according to number to rows in db LIMIT 4 -->

            <?php for ($i = 1; $i <= $page; $i++) : ?>
                <form method="POST" class="pagination">

                    <button class="page" name="page" type="submit"><a href="index.php?id=<?php echo $i; ?>"><?php echo $i; ?></a></button>
                </form>
            <?php endfor; ?>
        </div>




        <!-- <button class="page2" name="page2">2</button>
            <button class="page3" name="page3">3</button> -->

    </div>

    <?php include 'footer.php'; ?>
</body>

</html>