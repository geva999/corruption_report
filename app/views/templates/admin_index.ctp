<?php echo $this->element('top_menu', array('top_menu_title'=>'Администрирование доноров'));?>

<div id="line">
	<?php echo $this->element('admin_menu');?>
</div>

<div id="listcontent">

	<div id="caption" class="green">Список доноров - <?php echo $counttemplates;?></div>

	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="green">
	<tr>
		<th width="5">№</th>
		<th><?php echo $paginator->sort('Имя', 'Template.name', array('title' => 'сортировка по Имени'));?></th>
		<th><?php echo $paginator->sort('Дата', 'Template.date', array('title' => 'сортировка по Дате'));?></th>
		<th width="60">Редактирование</th>
		<th width="60">Удаление</th>
	</tr>
	<?php
		$i = intval($paginator->counter(array('format'=>'%start%')));
		foreach ($templates as $template) {?>
		<tr valign="top">
			<td align="center"><?php echo $i.'.'; $i++;?></td>
			<td><?php echo $template['Template']['name'];?></td>
			<td><?php echo date('d-m-Y', strtotime($template['Template']['date']));?></td>
			<td align="center"><?php echo $this->element('editlink', array('editlink'=>'/admin/templates/edit/'.$template['Template']['id']));?></td>
			<td align="center"><?php echo $this->element('deletelink', array('deletelink'=>'/admin/templates/delete/'.$template['Template']['id'], 'deletelinkquestion'=>'донора'));?></td>
		</tr>
	<?php }?>
	</table>

	<?php
		echo $this->element('paginator');
		echo $this->element('addlink', array('addlink'=>'/admin/templates/add', 'addtitle'=>' Добавить донора'));
		echo $this->element('simple_legend');
		echo $this->element('error_messages');
		echo $this->element('sponsor');
	?>
</div>
