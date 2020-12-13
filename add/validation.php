<?php


function validation($request) { //$_POST連想配列

  $errors = [];

  if (empty($request['name'])) {
    $errors[] = '名前は必須です。';
  }


  if (empty($request['text'])) {
    $errors[] = 'テキストは必須です。';
  }


  return $errors;

}


?>
