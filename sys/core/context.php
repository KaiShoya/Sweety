<?php
const DB_TYPE = 'mysql'; // mysql or pgsql.
const DB_HOST = 'localhost';
const DB_NAME = 'kaisdev';
const DB_USER = 'root';
const DB_PASS = '';

class Context {
  private static $pdo = null;

  public static function get_pdo() {
    if (self::$pdo != null) { return self::$pdo; }

    switch (DB_TYPE) {
    case 'mysql':
      $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;
      break;
    case 'pgsql':
      $dsn = 'pgsql:host='.DB_HOST.' dbname='.DB_NAME.' port=5432';
      break;
    case 'sqlite': # FIXME: not working.
      $dsn = 'sqlite:d:¥¥sqlite¥¥'.DB_NAME;
      break;
    default:
      return null;
    }

    try{
      self::$pdo = new PDO($dsn, DB_USER, DB_PASS);
      // self::$pdo = new PDO($dsn, DB_USER, DB_PASS, array(
      //   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      //   PDO::ATTR_EMULATE_PREPARES => false
      // ));
      return self::$pdo;
    }catch (PDOException $e){
      print('Error:'.$e->getMessage());
      die();
    }
  }

  public static function require_dir($dir) {
    // 最後に / が付加されていない場合は、付加
    $dir_last = substr($dir, -1);
    if($dir_last !== "/") {
      $dir .= "/";
    }

    // 指定されたパスが有効なディレクトリ名であればロード
    if (is_dir($dir)) {
      // 有効なディレクトリ名
      // → ディレクトリのオープンとハンドルの取得を試みる
      if ($dh = opendir($dir)) {
        // ディレクトリハンドル取得成功
        // → ファイル一覧を取得しながら反復処理
        while (($file = readdir($dh)) !== false) {
          if($file !== "." && $file !== "..") {
            if (is_dir($dir.$file))
              // サブディレクトリ内も処理
              // → 再帰処理
              require_dir($dir.$file);
            else
              // PHPファイル
              // → require_once
              require_once($dir.$file);
          }
        }
        closedir($dh);
      }
    }
  }

  public static function logger($txt){
    file_put_contents(TOP_PATH.'/logs/dev.log', $txt."\n", FILE_APPEND | LOCK_EX);
  }
}
