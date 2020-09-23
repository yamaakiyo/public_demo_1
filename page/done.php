<?php
define("TITLE" ,"My Toeic!! 登録完了！");
define("STYLE", "done");
require("../html/head.php");
?>
<div class="done_wrap">
<?PHP
  require('../../../config/properties.php');

  $input_flag = $_POST["input_flag"];
  $put_word_id = $_POST["put_word_id"];
  $put_words = $_POST["put_words"];
  $put_test_number = $_POST["put_test_number"];
  $put_supplementary_text = $_POST["put_supplementary_text"];
  $put_supplementary_img = $_POST["put_supplementary_img"];

  if ($input_flag) {
    try {
      $dbh = new PDO(DSN_INFO, USER_NAME, PASSWORD);
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      if ($input_flag === "add") {
        $sth = $dbh->prepare("INSERT public_demo_db_1 (sentence, test_number, supplementary_text, supplementary_img, input_time) VALUES(?, ?, ?, ?, sysdate())");
      } elseif ($input_flag === "edit") {
        $sth = $dbh->prepare("UPDATE public_demo_db_1 SET sentence = ?, test_number = ?, supplementary_text = ?, supplementary_img = ? WHERE word_id = ?");
        $sth->bindValue(5, $put_word_id, PDO::PARAM_INT);
      }
        $sth->bindValue(1, $put_words, PDO::PARAM_STR);
        $sth->bindValue(2, $put_test_number, PDO::PARAM_STR);
        $sth->bindValue(3, $put_supplementary_text, PDO::PARAM_STR);
        $sth->bindValue(4, $put_supplementary_img, PDO::PARAM_STR);
        $sth->execute();
?>
      <script>
        location.href = "/public_demo_1/page/done/";
      </script>
<?php

      $dbh = null;

    } catch (PDOException $e) {
        echo 'Connection failed'.$e->getMessage();
        exit;
    }
  }
?>
<p class='done_text'>登録してやった</p>
<a href="/public_demo_1/" class="link_back">もどる</a>
<!-- /done_wrap --></div>