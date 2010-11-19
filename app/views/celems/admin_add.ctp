<?php echo $this->element('top_menu', array('top_menu_title'=>'Администрирование элементов коррупциогенности'));?>

<div id="line">
	<?php echo $this->element('backlink_menu', array('backlink'=>'/admin/celems', 'backlinktitle'=>'Назад к списку элементов коррупциогенности'));?>
</div>

<div id="listcontent">
	
	<div id="caption" class="red">Добавление элемента коррупциогенности</div>
	
	<div id="Form">
		<?php
			echo $form->create('Celem');
			
		?>
			<ul>
				<li><?php echo $form->input('Celem.number', array('label'=>'№', 'size'=>4));?></li>
				<li><?php echo $form->input('Celem.name', array('label'=>'Имя', 'size'=>85));?></li>
				<li>
					<?php
						//echo $form->input('Celem.celemgroup', array('label'=>'Grup', 'size'=>85));
						echo $form->input('Celem.celemgroup', array(
								'label' => 'Grup: ',
								'options' => array(	'I. Взаимодействие законопроекта с другими законодательными или нормативными актами'=>'I. Взаимодействие законопроекта с другими законодательными или нормативными актами',
													'II. Порядок реализации полномочий органов публичной власти'=>'II. Порядок реализации полномочий органов публичной власти',
													'III. Порядок реализации прав и обязанностей'=>'III. Порядок реализации прав и обязанностей',
													'IV. Прозрачность и доступ к информации'=>'IV. Прозрачность и доступ к информации',
													'V. Ответственность'=>'V. Ответственность',
													'VI. Механизмы контроля'=>'VI. Механизмы контроля',
													'VII. Лингвистические формулировки'=>'VII. Лингвистические формулировки')
								));
					?>
				</li>
				<li><?php echo $form->input('Celem.description', array('label'=>'Описание', 'type'=>'textarea', 'style'=>'width: 65%;'));?></li>
			</ul>
			<?php echo $this->element('submit_button');?>
	</div>
	
	<?php
		echo $this->element('backlink', array('backlink'=>'/admin/celems', 'backlinktitle'=>'Назад к списку элементов коррупциогенности'));
		echo $this->element('error_messages');
		echo $this->element('sponsor');
	?>
	
</div>