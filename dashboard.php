<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include 'navbar.php';
    include 'database.php';

    // query for showing feedback

    $sql = "SELECT * FROM bike ";
    $result = mysqli_query($conn, $sql);
    $details = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // query for uploading bike details

    $allowed_ext = array('png', 'jpg', 'jpeg');
    $company = $bikename = $cc = $imagepath = '';
    $error = $error1 = $error2 = '';

    if (isset($_POST['uploadbtn'])) {

        //image upload
        if (!empty($_FILES['upload']['name'])) {
            $file_name = $_FILES['upload']['name'];
            $file_size = $_FILES['upload']['size'];
            $file_tmp = $_FILES['upload']['tmp_name'];
            $target_dir = './uploads/' . $file_name;

            //get file ext
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));

            //validate file ext
            if (in_array($file_ext, $allowed_ext)) {
                if ($file_size <= 1000000) {
                    move_uploaded_file($file_tmp, $target_dir);
                    $message = 'File Uploaded Successfully!';
                    $imagepath = $target_dir;
                } else {
                    $message = 'File too large';
                }
            } else {
                $message = 'Invalid file type';
            }
        } else {
            $message = "Please choose a file";
        }

        //upload company name
        if (!empty($_POST['company'])) {
            $company = $_POST['company'];
            $error = '';
        } else {
            $error = '<p style="color:red;">Please select any company</p>';
        }

        //upload bike name
        if (!empty($_POST['bikename'])) {
            $bikename = $_POST['bikename'];
            $error1 = '';
        } else {
            $error1 = '<p style="color:red;">bike name cannot be empty</p>';
        }

        //upload cc 
        if (!empty($_POST['cc'])) {
            $cc = $_POST['cc'];
            $error2 = '';
        } else {
            $error2 = '<p style="color:red;">Please select any cc</p>';
        }

        if (!empty($imagepath) && !empty($company) && !empty($bikename) && !empty($cc)) {
            $sql = "INSERT INTO bikedetails (company, bikename, cc, imagepath) VALUES ('$company', '$bikename', '$cc', '$imagepath')";
            if (mysqli_query($conn, $sql)) {

                echo 'Data inserted successfully';
            } else {
                echo "Error: data wasnot inserted";
            }
            mysqli_close($conn);
        } else {
            echo 'Cannot insert data';
        }
    }

    ?>
    <div class="flex">

        <!-- bike details upload section -->

        <div class="bike-details-section">
            <form class="bike-details-form" enctype="multipart/form-data" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h3>Add Bike Details</h3>
                <label for="company">Company: </label>
                <select name="company" id="company">
                    <option value="">--</option>
                    <option value="honda">Honda</option>
                    <option value="yamaha">YAHAMA</option>
                    <option value="tvs">TVS</option>
                    <option value="hero">Hero</option>
                    <option value="suzuki">Suzuki</option>
                    <option value="royalEnfield">Royal Enfield</option>
                    <option value="bajaj">BAJAJ</option>
                </select>
                <input type="text" name="bikename" placeholder="Bike name">

                <label for="cc">CC: </label>
                <select name="cc" id="cc">
                    <option value="">--</option>
                    <option value="125">125</option>
                    <option value="150">150</option>
                    <option value="200">200</option>
                    <option value="250">250</option>
                    <option value="300">300</option>
                    <option value="350">350</option>
                </select>
                <?php echo $error . '  ' . $error1 . '  ' . $error2; ?>

                <input type="file" name="upload" placeholder="upload image">
                <p style="color: red; margin-left: 20px;<?php echo (isset($message)) ? '' : 'display:none;' ?>"><?php echo $message; ?></p>
                <button type="submit" name="uploadbtn">Upload</button>
            </form>
        </div>

        <!-- Feedback Section -->

        <div class="feedback-display-container">
            <div class="feedback-header">Feedback</div>
            <?php foreach ($details as $items) : ?>
                <?php $time = strtotime($items['date']);
                $date = date("(g:i A)  W M, Y ", $time);
                ?>
                <div class="feedback-card">
                    <p class="feedback-name"><?php echo $items['firstname'] . ' ' . $items['lastname']; ?></p>
                    <p class="feedback-email"><?php echo $items['email']; ?></p>
                    <p class="message"><?php echo $items['message']; ?></p>
                    <hr>
                    <p class="date"><?php echo $date ?></p>
                </div>
            <?php endforeach; ?>

        </div>
    </div>


</body>

</html>