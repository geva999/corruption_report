<tr align="center"<?php echo isset($bgcolor)?' bgcolor="'.$bgcolor.'"':''?>>
	<td align="left" colspan="13" class="statistic_table_td"><?php echo $title?></td>
</tr>
<?php
	foreach ($criterias as $criteriakey => $criteriavalue) {
		echo '<tr align="center"'.(isset($bgcolor)?' bgcolor="'.$bgcolor.'"':'').'><td align="left">'.$criteriavalue.'</td>';
		$criteriakey++;
		$total[$criteriakey] = 0;
		foreach ($domains as $domain) {
			if (isset($statistic[$domain][$element_name][$criteriakey])) {
				echo '<td>'.$statistic[$domain][$element_name][$criteriakey].'</td><td>';
				if (($criteriakey == 2 || $criteriakey == 3) && $advanced == true)
					echo number_format($statistic[$domain][$element_name][$criteriakey]/$statistic[$domain][$element_name][1]*100, 2).'%</td>';
				else echo number_format($statistic[$domain][$element_name][$criteriakey]/$statistic[$domain]['total_reports_bydomain']*100, 2).'%</td>';
				$total[$criteriakey] = $total[$criteriakey] + $statistic[$domain][$element_name][$criteriakey];
			}
			else echo '<td>0</td><td>0%</td>';
		}
		echo '<td class="statistic_table_head">'.$total[$criteriakey].'</td><td class="statistic_table_head">';
		if (($criteriakey == 2 || $criteriakey == 3) && $advanced == true)
			echo number_format($total[$criteriakey]/$total[1]*100, 2).'%</td></tr>';
		else echo number_format($total[$criteriakey]/$statistic['total_reports']*100, 2).'%</td></tr>';
	}
?>