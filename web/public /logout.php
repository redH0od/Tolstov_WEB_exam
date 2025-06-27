<?php
require __DIR__.'/../source/config.php';
session_destroy();
setcookie('usercookie', '', time()-3600, '/');
header('Location: login.php');
exit;

