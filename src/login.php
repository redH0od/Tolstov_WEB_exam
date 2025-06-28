<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $db = new Database();
    $user = $db->login($username, $password);
    if ($user) {
        setcookie('user_id', $user['id'], time() + 3600, "/");
        setcookie('username', $user['username'], time() + 3600, "/");
        header("Location: welcome.php");
        exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($_GET['success'])) echo "<p style='color:green;'>" . $_GET['success'] . "</p>"; ?>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <label>Username: <input type="text" name="username" required></label><br>
        <label>Password: <input type="password" name="password" required></label><br>
        <input type="submit" value="Login">
    </form>
    <p><a href="register.php">Register</a></p>
</body>
</html>