<tr align="center"<?php echo isset($bgcolor)?' bgcolor="'.$bgcolor.'"':''?>>
	<td align="left" colspan="13" class="statistic_table_td"><?php echo $title?></td>
</tr>
<?php
	$domains = $this->domains;
	foreach ($criterias as $criteriakey => $criteriavalue) {
		echo '<tr align="center"'.(isset($bgcolor)?' bgcolor="'.$bgcolor.'"':'').'><td align="left">'.$criteriavalue.'</td>';
		$criteriakey++;
		$total = 0;
		foreach ($domains as $domain) {
			if (isset($statistic[$domain][$element_name][$criteria_by][$criteriakey])) {
				echo '<td>'.$statistic[$domain][$element_name][$criteria_by][$criteriakey].'</td><td>'
					.number_format($statistic[$domain][$element_name][$criteria_by][$criteriakey]/$statistic[$domain]['total_reports_bydomain']*100, 2).'%</td>';
				$total = $total + $statistic[$domain][$element_name][$criteria_by][$criteriakey];
			}
			else echo '<td>0</td><td>0%</td>';
		}
		echo '<td class="statistic_table_head">'.$total.'</td><td class="statistic_table_head">'
		.number_format($total/$statistic['total_reports']*100, 2).'%</td></tr>';
	}
?>