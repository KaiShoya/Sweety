<?php
include_once '../../sys/init.php';
Context::login_check('admin');

$hotel_id = isset($_REQUEST['hotel_id']) ? $_REQUEST['hotel_id'] : null;
$delete_flg = (isset($_REQUEST['delete_flg']) && (bool) $_REQUEST['delete_flg']) ? true : false;

if (($_SESSION['user_role'] == 'admin' && isset($hotel_id)) || (isset($_SESSION["hotel_id"]) && in_array($hotel_id, $_SESSION["hotel_id"]))) {
  $model = new Hotels();
  $model->id = $hotel_id;
  $model->deleted = $delete_flg;
  $mapper = new HotelsMapper();
  echo $mapper->update($model);
} else {
  echo "false";
}
