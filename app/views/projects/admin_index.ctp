<?php echo $this->element('top_menu', array('top_menu_title'=>'Администрирование проектов'));?>

<div id="line">
    <?php echo $this->element('admin_menu');?>
</div>

<div id="listcontent">

    <div align="left">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td>
                    <table border="0" cellpadding="5" cellspacing="0">
                        <?php
                            $links = array(
                'все'=>'',
                                'в процессе рассмотрения'=>'рассмотрение',
                                'принятые'=>'принятые',
                                'отозванные'=>'отозванные',
                                'отправленые эксперту для одобрения'=>'дляободрения',
                                'отклоненные экспертом'=>'отклоненные',
                                'одобренные экспертом'=>'одобренные'
                            );
                            echo '<tr><td>Проекты:</td>';
                            foreach ($links as $linktitle=>$linkaction)
                                echo '<td>'.$html->link($linktitle, '/admin/projects/index/'.$linkaction).'</td>';
                            echo '</tr>';
                        ?>
                    </table>
                </td>
                <td align="right" valign="top" width="25%">
                    <?php
                        echo $form->create('Project', array('action'=>'index')).
                            $form->input('Project.searchtype', array('label'=>'Критерии поиска: ', 'div'=>false,
                                'options'=>array(1=>'№ заключения', 2=>'№ проекта', 3=>'название проекта', 4=>'имя эксперта'))).
                            $form->input('Project.search', array('label'=>false, 'div'=>false)).
                            $form->submit('Поиск', array('div'=>false)).
                            $form->end();
                    ?>
                </td>
            </tr>
        </table>
    </div>

    <div id="caption" class="green"><?php echo $viewtext.' - '.$countprojects;?></div>

    <?php $paginator->options(array('url'=>$action));?>

    <table width="100%" border="0" cellspacing="1" cellpadding="5" id="green">
        <tr>
            <th width="5">№</th>
            <th width="80"><?php echo $paginator->sort('Номер заключения', 'Project.reportnumber', array('title'=>'сортировка по Номеру заключения'));?></th>
            <th><?php echo $paginator->sort('Название проекта', 'Project.name', array('title'=>'сортировка по Названию проекта'));?></th>
            <th width="80"><?php echo $paginator->sort('Номер проекта', 'Project.projectnumber', array('title'=>'сортировка по Номеру проекта'));?></th>
            <th width="200"><?php echo $paginator->sort('Имя эксперта', 'Expert.fullname', array('title'=>'сортировка по Имени эксперта'));?></th>
            <th width="70"><?php echo $paginator->sort('Предельный срок для эксперта', 'Project.datelimitexpert', array('title'=>'сортировка по Предельному сроку для эксперта'));?></th>
            <th width="70"><?php echo $paginator->sort('Предельный срок для государственного органа', 'Project.datelimitparlament', array('title'=>'сортировка по Предельному сроку для государственного органа'));?></th>
            <th width="100">Имя файла</th>
            <th width="50">Редактирование</th>
            <th width="50">Удалить</th>
        </tr>
        <?php
        $i = intval($paginator->counter(array('format'=>'%start%')));
        foreach ($projects as $project) {?>
        <tr align="center" valign="top">
            <td><?php echo $i.'.'; $i++;?></td>
            <td><?php echo $project['Project']['reportnumber'];?></td>
            <td align="left"><?php echo $project['Project']['name'];?></td>
            <td><?php echo $project['Project']['projectnumber'];?></td>
            <td align="left"><?php echo $project['Expert']['fullname'];?></td>
            <?php
                $bgexpertcolor = null;
                $bgparlamentcolor = null;
                $date = strtotime(date('d-m-Y', time()));
                $dateexpert = strtotime($project['Project']['datelimitexpert']);
                $dateparlament = strtotime($project['Project']['datelimitparlament']);
                if (($dateexpert - $date) < 0) $styleexpert = ' style="color:#000000; background-color:#ffd462;"'; else $styleexpert = null;
                if (($dateparlament - $date) < 0) $styleparlament = ' style="color:#000000; background-color:#f0523b;"'; else $styleparlament = null;
                echo '<td'.$styleexpert.'>'.date('d-m-Y', $dateexpert).'</td>';
                echo '<td'.$styleparlament.'>'.date('d-m-Y', $dateparlament).'</td>';
            ?>
            <td align="left">
                <?php
                    if (isset($project['Project']['filename']) && $project['Project']['filename'] != '')
                        echo $html->link($project['Project']['filename'], '/uploaded/projects/'.$project['Project']['filename']);
                    else echo 'Не существует';
                ?>
            </td>
            <td><?php echo $this->element('editlink', array('editlink'=>'/admin/projects/edit/'.$project['Project']['id']));?></td>
            <td><?php echo $this->element('deletelink', array('deletelink'=>'/admin/projects/delete/'.$project['Project']['id'], 'deletelinkquestion'=>'проект'));?></td>
        </tr>
        <?php }?>
    </table>

    <?php
        echo $this->element('paginator');
        echo $this->element('addlink', array('addlink'=>'/admin/projects/add', 'addtitle'=>' Добавить проект'));
        echo $this->element('simple_legend');
        echo $this->element('error_messages');
        echo $this->element('sponsor');
    ?>

</div>
