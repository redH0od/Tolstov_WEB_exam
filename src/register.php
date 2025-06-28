<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $db = new Database();
    if ($db->register($username, $password)) {
        header("Location: login.php?success=Registration successful");
        exit;
    } else {
        $error = "Registration failed. Username may already exist.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <input type="submit" value="Register">
    </form>
    <p><a href="login.php">Login</a></p>
</body>
</html>