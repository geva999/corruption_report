<?php $criteriashorizontal = array('проект закона', 'по запросу');?>
<table border="1" cellpadding="0" cellspacing="0" align="center" class="statistic_table">
	<tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
		<td rowspan="2">Autori nemijlociţi</td>
		<?php
			foreach ($criteriashorizontal as $criteriavalue) {
				echo '<td width="150" colspan="2">'.$criteriavalue.'</td>';
			}
		?>
		<td colspan="2">Total</td>
	</tr>
	<tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
		<td>nr. proiecte</td><td>%</td><td>nr. proiecte</td><td>%</td>
		<td>nr. proiecte</td><td>%</td>
	</tr>

	<?php
		foreach ($authors as $authorkey => $authorvalue) {
			echo '<tr align="center"><td align="left" width="200">'.$authorvalue.'</td>';
			foreach ($criteriashorizontal as $criteriashorizontalvalue) {
				if (isset($statistic[$criteriashorizontalvalue]['Authors'][$authorkey]['projects']))
					echo '<td>'.$statistic[$criteriashorizontalvalue]['Authors'][$authorkey]['projects'].'</td><td>'.
						number_format($statistic[$criteriashorizontalvalue]['Authors'][$authorkey]['projects']/$statistic['Authors'][$authorkey]['total']*100, 2).'%</td>';
				else echo '<td>0</td><td>0%</td>';
			}
			if (isset($statistic['Authors'][$authorkey]['total']))
				echo '<td>'.$statistic['Authors'][$authorkey]['total'].'</td><td>'.
					number_format($statistic['Authors'][$authorkey]['total']/$statistic['Authors']['total']*100, 2).'%</td>';
			else echo '<td>0</td><td>0%</td>';
		}
	?>
	<tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
		<td align="left">Total</td>
		<?php
			foreach ($criteriashorizontal as $criteriashorizontalvalue) {
				if (isset($statistic[$criteriashorizontalvalue]['Authors']['total']))
					echo '<td>'.$statistic[$criteriashorizontalvalue]['Authors']['total'].'</td><td>'.
						number_format($statistic[$criteriashorizontalvalue]['Authors']['total']/$statistic['Authors']['total']*100, 2).'%</td>';
				else echo '<td>0</td><td>0%</td>';
			}
			if (isset($statistic['Authors']['total']))
				echo '<td>'.$statistic['Authors']['total'].'</td><td>100%</td>';
			else echo '<td>0</td><td>0%</td>';
		?>
	</tr>
</table>