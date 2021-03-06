<?php echo $this->element('top_menu', array('top_menu_title'=>'Администрирование элементов коррупциогенности'));?>

<div id="line">
	<?php echo $this->element('admin_menu');?>
</div>

<div id="listcontent">

	<div id="caption" class="green">Список элементов коррупциогенности- <?php echo $countcelems;?></div>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="green">
	<tr>
		<th width="5"><?php echo $paginator->sort('№', 'Celem.number', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'сортировка согласно Номеру'));?></th>
		<th width="200"><?php echo $paginator->sort('Имя', 'Celem.name', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'сортировка согласно Имени'));?></th>
		<th width="200"><?php echo $paginator->sort('Группа', 'Celem.celemgroup', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'сортировка согласно Группе'));?></th>
		<th><?php echo $paginator->sort('Описание', 'Celem.description', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'сортировка согласно Описанию'));?></th>
		<th width="60">Редактирование</th>
		<th width="60">Удаление</th>
	</tr>
	<?php	
		foreach ($celems as $celem) {?>
		<tr valign="top">
			<td align="center"><?php echo $celem['Celem']['number'];?></td>
			<td><?php echo $celem['Celem']['name'];?></td>
			<td><?php echo $celem['Celem']['celemgroup'];?></td>
			<td><?php echo nl2br($celem['Celem']['description']);?></td>
			<td align="center"><?php echo $this->element('editlink', array('editlink'=>'/admin/celems/edit/'.$celem['Celem']['id']));?></td>
			<td align="center"><?php echo $this->element('deletelink', array('deletelink'=>'/admin/celems/delete/'.$celem['Celem']['id'], 'deletelinkquestion'=>'элемент коррупциогенности'));?></td>
		</tr>
	<?php }?>
	</table>
	
	<?php
		echo $this->element('paginator');
		echo $this->element('addlink', array('addlink'=>'/admin/celems/add', 'addtitle'=>' Добавить элемент коррупциогенности'));
		echo $this->element('simple_legend');
		echo $this->element('error_messages');
		echo $this->element('sponsor');
	?>
	
</div>