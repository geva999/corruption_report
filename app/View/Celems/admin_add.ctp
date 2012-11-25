<?php echo $this->element('top_menu', array('top_menu_title'=>'Администрирование факторов коррупционности'));?>

<div id="line">
    <?php echo $this->element('backlink_menu', array('backlink'=>'/admin/celems', 'backlinktitle'=>'Назад к списку факторов коррупционности'));?>
</div>

<div id="listcontent">

    <div id="caption" class="red">Добавление фактора коррупционности</div>

    <div id="Form">
        <?php
            echo $this->Form->create('Celem');

        ?>
            <ul>
                <li><?php echo $this->Form->input('Celem.number', array('label'=>'№', 'size'=>4));?></li>
                <li><?php echo $this->Form->input('Celem.name', array('label'=>'Имя', 'size'=>85));?></li>
                <li>
                    <?php
                        //echo $this->Form->input('Celem.celemgroup', array('label'=>'Grup', 'size'=>85));
                        echo $this->Form->input('Celem.celemgroup', array(
                                'label' => 'Группа: ',
                                'options' => array(
                  'I. Коррупционные факторы, связанные с реализацией дискреционных полномочий'=>'I. Коррупционные факторы, связанные с реализацией дискреционных полномочий',
                  'II. Коррупционные факторы, связанные с правовыми пробелами'=>'II. Коррупционные факторы, связанные с правовыми пробелами',
                  'III. Коррупционные факторы системного характера'=>'III. Коррупционные факторы системного характера',
                  'IV. Другие коррупционные проявления'=>'IV. Другие коррупционные проявления')
                                ));
                    ?>
                </li>
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
