<?php
  echo $this->Html->link(
    $this->Html->image('/images/delete.png', array('title' => 'Удалить')),
    $deletelink,
    array('escape' => false),
    'Вы уверены, что хотите удалить этот '.$deletelinkquestion.' ?');
?>
