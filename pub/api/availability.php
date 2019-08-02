<?php
include_once '../../sys/init.php';
Context::login_check();

$hotel_id = isset($_REQUEST['hotel_id']) ? $_REQUEST['hotel_id'] : null;
$available = isset($_REQUEST['available']) ? $_REQUEST['available'] : 0;
echo $hotel_id;
echo ",";
echo $available;
echo ",";

if (isset($_SESSION["hotel_id"]) && in_array($hotel_id, $_SESSION["hotel_id"])) {
  $model = new Availability();
  $model->hotel_id = $hotel_id;
  $model->availability = $available;

  $update = new Availability();
  $update->availability = true;

  $mapper = new AvailabilityMapper();
  echo $mapper->duplicate_update($model, $update);
} else {
  echo "false";
}
