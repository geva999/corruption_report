<?php echo $this->element('top_menu', array('top_menu_title'=>'Administrare autori nemijlociţi'));?>

<div id="line">
	<?php echo $this->element('backlink_menu', array('backlink'=>'/admin/authors', 'backlinktitle'=>'Înapoi la lista autori nemijlociţi'));?>
</div>

<div id="listcontent">

	<div id="caption" class="red">Adăugare autor nemijlocit</div>

	<div id="Form">
		<?php
			echo $form->create('Author');
			
		?>
			<ul>
				<li><?php echo $form->input('Author.name', array('label'=>'Denumire', 'size'=>'70'));?></li>
			</ul>
			<?php echo $this->element('submit_button');?>
	</div>

	<?php
		echo $this->element('backlink', array('backlink'=>'/admin/authors', 'backlinktitle'=>'Înapoi la lista autori nemijlociţi'));
		echo $this->element('error_messages');
		echo $this->element('sponsor');
	?>
	
</div>