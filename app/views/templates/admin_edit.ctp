<?php echo $this->element('top_menu', array('top_menu_title'=>'Администрирование доноров'));?>

<div id="line">
    <?php echo $this->element('backlink_menu', array('backlink'=>'/admin/templates', 'backlinktitle'=>'Назад к списку доноров'));?>
</div>

<div id="listcontent">

    <div id="caption" class="red">Редактирование донора</div>

    <div id="Form">
        <?php
            echo $form->create('Template');
            echo $form->input('Template.id');
        ?>
            <ul>
                <li><?php echo $form->input('Template.name', array('label'=>'Наименование', 'size'=>'70'));?></li>
                <li>
                    <?php
                        echo $form->input('Template.datetext', array('label'=>'Действителен от:', 'readonly'=>'readonly'));
                        echo $form->hidden('Template.date');
                    ?>
                </li>
                <br/>
                <li><?php echo $form->input('Template.header', array('label'=>'Header для страницы', 'type'=>'textarea', 'class'=>'tinymceeditor'));?></li>
                <li><?php echo $form->input('Template.footer', array('label'=>'Footer для страницы', 'type'=>'textarea', 'class'=>'tinymceeditor'));?></li>
                <br/><br/>
                <li><?php echo $form->input('Template.headerpdf', array('label'=>'Header для PDF', 'type'=>'textarea', 'class'=>'tinymceeditor'));?></li>
                <div class="red" style="padding-left:12%">
                    Для документа PDF ширина таблиц исчисляется только в пикселях, ширина исчисленная в % не афишируется правильно.<br/>
                    Ширина документа PDF в формате A4 равна 490 пикселям.
                </div>
                <br/>
                <li><?php echo $form->input('Template.footerpdf', array('label'=>'Footer для PDF', 'type'=>'textarea', 'class'=>'tinymceeditor'));?></li>
            </ul>
            <?php echo $this->element('submit_button');?>
    </div>

    <?php
        echo $this->element('backlink', array('backlink'=>'/admin/templates', 'backlinktitle'=>'Назад к списку доноров'));
        echo $this->element('error_messages');
        echo $this->element('sponsor');
        echo $this->element('template_js');
    ?>

</div>
