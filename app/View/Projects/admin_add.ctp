<?php echo $this->element('top_menu', array('top_menu_title'=>'Администрирование проектов'));?>

<div id="line">
    <?php echo $this->element('backlink_menu', array('backlink'=>'/admin/projects', 'backlinktitle'=>'Назад к списку проектов'));?>
</div>

<div id="listcontent">

    <div id="caption" class="red">Добавить проект</div>

    <div id="Form">
        <?php
            echo $this->Form->create('Project', array('enctype'=>'multipart/form-data'));

        ?>
            <ul>
                <li>
                    <?php
                        if ($this->request->data['Project']['projecttype'] != '')
                            $projecttype = $this->request->data['Project']['projecttype'];
                        else
                            $projecttype = 'проект закона';
                        echo $this->Form->input('Project.projecttype', array(
                                'label' => 'Вид проекта',
                                'options' => array(
                                    'проект закона'=>'проект закона',
                                    'по запросу'=>'по запросу')));
                    ?>
                </li>
                <li><?php echo $this->Form->input('Project.expert_id', array('label'=>'Имя эксперта'));?></li>
                <li><?php echo $this->Form->input('Project.name', array('label'=>'Название проекта', 'type'=>'textarea', 'style'=>'width: 65%;'));?></li>
                <li class="option2"<?php if ($projecttype != 'по запросу') echo ' style="display:none;"';?>>
                    <?php echo $this->Form->input('Project.namesolicitare', array('label'=>'По запросу', 'type'=>'textarea', 'style'=>'width: 65%;'));?>
                </li>
                <li>
                    <?php
                        echo $this->Form->input('Project.projecttypevizat', array(
                                'label' => 'Вид акта, предусмотренного проектом',
                                'options' => array( 'общий'=>'общий',
                                                    'о внесении изменений'=>'о внесении изменений',
                                                    'о внесении дополнений'=>'о внесении дополнений',
                                                    'о внесении изменений и дополнений'=>'о внесении изменений и дополнений',
                                                    'о признании утратившим силу'=>'о признании утратившим силу')));
                    ?>
                </li>
                <br/>
                <li>
                    <?php
                        echo $this->Form->input('Project.projectdomain', array(
                                'label' => 'Область',
                                'options' => $domains_select));
                    ?>
                </li>
                <li class="option1"<?php if ($projecttype != 'проект закона') echo ' style="display:none;"';?>>
                    <?php echo $this->Form->input('Project.projectnumber', array('label'=>'Номер регистрации в Парламенте'));?>
                </li>
                <br/>
                <li>
                    <label class="option1"<?php if ($projecttype != 'проект закона') echo ' style="display:none;"';?>>Дата регистрации в Парламенте</label>
                    <label class="option2"<?php if ($projecttype != 'по запросу') echo ' style="display:none;"';?>>Дата запроса</label>
                    <?php
                        echo $this->Form->input('Project.projectdatetext', array('label'=>false, 'readonly'=>'readonly'));
                        echo $this->Form->hidden('Project.projectdate');
                    ?>
                </li>
                <li class="option1"<?php if ($projecttype != 'проект закона') echo ' style="display:none;"';?>>
                    <br/>
                    <?php
                        echo $this->Form->input('Project.initiative', array(
                                'label' => 'Законодательная инициатива',
                                'div' => false,
                                'empty' => 'выберите',
                                'options' => array(
                                    'Правительство'=>'Правительство',
                                    'депутат'=>'депутат',
                                    'группа депутатов'=>'группа депутатов',
                                    'Президент'=>'Президент')));
                    ?>
                </li>
                <br/>
                <li class="option3"<?php if ($this->request->data['Project']['initiative'] != 'Правительство' && $projecttype == 'проект закона') echo ' style="display:none;"';?>>
                    <?php echo $this->Form->input('Project.author_id', array('label'=>'Непосредственный автор'));?>
                </li>
                <li><?php echo $this->Form->input('Project.reportnumber', array('label'=>'Номер заключения'));?></li>
                <li><label>Необходимость проверки согласования проекта затрагивающего интересы субъектов частного предпринимательства с аккредитованными объединениями этих субъектов</label><?php echo $this->Form->input('Project.reportimpact', array('label'=>false, 'div'=>false));?></li>
                <br/><br/><br/><br/><br/><br/>
                <li><?php echo $this->Form->input('Project.numberpages', array('label'=>'Число страниц'));?></li>
                <li>
                    <?php
                        echo $this->Form->input('Project.datelimitexperttext', array('label'=>'Предельный срок для эксперта', 'readonly'=>'readonly'));
                        echo $this->Form->hidden('Project.datelimitexpert');
                    ?>
                </li>
                <li>
                    <?php
                        echo $this->Form->input('Project.datelimitparlamenttext', array('label'=>'Предельный срок для государственного органа', 'readonly'=>'readonly'));
                        echo $this->Form->hidden('Project.datelimitparlament');
                    ?>
                </li>
                <br/>
                <li>
                    <?php
                        echo $this->Form->label('Project.filename', 'Имя файла');
                        if (isset($this->request->data['Project']['filename']) && $this->request->data['Project']['filename'] != '')
                            echo $this->Html->link($this->request->data['Project']['filename'], '/uploaded/projects/'.$this->request->data['Project']['filename']);
                        else echo 'Для этого проекта не существует файла.';
                    ?>
                </li>
                <li>
                    <?php
                        echo $this->Form->input('Project.file', array('type'=>'file', 'label'=>'Выберите файл', 'style'=>'width: 50%;'));
                    ?>
                </li>
                <li>
                    <?php
                        $options = array(1=>'сохранен', 2=>'отправлен эксперту', 3=>'одобрен экспертом', 4=>'отклонен экспертом');
                        //la edit cind e accepat - attr disabled
                        echo $this->Form->input('Project.projectreportstate', array(
                                    'legend' => false,
                                    'label' => 'проект:',
                                    'div' => false,
                                    'type' => 'select',
                                    'options' => $options));
                    ?>
                </li>
                <li>
                    <?php
                        echo $this->Form->input('Project.projectstate', array(
                                    'legend' => false,
                                    'label' => 'Статус проекта',
                                    'div' => false,
                                    'type' => 'select',
                                    'options' => array(1=>'В процессе рассмотрения', 2=>'Принят', 3=>'Отозван')));
                    ?>
                </li>
                <li><label>Заключение с возможностью редактирования несколькими экспертами</label><?php echo $this->Form->input('Project.reportmultipleedit', array('label'=>false, 'div'=>false));?></li>
            </ul>
            <br/><br/>
            <?php echo $this->element('project_sortables_destination');?>
            <br/>
            <div class="Submit" style="padding-left:10%">
                <?php
                    echo $this->Form->submit('Сохранить');
                    echo $this->Form->end();
                ?>
            </div>
            <?php echo $this->element('project_sortables_source');?>
    </div>

    <?php
        echo $this->element('backlink', array('backlink'=>'/admin/projects', 'backlinktitle'=>'Назад к списку проектов'));
        echo $this->element('error_messages');
        echo $this->element('sponsor');
        echo $this->element('project_js');
    ?>

</div>
