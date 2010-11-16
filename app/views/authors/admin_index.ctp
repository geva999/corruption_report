<?php echo $this->element('top_menu', array('top_menu_title'=>'Administrare autori nemijlociţi'));?>

<div id="line">
	<?php echo $this->element('admin_menu');?>
</div>

<div id="listcontent">
	
	<div id="caption" class="green">Lista autori nemijlociţi - <?php echo $countauthors;?></div>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="green">
		<tr>
			<th width="5">Nr.</th>
			<th><?php echo $paginator->sort('Autor nemijlocit', 'Author.name', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'sortare după autor nemijlocit'));?></th>
			<th width="50">Editare</th>
			<th width="50">Ştergere</th>
		</tr>
		<?php
		$i = intval($paginator->counter(array('format'=>'%start%')));
		foreach ($authors as $author) {?>
		<tr valign="top">
			<td align="center"><?php echo $i.'.'; $i++;?></td>
			<td><?php echo $author['Author']['name'];?></td>
			<td align="center"><?php echo $this->element('editlink', array('editlink'=>'/admin/authors/edit/'.$author['Author']['id']));?></td>
			<td align="center"><?php echo $this->element('deletelink', array('deletelink'=>'/admin/authors/delete/'.$author['Author']['id'], 'deletelinkquestion'=>'author nemijlocit'));?></td>
		</tr>
		<?php }?>
	</table>
		
	<?php
		echo $this->element('paginator');
		echo $this->element('addlink', array('addlink'=>'/admin/authors/add', 'addtitle'=>' Adaugă autor nemijlocit'));
		echo $this->element('simple_legend');
		echo $this->element('error_messages');
		echo $this->element('sponsor');
	?>
	
</div>