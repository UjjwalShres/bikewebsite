<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include 'database.php';
    include "navbar.php";


    $firstname = $lastname = $email = $phone = $address = $message = '';
    $firstnameErr = $lastnameErr = $emailErr = $phoneErr = $addressErr = $messageErr = $successmsg = '';


    // Created Function to remove special characters
    function RemoveSpecialChar($str)
    {

        // Using str_replace() function
        // to replace the word
        $res = str_replace(array(
            '\'', '"',
            ',', ';', '<', '>'
        ), ' ', $str);

        // Returning the result
        return $res;
    }

    if (isset($_POST['submit'])) {
        if (!empty($_POST['firstname'])) {
            $firstnameErr = 'valid';
            $firstname = RemoveSpecialChar($_POST['firstname']);
        } else {
            $firstnameErr = 'first name is required';
        }

        if (!empty($_POST['lastname'])) {
            $lastnameErr = 'valid';
            $lastname = RemoveSpecialChar($_POST['lastname']);
        } else {
            $lastnameErr = 'last name is required';
        }

        if (!empty($_POST['email'])) {
            $emailErr = 'valid';
            $email = RemoveSpecialChar($_POST['email']);
        } else {
            $emailErr = 'email is required';
        }

        if (!empty($_POST['phone'])) {
            $phoneErr = 'valid';
            $phone = RemoveSpecialChar($_POST['phone']);
        } else {
            $phoneErr = 'phone number is required';
        }

        if (!empty($_POST['address'])) {
            $addressErr = 'valid';
            $address = RemoveSpecialChar($_POST['address']);
        } else {
            $addressErr = 'address is required';
        }

        if (!empty($_POST['message'])) {
            $messageErr = 'valid';
            $message = RemoveSpecialChar($_POST['message']);
        } else {
            $messageErr = 'please leave a message';
        }

        if ($firstnameErr != 'valid') {
            $successmsg = '';
        } else {
            if ($lastnameErr != 'valid') {
                $successmsg = '';
            } else {
                if ($emailErr != 'valid') {
                    $successmsg = '';
                } else {
                    if ($phoneErr != 'valid') {
                        $successmsg = '';
                    } else {
                        if ($addressErr != 'valid') {
                            $successmsg = '';
                        } else {
                            if ($messageErr != 'valid') {
                                $successmsg = '';
                            } else {
                                $sql = "INSERT INTO bike (firstname, lastname, email, phone, address, message) VALUES ('$firstname', '$lastname', '$email', '$phone', '$address', '$message')";

                                if (mysqli_query($conn, $sql)) {
                                    $successmsg = 'Thanks for the feedback';
                                    header("refresh:2; Url=http://localhost/bikedisplay/contact.php");
                                } else {
                                    echo "Error:";
                                }
                                mysqli_close($conn);
                            }
                        }
                    }
                }
            }
        }
    }
    ?>
    <div class="contact-container">
        <h1>Get in touch!</h1>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <p class="contact-alert" style="<?php echo (($firstnameErr == 'valid' && $lastnameErr == 'valid') || ($firstnameErr == '' && $lastnameErr == '')) ? 'display:none;' : ''; ?>"><?php echo $firstnameErr . ' ' . $lastnameErr; ?></p><br>
            <p class="contact-success" style="<?php echo ($successmsg == '') ? 'display:none;' : ''; ?>"><?php echo $successmsg; ?></p><br>
            <input type="text" style="background-color: #FDD3BC;" class="inline-input" placeholder="First name" name="firstname">
            <input type="text" style="background-color: #FDD3BC;" class="inline-input" placeholder="Last name" name="lastname">
            <p class="contact-alert" style="<?php echo (($emailErr == 'valid' && $phoneErr == 'valid') || ($emailErr == '' && $phoneErr == '')) ? 'display:none;' : ''; ?>"><?php echo $emailErr . ' ' . $phoneErr; ?></p><br>
            <input type="email" class="inline-input" placeholder="Email" style=" background-color: #FFBD99;" name="email">
            <input type="text" style="background-color: #FFBD99;" class="inline-input" placeholder="Phone" name="phone">
            <p class="contact-alert" style="<?php echo (($addressErr == 'valid') || ($addressErr == '')) ? 'display:none;' : ''; ?>"><?php echo $addressErr; ?></p><br>
            <input type="address" style="background-color: #FFAF82;" id="fullline-input" placeholder="Address" name="address">
            <p class="contact-alert" style="<?php echo (($messageErr == 'valid') || ($messageErr == '')) ? 'display:none;' : ''; ?>"><?php echo $messageErr; ?></p><br>
            <textarea name="message" style="background-color: #FFA16D;" cols="30" rows="5" placeholder="Your message here..."></textarea>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
    <?php include 'footer.php'; ?>
</body>

</html>