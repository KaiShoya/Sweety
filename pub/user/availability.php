<?php
include_once '../../sys/init.php';
$_SESSION["title"] = AVAILABILITY;
Context::login_check();
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
    <div class="columns is-mobile">
      <button v-bind:class="{'is-primary': available == 1}" class="button column" style="height: 200px;" v-on:click="available = 1">空室あり</button>
      <button v-bind:class="{'is-primary': available == 2}" class="button column" style="height: 200px;" v-on:click="available = 2">空室なし</button>
    </div>

    <div class="field is-horizontal">
      <div class="field-label is-large">
        <label class="label">空室数</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input class="input is-large" type="number" placeholder="Large input" v-model="vacancies" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- コンテンツ -->

  <?php include_once PUB_PATH.'/parts/footer.php'; ?>
</body>
</html>
