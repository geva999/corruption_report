<?php echo $this->element('top_menu', array('top_menu_title'=>'Администрирование пользователей'));?>

<div id="line">
    <?php echo $this->element('backlink_menu', array('backlink'=>'/admin/experts', 'backlinktitle'=>'Назад к списку пользователей'));?>
</div>

<div id="listcontent">

    <div id="caption" class="red">Добавить пользователя</div>

    <div id="Form">
        <?php
            echo $this->Form->create('Expert');

        ?>
            <ul>
                <li><?php echo $this->Form->input('Expert.fullname', array('label'=>'Фамилия и имя', 'size'=>'50'));?></li>
                <li><?php echo $this->Form->input('Expert.username', array('label'=>'Логин', 'size'=>'50'));?></li>
                <li><?php echo $this->Form->input('Expert.password', array('label'=>'Пароль', 'size'=>'50', 'value'=>''));?></li>

                <li style="padding-left:35%"><?php echo $this->Form->input('Expert.isadmin', array('label'=>false, 'div'=>false));?> Пользователь является администратором</li>
            </ul>
            <?php echo $this->element('submit_button');?>
    </div>

    <?php
        echo $this->element('backlink', array('backlink'=>'/admin/experts', 'backlinktitle'=>'Назад к списку пользователей'));
        echo $this->element('error_messages');
        echo $this->element('sponsor');
    ?>

</div>
