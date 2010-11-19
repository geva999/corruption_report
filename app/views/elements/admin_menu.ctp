<div id="menulink">
	<table border="0" cellpadding="5" cellspacing="0">
		<tr height="50">
			<td>
				<?php echo $ajax->link('Проекты', '/admin/projects', array('update'=>'content', 'indicator' => 'spinner'), null, false);?>
			</td>
			<td>
				<?php echo $ajax->link('Заключения', '/admin/reports', array('update'=>'content', 'indicator' => 'spinner'), null, false);?>
			</td>
			<td>
				<?php echo $ajax->link('Статистика'/admin/reports/statistic', array('update'=>'content', 'indicator' => 'spinner'), null, false);?>
			</td>
			<td>
				<?php echo $ajax->link('Пользователи', '/admin/experts', array('update'=>'content', 'indicator' => 'spinner'), null, false);?>
			</td>
			<td>
				<?php echo $ajax->link('Элементы коррупциогенности', '/admin/celems', array('update'=>'content', 'indicator' => 'spinner'), null, false);?>
			</td>
			<td>
				<?php echo $ajax->link('Непосредственные авторы', '/admin/authors', array('update'=>'content', 'indicator' => 'spinner'), null, false);?>
			</td>
			<td>
				<?php echo $ajax->link('Доноры', '/admin/templates', array('update'=>'content', 'indicator' => 'spinner'), null, false);?>
			</td>
		</tr>
	</table>
</div>