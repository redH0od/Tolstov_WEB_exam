<?php
if (!isset($_COOKIE['user_id']) || !isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit;
}
$username = $_COOKIE['username'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h2>Привет, <?php echo htmlspecialchars($username); ?>!</h2>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>