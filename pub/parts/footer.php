<?php
$associative_array = debug_backtrace();
$file = pathinfo($associative_array[0]["file"])['filename'];
?>

<!-- Ajax用㝮 -->
<script src="<?= ASSETS_PATH ?>/js/axios.min.js"></script>
<script src="<?= ASSETS_PATH ?>/js/vue.min.js"></script>
<script src="<?= ASSETS_PATH ?>/js/buefy.min.js"></script>
<script src="<?= ASSETS_PATH ?>/js/lodash.min.js"></script>
<?php if (file_exists(PUB_PATH."/assets/js/".$file.".js")): ?>
  <script src="<?=ASSETS_PATH?>/js/<?=$file?>.js"></script>
<?php endif;?>
