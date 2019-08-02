<?php
include_once '../../sys/init.php';
$_SESSION["title"] = AVAILABILITY;
Context::login_check();

$mapper = new HotelsMapper();
$hotels = $mapper->find_by_id($_SESSION["hotel_id"]);

$a_mapper = new AvailabilityMapper();
$tmp = $a_mapper->find_by_hotel_id($_SESSION["hotel_id"]);
$availavility = [];
foreach ($tmp as $value) {
  $availavility[$value["hotel_id"]] = $value["availability"];
}
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
      <div class="columns is-mobile">
        <button v-bind:class="{'is-primary': available[<?= $hotel["id"] ?>] == '1'}" class="button column" style="height: 200px;" v-on:click="onClick(<?= $hotel["id"] ?>, '1')">空室あり</button>
        <button v-bind:class="{'is-primary': available[<?= $hotel["id"] ?>] == '2'}" class="button column" style="height: 200px;" v-on:click="onClick(<?= $hotel["id"] ?>, '2')">空室なし</button>
      </div>
    <?php endforeach; ?>
  </div>
  <!-- コンテンツ -->

  <script>
    const topPath = '<?= PUBLIC_TOP ?>';
    const availables = <?= json_encode($availavility) ?>;
  </script>
  <?php include_once PUB_PATH . '/parts/footer.php'; ?>
</body>

</html>