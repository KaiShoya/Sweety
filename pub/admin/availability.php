<?php
include_once '../../sys/init.php';
$_SESSION["title"] = AVAILABILITY;
Context::login_check('admin');

$mapper = new HotelsMapper();
$hotels = $mapper->all();

$a_mapper = new AvailabilityMapper();
$tmp = $a_mapper->all();
$availavility = [];
foreach($tmp as $value) {
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
    <table class="table is-hoverable is-bordered">
      <tbody>
        <?php foreach ($hotels as $i => $hotel) : ?>
          <tr>
            <td><?= $hotel["name"] ?></td>
            <td>
              <div class="field has-addons">
                <p class="control">
                  <button v-bind:class="{'is-primary': available[<?= $hotel["id"] ?>] == '1'}" class="button" v-on:click="onClick(<?= $hotel["id"] ?>, '1', <?= $hotel["id"] ?>)">空室あり</button>
                  <button v-bind:class="{'is-primary': available[<?= $hotel["id"] ?>] == '2'}" class="button" v-on:click="onClick(<?= $hotel["id"] ?>, '2', <?= $hotel["id"] ?>)">空室なし</button>
                  <button v-bind:class="{'is-primary': ['1', '2'].indexOf(available[<?= $hotel["id"] ?>]) < 0}" class="button" v-on:click="onClick(<?= $hotel["id"] ?>, '0', <?= $hotel["id"] ?>)">不明</button>
                </p>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  </div>
  <!-- コンテンツ -->

  <script>
    const topPath = '<?= PUBLIC_TOP ?>';
    const availables = <?= json_encode($availavility) ?>;
  </script>
  <?php include_once PUB_PATH . '/parts/footer.php'; ?>
</body>

</html>