<?php
include_once '../sys/init.php';
$_SESSION["title"] = HOTEL_LIST;
?>

<!DOCTYPE html>
<html lang="ja">
<?php include_once PUB_PATH.'/parts/head.php'; ?>
<body>
  <!-- ナビゲーション -->
  <?php include_once PUB_PATH.'/parts/navbar.php'; ?>
  <!-- ナビゲーション -->

  <!-- コンテンツ -->
  <div class="container">
    <table class="table is-hoverable is-bordered">
      <thead>
        <tr>
          <th class="col-md-2">id</th>
          <th class="col-md-2">ホテル名</th>
          <th class="col-md-2">住所</th>
          <th class="col-md-2">電話番号</th>
          <th class="col-md-2">マップコード</th>
          <!-- <th class="col-md-2">緯度</th>
          <th class="col-md-2">経度</th> -->
          <th class="col-md-2">カード</th>
          <!-- <th class="col-md-2">created_at</th>
          <th class="col-md-2">updated_at</th> -->
        </tr>
      </thead>
      <tbody>
        <tr is="hotel-row" v-for="hotel in hotels" :h="hotel"></tr>
      </tbody>
    </table>
  </div>
  <!-- コンテンツ -->

  <!-- Tableテンプレート -->
  <script type="text/x-template" id="hotel-row">
    <tr>
      <td>{{ h.id }}</td>
      <td>{{ h.name }}</td>
      <td>{{ h.address }}</td>
      <td>{{ h.phone }}</td>
      <td>{{ h.mapcode }}</td>
      <!-- <td>{{ h.lat }}</td>
      <td>{{ h.lon }}</td> -->
      <td>{{ h.credit_card }}</td>
      <!-- <td>{{ h.created_at }}</td>
      <td>{{ h.updated_at }}</td> -->
    </tr>
  </script>
  <!-- Tableテンプレート -->

  <?php include_once PUB_PATH.'/parts/footer.php'; ?>
</body>
</html>
