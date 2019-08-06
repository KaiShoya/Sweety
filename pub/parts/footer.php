<?php
$associative_array = debug_backtrace();
$file = pathinfo($associative_array[0]["file"]);
$subdir = str_replace(realpath(PUB_PATH), "", $file["dirname"]);
?>

<script src="<?= ASSETS_PATH ?>/js/axios.min.js"></script>
<script src="<?= ASSETS_PATH ?>/js/vue.min.js"></script>
<script src="<?= ASSETS_PATH ?>/js/lodash.min.js"></script>
<?php if (file_exists(PUB_PATH . "/assets/js" . $subdir . "/" . $file["filename"] . ".js")) : ?>
  <script src="<?= ASSETS_PATH ?>/js<?= $subdir ?>/<?= $file["filename"] ?>.js"></script>
<?php endif; ?>