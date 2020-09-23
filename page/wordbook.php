<?php
  require('../../config/properties.php');
  require('function/htmlspecialchar.php');

  $put_word_id = $_POST["put_word_id"];
  $put_understand_plus = $_POST["put_understand_plus"];
  $put_understand_minus = $_POST["put_understand_minus"];

  // DB接続
  try {
    $dbh = new PDO(DSN_INFO, USER_NAME, PASSWORD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (is_numeric($put_understand_plus)) {
      putUnderstand($dbh, $put_understand_plus, $put_word_id);
    } else if (is_numeric($put_understand_minus)) {
      putUnderstand($dbh, $put_understand_minus, $put_word_id);
    }

    if (is_numeric($put_understand_plus) || is_numeric($put_understand_minus)) {
?>
    <script>
      location.href = "/public_demo_1/";
    </script>
<?php
    }

    $stmt = $dbh->query("SELECT word_id, sentence, test_number, supplementary_text, supplementary_img, understand FROM public_demo_db_1 ORDER BY understand ASC");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="words_wrap">
<ul class="words_list">

<?php
    foreach ($users as $value) {
      $value_understand = $value['understand'];
      $value_understand_plus = ++$value_understand;
      $value_understand_minus = $value_understand - 2;

      echo '<li class="words_item">'
              .'<p class="words_item_text js_toggle_detail">'
              .func_htmlspecialchar($value['sentence'])
              .'</p>'
              .'<ul class="understand_list">'
                .'<li class="understand_item">'
                  .'<form action="./" method="post">'
                    .'<input type="hidden" name="put_understand_minus" value="'.$value_understand_minus.'">'
                    .'<input type="hidden" name="put_word_id" value="'.$value['word_id'].'">'
                    .'<input type="submit" value="NG" class="understand_item_submit">'
                    .'</form>'
                    .'</li>'
                    .'<li class="understand_item">'
                    .'<form action="./" method="post">'
                    .'<input type="hidden" name="put_understand_plus" value="'.$value_understand_plus.'">'
                    .'<input type="hidden" name="put_word_id" value="'.$value['word_id'].'">'
                    .'<input type="submit" value="OK" class="understand_item_submit">'
                  .'</form>'
                .'</li>'
              .'</ul>'
              .'<div class="more_button js_toggle_detail"></div>'
              .'<div class="words_detail">';

              if ($value['supplementary_img']) {
                echo '<img src="'.func_htmlspecialchar($value['supplementary_img']).'" alt="" class="words_detail_image">';
              }
              if ($value['supplementary_text']) {
                echo '<p class="words_detail_text">'.func_htmlspecialchar($value['supplementary_text']).'</p>';
              }

              echo '<form action="page/edit" method="post">'
                    .'<input type="hidden" name="edit_word_id" value="'.$value['word_id'].'">'
                    .'<input type="hidden" name="edit_sentence" value="'.func_htmlspecialchar($value['sentence']).'">'
                    .'<input type="hidden" name="edit_test_number" value="'.func_htmlspecialchar($value['test_number']).'">'
                    .'<input type="hidden" name="edit_supplementary_img" value="'.func_htmlspecialchar($value['supplementary_img']).'">'
                    .'<input type="hidden" name="edit_supplementary_text" value="'.func_htmlspecialchar($value['supplementary_text']).'">'
                    .'<input type="submit" value="Edit" class="edit_item">'
                  .'</form>'
              .'</div>'
            .'</li>';
    }

    $dbh = null;

  } catch (PDOException $e) {
      echo 'Connection failed'.$e->getMessage();
      exit;
  }

  function putUnderstand($dbh, $plus_minus, $put_word_id) {
      $sth = $dbh->prepare('UPDATE public_demo_db_1 SET understand = ? WHERE word_id = ?');
      $sth->bindValue(1, $plus_minus, PDO::PARAM_INT);
      $sth->bindValue(2, $put_word_id, PDO::PARAM_INT);
      $sth->execute();
  }
?>
<!-- /words_list --></ul>
<!-- /words_wrap --></div>
