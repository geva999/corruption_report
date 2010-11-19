<div id="menulink">
	<table border="0" cellpadding="5" cellspacing="0">
		<tr height="50">
			<td>
				<?php echo $ajax->link('Проекты', '/projects', array('update'=>'content', 'indicator' => 'spinner'), null, false);?>
			</td>
			<td>
				<?php echo $ajax->link('Заключения', '/reports', array('update'=>'content', 'indicator' => 'spinner'), null, false);?>
			</td>
		</tr>
	</table>
</div>