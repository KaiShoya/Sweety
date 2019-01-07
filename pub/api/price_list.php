<?php
include_once '../../sys/init.php';

$dow = isset($_REQUEST["dow_id"]) ? $_REQUEST["dow_id"] : "0";
$start_hour = isset($_REQUEST["start_hour"]) ? $_REQUEST["start_hour"] : null;
$start_time = isset($_REQUEST["start_time"]) ? $_REQUEST["start_time"] : "00";
$utilization_time = isset($_REQUEST["utilization_time"]) ? $_REQUEST["utilization_time"] : null;

$prices = new PriceListsMapper();
// 最低価格順に並び替え
$prices::$sort = "min_price";

if ($dow == 0 && $start_hour == null && $utilization_time == null) {
  $price_list = $prices::all();
} else {
  $model = new PriceLists();
  if ($dow != 0) {
    $model->day_of_week = $dow;
  }
  if ($start_hour != null) {
    $model->time_zone_start = "$start_hour:$start_time:00";
    $model->time_zone_end = "$start_hour:$start_time:00";
  }
  if ($utilization_time != null) {
    $model->utilization_time = $utilization_time;
  }
  $price_list = $prices::find_by($model);
}

echo json_encode($price_list);
