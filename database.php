<?php


$DB_HOST = 'localhost';
$DB_USERNAME = 'ujjwal';
$DB_PASS = '123456';
$DB_NAME = 'user';

$conn = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASS, "$DB_NAME");

if (!$conn) {
    echo 'ERROR:';
}
