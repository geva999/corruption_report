<?php $criteriashorizontal = $this->domains;?>
<table border="1" cellpadding="0" cellspacing="0" align="center" class="statistic_table">
	<tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
		<td rowspan="2">Вид акта</td>
		<?php
			foreach ($criteriashorizontal as $criteriavalue) {
				echo '<td width="150" colspan="2">'.$criteriavalue.'</td>';
			}
		?>
		<td colspan="2">Итого</td>
	</tr>
	<tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
		<td>число проектов</td><td>%</td>
		<td>число проектов</td><td>%</td>
		<td>число проектов</td><td>%</td>
		<td>число проектов</td><td>%</td>
		<td>число проектов</td><td>%</td>
		<td>число проектов</td><td>%</td>
	</tr>

	<?php
		$criteriasvertical = array(
			'Правительство'=>'Правительство',
			'депутат'=>'депутат',
			'группа депутатов'=>'группа депутатов',
			'Президент'=>'Президент');
		foreach ($criteriasvertical as $criteriasverticalvalue) {
			echo '<tr align="center"><td align="left" width="150">'.$criteriasverticalvalue.'</td>';
			foreach ($criteriashorizontal as $criteriashorizontalvalue) {
				if (isset($statistic['bydomain'][$criteriashorizontalvalue][$criteriasverticalvalue]['total']))
					echo '<td>'.$statistic['bydomain'][$criteriashorizontalvalue][$criteriasverticalvalue]['total'].'</td><td>'.
						number_format($statistic['bydomain'][$criteriashorizontalvalue][$criteriasverticalvalue]['total']/$statistic['bydomain'][$criteriasverticalvalue]['total']*100, 2).'%</td>';
				else echo '<td>0</td><td>0%</td>';
			}
			if (isset($statistic['bydomain'][$criteriasverticalvalue]['total']))
				echo '<td>'.$statistic['bydomain'][$criteriasverticalvalue]['total'].'</td><td>'.
					number_format($statistic['bydomain'][$criteriasverticalvalue]['total']/$statistic['total']*100, 2).'%</td>';
			else echo '<td>0</td><td>0%</td>';
		}
	?>
	<tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
		<td align="left">Итого</td>
		<?php
			foreach ($criteriashorizontal as $criteriashorizontalvalue) {
				if (isset($statistic['bydomain'][$criteriashorizontalvalue]['total']))
					echo '<td>'.$statistic['bydomain'][$criteriashorizontalvalue]['total'].'</td><td>'.
						number_format($statistic['bydomain'][$criteriashorizontalvalue]['total']/$statistic['total']*100, 2).'%</td>';
				else echo '<td>0</td><td>0%</td>';
			}
			if (isset($statistic['total']))
				echo '<td>'.$statistic['total'].'</td><td>100%</td>';
			else echo '<td>0</td><td>0%</td>';
		?>
	</tr>
</table>