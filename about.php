<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include "navbar.php";

    ?>
    <div class="about-container">
        <h1>Get to know us</h1>
        <p>Pure Bike Store offers an extensive range of quality automotive services. We offer all types of motorcycle company brands and models.</p>
        <button>Book an appointment</button>
    </div>

    <div class="about-section2">
        <h1>Why Pure Bikes Store</h1>

        <div class="about-card-container">
            <div class="about-card">
                <img src="./assets/tick-logo.png" alt="tickmark">
                <h3>Quality Supplies</h3>
                <p>We use only high-quality consumables for servicing your vehicles.</p>
            </div>

            <div class="about-card">
                <img src="./assets/tick-logo.png" alt="tickmark">
                <h3>Expert mechanics</h3>
                <p>Our mechanics undergo rigorous training and apprenticeship before handling motorcycles.</p>
            </div>

            <div class="about-card">
                <img src="./assets/tick-logo.png" alt="tickmark">
                <h3>Authentic auto parts</h3>
                <p>We use authentic auto spare parts straight from manufacturers.</p>
            </div>
        </div>

    </div>
    <?php include 'footer.php'; ?>
</body>

</html>