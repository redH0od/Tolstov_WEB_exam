<?php
require __DIR__.'/../source/config.php';

$link = mysqli_connect($host, $user, $pass, $db);
if (!$link) {
    die("Connect error: ".mysqli_connect_error());
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';

    if ($u === '' || $p === '') {
        $error = 'Заполните оба поля';
    } else {
        $sql = "INSERT INTO users(username,password_hash)
                VALUES('$u','$p')";
        $res = mysqli_query($link, $sql);
        if ($res) {
            header('Location: login.php');
            exit;
        } else {
            $error = "MySQL error: ".mysqli_error($link);
        }
    }
}
?>
<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>Tolstov Site Register</title></head>
<body>
<h1>Регистрация</h1>
<?php if ($error): ?>
  <p style="color:red"><?=htmlspecialchars($error)?></p>
<?php endif ?>
<form method="post">
  <input name="username" placeholder="Username" 
         value="<?=htmlspecialchars($_POST['username']??'')?>"><br>
  <input name="password" type="password" placeholder="Password"><br>
  <button>Зарегистрироваться</button>
</form>
<p><a href="login.php">Вход</a></p>
</body></html>

