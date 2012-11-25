<?php echo $this->element('top_menu', array('top_menu_title'=>'Администрирование проектов'));?>

<div id="line">
    <?php echo $this->element('expert_menu');?>
</div>

<div id="listcontent">

    <div id="caption" class="green">Проекты для одобрения - <?php echo $countsaved;?></div>

    <table width="100%" border="0" cellspacing="1" cellpadding="5" id="green">
        <tr>
            <th width="5">№</th>
            <th width="80">Номер заключения</th>
            <th>Название проекта</th>
            <th width="80">Номер проекта</th>
            <th width="70">Предельный срок для эксперта</th>
            <th width="70">Предельный срок для государственного органа</th>
            <th width="100">Имя файла</th>
            <th width="50">Одобрение</th>
            <th width="50">Отклонить</th>
        </tr>
        <?php
        $i = 1;
        foreach ($projectssaved as $projectsaved) {?>
        <tr>
            <td align="center"><?php echo $i.'.'; $i++;?></td>
            <td align="center"><?php echo $projectsaved['Project']['reportnumber'];?></td>
            <td><?php echo $projectsaved['Project']['name'];?></td>
            <td align="center"><?php echo $projectsaved['Project']['projectnumber'];?></td>
            <?php
                $bgexpertcolor = null;
                $bgparlamentcolor = null;
                $date = strtotime(date('d-m-Y', time()));
                $dateexpert = strtotime($projectsaved['Project']['datelimitexpert']);
                $dateparlament = strtotime($projectsaved['Project']['datelimitparlament']);
                if (($dateexpert - $date) < 0) $bgexpertcolor = '#ffd462';
                if (($dateparlament - $date) < 0) $bgparlamentcolor = '#f0523b';
                echo '<td'.(isset($bgexpertcolor)?' bgcolor="'.$bgexpertcolor.'"':'').'>'.date('d-m-Y', $dateexpert).'</td>';
                echo '<td'.(isset($bgexpertcolor)?' bgcolor="'.$bgparlamentcolor.'"':'').'>'.date('d-m-Y', $dateparlament).'</td>';
            ?>
            <td>
                <?php
                    if (isset($projectsaved['Project']['filename']) && $projectsaved['Project']['filename'] != '')
                        echo $this->Html->link($projectsaved['Project']['filename'], '/uploaded/projects/'.$projectsaved['Project']['filename']);
                    else echo 'Не существует';
                ?>
            </td>
            <td align="center"><?php echo $this->element('aprove_link', array('aprovelink'=>'/projects/accept/'.$projectsaved['Project']['id']));?></td>
            <td align="center"><?php echo $this->element('reject_link', array('rejectlink'=>'/projects/reject/'.$projectsaved['Project']['id']));?></td>
        </tr>
        <?php }?>
    </table>

    <div id="caption" class="orange">Одобренные проекты - <?php echo $countaccepted;?></div>

    <table width="100%" border="0" cellspacing="1" cellpadding="5" id="orange">
        <tr>
            <th width="5">№</th>
            <th width="80"><?php echo $this->Paginator->sort('Project.reportnumber', 'Номер заключения', array('title' => 'сортировка по Номеру заключения'));?></th>
            <th><?php echo $this->Paginator->sort('Project.name', 'Название проекта', array('title' => 'сортировка по Названию проекта'));?></th>
            <th width="80"><?php echo $this->Paginator->sort('Project.projectnumber', 'Номер проекта', array('title' => 'сортировка по Номеру проекта'));?></th>
            <th width="70"><?php echo $this->Paginator->sort('Project.datelimitexpert', 'Предельный срок для эксперта', array('title' => 'сортировка по Предельному сроку для эксперта'));?></th>
            <th width="70"><?php echo $this->Paginator->sort('Project.datelimitparlament', 'Предельный срок для государственного органа', array('title' => 'сортировка по Предельному сроку для государственного органа'));?></th>
            <th width="100">Имя файла</th>
        </tr>
        <?php
        $i = intval($this->Paginator->counter(array('format'=>'%start%')));
        foreach ($projectsaccepted as $projectaccepted) {?>
        <tr>
            <td align="center"><?php echo $i.'.'; $i++;?></td>
            <td align="center"><?php echo $projectaccepted['Project']['reportnumber'];?></td>
            <td><?php echo $projectaccepted['Project']['name'];?></td>
            <td align="center"><?php echo $projectaccepted['Project']['projectnumber'];?></td>
            <?php
                $bgexpertcolor = null;
                $bgparlamentcolor = null;
                $date = strtotime(date('d-m-Y', time()));
                $dateexpert = strtotime($projectaccepted['Project']['datelimitexpert']);
                $dateparlament = strtotime($projectaccepted['Project']['datelimitparlament']);
                if (($dateexpert - $date) < 0) $bgexpertcolor = '#ffd462';
                if (($dateparlament - $date) < 0) $bgparlamentcolor = '#f0523b';
                echo '<td'.(isset($bgexpertcolor)?' bgcolor="'.$bgexpertcolor.'"':'').'>'.date('d-m-Y', $dateexpert).'</td>';
                echo '<td'.(isset($bgexpertcolor)?' bgcolor="'.$bgparlamentcolor.'"':'').'>'.date('d-m-Y', $dateparlament).'</td>';
            ?>
            <td>
                <?php
                    if (isset($projectaccepted['Project']['filename']) && $projectaccepted['Project']['filename'] != '')
                        echo $this->Html->link($projectaccepted['Project']['filename'], '/uploaded/projects/'.$projectaccepted['Project']['filename']);
                    else echo 'Не существует';
                ?>
            </td>
        </tr>
        <?php }?>
    </table>

    <?php
        echo $this->element('paginator');
        echo $this->element('expert_simple_legend');
        echo $this->element('error_messages');
        echo $this->element('sponsor');
    ?>

</div>
