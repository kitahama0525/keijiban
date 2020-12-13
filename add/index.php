<?php

session_start();

require 'validation.php';
require '../mainte/db_connection.php';

header('X-FRAME-OPTIONS:DENY');


// XSS
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

$errors = validation($_POST);


?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>掲示板PHP練習</title>
  <link rel="stylesheet" href="../css/app.css">
</head>

<body>
  <div class="l-container">
    <?php

    // csrfToken
    if (!isset($_SESSION['csrfToken'])) {
      $csrfToken = bin2hex(random_bytes(32));
      $_SESSION['csrfToken'] = $csrfToken;
    }
    $token = $_SESSION['csrfToken'];

    ?>
    <?php if (!empty($errors) && !empty($_POST['submit'])) { ?>
      <?php echo '<ul>' ?>
      <?php foreach ($errors as $error) {
        echo '<li>' . $error . '</li>';
      }
      ?>
      <?php echo '</ul>'; ?>
    <?php } ?>
    <form class="c-form" method="post" action="../">
      <div class="c-form__block">
        <label>
          <p>名前</p>
          <input type="text" name="name" value="<?php echo h($_POST['name']) ?>">
        </label>
      </div>
      <div class="c-form__block">
        <label>
          <p>テキスト</p>
          <textarea name="text" rows="4" cols="40"><?php echo h($_POST['text']) ?></textarea>
        </label>
      </div>
      <div class="c-form__submit">
        <button class="c-button" type="submit" name="submit" value="send">投稿する</button>
      </div>
    </form>
  </div>
</body>

</html>
