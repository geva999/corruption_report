<?php echo $this->element('top_menu', array('top_menu_title'=>'Администрирование непосредственных авторов'));?>

<div id="line">
    <?php echo $this->element('backlink_menu', array('backlink'=>'/admin/authors', 'backlinktitle'=>'Назад к списку непосредственных авторов'));?>
</div>

<div id="listcontent">

    <div id="caption" class="red">Добавление непосредственного автора</div>

    <div id="Form">
        <?php
            echo $this->Form->create('Author');

        ?>
            <ul>
                <li><?php echo $this->Form->input('Author.name', array('label'=>'Название', 'size'=>'70'));?></li>
            </ul>
            <?php echo $this->element('submit_button');?>
    </div>

    <?php
        echo $this->element('backlink', array('backlink'=>'/admin/authors', 'backlinktitle'=>'Назад к списку непосредственных авторов'));
        echo $this->element('error_messages');
        echo $this->element('sponsor');
    ?>

</div>
