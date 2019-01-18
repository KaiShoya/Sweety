<?php
# エラー表示
ini_set("display_errors", On);
error_reporting(E_ALL);

# セッションスタート
session_start();

# core
if (gethostname() == "sv5.php.starfree.ne.jp") {
  require_once 'core/constant.php';
} else {
  require_once 'core/constant_dev.php';
}
require_once 'core/context.php';

# model
require_once 'model/model.php';
Context::require_dir(SYS_PATH.'/model/');

# mapper
require_once 'mapper/data_mapper.php';
Context::require_dir(SYS_PATH.'/mapper/');
