<?php echo $this->element('top_menu', array('top_menu_title'=>'Администрирование факторов коррупционности'));?>

<div id="line">
    <?php echo $this->element('backlink_menu', array('backlink'=>'/admin/celems', 'backlinktitle'=>'Назад к списку факторов коррупционности'));?>
</div>

<div id="listcontent">

    <div id="caption" class="red">Редактирование фактора коррупционности</div>

    <div id="Form">
        <?php
            echo $this->Form->create('Celem');
            echo $this->Form->input('Celem.id');
        ?>
            <ul>
                <li><?php echo $this->Form->input('Celem.number', array('label'=>'№', 'size'=>4));?></li>
                <li><?php echo $this->Form->input('Celem.name', array('label'=>'Имя', 'size'=>85));?></li>
                <li><?php echo $this->Form->input('Celem.celemgroup', array('label' => 'Группа: ', 'options' => $celem_groups_select));?></li>
                <li><?php echo $this->Form->input('Celem.description', array('label'=>'Описание', 'type'=>'textarea', 'style'=>'width: 65%;'));?></li>
            </ul>
            <?php echo $this->element('submit_button');?>
    </div>

    <?php
        echo $this->element('backlink', array('backlink'=>'/admin/celems', 'backlinktitle'=>'Назад к списку факторов коррупционности'));
        echo $this->element('error_messages');
        echo $this->element('sponsor');
    ?>

</div>
