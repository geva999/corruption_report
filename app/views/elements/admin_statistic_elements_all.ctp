<table border="1" cellpadding="0" cellspacing="0" align="center" width="100%" class="statistic_table">
	<!-- Список областей -->
	<tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
		<td rowspan="3">Категории элементов</td>
		<?php foreach ($domains as $domainvalue) echo '<td width="148" colspan="4">Область: '.$domainvalue.'</td>';?>
		<td width="148" colspan="4">Итого</td>
		<td width="74" rowspan="2" colspan="2">Уровень распространения элемента в категории в которую он включен</td>
	</tr>
	<tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
		<?php
			for ($i = 1; $i <= 6; $i++) {
				echo '<td colspan="2">распространение</td><td colspan="2">частота</td>';
			}
		?>
	</tr>
	<tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
		<?php
			for ($i = 1; $i <= 13; $i++) {
				echo '<td>№</td><td>%</td>';
			}
		?>
	</tr>
	<?php
		//элементы
		foreach ($elemgroups as $elemgroupkey => $elemgroupvalue) {

			//отображение группы
			$bgcolor = '#BBBBBB';
			echo '<tr align="center"  class="statistic_table_head" bgcolor="'.$bgcolor.'"><td align="left">'.$elemgroupvalue.'</td>';
			$total_group_elems = 0;
			$total_group_fenomen = 0;
			foreach ($domains as $domain) {
				if (isset($statistic[$domain][$elemgroupvalue]['total_celem_bygroup'])) {
					echo '<td>'.$statistic[$domain][$elemgroupvalue]['total_celem_bygroup'].'</td><td>'
						.number_format($statistic[$domain][$elemgroupvalue]['total_celem_bygroup']/$statistic[$domain]['total_celems_bydomain']*100, 2).'%</td>';
					$total_group_elems = $total_group_elems + $statistic[$domain][$elemgroupvalue]['total_celem_bygroup'];
				}
				else echo '<td>0</td><td>0%</td>';
				if (isset($statistic[$domain][$elemgroupvalue]['total_celem_fenomen_bygroup'])) {
					echo '<td>'.$statistic[$domain][$elemgroupvalue]['total_celem_fenomen_bygroup'].'</td><td>'
						.number_format($statistic[$domain][$elemgroupvalue]['total_celem_fenomen_bygroup']/$statistic[$domain]['total_celems_fenomen_bydomain']*100, 2).'%</td>';
					$total_group_fenomen = $total_group_fenomen + $statistic[$domain][$elemgroupvalue]['total_celem_fenomen_bygroup'];
				}
				else echo '<td>0</td><td>0%</td>';
			}
			echo '<td>'.$total_group_elems.'</td><td>'
				.number_format($total_group_elems/$statistic['total_celems']*100, 2).'%</td>';
			echo '<td>'.$total_group_fenomen.'</td><td>'
				.number_format($total_group_fenomen/$statistic['total_celems_fenomen']*100, 2).'%</td>';
			echo '<td>'.$total_group_elems.'</td><td>100%</td>';
			echo '</tr>';

			//отображение элементов из группы
			foreach ($elems as $elemkey => $elemvalue) {
				$bgcolor = '#DDDDDD';
				if ($elemgroupvalue == $elemvalue['celemgroup']) {
					echo '<tr align="center"><td align="left">'.$elemvalue['celem'].'</td>';
					$total_elems = 0;
					$total_fenomen = 0;
					foreach ($domains as $domain) {
						if (isset($statistic[$domain]['celems'][$elemkey]['total'])) {
							echo '<td bgcolor="'.$bgcolor.'">'.$statistic[$domain]['celems'][$elemkey]['total'].'</td><td>'
								.number_format($statistic[$domain]['celems'][$elemkey]['total']/$statistic[$domain]['total_celems_bydomain']*100, 2).'%</td>';
							$total_elems = $total_elems + $statistic[$domain]['celems'][$elemkey]['total'];
						}
						else echo '<td bgcolor="'.$bgcolor.'">0</td><td>0%</td>';
						if (isset($statistic[$domain]['celems'][$elemkey]['fenomen'])) {
							echo '<td bgcolor="'.$bgcolor.'">'.$statistic[$domain]['celems'][$elemkey]['fenomen'].'</td><td>'
								.number_format($statistic[$domain]['celems'][$elemkey]['fenomen']/$statistic['total_reports']*100, 2).'%</td>';
							$total_fenomen = $total_fenomen + $statistic[$domain]['celems'][$elemkey]['fenomen'];
						}
						else echo '<td bgcolor="'.$bgcolor.'">0</td><td>0%</td>';
					}
					$bgcolor = '#BBBBBB';
					echo '<td class="statistic_table_head" bgcolor="'.$bgcolor.'">'.$total_elems.'</td><td class="statistic_table_head">'
						.number_format($total_elems/$statistic['total_celems']*100, 2).'%</td>';
					echo '<td class="statistic_table_head" bgcolor="'.$bgcolor.'">'.$total_fenomen.'</td><td class="statistic_table_head">'
						.number_format($total_fenomen/$statistic['total_reports']*100, 2).'%</td>';
					echo '<td class="statistic_table_head" bgcolor="'.$bgcolor.'">'.$total_elems.'</td><td class="statistic_table_head">'
						.number_format($total_elems/$total_group_elems*100, 2).'%</td>';
					echo '</tr>';
				}
			}
		}
		//другие элементы
		$total_other_elements = 0;
		$total_other_elements_fenomen = 0;
		echo '<tr align="center" bgcolor="'.$bgcolor.'"><td align="left" class="statistic_table_head">Другие элементы коррупциогенности</td>';
		foreach ($domains as $domain) {
			if (isset($statistic[$domain]['total_other_elements_bydomain'])) {
				echo '<td>'.$statistic[$domain]['total_other_elements_bydomain'].'</td><td>'
					.number_format($statistic[$domain]['total_other_elements_bydomain']/$statistic[$domain]['total_celems_bydomain']*100, 2).'%</td>';
				$total_other_elements = $total_other_elements + $statistic[$domain]['total_other_elements_bydomain'];
			}
			else echo '<td>0</td><td>0%</td>';
			if (isset($statistic[$domain]['total_other_elements_fenomen_bydomain'])) {
				echo '<td>'.$statistic[$domain]['total_other_elements_fenomen_bydomain'].'</td><td>'
					.number_format($statistic[$domain]['total_other_elements_fenomen_bydomain']/$statistic[$domain]['total_celems_fenomen_bydomain']*100, 2).'%</td>';
				$total_other_elements_fenomen = $total_other_elements_fenomen + $statistic[$domain]['total_other_elements_fenomen_bydomain'];
			}
			else echo '<td>0</td><td>0%</td>';
		}
		echo '<td class="statistic_table_head">'.$total_other_elements.'</td><td class="statistic_table_head">'
			.number_format($total_other_elements/$statistic['total_celems']*100, 2).'%</td>';
		echo '<td class="statistic_table_head">'.$total_other_elements_fenomen.'</td><td class="statistic_table_head">'
			.number_format($total_other_elements_fenomen/$statistic['total_celems_fenomen']*100, 2).'%</td>';
		echo '<td class="statistic_table_head">'.$total_other_elements.'</td><td class="statistic_table_head">100%</td>';
		echo '</tr>';

		//всего элементов
		$bgcolor = '#BBBBBB';
		echo '<tr align="center" class="statistic_table_td"'.(isset($bgcolor)?' bgcolor="'.$bgcolor.'"':'').'><td align="left">Итого элементов согласно областям</td>';
		foreach ($domains as $domain) {
			if (isset($statistic[$domain]['total_celems_bydomain']))
				echo '<td width="37">'.$statistic[$domain]['total_celems_bydomain'].'</td><td>'
					.number_format($statistic[$domain]['total_celems_bydomain']/$statistic['total_celems']*100, 2).'%</td>';
			else echo '<td width="37">0</td><td>0%</td>';
			if (isset($statistic[$domain]['total_celems_fenomen_bydomain']))
				echo '<td width="37">'.$statistic[$domain]['total_celems_fenomen_bydomain'].'</td><td>'
					.number_format($statistic[$domain]['total_celems_fenomen_bydomain']/$statistic['total_celems_fenomen']*100, 2).'%</td>';
			else echo '<td width="37">0</td><td>0%</td>';
		}
		echo '<td width="37">'.$statistic['total_celems'].'</td><td>100%</td>';
		echo '<td width="37">'.$statistic['total_celems_fenomen'].'</td><td>100%</td>';
		echo '<td width="37">'.$statistic['total_celems'].'</td><td>100%</td>';
		echo '</tr>';
	?>
</table>