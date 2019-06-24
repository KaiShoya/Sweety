<?php
include_once '../../sys/init.php';

$id = isset($_POST['id']) ? $_POST['id'] : null;
$passwd = isset($_POST['passwd']) ? $_POST['passwd'] : null;

if ($id === "kai" && $passwd === "shoya") {
  $_SESSION['user_id'] = $id;
  $_SESSION['user_name'] = '甲斐';
  $_SESSION['user_role'] = 'admin';

  $url = PUBLIC_TOP . '/';
} elseif ($id === 'm-arc') {
  $_SESSION['hotel_id'] = 1;
  $_SESSION['user_id'] = $id;
  $_SESSION['user_name'] = 'ホテル アーク';
  $_SESSION['user_role'] = 'user';
  $url = PUBLIC_TOP . '/';
} else {
  $url = PUBLIC_TOP . '/login.php';
}

header('Location: ' . $url, true, 301);
exit;
