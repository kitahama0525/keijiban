<?php

const DB_HOST = 'mysql:dbname=keijiban;host=localhost;charset=utf8';
const DB_USER = 'keijiban_user';
const DB_PASSWORD = 'hamahiro4329';

// 例外処理 Exception
try {
  $pdo = new PDO(DB_HOST, DB_USER, DB_PASSWORD, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //連想配列
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //例外
    PDO::ATTR_EMULATE_PREPARES => false,
  ]);
  // echo '接続成功';

} catch(PDOException $e) {
  echo '接続失敗' . $e->getMessage() . "\n";
  exit;
}
