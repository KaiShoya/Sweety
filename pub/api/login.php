<?php
include_once '../../sys/init.php';

$id = isset($_POST['id']) ? $_POST['id'] : null;
$passwd = isset($_POST['passwd']) ? $_POST['passwd'] : null;

$mapper = new UsersMapper();
$res = $mapper->login($id, $passwd);

if (count($res) == 1) {
  $_SESSION['user_id'] = $res[0]["login_id"];
  $_SESSION['user_name'] = $res[0]["name"];
  $_SESSION['user_role'] = $res[0]["role"];

  $uh = new UserHotels();
  $uh->user_id = $res[0]["id"];
  $uh_mapper = new UserHotelsMapper();
  $_SESSION["hotel_id"] = $uh_mapper->get_hotel_ids($uh);

  $url = PUBLIC_TOP . '/';
} else {
  $_SESSION["error"] = 'ログインIDかパスワードが間違っています。';
  $url = PUBLIC_TOP . '/login.php';
}

header('Location: ' . $url, true, 301);
exit;
