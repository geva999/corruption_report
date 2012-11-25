<br/>
Список пользователей с правом совместного редактирования по данному проекту
(сортировка или перенос пользователей обратно в "Список пользователей из системы" осущевстляется путем перетягивания иконки
<?php echo $this->Html->image("/images/draggable.png"); ?>
&nbsp;слева от имени пользователей)
<div id="expertslist">
    <div id="sortabledestination" class="connectedsortable">
        <?php
            if (isset($this->request->data['Projectexpert']))
                foreach ($this->request->data['Projectexpert'] as $projectexpert)
                    echo '<div class="sortableitems">'.$this->Form->hidden('Projectexpert.][expert_id', array('value'=>$projectexpert['expert_id'])).$projectexpertslist[$projectexpert['expert_id']].'</div>';
        ?>
    </div>
</div>
