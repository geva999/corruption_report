<?php echo $this->element('top_menu', array('top_menu_title'=>'Администрирование проектов'));?>

<div id="line">
	<?php echo $this->element('backlink_menu', array('backlink'=>'/admin/projects', 'backlinktitle'=>'Назад к списку проектов'));?>
</div>

<div id="listcontent">

	<div id="caption" class="red">Редактирование проекта</div>

	<div id="Form">
		<?php
			echo $form->create('Project', array('enctype'=>'multipart/form-data'));
			echo $form->input('Project.id');
		?>
			<ul>
				<li>
					<?php
						if ($this->data['Project']['projecttype'] != '')
							$projecttype = $this->data['Project']['projecttype'];
						else
							$projecttype = 'проект закона';
						echo $form->input('Project.projecttype', array(
								'label' => 'Вид проекта',
								'options' => array(
									'проект закона'=>'проект закона',
									'по запросу'=>'по запросу')));
					?>
				</li>
				<li><?php echo $form->input('Project.expert_id', array('label'=>'Имя эксперта'));?></li>
				<li><?php echo $form->input('Project.name', array('label'=>'Название проекта', 'type'=>'textarea', 'style'=>'width: 65%;'));?></li>
				<li class="option2"<?php if ($projecttype != 'по запросу') echo ' style="display:none;"';?>>
					<?php echo $form->input('Project.namesolicitare', array('label'=>'По запросу', 'type'=>'textarea', 'style'=>'width: 65%;'));?>
				</li>
				<li>
					<?php
						echo $form->input('Project.projecttypevizat', array(
								'label' => 'Вид акта, предусмотренного проектом',
								'options' => array(	'общий'=>'общий',
													'о внесении изменений'=>'о внесении изменений',
													'о внесении дополнений'=>'о внесении дополнений',
													'о внесении изменений и дополнений'=>'о внесении изменений и дополнений',
													'о признании утратившим силу'=>'о признании утратившим силу')));
					?>
				</li>
				<li>
					<?php
						echo $form->input('Project.projectdomain', array(
								'label' => 'Область',
								'options' => $domainsforselect));
					?>
				</li>
				<li class="option1"<?php if ($projecttype != 'проект закона') echo ' style="display:none;"';?>>
					<?php echo $form->input('Project.projectnumber', array('label'=>'Номер регистрации в Парламенте'));?>
				</li>
				<br/>
				<li>
					<label class="option1"<?php if ($projecttype != 'проект закона') echo ' style="display:none;"';?>>Дата регистрации в Парламенте</label>
					<label class="option2"<?php if ($projecttype != 'по запросу') echo ' style="display:none;"';?>>Дата запроса</label>
					<?php
						echo $form->input('Project.projectdatetext', array('label'=>false, 'readonly'=>'readonly'));
						echo $form->hidden('Project.projectdate');
					?>
				</li>
				<li class="option1"<?php if ($projecttype != 'проект закона') echo ' style="display:none;"';?>>
					<?php
						echo $form->input('Project.initiative', array(
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
				<li class="option3"<?php if ($this->data['Project']['initiative'] != 'Правительство' && $projecttype == 'проект закона') echo ' style="display:none;"';?>>
					<?php echo $form->input('Project.author_id', array('label'=>'Непосредственный автор'));?>
				</li>
				<li><?php echo $form->input('Project.reportnumber', array('label'=>'Număr raport'));?></li>
				<li><label>Необходимость проверки экспертом соблюдения проектом критерия прозрачности принятия решений</label><?php echo $form->input('Project.reporttrasnparenta', array('label'=>false, 'div'=>false));?></li>
				<br/><br/>
				<li><label>Необходимость проверки экспертом соблюдения сроков сотрудничества с гражданским обществом</label><?php echo $form->input('Project.reportrespectaretermen', array('label'=>false, 'div'=>false));?></li>
				<br/><br/><br/>
				<li><label>Необходимость проверки экспертом анализа последствий регулирования проекта</label><?php echo $form->input('Project.reportimpact', array('label'=>false, 'div'=>false));?></li>
				<br/><br/>
				<li><?php echo $form->input('Project.numberpages', array('label'=>'Число страниц'));?></li>
				<li><?php echo $form->input('Project.numberprojectsstandard', array('label'=>'Число стандартных проектов'));?></li>
				<li>
					<?php
						echo $form->input('Project.datelimitexperttext', array('label'=>'Предельный срок для эксперта', 'readonly'=>'readonly'));
						echo $form->hidden('Project.datelimitexpert');
					?>
				</li>
				<li>
					<?php
						echo $form->input('Project.datelimitparlamenttext', array('label'=>'Предельный срок для государственного органа', 'readonly'=>'readonly'));
						echo $form->hidden('Project.datelimitparlament');
					?>
				</li>
				<li>
					<?php
						echo $form->label('Project.filename', 'Имя файла');
						if (isset($this->data['Project']['filename']) && $this->data['Project']['filename'] != '')
							echo $html->link($this->data['Project']['filename'], '/uploaded/projects/'.$this->data['Project']['filename']);
						else echo 'Для этого проекта не существует файла.';
					?>
				</li>
				<li>
					<?php
						echo $form->input('Project.file', array('type'=>'file', 'label'=>'Выберите файл', 'style'=>'width: 50%;'));
					?>
				</li>
				<li>
					<?php
						$options = array(1=>'сохранен', 2=>'отправлен эксперту', 3=>'одобрен экспертом', 4=>'отклонен экспертом');
						//la edit cind e accepat - attr disabled
						echo $form->input('Project.projectreportstate', array(
									'legend' => false,
									'label' => 'проект:',
									'div' => false,
									'type' => 'select',
									'options' => $options));
					?>
				</li>
				<li>
					<?php
						echo $form->input('Project.projectstate', array(
									'legend' => false,
									'label' => 'Статус проекта',
									'div' => false,
									'type' => 'select',
									'options' => array(1=>'В процессе рассмотрения', 2=>'Принят', 3=>'Отозван')));
					?>
				</li>
				<li><label>Заключение с возможностью редактирования несколькими экспертами</label><?php echo $form->input('Project.reportmultipleedit', array('label'=>false, 'div'=>false));?></li>
			</ul>
			<?php echo $this->element('project_sortables_destination');?>
			<br/>
			<div class="Submit" style="padding-left:10%">
				<?php
					echo $form->submit('Сохранить');
					echo $form->end();
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