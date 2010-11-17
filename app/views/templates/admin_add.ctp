<?php echo $this->element('top_menu', array('top_menu_title'=>'Administrare finanţatori'));?>

<div id="line">
	<?php echo $this->element('backlink_menu', array('backlink'=>'/admin/templates', 'backlinktitle'=>'Назад к списку finanţatori'));?>
</div>

<div id="listcontent">
	
	<div id="caption" class="red">Adăugare finanţator</div>
	
	<div id="Form">
		<?php
			echo $form->create('Template');
		
		?>
			<ul>
				<li><?php echo $form->input('Template.name', array('label'=>'Denumirea', 'size'=>'70'));?></li>
				<li>
					<?php
						echo $form->input('Template.datetext', array('label'=>'Valabil din:', 'readonly'=>'readonly'));
						echo $form->hidden('Template.date');
					?>
				</li>
				<br/>
				<li><?php echo $form->input('Template.header', array('label'=>'Header pentru pagină', 'type'=>'textarea', 'class'=>'tinymceeditor'));?></li>
				<li><?php echo $form->input('Template.footer', array('label'=>'Footer pentru pagină', 'type'=>'textarea', 'class'=>'tinymceeditor'));?></li>
				<br/><br/>
				<li><?php echo $form->input('Template.headerpdf', array('label'=>'Header pentru PDF', 'type'=>'textarea', 'class'=>'tinymceeditor'));?></li>
				<div class="red" style="padding-left:12%">
					Pentru documentul PDF lăţimea tabelelor se dă numai în pixeli, lăţimea dată în % nu se afişează corect.<br/>
					Lăţimea documentului PDF în format A4 este de 490 pixeli.
				</div>
				<br/>
				<li><?php echo $form->input('Template.footerpdf', array('label'=>'Footer pentru PDF', 'type'=>'textarea', 'class'=>'tinymceeditor'));?></li>
			</ul>
			<?php echo $this->element('submit_button');?>
	</div>
	
	<?php
		echo $this->element('backlink', array('backlink'=>'/admin/templates', 'backlinktitle'=>'Назад к списку finanţatori'));
		echo $this->element('error_messages');
		echo $this->element('sponsor');
		echo $this->element('template_js');
	?>
	
</div>