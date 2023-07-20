<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = '';
}

if ($username == 'correct') {
    $link = 'dashboard.php';
} else {
    $link = 'admin.php';
}
?>

<div class="nav-container">
    <div class="img"></div>

    <div class="link">

        <div><a href="index.php" style="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'border-bottom: 3px solid white; color:white;' : 'border-bottom: none; color: black;' ?>">Home</a></div>
        <div><a href="about.php" style="<?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'border-bottom: 3px solid white; color:white;' : 'border-bottom: none; color: black;' ?>">About</a></div>
        <div><a href="contact.php" style="<?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'border-bottom: 3px solid white; color:white;' : 'border-bottom: none; color: black;' ?>">Contact</a></div>
        <div><a href="<?php echo $link; ?>" style="<?php echo (basename($_SERVER['PHP_SELF']) == 'admin.php' || basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'border-bottom: 3px solid white; color:white;' : 'border-bottom: none; color: black;' ?>">Admin</a></div>
        <div><a href="logout.php" style="<?php echo (!empty($username)) ? 'display: block; color:black;' : 'display: none;' ?>">Logout</a></div>

    </div>

</div>