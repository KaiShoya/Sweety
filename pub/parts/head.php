<?php
$associative_array = debug_backtrace();
$file = pathinfo($associative_array[0]["file"])['filename'];
?>

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132761789-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-132761789-1');
  </script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $_SESSION["title"] ?></title>
  <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.5.94/css/materialdesignicons.min.css">
  <!-- <link rel="stylesheet" href="https://unpkg.com/buefy/dist/buefy.min.css"> -->
  <link rel="stylesheet" href="<?=ASSETS_PATH?>/css/buefy.min.css">
  <link rel="stylesheet" href="<?=ASSETS_PATH?>/css/common.css">
<?php if (file_exists(PUB_PATH."/assets/css/".$file.".css")): ?>
  <link rel="stylesheet" href="<?=ASSETS_PATH?>/css/<?=$file?>.css">
<?php endif;?>
</head>
