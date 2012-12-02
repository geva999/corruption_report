<div id="div-report-edit">
  <?php
    echo $this->Form->create('Report', array('id'=>'ReportEditForm', 'enctype'=>'multipart/form-data'));
    echo $this->Form->hidden('Report.id');
    echo $this->Form->hidden('Report.project_id');
    echo $this->Form->hidden('Project.projecttype');
    echo $this->Form->hidden('Project.reportmultipleedit');
    echo $this->Form->hidden('Project.name');
    //echo $this->Form->hidden('Project.Author.name');
    echo $this->Form->hidden('Project.namesolicitare');
    echo $this->Form->hidden('Project.projecttypevizat');
    echo $this->Form->hidden('Project.projectdomain');
    echo $this->Form->hidden('Project.projectnumber');
    echo $this->Form->hidden('Project.projectdatetext');
    echo $this->Form->hidden('Project.initiative');
    echo $this->Form->hidden('Project.reportimpact');
    echo $this->Form->hidden('Project.projectstate');
    $projecttype = $this->request->data['Project']['projecttype'];
    $pointdigit = 1;
    $this->countattachment = 0;
    $projectname = $this->request->data['Project']['name'];
  ?>

  <br/>
  <table align="center" border="0" cellpadding="0" cellspacing="0" width="972">
  <!-- Дата и номер -->
  <tr>
    <td>
      <table valign="top" align="left" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top" width="220">
            <?php
              if ($isadmin == 1)
                echo $this->Form->input('Report.reportdatetext', array('label'=>false, 'size'=>'17', 'maxlength'=>'18', 'readonly'=>'readonly')).
                  '<span class="green"></span>'.
                  $this->Form->hidden('Report.reportdate');
            ?>
          </td>
          <td valign="top" align="right" width="752"><a href="<?php echo $backlink;?>">назад к списку заключений</a></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <br/><br/>
      <h1>ЭКСПЕРТНОЕ ЗАКЛЮЧЕНИЕ</h1>
      <h1>по <?php echo $projectname;?></h1>
      <h3>
        <?php
          if (substr($projectname, 0, 7) == 'проекту')
                        $projectname = substr($projectname, 7, strlen($projectname)-7);
          if ($projecttype == 'проект закона')
            echo '<p align="center" class="evidentiat">(зарегистрированный в Парламенте под номером '.
                            $this->request->data['Project']['projectnumber'].
              ' от '.$this->request->data['Project']['projectdatetext'].')</p>';
          else
                        echo '<p align="center">По запросу '.nl2br($this->request->data['Project']['namesolicitare']).'</p>';
        ?>
      </h3>
    </td>
  </tr>
  <tr>
    <td>
      <br/>
      <div class="gri">
          <!-- Пункт 0 - 1 -->
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td valign="top" width="390"><?php echo 'Вид акта, предусмотренного проектом: '.$this->request->data['Project']['projecttypevizat'];?></td>
              <td valign="top"><?php echo 'Область: '.$this->request->data['Project']['projectdomain'];?></td>
            </tr>
            <?php
              if ($projecttype == 'проект закона') {
                echo '<tr><td valign="top" width="390">Зарегистрированный в Парламенте под №. '.
                                    $this->request->data['Project']['projectnumber'].'</td>'.
                  '<td valign="top">от: '.$this->request->data['Project']['projectdatetext'].'</td></tr>';
              }
            ?>
          </table>
      </div>
    </td>
  </tr>
  <?php if ($multipleeditcontrol) {?>
  <tr>
    <td>
      <br/>
      <div class="bej">
        <h2>Общая оценка</h2>
        <?php
          if ($projecttype == 'проект закона') {
            //<!-- Пункт 1 -->
            $headcontent = ' является '.$this->request->data['Project']['initiative'];
            if ($this->request->data['Project']['initiative'] == 'Правительство')
                            $headcontent = $headcontent.', непосредственный автор - '.$author;
            echo $this->element('report_edit_pointhead', array(
                'letter'=>$pointdigit,
                'headtext'=>'Автор законодательной инициативы',
                'headcontent'=>$headcontent.'.'));
            $pointdigit++;
          }
        ?>

        <!-- Пункт 4 -->
        <?php
          echo $this->element('report_edit_pointhead', array(
            'letter'=>$pointdigit,
            'headtext'=>'Цель продвижения проекта.',
            'headsmalltext'=>'Укажите цель проекта, вытекающую из концепции законопроекта, пояснительной записки либо непосредственно из текста проекта (из Преамбулы, формулы принятия либо отдельной статьи), в случае если она расписана. Если у вас другое мнение или вы хотите дополнить цель указанную автором, укажите это конкретно.',
            'textareaname'=>'p04text1'));
          $pointdigit++;
        ?>
      </div>
    </td>
  </tr>
  <tr>
    <td>
      <br/>
      <div class="gri">
          <h2>Обоснование проекта</h2>

          <!-- Пункт 7 -->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Пояснительная записка и достаточность обоснования.',
              'headsmalltext'=>'Укажите ваше мнение если пояснительная записка содержит достаточное обоснование для продвижения проекта законодательного акта.',
              'textareaname'=>'p07text1'));
            $pointdigit++;
          ?>
          <table width="100%" border="0" cellpadding="3" cellspacing="0" class="blue">
            <?php
                            echo $this->element('report_edit_radio', array(
                                'tdtext'=>'Обоснование достаточное?',
                                'radioname'=>'p07radio1'));
                        ?>
          </table>

          <!-- Пункт 8 -->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Совместимость с международными стандартами.',
              'headsmalltext'=>'Укажите существование ссылок в пояснительной записке или тексте проекта на международные стандарты или отсутствие этих ссылок, в случае существования таких актов, установленных экспертом.',
              'textareaname'=>'p08text1'));
            $pointdigit++;
          ?>
          <table border="0" cellpadding="3" cellspacing="0" width="100%" class="blue">
            <?php
                echo $this->element('report_edit_radio', array(
                                'tdtext'=>'Записка / проект содержит ссылки на другие релевантные международные стандарты?',
                                'radioname'=>'p08radio2'));
                        ?>
          </table>

          <!-- Пункт 9 -->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Финансово-экономическое обоснование.',
              'headsmalltext'=>'Определите существование и релевантность финансово-экономического обоснования предписаний проекта в пояснительной записке.',
              'textareanotrequired'=>true,
              'textareaname'=>'p09text1'));
            $pointdigit++;
          ?>
          <table border="0" cellpadding="3" cellspacing="0" width="100%" class="blue">
            <?php
                            echo $this->element('report_edit_radio', array(
                                'tdtext'=>'Применение проекта предполагает финансовые затраты?',
                                'radioname'=>'p09radio1'));
              $trstyle = ($this->request->data['Report']['p09radio1'] == 2) ? $trstyle = 'display: none;' : null;
              echo $this->element('report_edit_radio', array(
                                'tdtext'=>'Пояснительная записка содержит финансово-экономическое обоснование?',
                                'radioname'=>'p09radio2',
                                'trclass'=>'divtohidep09radio1',
                                'trstyle'=>$trstyle));
            ?>
            </tr>
          </table>

          <!-- Пункт 10 -->
          <?php
            if ($this->request->data['Project']['reportimpact'] == 1) {
              echo $this->element('report_edit_pointhead', array(
                'letter'=>$pointdigit,
                'headtext'=>'Согласование с аккредитованными объединениями субъектов частного предпринимательства.',
                'textareaname'=>'p10text1'));
              $pointdigit++;
          ?>
            <table width="100%" border="0" cellpadding="3" cellspacing="0" class="blue">
              <?php
                                echo $this->element('report_edit_radio', array(
                                    'tdtext'=>'Проект был согласован с аккредитованными субъектами частного предпринимательства?',
                                    'radioname'=>'p10radio1'));
                            ?>
            </table>
        <?php }?>
      </div>
    </td>
  </tr>
  <?php }?>
  <tr>
    <td>
      <br/>
      <div class="bej">
          <h2>Оценка коррупционности по существу</h2>

          <?php if ($multipleeditcontrol) {?>
          <!-- Пункт 11 -->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Установление и продвижение интересов / выгод.',
              'headsmalltext'=>'Определите если проект устанавливает и / или продвигает груповые либо частные интересы или выгоды и если, по мнению эксперта, оно имеет или не имеет законного обоснования.',
              'textareaname'=>'p11text1'));
            $pointdigit++;
          ?>
          <table border="0" cellpadding="3" cellspacing="0" width="100%" class="blue">
            <?php
                            echo $this->element('report_edit_radio', array(
                                'tdtext'=>'Проект продвигает интересы, выгоды?',
                                'radioname'=>'p11radio1'));
                            $trstyle = ($this->request->data['Report']['p11radio1'] == 2) ? $trstyle = 'display: none;' : null;
              echo $this->element('report_edit_radio', array(
                                'tdtext'=>'Продвижение соответствует общему интересу общества?',
                                'radioname'=>'p11radio2',
                                'trclass'=>'divtohidep11radio1',
                                'trstyle'=>$trstyle));
            ?>
          </table>

          <!-- Пункт 12 -->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Ущерб наносимый применением акта.',
              'headsmalltext'=>'Определите если продвижение проекта может повлечь нанесение ущерба определенным категориям и если, по мнению эксперта это имеет или не иммет законное обоснование.',
              'textareaname'=>'p12text1'));
            $pointdigit++;
          ?>
          <table border="0" cellpadding="3" cellspacing="0" width="100%" class="blue">
            <?php
                            echo $this->element('report_edit_radio', array(
                                'tdtext'=>'При применении, проект нанесит ущерб?',
                                'radioname'=>'p12radio1'));
                            $trstyle = ($this->request->data['Report']['p12radio1'] == 2) ? $trstyle = 'display: none;' : null;
              echo $this->element('report_edit_radio', array(
                                'tdtext'=>'Ущерб соответствует общему интересу общества?',
                                'radioname'=>'p12radio2',
                                'trclass'=>'divtohidep12radio1',
                                'trstyle'=>$trstyle));
            ?>
          </table>

          <!-- Пункт 13 -->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Совместимость проекта с предписаниями национального законодательства.',
              'textareaname'=>'p13text1'));
            $pointdigit++;
          ?>
          <table border="0" cellpadding="3" cellspacing="0" width="100%" class="blue">
            <?php
                            echo $this->element('report_edit_radio', array(
                                'tdtext'=>'Проект соответствует национальному законодательству?',
                                'radioname'=>'p13radio1'));
                        ?>
          </table>

          <!-- Пункт 14 -->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Лингвистические формулировки положений проекта.',
              'textareaname'=>'p14text1'));
            $pointdigit++;
          ?>
          <table border="0" cellpadding="3" cellspacing="0" width="100%" class="blue">
            <?php
                            echo $this->element('report_edit_radio', array(
                                'tdtext'=>'У эксперта есть существенные замечания относительно лингвистических формулировок?',
                                'radioname'=>'p14radio1'));
                        ?>
          </table>

          <!-- Пункт 15 -->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Регулирование деятельности государственных органов.',
              'headsmalltext'=>'Определите если проект содержит положения относительно государственных органов: порядок организации, деятельности, компетенции, и др. и дайте общую оценку этих положений из перспективы существования либо отсутствия факторов коррупционности. Сформулируйте подробные коментарии относительно проблемных формулировок, касающихся деятельности государственных органов, предусмотренных проетов, в таблице подробного анализа потенциально коррупционных положений проекта.',
              'textareaname'=>'p15text1'));
            $pointdigit++;
          ?>
          <table border="0" cellpadding="3" cellspacing="0" width="100%" class="blue">
            <?php
                            echo $this->element('report_edit_radio', array(
                                'tdtext'=>'Проект регулирует деятельность государственных органов?',
                                'radioname'=>'p15radio1'));
                            $trstyle = ($this->request->data['Report']['p15radio1'] == 2) ? $trstyle = 'display: none;' : null;
              echo $this->element('report_edit_radio', array(
                                'tdtext'=>'У эксперта есть замечания?',
                                'radioname'=>'p15radio2',
                                'trclass'=>'divtohidep15radio1',
                                'trstyle'=>$trstyle));
            ?>
          </table>

          <?php }?>

          <!-- Пункт 16 -->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Подробный анализ потенциально коррупционных положений проекта.',
              'headsmalltext'=>'В случае установления факторов коррупционности в конкретных положениях проекта, эксперт заполняет нижеприведенную таблицу.'));
          ?>
          <div>
            <br/>
            <div id="rowsdiv" class="sortable">
              <?php
                echo $this->element('report_edit_lastpoint');
              ?>
            </div>
            <div align="center"><br/><input type="button" onclick="addrow();" value="Добавь строку"></div>
            <br/><br/>
            <?php echo $this->Form->input('Report.simplesubreport', array('type'=>'textarea', 'label'=>false, 'style'=>"height: 150px;"));?>
          </div>

      </div>
    </td>
  </tr>
  <tr>
    <td>
      <br/>
      <div class="gri">
          <!-- Выводы -->
          <h2>Выводы</h2>
          <span class="green" style="float:right;margin-bottom:-10px;"></span>
          <?php echo $this->Form->input('Report.concluzii', array('type'=>'textarea', 'class'=>'required_dependent tinymceeditor', 'label'=>false));?>
          <a href="javascript:void(0);" onclick="return toogletinymce('ReportConcluzii');">включить/выключить редактор</a>
      </div>
    </td>
  </tr>
  <?php if ($multipleeditcontrol) {?>
  <tr>
    <td>
      <br/>
      <div class="bej">
          <!-- Приложения -->
          <h2>Приложения</h2>
          <?php
            echo $this->element('report_edit_attachments');
          ?>
          <div align="center"><br/><input type="button" onclick="addattachment();" value="Добавить приложение"></div>
      </div>
    </td>
  </tr>
  <?php }?>
  <?php
    if ($this->request->data['Report']['admincoments']!='' || $isadmin == 1)
    {
  ?>
      <!-- Замечания администратора к эксперту -->
      <tr>
        <td>
          <br/>
          <div class="gri">
              <h2>Замечания администратора к эксперту</h2>
              <?php
                if ($isadmin == 1)
                                    echo $this->Form->input('Report.admincoments', array('type'=>'textarea', 'label'=>false));
                else
                                    echo $this->Form->input('Report.admincoments', array('type'=>'textarea', 'label'=>false, 'readonly'=>'readonly'));
              ?>
          </div>
          <br/><br/>
        </td>
      </tr>
  <?php
    }
  ?>
  <tr>
    <td>
      <br/>
      <div align="center">
        <!-- Save area -->
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="650">
          <tr id="saverow">
            <?php
              if ($isadmin == 1)
              {
                echo '<td align="center" valign="center">';
                echo $this->Form->input('Report.reportstate', array(
                    'legend' => false,
                    'label' => ' статус заключения: ',
                    'div' => false,
                    'type' => 'select',
                    'options' => array(
                      '1'=>'В процессе рассмотрения администратором',
                      '2'=>'Возвращен эксперту с замечаниями администратора',
                      '3'=>'Одобрен для опубликования с размещением на сайте')
                    ));
                echo '</td>';
              }
              elseif ($multipleeditcontrol)
              {
                echo '<td align="center" valign="center">';
                echo $this->Form->input('Report.reportstate', array(
                    'legend' => false,
                    'label' => false,
                    'div' => false,
                    'type' => 'checkbox',
                    'value' => '1'
                    ));
                echo '<font size="+0" color="#CC0000"><strong>&nbsp;&nbsp;Отправить для одобрения</strong></font></td>';
              }
            ?>
                  </tr>
                    <tr>
                        <td align="center" valign="center">
                            <br/>
              <input name="savebutton" id="savebutton" style="width: 150px; font-size:18px;" value="Сохранить" type="submit"/>
            </td>
          </tr>
          <tr>
            <td align="center" colspan="2">
              <div id="submit-message-append" class="error-message"></div>
            </td>
          </tr>
                    <tr>
                      <td align="center" colspan="2">
                        <br/><br/>
                        <a href="<?php echo $backlink;?>">назад к списку заключений</a>
                      </td>
                    </tr>
        </table>
      </div>
    </td>
  </tr>
  </table>

  <?php echo $this->Form->end();?>
</div>
<br/><br/>
<div name="savebutton2" id="savebutton2"></div>
<?php
    echo $this->element('sponsor');
    echo $this->Html->scriptBlock('var isadmin = '.$isadmin.'; var celemsacceptance = '.$celemsacceptance.'; var countattachment = '.$this->countattachment.';');
    echo $this->Html->script('reportedit');
?>
