<?php
include_once '../../sys/init.php';

unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
unset($_SESSION['user_role']);

$url = PUBLIC_TOP . '/login.php';
header('Location: ' . $url, true, 301);
