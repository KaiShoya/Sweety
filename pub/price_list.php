<?php
include_once '../sys/init.php';
$_SESSION["title"] = PRICE_LIST;
$dow_id = isset($_REQUEST['dow_id']) ? $_REQUEST['dow_id'] : date('N');
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

    <div id="form">
      <nav class="level">
        <div class="level-left">
          <div class="level-item">利用する曜日</div>
          <div class="level-item">
            <button class="button <?= $dow_id == "1" ? "is-primary" : "" ?>" v-on:click="click_dow">月</button>
            <button class="button <?= $dow_id == "2" ? "is-primary" : "" ?>" v-on:click="click_dow">火</button>
            <button class="button <?= $dow_id == "3" ? "is-primary" : "" ?>" v-on:click="click_dow">水</button>
            <button class="button <?= $dow_id == "4" ? "is-primary" : "" ?>" v-on:click="click_dow">木</button>
            <button class="button <?= $dow_id == "5" ? "is-primary" : "" ?>" v-on:click="click_dow">金</button>
            <button class="button <?= $dow_id == "6" ? "is-primary" : "" ?>" v-on:click="click_dow">土</button>
            <button class="button <?= $dow_id == "7" ? "is-primary" : "" ?>" v-on:click="click_dow">日</button>
          </div>
          <div class="level-item">
            <button class="button <?= $dow_id == "8" ? "is-primary" : "" ?>" v-on:click="click_dow">祝日</button>
            <button class="button <?= $dow_id == "9" ? "is-primary" : "" ?>" v-on:click="click_dow">祝前日</button>
            <button class="button <?= $dow_id == "0" ? "is-primary" : "" ?>" v-on:click="click_dow">全曜日</button>
          </div>
        </div>
      </nav>

      <nav class="level">
        <div class="level-left">
          <div class="level-item">利用開始時間</div>
          <div class="level-item select">
            <select name="start_hour" v-model="startHour" v-on:change="change_start_hour">
              <option v-for="d in [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]">{{d}}</option>
            </select>
            <span>：</span>
            <select name="start_time" v-model="startTime" v-on:change="change_start_time">
              <option value="00">00</option>
              <option value="15">15</option>
              <option value="30">30</option>
              <option value="45">45</option>
            </select>
          </div>
          <div class="level-item" id="utilization_time">
            <button class="button" v-on:click="now_start_time">今から</button>
            <button class="button" v-on:click="reset_start_time">指定しない</button>
          </div>
        </div>
      </nav>

      <nav class="level">
        <div class="level-left">
          <div class="level-item">利用時間　　</div>
          <div class="level-item">
            <input class="input" type="text" name="utilization_time" style="width: 60px;" v-model="utilizationTime" v-on:change="change_utilization_time" />
            <span>分</span>
          </div>
          <div class="level-item">
            <button class="button" v-on:click="click_utilization_time(60)">60</button>
            <button class="button" v-on:click="click_utilization_time(90)">90</button>
            <button class="button" v-on:click="click_utilization_time(120)">120</button>
            <button class="button" v-on:click="click_utilization_time(180)">180</button>
          </div>
          <div class="level-item">
            <button class="button" v-on:click="click_utilization_time('Free')">フリータイム</button>
            <button class="button" v-on:click="click_utilization_time('Lodging')">宿泊</button>
          </div>
        </div>
      </nav>

      <nav class="level">
        <div class="level-left">
          <div class="level-item">空室状況　　</div>
          <div class="level-item has-text-centered">
            <label class="checkbox" style="margin-right: 1rem;">
              <input type="checkbox" value="1" v-model="isAvailable" v-on:change="change_is_available">
              <span class="tag is-success">あり</span>
            </label>
            <label class="checkbox" style="margin-right: 1rem;">
              <input type="checkbox" value="2" v-model="isAvailable" v-on:change="change_is_available">
              <span class="tag is-danger">なし</span>
            </label>
            <label class="checkbox">
              <input type="checkbox" value="0" v-model="isAvailable" v-on:change="change_is_available">
              <span class="tag is-warning">不明</span>
            </label>
          </div>
        </div>
      </nav>

      <label class="checkbox">
        <input type="checkbox" id="card_accepted" v-model="cardAccepted" v-on:change="change_card_accepted">
        クレジットカード可
      </label>
    </div>

    <div class="box" is="price-row" v-for="price in orderedPrices" :p="price"></div>
  </div>
  <!-- コンテンツ -->

  <!-- PHPからJSへ値渡し -->
  <script>
    var dowId = "<?= $dow_id ?>";
  </script>

  <!-- テンプレート -->
  <script type="text/x-template" id="price-row">
    <div>
      <div class="content">
        <div>
          <?php if ($dow_id == 0): ?>
            <span class="tag">{{ p.day_of_week }}</span>
          <?php endif; ?>
          <span v-bind:class="[p.availability == '1' ? 'is-success' : p.availability == '2' ? 'is-danger' : 'is-warning', 'tag']">
            <small v-if="p.updated_at_availability == null">未更新</small>
            <small v-else>{{ p.updated_at_availability }}</small>
          </span>
          <span v-if="p.credit_card == '1'" class="tag is-info"><small>クレカOK</small></span>
        </div>
        <p>
          <strong>{{ p.hotel_id }}</strong>
          <span>
            <small>プラン:</small>
            <small v-if="p.utilization_time == 'Free'"><strong>フリー</strong></small>
            <small v-else-if="p.utilization_time == 'Lodging'"><strong>宿泊</strong></small>
            <small v-else><strong>{{ p.utilization_time }}分</strong></small>
          </span>
          <small>{{ p.time_zone_start }}〜{{ p.time_zone_end }}</small>
          <br>
          料金:
          <strong v-if="p.min_price == p.max_price">{{ p.min_price }}</strong>
          <strong v-else>{{ p.min_price }}〜{{ p.max_price }}</strong>
        </p>
      </div>
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