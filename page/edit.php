<?php
define("TITLE" ,"Edit");
define("STYLE", "edit");
require("../html/head.php");
?>
<div class="wrapper">
<?PHP
  require('../../../config/properties.php');
  require('../function/htmlspecialchar.php');

  $edit_word_id = $_POST["edit_word_id"];
  $edit_test_number = $_POST["edit_test_number"];
  $edit_sentence = $_POST["edit_sentence"];
  $edit_supplementary_img = $_POST["edit_supplementary_img"];
  $edit_supplementary_text = $_POST["edit_supplementary_text"];
?>

<div class="edit_wrap">
  <div class="edit_inner">
    <form action="done" method="post" class="edit_form">
      <input type="hidden" name="put_word_id" value="<?=$edit_word_id?>">
      <input required type="tel" name="put_test_number" size="3" placeholder="test number" class="edit_item" value="<?=$edit_test_number?>">
      <textarea required name="put_words" placeholder="sentence" class="edit_item"><?=func_htmlspecialchar($edit_sentence)?></textarea>
      <input type="url" name="put_supplementary_img" placeholder="supplementary image" class="edit_item" value="<?=func_htmlspecialchar($edit_supplementary_img)?>">
      <textarea name="put_supplementary_text" placeholder="supplementary text" class="edit_item"><?=func_htmlspecialchar($edit_supplementary_text)?></textarea>
      <input type="hidden" name="input_flag" value="edit">
      <input type="submit" value="Edit" class="edit_item_submit">
    </form>
    <form action="deleted" method="post" class="delete" onSubmit="return deleteCheck()">
      <input type="hidden" name="put_word_id" value="<?=$edit_word_id?>">
      <input type="submit" value="Delete" class="delete_submit">
    </form>
  </div>
</div>

<a href="/public_demo_1/" class="link_back">Back</a>
<!-- /wrapper --></div>
<script>
  const deleteCheck = () => {
    if (window.confirm('削除しますよ？')) {
      return true;
    } else {
      window.alert('削除をキャンセルしました');
      return false;
    }
  }
</script>