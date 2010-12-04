<div id="div-report-edit">
  <?php
    echo $form->create('Report', array('id'=>'ReportEditForm', 'enctype'=>'multipart/form-data'));
    echo $form->hidden('Report.id');
    echo $form->hidden('Report.project_id');
    echo $form->hidden('Project.projecttype');
    echo $form->hidden('Project.reportmultipleedit');
    echo $form->hidden('Project.name');
    //echo $form->hidden('Project.Author.name');
    echo $form->hidden('Project.namesolicitare');
    echo $form->hidden('Project.projecttypevizat');
    echo $form->hidden('Project.projectdomain');
    echo $form->hidden('Project.projectnumber');
    echo $form->hidden('Project.projectdatetext');
    echo $form->hidden('Project.initiative');
    echo $form->hidden('Project.reporttrasnparenta');
    echo $form->hidden('Project.reportrespectaretermen');
    echo $form->hidden('Project.reportimpact');
    echo $form->hidden('Project.projectstate');
    $projecttype = $this->data['Project']['projecttype'];
    $pointdigit = 1;
    $this->countattachment = 0;
    $projectname = $this->data['Project']['name'];
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
                echo $form->input('Report.reportdatetext', array('label'=>false, 'size'=>'17', 'maxlength'=>'18', 'readonly'=>'readonly')).
                  '<span class="green"></span>'.
                  $form->hidden('Report.reportdate');
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
							$this->data['Project']['projectnumber'].
              ' от '.$this->data['Project']['projectdatetext'].')</p>';
          else
						echo '<p align="center">По запросу '.nl2br($this->data['Project']['namesolicitare']).'</p>';
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
              <td valign="top" width="390"><?php echo 'Вид акта, предусмотренного проектом: '.$this->data['Project']['projecttypevizat'];?></td>
              <td valign="top"><?php echo 'Область: '.$this->data['Project']['projectdomain'];?></td>
            </tr>
            <?php
              if ($projecttype == 'проект закона') {
                echo '<tr><td valign="top" width="390">Зарегистрированный в Парламенте под №. '.
									$this->data['Project']['projectnumber'].'</td>'.
                  '<td valign="top">от: '.$this->data['Project']['projectdatetext'].'</td></tr>';
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
            $headcontent = ' este '.$this->data['Project']['initiative'];
            if ($this->data['Project']['initiative'] == 'Правительство')
							$headcontent = $headcontent.', непосредственный автор - '.$author;
            echo $this->element('report_edit_pointhead', array(
                'letter'=>$pointdigit,
                'headtext'=>'Автор законодательной инициативы',
                'headcontent'=>$headcontent.'.'));
            $pointdigit++;

            //<!-- Пункт 2 -->
            echo $this->element('report_edit_pointhead', array(
                'letter'=>$pointdigit,
                'headtext'=>'Категория законодательного акта',
                'headcontent'=>' предложенного: <span>'.
                  $form->input('Report.p02list1', array(
                    'class' => 'required_dependent',
                    'label' => false,
                    'div' => false,
                    'empty' => 'выберите',
                    'options' => array(
											'органический закон'=>'органический закон',
                      'ординарный закон'=>'ординарный закон',
                      'конституционный закон'=>'конституционный закон',
                      'постановление Парламента'=>'постановление Парламента',
                      'не указана'=>'не указана'))).
                  '</span><span class="green"></span>, что <span>'.
                  $form->input('Report.p02list2', array(
                    'class' => 'required_dependent',
                    'label' => false,
                    'div' => false,
                    'empty' => 'выберите',
                    'options' => array(
											'соответствует'=>'соответствует',
                      'не соответствует'=>'не соответствует'))).
                  '</span><span class="green"></span> статье 72 Конституции и ст. ст. 6-11, 27, 35 и 39 Закона о законодательных актах, №780-XV от 27.12.2001.',
                'headsmalltext'=>'Впишите ниже текст, разъясняющий в чем конкретно состоит несоответствие или для высказывания других идей в связи с этой проблемой.',
                'textareanotrequired'=>true,
                'textareaname'=>'p02text1'));
            $pointdigit++;
            echo '<div class="blue">';
            echo $form->input('Report.p02option1', array('type'=>'checkbox', 'label'=>' У эксперта есть замечания относительно категории законодательного акта'));
            if ($isadmin == 1)
							echo $form->input('Report.p02option2', array('type' => 'checkbox', 'label'=>' Замечание принято'));
            echo '</div>';
          }
        ?>

        <!-- Пункт 3 -->
        <?php
          if ($this->data['Project']['reporttrasnparenta'] == 1) {
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Прозрачность принятия решений.',
              'textareaname'=>'p03text1'));
            $pointdigit++;
        ?>
        		<table width="100%" border="0" cellpadding="3" cellspacing="0" class="blue">
              <?php
								echo $this->element('report_edit_radio', array(
									'tdtext'=>'Принцип прозрачности принятия решения был соблюден?',
									'radioname'=>'p03radio1'));
							?>
            </table>
        <?php }?>

        <!-- Пункт 4 -->
        <?php
          echo $this->element('report_edit_pointhead', array(
            'letter'=>$pointdigit,
            'headtext'=>'Цель продвижения проекта.',
            'headsmalltext'=>'Укажите цель проекта, вытекающую из информационной ноты либо непосредственно из текста проекта (из Преамбулы, формулы принятия либо отдельной статьи), в случае если она расписана. Если у вас другое мнение или вы хотите дополнить цель указанную автором, укажите это конкретно.',
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

          <?php
            if ($projecttype == 'проект закона') {
              //<!-- Пункт 5 -->
              echo $this->element('report_edit_pointhead', array(
                'letter'=>$pointdigit,
                'headtext'=>'Пояснительная записка',
                'headcontent'=>' проекта, подвергнутого экспертизе <span>'.
                  $form->input('Report.p05list1', array(
                    'class' => 'required_dependent',
                    'label' => false,
                    'div' => false,
                    'empty' => 'выберите',
                    'options' => array(
											'опубликована на сайте Парламента'=>'опубликована на сайте Парламента',
                      'не опубликована на сайте Парламента'=>'не опубликована на сайте Парламента'))).
                  '</span><span class="green"></span>'.
                  '<br/>Считаем, что таким образом Парламент <b><span id="ReportP05list2">...</span></b> принцип прозрачности законодательного процесса и принципы сотрудничества с гражданским обществом.',
                'headsmalltext'=>'Укажите и другие идеи / мнения.',
                'textareanotrequired'=>true,
                'textareaname'=>'p05text1'));
              $pointdigit++;
            }
          ?>

          <!-- Пункт 6 -->
          <?php
            if ($this->data['Project']['reportrespectaretermen'] == 1) {
              echo $this->element('report_edit_pointhead', array(
                'letter'=>$pointdigit,
                'headtext'=>'Соблюдение сроков сотрудничества с гражданским обществом.',
                'textareanotrequired'=>true,
                'textareaname'=>'p06text1'));
              $pointdigit++;
          ?>
              <table width="100%" border="0" cellpadding="3" cellspacing="0" class="blue">
                <?php
									echo $this->element('report_edit_radio', array(
										'tdtext'=>'Сроки сотрудничества с гражданским обществом были соблюдены?',
										'radioname'=>'p06radio1'));
								?>
              </table>
          <?php }?>

          <!-- Пункт 7 -->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Достаточность обоснования.',
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
              'headtext'=>'Совместимость с законодательством Сообщества и другими международными стандартами.',
              'headsmalltext'=>'Укажите существование ссылок в пояснительной записке или тексте проекта на законодательство Сообщества и другие международные стандарты или отсутствие этих ссылок, в случае существования таких актов, установленных экспертом.',
              'textareaname'=>'p08text1'));
            $pointdigit++;
          ?>
          <table border="0" cellpadding="3" cellspacing="0" width="100%" class="blue">
            <?php
							echo $this->element('report_edit_radio', array(
								'tdtext'=>'Записка / проект содержит ссылки на законодательство Сообщества?',
								'radioname'=>'p08radio1'));
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
              $trstyle = ($this->data['Report']['p09radio1'] == 2) ? $trstyle = 'display: none;' : null;
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
            if ($this->data['Project']['reportimpact'] == 1) {
              echo $this->element('report_edit_pointhead', array(
                'letter'=>$pointdigit,
                'headtext'=>'Анализ последствий регулирования проекта.',
                'textareaname'=>'p10text1'));
              $pointdigit++;
          ?>
            <table width="100%" border="0" cellpadding="3" cellspacing="0" class="blue">
              <?php
								echo $this->element('report_edit_radio', array(
									'tdtext'=>'Проект был подвергнут анализу последствий регулирования?',
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
          <h2>Оценка коррупциогенности по существу</h2>

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
							$trstyle = ($this->data['Report']['p11radio1'] == 2) ? $trstyle = 'display: none;' : null;
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
							$trstyle = ($this->data['Report']['p12radio1'] == 2) ? $trstyle = 'display: none;' : null;
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
              'headsmalltext'=>'Определите если проект содержит положения относительно государственных органов: порядок организации, деятельности, компетенции, и др. и дайте общую оценку этих положений из перспективы существования либо отсутствия элементов коррупциогенности. Сформулируйте подробные коментарии относительно проблемных формулировок, касающихся деятельности государственных органов, предусмотренных проетов, в таблице подробного анализа потенциально коррупциогенных положений проекта.',
              'textareaname'=>'p15text1'));
            $pointdigit++;
          ?>
          <table border="0" cellpadding="3" cellspacing="0" width="100%" class="blue">
            <?php
							echo $this->element('report_edit_radio', array(
								'tdtext'=>'Проект регулирует деятельность государственных органов?',
								'radioname'=>'p15radio1'));
							$trstyle = ($this->data['Report']['p15radio1'] == 2) ? $trstyle = 'display: none;' : null;
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
              'headtext'=>'Подробный анализ потенциально коррупциогенных положений проекта.',
              'headsmalltext'=>'В случае установления элементов коррупциогенности в конкретных положениях проекта, эксперт заполняет нижеприведенную таблицу.'));
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
            <?php echo $form->input('Report.simplesubreport', array('type'=>'textarea', 'label'=>false, 'style'=>"height: 150px;"));?>
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
          <?php echo $form->input('Report.concluzii', array('type'=>'textarea', 'class'=>'required_dependent', 'label'=>false));?>
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
    if ($this->data['Report']['admincoments']!='' || $isadmin == 1)
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
									echo $form->input('Report.admincoments', array('type'=>'textarea', 'label'=>false));
                else
									echo $form->input('Report.admincoments', array('type'=>'textarea', 'label'=>false, 'readonly'=>'readonly'));
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
                echo $form->input('Report.reportstate', array(
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
                echo $form->input('Report.reportstate', array(
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
              <input name="savebutton" id="savebutton" style="width: 100px; font-size:18px;" value="Сохранить" type="submit"/>
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

  <?php echo $form->end();?>
</div>
<br/><br/>
<div name="savebutton2" id="savebutton2"></div>
<?php
	echo $this->element('sponsor');
	echo $javascript->codeBlock('var isadmin = '.$isadmin.'; var celemsacceptance = '.$celemsacceptance.'; var countattachment = '.$this->countattachment.';');
	echo $javascript->link('reportedit');
?>