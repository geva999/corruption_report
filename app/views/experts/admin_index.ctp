<?php echo $this->element('top_menu', array('top_menu_title'=>'Администрирование пользователей'));?>

<div id="line">
	<?php echo $this->element('admin_menu');?>
</div>

<div id="listcontent">
	
	<div id="caption" class="green">Список пользователей - <?php echo $countexperts;?></div>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="green">
		<tr>
			<th width="5">№</th>
			<th><?php echo $paginator->sort('Фамилия и имя пользователя', 'Expert.fullname', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'сортировка по Фамилии и имени'));?></th>
			<th width="180"><?php echo $paginator->sort('Login', 'Expert.username', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'сортировка по Логину'));?></th>
			<th width="100"><?php echo $paginator->sort('Является администратором', 'Expert.isadmin', array('update' => 'content', 'indicator' => 'spinner'));?></th>
			<th width="50">Редактирование</th>
			<th width="50">Удаление</th>
		</tr>
		<?php
		$i = intval($paginator->counter(array('format'=>'%start%')));
		foreach ($experts as $expert) {?>
		<tr valign="top">
			<td align="center"><?php echo $i.'.'; $i++;?></td>
			<td><?php echo $expert['Expert']['fullname'];?></td>
			<td><?php echo $expert['Expert']['username'];?></td>
			<td align="center"><?php if ($expert['Expert']['isadmin'] == 1) {echo 'Da';} else {echo 'Nu';};?></td>
			<td align="center"><?php echo $this->element('editlink', array('editlink'=>'/admin/experts/edit/'.$expert['Expert']['id']));?></td>
			<td align="center"><?php echo $this->element('deletelink', array('deletelink'=>'/admin/experts/delete/'.$expert['Expert']['id'], 'deletelinkquestion'=>'expert'));?></td>
		</tr>
		<?php }?>
	</table>
		
	<?php
		echo $this->element('paginator');
		echo $this->element('addlink', array('addlink'=>'/admin/experts/add', 'addtitle'=>' Добавить пользователя'));
		echo $this->element('simple_legend');
		echo $this->element('error_messages');
		echo $this->element('sponsor');
	?>
	
</div>