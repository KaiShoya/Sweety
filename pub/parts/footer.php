<?php
$associative_array = debug_backtrace();
$file = pathinfo($associative_array[0]["file"])['filename'];
?>

<!-- Ajax用の -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vue"></script>
<!-- <script src="https://unpkg.com/vue-router"></script> -->
<script src="<?=ASSETS_PATH?>/js/buefy.min.js"></script>
<!-- <script src="https://unpkg.com/buefy/dist/buefy.min.js"></script> -->
<script src="https://unpkg.com/buefy/dist/components/table"></script>
<script src="https://unpkg.com/buefy/dist/components/input"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.11/lodash.min.js"></script>
<?php if (file_exists(PUB_PATH."/assets/js/".$file.".js")): ?>
  <script src="<?=ASSETS_PATH?>/js/<?=$file?>.js"></script>
<?php endif;?>
