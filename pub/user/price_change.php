<?php
include_once '../../sys/init.php';
$_SESSION["title"] = PRICE_CHANGE;
Context::login_check();

$mapper = new HotelsMapper();
$hotels = $mapper->find_by_id($_SESSION["hotel_id"]);

$prices = new PriceListsMapper();
$prices::$sort = "day_of_week,time_zone_start,utilization_time";
$day_of_week = [
  0 => "全曜日",
  1 => "月",
  2 => "火",
  3 => "水",
  4 => "木",
  5 => "金",
  6 => "土",
  7 => "日",
  8 => "祝日",
  9 => "祝前日"
];

?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once PUB_PATH . '/parts/head.php'; ?>

<body>
  <!-- ナビゲーション -->
  <?php include_once PUB_PATH . '/parts/navbar.php'; ?>
  <!-- ナビゲーション -->

  <!-- コンテンツ -->
  <div class="container">
    <?php foreach ($hotels as $i => $hotel) : ?>
      <section class="section">
        <h1 class="title"><?= $hotel["name"] ?></h1>
      </section>

      <table class="table is-hoverable is-bordered">
        <thead>
          <tr>
            <td>週番号</td>
            <td>最低価格</td>
            <td>最大価格</td>
            <td>利用開始時間</td>
            <td>利用終了時間</td>
            <td>時間</td>
            <td>チェックインかチェックアウトか</td>
          </tr>
        </thead>
        <tbody>
          <?php $price_list = $prices::find_by_hotel_id($hotel["id"]); ?>
          <?php foreach ($price_list as $j => $pl) : ?>
            <tr>
              <td><?= $day_of_week[$pl["day_of_week"]] ?></td>
              <td><?= $pl["min_price"] ?></td>
              <td><?= $pl["max_price"] ?></td>
              <td><?= $pl["time_zone_start"] ?></td>
              <td><?= $pl["time_zone_end"] ?></td>
              <td><?= $pl["utilization_time"] ?></td>
              <td><?= $pl["from_checkin"] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php endforeach; ?>
  </div>
  </div>
  <!-- コンテンツ -->

  <?php include_once PUB_PATH . '/parts/footer.php'; ?>
</body>

</html>