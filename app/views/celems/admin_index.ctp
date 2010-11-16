<?php echo $this->element('top_menu', array('top_menu_title'=>'Administrare elemente de coruptibilitate'));?>

<div id="line">
	<?php echo $this->element('admin_menu');?>
</div>

<div id="listcontent">

	<div id="caption" class="green">Lista elemente de coruptibilitate - <?php echo $countcelems;?></div>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="green">
	<tr>
		<th width="5"><?php echo $paginator->sort('Nr.', 'Celem.number', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'sortare după Număr'));?></th>
		<th width="200"><?php echo $paginator->sort('Nume', 'Celem.name', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'sortare după Nume'));?></th>
		<th width="200"><?php echo $paginator->sort('Grup', 'Celem.celemgroup', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'sortare după Grup'));?></th>
		<th><?php echo $paginator->sort('Descriere', 'Celem.description', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'sortare după Descriere'));?></th>
		<th width="60">Editare</th>
		<th width="60">Ştergere</th>
	</tr>
	<?php	
		foreach ($celems as $celem) {?>
		<tr valign="top">
			<td align="center"><?php echo $celem['Celem']['number'];?></td>
			<td><?php echo $celem['Celem']['name'];?></td>
			<td><?php echo $celem['Celem']['celemgroup'];?></td>
			<td><?php echo nl2br($celem['Celem']['description']);?></td>
			<td align="center"><?php echo $this->element('editlink', array('editlink'=>'/admin/celems/edit/'.$celem['Celem']['id']));?></td>
			<td align="center"><?php echo $this->element('deletelink', array('deletelink'=>'/admin/celems/delete/'.$celem['Celem']['id'], 'deletelinkquestion'=>'element de coruptibilitate'));?></td>
		</tr>
	<?php }?>
	</table>
	
	<?php
		echo $this->element('paginator');
		echo $this->element('addlink', array('addlink'=>'/admin/celems/add', 'addtitle'=>' Adaugă element de coruptibilitate'));
		echo $this->element('simple_legend');
		echo $this->element('error_messages');
		echo $this->element('sponsor');
	?>
	
</div>
