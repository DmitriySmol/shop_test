<?php 

if(isset($_GET['hash']),$_GET['id']) {
  query("
      UPDATE `users` SET
      `active` = 1
      WHERE `id` = ".(int)$_GET['id']."
      AND `hash` = '".mysql_real_escape_string_All($_GET['hash'])."'
  ")
  $info = 'Вы прошли активацию';
} else {
    $info = 'Вы прошли по неверной ссылке';
}

?>