<?php

function insert($request) {

  //DB接続 PDO
  require 'db_connection.php';

  $params = [
    'id' => null,
    'name' => $request['name'],
    'text' => $request['text'],
    'created_at' => null
  ];

  $count = 0;
  $columns = '';
  $values = '';

  foreach(array_keys($params) as $key) {
    if ($count++ > 0) {
      $columns .= ',';
      $values .= ',';
    }
    $columns .= $key;
    $values .= ':'.$key;
  }

  $sql = 'insert into comments (' . $columns . ')values(' . $values . ')';

  $stmt = $pdo->prepare($sql); // プリペアードステートメント
  $stmt->execute($params); // 実行

  header('Location: ./');
}
