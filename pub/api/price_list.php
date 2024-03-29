<?php
include_once '../../sys/init.php';

$dow = isset($_REQUEST["dow_id"]) ? $_REQUEST["dow_id"] : date('N');
$start_hour = isset($_REQUEST["start_hour"]) ? $_REQUEST["start_hour"] : null;
$start_time = isset($_REQUEST["start_time"]) ? $_REQUEST["start_time"] : "00";
$utilization_time = isset($_REQUEST["utilization_time"]) ? $_REQUEST["utilization_time"] : "0";
$card_accepted = isset($_REQUEST["card_accepted"]) ? "1" : "0";
$available = isset($_REQUEST["available"]) ? ($_REQUEST["available"] == "undefined") ? [] : explode(",", $_REQUEST["available"]) : array("0", "1");

$log = new SearchLogs();
$log->card_accepted = $card_accepted;

$prices = new PriceListsMapper();
// 最低価格順に並び替え
$prices::$sort = "min_price";

if ($dow == 0 && $start_hour == null && $utilization_time == null && $card_accepted == "0") {
  $price_list = $prices::all();

  $log->day_of_week = $dow;
} else {
  $model = new PriceLists();
  if ($dow != 0) {
    $model->day_of_week = $dow;
  }
  if ($start_hour == null) {
    $model->time_zone_start = "00:00:00";
  } else {
    $model->time_zone_start = "$start_hour:$start_time:00";
    // $model->time_zone_end = "$start_hour:$start_time:00";
  }
  $model->utilization_time = $utilization_time;
  $model->credit_card = $card_accepted;
  $model->availability = $available;
  $price_list = $prices::find_by($model);

  $log->day_of_week = $dow;
  $log->time_zone_start = $model->time_zone_start;
  $log->utilization_time = $model->utilization_time;
}

// ログ保存
// 30秒間に複数回検索した場合、ログを上書きする
$logMapper = new SearchLogsMapper();
if (isset($_COOKIE["search"])) {
  $log->id = $_COOKIE["search"];
  $logMapper::update($log);
  // cookieの保持期間を更新
  setcookie("search", $_COOKIE["search"], time() + 30);
} else {
  $searchLogsId = $logMapper::add($log);
  setcookie("search", $searchLogsId, time() + 30);
}

if (!isset($_COOKIE["visited"])) {
  // セッションの保持期間はとりあえず1時間
  setcookie("visited", "true", time() + 60 * 60);

  $log = new AccessLogs();

  $datetime = new DateTime();
  $access_time = $datetime->format('Y-m-d H:00:00');

  $log->access_time = $access_time;
  $log->remote_addr = $_SERVER['REMOTE_ADDR'];
  $log->http_user_agent = $_SERVER['HTTP_USER_AGENT'];
  $logMapper = new AccessLogsMapper();
  $logMapper::add_count($log);
}

echo json_encode($price_list);
