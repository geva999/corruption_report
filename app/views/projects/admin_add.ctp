<?php echo $this->element('top_menu', array('top_menu_title'=>'Administrare proiecte'));?>

<div id="line">
	<?php echo $this->element('backlink_menu', array('backlink'=>'/admin/projects', 'backlinktitle'=>'Назад к списку proiecte'));?>
</div>

<div id="listcontent">

	<div id="caption" class="red">Adăugare proiect</div>

	<div id="Form">
		<?php
			echo $form->create('Project', array('enctype'=>'multipart/form-data'));

		?>
			<ul>
				<li>
					<?php
						if ($this->data['Project']['projecttype'] != '') $projecttype = $this->data['Project']['projecttype'];
						else $projecttype = 'проект закона';
						echo $form->input('Project.projecttype', array(
								'label' => 'Tip proiect',
								'options' => array(	'проект закона'=>'проект закона',
													'по запросу'=>'по запросу')));
					?>
				</li>
				<li><?php echo $form->input('Project.expert_id', array('label'=>'Nume expert'));?></li>
				<li><?php echo $form->input('Project.name', array('label'=>'Denumirea proiectului', 'type'=>'textarea', 'style'=>'width: 65%;'));?></li>
				<li class="option2"<?php if ($projecttype != 'по запросу') echo ' style="display:none;"';?>>
					<?php echo $form->input('Project.namesolicitare', array('label'=>'La solicitarea', 'type'=>'textarea', 'style'=>'width: 65%;'));?>
				</li>
				<li>
					<?php

						echo $form->input('Project.projecttypevizat', array(
								'label' => 'Tipul actului vizat de proiect',
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
								'label' => 'Domeniul',
								'options' => array(	'I. Justiţie şi afaceri interne, drepturile şi libertăţile omului'=>'I. Justiţie şi afaceri interne, drepturile şi libertăţile omului',
													'II. Economie şi comerţ'=>'II. Economie şi comerţ',
													'III. Buget şi finanţe'=>'III. Buget şi finanţe',
													'IV. Educaţie, cultură, culte şi mass-media'=>'IV. Educaţie, cultură, culte şi mass-media',
													'V. Legislaţia muncii, asigurarea socială şi ocrotirea sănătăţii'=>'V. Legislaţia muncii, asigurarea socială şi ocrotirea sănătăţii')));
					?>
				</li>
				<li class="option1"<?php if ($projecttype != 'проект закона') echo ' style="display:none;"';?>>
					<?php echo $form->input('Project.projectnumber', array('label'=>'Număr de înregistrare în Parlament'));?>
				</li>
				<br/>
				<li>
					<label class="option1"<?php if ($projecttype != 'проект закона') echo ' style="display:none;"';?>>Data înregistrării în Parlament</label>
					<label class="option2"<?php if ($projecttype != 'по запросу') echo ' style="display:none;"';?>>Data solicitării</label>
					<?php
						echo $form->input('Project.projectdatetext', array('label'=>false, 'readonly'=>'readonly'));
						echo $form->hidden('Project.projectdate');
					?>
				</li>
				<li class="option1"<?php if ($projecttype != 'проект закона') echo ' style="display:none;"';?>>
					<?php
						echo $form->input('Project.initiative', array(
								'label' => 'Iniţiativa legislativă',
								'div' => false,
								'empty' => 'alegeţi',
								'options' => array(	'Правительство'=>'Правительство',
													'депутат'=>'депутат',
													'группа депутатов'=>'группа депутатов',
													'Preşedintele RM'=>'Preşedintele RM',
													'Adunarea Populară a UTA Gagauzia'=>'Adunarea Populară a UTA Gagauzia')));

					?>
				</li>
				<li class="option3"<?php if ($this->data['Project']['initiative'] != 'Правительство' && $projecttype == 'проект закона') echo ' style="display:none;"';?>>
					<?php echo $form->input('Project.author_id', array('label'=>'Autor nemijlocit'));?>
				</li>
				<li><?php echo $form->input('Project.reportnumber', array('label'=>'Număr raport'));?></li>
				<li><label>Necesitatea verificării de către expert a transparenţei decizionale a proiectului</label><?php echo $form->input('Project.reporttrasnparenta', array('label'=>false, 'div'=>false));?></li>
				<br/><br/>
				<li><label>Necesitatea verificării de către expert a respectării termenului de cooperare cu societatea civilă</label><?php echo $form->input('Project.reportrespectaretermen', array('label'=>false, 'div'=>false));?></li>
				<br/><br/><br/>
				<li><label>Necesitatea verificării de către expert a analizei impactului de reglementare a proiectului</label><?php echo $form->input('Project.reportimpact', array('label'=>false, 'div'=>false));?></li>
				<br/><br/>
				<li><?php echo $form->input('Project.numberpages', array('label'=>'Număr de pagini'));?></li>
				<li><?php echo $form->input('Project.numberprojectsstandard', array('label'=>'Număr de proiecte standart'));?></li>
				<li>
					<?php
						echo $form->input('Project.datelimitexperttext', array('label'=>'Data limită pentru expert', 'readonly'=>'readonly'));
						echo $form->hidden('Project.datelimitexpert');
					?>
				</li>
				<li>
					<?php
						echo $form->input('Project.datelimitparlamenttext', array('label'=>'Data limită pentru autoritate', 'readonly'=>'readonly'));
						echo $form->hidden('Project.datelimitparlament');
					?>
				</li>
				<li>
					<?php
						echo $form->label('Project.filename', 'Nume fişier');
						if (isset($this->data['Project']['filename']) && $this->data['Project']['filename'] != '')
							echo $html->link($this->data['Project']['filename'], '/uploaded/projects/'.$this->data['Project']['filename']);
						else echo 'Nu există document pentru acest proiect.';
					?>
				</li>
				<li>
					<?php
						echo $form->input('Project.file', array('type'=>'file', 'label'=>'Alegeţi fişier', 'style'=>'width: 50%;'));
					?>
				</li>
				<li>
					<?php
						$options = array(1=>'salvat', 2=>'trimis către expert', 3=>'acceptat de expert', 4=>'respins de expert');
						//la edit cind e accepat - attr disabled
						echo $form->input('Project.projectreportstate', array(
									'legend' => false,
									'label' => 'proiectul este:',
									'div' => false,
									'type' => 'select',
									'options' => $options));
					?>
				</li>
				<li>
					<?php
						echo $form->input('Project.projectstate', array(
									'legend' => false,
									'label' => 'Statutul proiectului',
									'div' => false,
									'type' => 'select',
									'options' => array(1=>'În curs de examinare', 2=>'Adoptat', 3=>'Retras')));
					?>
				</li>
				<li><label>Raport cu posibilitatea editării de către mai mulţi experţi</label><?php echo $form->input('Project.reportmultipleedit', array('label'=>false, 'div'=>false));?></li>
			</ul>
			<?php echo $this->element('project_sortables_destination');?>
			<br/>
			<div class="Submit" style="padding-left:10%">
				<?php
					echo $form->submit('Salvează');
					echo $form->end();
				?>
			</div>
			<?php echo $this->element('project_sortables_source');?>
	</div>

	<?php
		echo $this->element('backlink', array('backlink'=>'/admin/projects', 'backlinktitle'=>'Назад к списку proiecte'));
		echo $this->element('error_messages');
		echo $this->element('sponsor');
		echo $this->element('project_js');
	?>

</div>