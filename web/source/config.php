<?php
$host = getenv('DB_HOST') ?: 'db';
$db   = getenv('DB_NAME') ?: 'tolstov_exam';
$user = getenv('DB_USER') ?: 'appuser';
$pass = getenv('DB_PASS') ?: 'apppassword';
session_start();

$max_attempts = 10;
$attempt = 0;
$link = null;
while ($attempt < $max_attempts) {
    $link = mysqli_connect($host, $user, $pass, $db);
    if ($link) {
        mysqli_set_charset($link, 'utf8mb4');
        break;
    }
    $attempt++;
    sleep(2);
}
if (!$link) {
    die("Cannot connect to database after $max_attempts attempts: " . mysqli_connect_error());
}
