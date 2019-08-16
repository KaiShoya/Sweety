<?php
include_once '../sys/init.php';
$_SESSION["title"] = HOTEL_LIST;
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
    <div>
      空き状況：
      <span class="tag is-success">あり</span>
      <span class="tag is-danger">なし</span>
      <span class="tag is-warning">不明</span>
    </div>
    <div class="box" is="hotel-row" v-for="hotel in hotels" :h="hotel"></div>
  </div>
  <!-- コンテンツ -->

  <!-- テンプレート -->
  <script type="text/x-template" id="hotel-row">
    <div>
      <article class="media">
        <div class="media-content">
          <div class="content">
            <p>
              <span v-bind:class="[h.availability == '1' ? 'is-success' : h.availability == '2' ? 'is-danger' : 'is-warning', 'tag']">
                <small v-if="h.updated_at_availability == null">未更新</small>
                <small v-else>{{ h.updated_at_availability }}</small>
              </span>
              <span v-if="h.credit_card == '1'" class="tag is-info">
                <small>クレカOK</small>
              </span>
              <br>
              <a :href="`https://www.google.com/maps/search/?api=1&query=${ h.address }`" target="_blank" rel="noopener">
                <strong style="font-size: 1.2rem;line-hight: 10px;">{{ h.name }}</strong>
              </a>
              <br>
              <small>{{ h.address }}</small>
              <small><a :href="`tel:${ h.phone }`">{{ h.phone }}</a></small>
            </p>
          </div>
        </div>
      </article>
    </div>
  </script>
  <!-- テンプレート -->

  <script src="<?= ASSETS_PATH ?>/js/moment.min.js"></script>
  <script src="<?= ASSETS_PATH ?>/js/moment-with-locales.min.js"></script>
  <script>
    moment.locale('ja');
  </script>
  <?php include_once PUB_PATH . '/parts/footer.php'; ?>
</body>

</html>