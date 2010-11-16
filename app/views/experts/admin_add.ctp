<?php echo $this->element('top_menu', array('top_menu_title'=>'Administrare utilizatori'));?>

<div id="line">
	<?php echo $this->element('backlink_menu', array('backlink'=>'/admin/experts', 'backlinktitle'=>'Înapoi la lista utilizatori'));?>
</div>

<div id="listcontent">

	<div id="caption" class="red">Adăugare utilizator</div>

	<div id="Form">
		<?php
			echo $form->create('Expert');
			
		?>
			<ul>
				<li><?php echo $form->input('Expert.fullname', array('label'=>'Nume şi prenume', 'size'=>'50'));?></li>
				<li><?php echo $form->input('Expert.username', array('label'=>'Login', 'size'=>'50'));?></li>
				<li><?php echo $form->input('Expert.password', array('label'=>'Parola', 'size'=>'50', 'value'=>''));?></li>
				
				<li style="padding-left:35%"><?php echo $form->input('Expert.isadmin', array('label'=>false, 'div'=>false));?> Utilizatorul este administrator</li>
			</ul>
			<?php echo $this->element('submit_button');?>
	</div>

	<?php
		echo $this->element('backlink', array('backlink'=>'/admin/experts', 'backlinktitle'=>'Înapoi la lista utilizatori'));
		echo $this->element('error_messages');
		echo $this->element('sponsor');
	?>
	
</div>