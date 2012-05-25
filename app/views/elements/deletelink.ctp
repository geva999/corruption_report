<?php
  echo $html->link(
    $html->image('/images/delete.png', array('title' => 'Удалить')),
    $deletelink,
    null,
    'Вы уверены, что хотите удалить этот '.$deletelinkquestion.' ?',
    false);
?>
