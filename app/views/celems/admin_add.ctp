<?php echo $this->element('top_menu', array('top_menu_title'=>'Administrare elemente de coruptibilitate'));?>

<div id="line">
	<?php echo $this->element('backlink_menu', array('backlink'=>'/admin/celems', 'backlinktitle'=>'Înapoi la lista elemente de coruptibilitate'));?>
</div>

<div id="listcontent">
	
	<div id="caption" class="red">Adăugare element de coruptibilitate</div>
	
	<div id="Form">
		<?php
			echo $form->create('Celem');
			
		?>
			<ul>
				<li><?php echo $form->input('Celem.number', array('label'=>'Nr.', 'size'=>4));?></li>
				<li><?php echo $form->input('Celem.name', array('label'=>'Nume', 'size'=>85));?></li>
				<li>
					<?php
						//echo $form->input('Celem.celemgroup', array('label'=>'Grup', 'size'=>85));
						echo $form->input('Celem.celemgroup', array(
								'label' => 'Grup: ',
								'options' => array(	'I. Impactul şi interacţiunea proiectului cu alte acte legislative şi normative'=>'I. Impactul şi interacţiunea proiectului cu alte acte legislative şi normative',
													'II. Modul de exercitare a atribuţiilor autorităţilor publice'=>'II. Modul de exercitare a atribuţiilor autorităţilor publice',
													'III. Modul de exercitare a drepturilor şi obligaţiilor'=>'III. Modul de exercitare a drepturilor şi obligaţiilor',
													'IV. Transparenţa şi accesul la informaţie'=>'IV. Transparenţa şi accesul la informaţie',
													'V. Răspundere şi responsabilitate'=>'V. Răspundere şi responsabilitate',
													'VI. Mecanisme de control'=>'VI. Mecanisme de control',
													'VII. Formularea lingvistică'=>'VII. Formularea lingvistică')
								));
					?>
				</li>
				<li><?php echo $form->input('Celem.description', array('label'=>'Descriere', 'type'=>'textarea', 'style'=>'width: 65%;'));?></li>
			</ul>
			<?php echo $this->element('submit_button');?>
	</div>
	
	<?php
		echo $this->element('backlink', array('backlink'=>'/admin/celems', 'backlinktitle'=>'Înapoi la lista elemente de coruptibilitate'));
		echo $this->element('error_messages');
		echo $this->element('sponsor');
	?>
	
</div>
