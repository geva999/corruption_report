<?php echo $this->element('top_menu', array('top_menu_title'=>'Статистика'));?>

<div id="line">
  <?php
    if ($isadmin == 1)
      echo $this->element('admin_menu');
    else
      echo $this->element('expert_menu');
  ?>
</div>

<div id="listcontent" style="color: black;">

    <div align="center">
        <?php echo $form->create('Report', array('id'=>'ReportStatisticForm', 'action'=>'statistic'));?>
        <table cellpadding="5" cellspacing="0" border="0">
            <tr>
                <td rowspan="4">Критерии фильтрирования статистики :</td>
                <?php
                    echo '<td>'
                        .$form->input('Project.projectstate', array(
                                'label'=>'Статус проекта: ',
                                'div'=>false,
                                'empty'=>'все',
                                'options'=>array(2=>'Принятый', 3=>'Отозванный'))).
                        '</td>'.'<td>'.
                        $form->input('Project.projecttype', array(
                                'label'=>'Вид проекта: ',
                                'div'=>false,
                                'empty'=>'все',
                                'options'=>array('проект закона'=>'проект закона', 'по запросу'=>'по запросу'))).
                        '</td>'.'<td rowspan="4">'.
                        $form->submit('Фильтрирование', array('div'=>false)).
                        '</td>'.'<tr><td colspan="2">Период афиширования - '.
                        $form->input('Report.date1text', array('label'=>'&nbsp;&nbsp;&nbsp;от: ', 'div'=>false, 'size'=>'17', 'maxlength'=>'18', 'readonly'=>'readonly')).
                        $form->hidden('Report.date1').
                        $form->input('Report.date2text', array('label'=>'&nbsp;&nbsp;&nbsp;до: ', 'div'=>false, 'size'=>'17', 'maxlength'=>'18', 'readonly'=>'readonly')).
                        $form->hidden('Report.date2').
                        '</td></tr>'.'<tr><td>'.
                        $form->input('Project.expert_id', array('empty'=>'все', 'label'=>'Имя эксперта: ', 'div'=>false)).
                        '</td>'.'<td>&nbsp;</td></tr><tr><td>'.
                        $form->input('Project.initiative', array(
                                'label'=>'Законодательная инициатива: ',
                                'div'=>false,
                                'empty'=>'все',
                                'options'=>array(
                                    'Правительство'=>'Правительство',
                                    'депутаты Парламента'=>'депутаты Парламента',
                                    'Президент'=>'Президент'))).
                        '</td><td>'.
                        $form->input('Project.author_id', array('empty'=>'все', 'label'=>'Непосредственный автор проекта: ', 'div'=>false)).
                        '</td></tr>';
                ?>
            </tr>
        </table>
        <?php echo $form->end();?>
    </div>
    <div id="spinner" style="display: none; text-align: center;"><br/><img src="/img/loadinganimation.gif"/><br/></div>

    <br/>
    <div id="caption" class="red" align="center">Статус проектов</div>
    <?php
        echo $this->element('admin_statistic_projects', array('statistic'=>$statisticprojectsall));
    ?>
    <br/><br/>

    <div id="caption" class="red" align="center">Объем работы экспертов</div>
    <?php
        echo $this->element('admin_statistic_experts', array('statistic'=>$statisticexpertsauthors, 'experts'=>$experts));
    ?>
    <br/><br/>

    <div id="caption" class="red" align="center">Авторы законодательных проектов, подвергнутых экспертизе коррупционности</div>
    <?php
        echo $this->element('admin_statistic_initiative_bydomain', array('statistic'=>$statisticexpertsauthors['проект закона']));
    ?>
    <br/><br/>

    <div id="caption" class="red" align="center">Непосредственные авторы проектов, подвергнутых экспертизе коррупционности</div>
    <?php
        echo $this->element('admin_statistic_authors', array('statistic'=>$statisticexpertsauthors, 'authors'=>$authors));
    ?>
    <br/><br/>

    <div id="caption" class="red" align="center">Общая оценка, обоснование и оценка коррупционности по существу (все заключения)</div>
    <?php
        echo $this->element('admin_statistic_reports', array('statistic'=>$statisticreportsall));
    ?>
    <br/><br/>

    <div id="caption" class="red" align="center">Распространение факторов коррупционности в тексте проектов – уровень распространения, частота коррупционных факторов в проектах, уровень распространения каждого фактора в своей категории (все проекты, подвергнутые экспертизе - <?php echo $statisticelementsall['total_reports'];?>)</div>
    <?php
        echo $this->element('admin_statistic_elements_all', array('statistic'=>$statisticelementsall, 'elemgroups'=>$celemgroups, 'elems'=>$celems));
    ?>
    <br/><br/>

    <div id="caption" class="red" align="center">Эффективность замечаний относительно коррупционности по областям экспертизы (из заключений по принятым или отозванным проектам - <?php echo $statisticelementsefficiency['total_reports'];?>)</div>
    <?php
        echo $this->element('admin_statistic_elements_efficiency', array('statistic'=>$statisticelementsefficiency, 'elemgroups'=>$celemgroups, 'elems'=>$celems));
    ?>
    <br/><br/>

    <div id="caption" class="red" align="center">Список заключений по принятым проектам в которых замечания коррупционности были приняты</div>
    <?php
        echo $this->element('admin_statistic_pelems', array('statistic'=>$statisticpelems, 'elemgroups'=>$celemgroups, 'elems'=>$celems));
    ?>
    <br/><br/>
    <?php echo $this->element('sponsor');?>

</div>

<?php echo $this->element('admin_statistic_js');?>
