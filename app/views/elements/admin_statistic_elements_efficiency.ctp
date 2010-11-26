<table border="1" cellpadding="0" cellspacing="0" align="center" width="100%" class="statistic_table">
	<!-- Список областей -->
	<tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
		<td width="300">Категории элементов</td>
		<?php foreach ($this->domains as $domainvalue) echo '<td width="110" colspan="3">Domeniul '.$domainvalue.'</td>';?>
		<td width="110" colspan="3">Итого<br/>Принятые замечания согласно категориям элементов и конкретных элементов</td>
	</tr>
	<?php
		$domains = $this->domains;
		//элементы
		foreach ($elemgroups as $elemgroupkey => $elemgroupvalue) {

			//отображение группы
			$bgcolor = '#BBBBBB';
			echo '<tr align="center"  class="statistic_table_head" bgcolor="'.$bgcolor.'"><td align="left">'.$elemgroupvalue.'</td>';
			$total_group_celems = 0;
			$total_group_pelems = 0;
			foreach ($domains as $domain) {
				if (isset($statistic[$domain][$elemgroupvalue]['total_celem_bygroup'])) {
					echo '<td>';
						if (isset($statistic[$domain][$elemgroupvalue]['total_pelem_bygroup'])) echo $statistic[$domain][$elemgroupvalue]['total_pelem_bygroup'];
						else echo '0';
					echo '</td>';
					echo '<td>'.$statistic[$domain][$elemgroupvalue]['total_celem_bygroup'].'</td>';
					echo '<td>'.number_format($statistic[$domain][$elemgroupvalue]['total_pelem_bygroup']/$statistic[$domain][$elemgroupvalue]['total_celem_bygroup']*100, 2).'%</td>';
					$total_group_celems = $total_group_celems + $statistic[$domain][$elemgroupvalue]['total_celem_bygroup'];
					$total_group_pelems = $total_group_pelems + $statistic[$domain][$elemgroupvalue]['total_pelem_bygroup'];
				}
				else echo '<td>0</td><td>0</td><td>0%</td>';
			}
			echo '<td>'.$total_group_pelems.'</td>';
			echo '<td>'.$total_group_celems.'</td>';
			echo '<td>'.number_format($total_group_pelems/$total_group_celems*100, 2).'%</td>';

			//отображение элементов из группы
			foreach ($elems as $elemkey => $elemvalue) {
				$bgcolor = '#DDDDDD';
				if ($elemgroupvalue == $elemvalue['celemgroup']) {
					echo '<tr align="center"><td align="left">'.$elemvalue['celem'].'</td>';
					$total_celems = 0;
					$total_pelems = 0;
					foreach ($domains as $domain) {
						if (isset($statistic[$domain]['celems'][$elemkey]['total'])) {
							echo '<td bgcolor="'.$bgcolor.'">';
								if (isset($statistic[$domain]['pelems'][$elemkey]['total'])) echo $statistic[$domain]['pelems'][$elemkey]['total'];
								else echo '0';
							echo '</td>';
							echo '<td bgcolor="'.$bgcolor.'">'.$statistic[$domain]['celems'][$elemkey]['total'].'</td>';
							echo '<td bgcolor="'.$bgcolor.'">'.number_format($statistic[$domain]['pelems'][$elemkey]['total']/$statistic[$domain]['celems'][$elemkey]['total']*100, 2).'%</td>';
							$total_celems = $total_celems + $statistic[$domain]['celems'][$elemkey]['total'];
							$total_pelems = $total_pelems + $statistic[$domain]['pelems'][$elemkey]['total'];
						}
						else echo '<td bgcolor="'.$bgcolor.'">0</td><td bgcolor="'.$bgcolor.'">0</td><td bgcolor="'.$bgcolor.'">0%</td>';
					}
					$bgcolor = '#BBBBBB';
					echo '<td class="statistic_table_head" bgcolor="'.$bgcolor.'">'.$total_pelems.'</td>';
					echo '<td class="statistic_table_head" bgcolor="'.$bgcolor.'">'.$total_celems.'</td>';
					echo '<td class="statistic_table_head" bgcolor="'.$bgcolor.'">'.number_format($total_pelems/$total_celems*100, 2).'%</td>';
					echo '</tr>';
				}
			}
		}
		//другие элементы
		$total_other_elements = 0;
		$total_other_pelements = 0;
		echo '<tr align="center" bgcolor="'.$bgcolor.'"><td align="left" class="statistic_table_head">Другие элементы коррупциогенности</td>';
		foreach ($domains as $domain) {
			if (isset($statistic[$domain]['total_other_elements_bydomain'])) {
				echo '<td>';
					if (isset($statistic[$domain]['total_other_pelements_bydomain'])) echo $statistic[$domain]['total_other_pelements_bydomain'];
					else echo '0';
				echo '</td>';
				echo '<td>'.$statistic[$domain]['total_other_elements_bydomain'].'</td>';
				echo '<td>'.number_format($statistic[$domain]['total_other_pelements_bydomain']/$statistic[$domain]['total_other_elements_bydomain']*100, 2).'%</td>';
				$total_other_elements = $total_other_elements +$statistic[$domain]['total_other_elements_bydomain'];
				$total_other_pelements = $total_other_pelements +$statistic[$domain]['total_other_pelements_bydomain'];
			}
			else echo '<td>0</td><td>0</td><td>0%</td>';
		}
		echo '<td>'.$total_other_pelements.'</td><td>'.$total_other_elements.'</td><td class="statistic_table_head">'.number_format($total_other_pelements/$total_other_elements*100, 2).'%</td>';
		echo '</tr>';

		//всего элементов
		$bgcolor = '#BBBBBB';
		echo '<tr align="center" class="statistic_table_td"'.(isset($bgcolor)?' bgcolor="'.$bgcolor.'"':'').'><td align="left">Итого принятых замечаний согласно областям</td>';
		foreach ($domains as $domain) {
			if (isset($statistic[$domain]['total_celems_bydomain'])) {
				echo '<td>';
					if (isset($statistic[$domain]['total_pelems_bydomain'])) echo $statistic[$domain]['total_pelems_bydomain'];
					else echo '0';
				echo '</td>';
				echo '<td>'.$statistic[$domain]['total_celems_bydomain'].'</td>';
				echo '<td>'.number_format($statistic[$domain]['total_pelems_bydomain']/$statistic[$domain]['total_celems_bydomain']*100, 2).'%</td>';
			}
			else echo '<td>0</td><td>0</td><td>0%</td>';
		}
		echo '<td>'.$statistic['total_pelems'].'</td><td>'.$statistic['total_celems'].'</td><td>'.number_format($statistic['total_pelems']/$statistic['total_celems']*100, 2).'%</td>';
		echo '</tr>';
	?>
</table>