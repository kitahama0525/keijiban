<?php

require './mainte/db_connection.php';
require './mainte/insert.php';

// XSS
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}


if (!empty($_POST['name']) && !empty($_POST['text'])) {
  insert($_POST);
}

$sql = 'select * from comments';
$stmt = $pdo->query($sql); // ステートメント
$results = $stmt->fetchall();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>掲示板PHP練習</title>
  <link rel="stylesheet" href="./css/app.css">
</head>

<body>
  <section class="l-section">
    <div class="l-container">
      <h1>掲示板PHP練習</h1>
      <div class="c-result">
        <input type="hidden" name="text" value="<?php echo h($_POST['text']); ?>">
        <input type="hidden" name="name" value="<?php echo h($_POST['name']); ?>">
        <?php
        foreach ($results as $result) {
        ?>
          <div class="c-result__block">
            <div class="c-result__head">
              <div class="c-result__name">
                <?php echo $result['name']; ?>
              </div>
              <div class="c-result__date">
                <?php echo date('Y.m.d H:i', strtotime($result['created_at'])); ?>
              </div>
            </div>
            <div class="c-result__text">
              <?php echo $result['text']; ?>
            </div>
          </div>
        <?php
        }
        ?>
        <div class="c-result__button">
          <a href="./add/" class="c-button">コメントを投稿する</a>
        </div>
      </div>
    </div>
  </section>
</body>

</html>
