<br/>
Список пользователей из системы
(перенос пользователей в "Список пользователей с правом совместного редактирования по данному проекту"
осущевстляется путем перетягивания иконки
<?php echo $this->Html->image("/images/draggable.png"); ?>
&nbsp;слева от имени пользователей)
<div id="sortablesource" class="connectedsortable">
    <?php
      foreach ($projectexpertslist as $expertid => $expertname) {
        $found = 0;
        foreach ($this->data['Projectexpert'] as $projectexpert)
          if ($expertid == $projectexpert['expert_id']) $found = 1;
        if ($found == 0)
          echo '<div class="sortableitems">'.$this->Form->hidden('Projectexpert.][expert_id', array('value'=>$expertid)).$expertname.'</div>';
      }
    ?>
</div>
