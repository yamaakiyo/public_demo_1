<?php
define("TITLE" ,"削除完了！");
define("STYLE", "deleted");
require("../html/head.php");
?>
<div class="deleted_wrap">
<?PHP
  require('../../../config/properties.php');

  $put_word_id = $_POST["put_word_id"];
  // DB接続
  if ($put_word_id) {
    try {
      $dbh = new PDO(DSN_INFO, USER_NAME, PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth = $dbh->prepare("DELETE FROM public_demo_db_1 WHERE word_id = ?");
        $sth->bindValue(1, $put_word_id, PDO::PARAM_STR);
        $sth->execute();
?>
      <script>
        location.href = "/public_demo_1/page/deleted/";
      </script>
<?php

      $dbh = null;

    } catch (PDOException $e) {
      echo 'Connection failed'.$e->getMessage();
      exit;
    }
  }
?>
<p class='done_text'>削除してやった</p>
<a href="/public_demo_1/" class="link_back">もどる</a>
<!-- /deleted_wrap --></div>