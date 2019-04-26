<?php
define("PUBLIC_TOP", '/hotel_list/pub');
define("PUBLIC_PUB", PUBLIC_TOP.'');
// define("PUBLIC_SYS", PUBLIC_TOP.'/sys');
define("ASSETS_PATH", PUBLIC_PUB.'/assets');

define("TOP_PATH", __DIR__.'/../..');
define("PUB_PATH", TOP_PATH.PUBLIC_TOP);
define("SYS_PATH", TOP_PATH.'/sys');

// タイトル
define("INDEX", 'トップ');
define("HOTEL_LIST", 'ホテル一覧');
define("PRICE_LIST", '価格一覧');
define("TOS", '利用規約');

// DB情報
define("DB_TYPE", 'mysql'); // mysql or pgsql.
define("DB_HOST", 'localhost');
define("DB_NAME", 'kaisdev');
define("DB_USER", 'root');
define("DB_PASS", '');
