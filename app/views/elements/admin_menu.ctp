<div id="menulink">
	<table border="0" cellpadding="5" cellspacing="0">
		<tr height="50">
			<td>
				<?php echo $ajax->link('Proiecte', '/admin/projects', array('update'=>'content', 'indicator' => 'spinner'), null, false);?>
			</td>
			<td>
				<?php echo $ajax->link('Rapoarte', '/admin/reports', array('update'=>'content', 'indicator' => 'spinner'), null, false);?>
			</td>
			<td>
				<?php echo $ajax->link('Statistica', '/admin/reports/statistic', array('update'=>'content', 'indicator' => 'spinner'), null, false);?>
			</td>
			<td>
				<?php echo $ajax->link('Utilizatori', '/admin/experts', array('update'=>'content', 'indicator' => 'spinner'), null, false);?>
			</td>
			<td>
				<?php echo $ajax->link('Elemente de coruptibilitate', '/admin/celems', array('update'=>'content', 'indicator' => 'spinner'), null, false);?>
			</td>
			<td>
				<?php echo $ajax->link('Autori nemijlociţi', '/admin/authors', array('update'=>'content', 'indicator' => 'spinner'), null, false);?>
			</td>
			<td>
				<?php echo $ajax->link('Finanţatori', '/admin/templates', array('update'=>'content', 'indicator' => 'spinner'), null, false);?>
			</td>
		</tr>
	</table>
</div>