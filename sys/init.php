<?php
# エラー表示
ini_set("display_errors", 1);
error_reporting(E_ALL);

date_default_timezone_set('Asia/Tokyo');

# セッションスタート
session_start();

# core
if (gethostname() == "sv5.php.starfree.ne.jp") {
  require_once 'core/constant_starfree.php';
} else if (gethostname() == "www.sweetyhotel.shop") {
  require_once 'core/constant_xrea.php';
} else {
  require_once 'core/constant_dev.php';
}
require_once 'core/context.php';

# model
require_once 'model/model.php';
Context::require_dir(SYS_PATH . '/model/');

# mapper
require_once 'mapper/data_mapper.php';
Context::require_dir(SYS_PATH . '/mapper/');
