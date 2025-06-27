<?php
require __DIR__.'/../source/config.php';

$link = mysqli_connect($host, $user, $pass, $db);
if (!$link) {
    die("Connect error: ".mysqli_connect_error());
}

mysqli_report(MYSQLI_REPORT_OFF);

if (empty($_SESSION['user']) && !empty($_COOKIE['usercookie'])) {
    $_SESSION['user'] = $_COOKIE['usercookie'];
    header('Location: welcome.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';

    $sql = "SELECT * FROM users WHERE username = '$u' AND password_hash = '$p'";
    $res = mysqli_query($link, $sql);
    if (! $res) {
        die("MySQL error: ".mysqli_error($link));
    }

    if (mysqli_num_rows($res) === 1) {
        $_SESSION['user'] = $u;
        setcookie('usercookie', $u, time()+3600, '/');
        header('Location: welcome.php');
        exit;
    } else {
        $error = 'Неверный логин или пароль';
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Tolstov Site Login</title></head>
<body>
<h1>Вход</h1>
<?php if ($error): ?>
  <p style="color:red"><?=htmlspecialchars($error)?></p>
<?php endif ?>
<form method="post">
  <input name="username" placeholder="Username"
         value="<?=htmlspecialchars($_POST['username']??'')?>"><br>
  <input name="password" type="password" placeholder="Password"><br>
  <button>Войти</button>
</form>
<p><a href="register.php">Регистрация</a></p>
</body></html>

