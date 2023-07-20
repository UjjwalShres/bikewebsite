<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include "navbar.php";
    $usernameErr = $passwordErr = '';

    if (isset($_POST['login'])) {
        if (empty($_POST['username'])) {
            $usernameErr = 'username cannot be empty';
        } elseif ($_POST['username'] != 'admin') {
            $usernameErr = 'invalid username';
        } else {
            $usernameErr = 'correct';
            $_SESSION['username'] = $usernameErr;
        }

        if (empty($_POST['password'])) {
            $passwordErr = 'password cannot be empty';
        } elseif ($_POST['password'] != 'admin') {
            $passwordErr = 'invalid password';
        } else {
            $passwordErr = 'correct';
        }

        if ($usernameErr == 'correct' && $passwordErr == 'correct') {
            header('location: loading.php');
        } else {
            $usernameErr == 'invalid username';
            $passwordErr == 'invalid password';
        }
    }

    ?>
    <div class="login-container">
        <form method="POST" class="login-form">
            <input type="text" name="username" placeholder="Username">
            <div class="error-message"><?php echo $usernameErr; ?></div>
            <input type="password" name="password" placeholder="Password">
            <div class="error-message"><?php echo $passwordErr; ?></div>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>

</html>