<?php
	$domains = $this->domains;
	echo '<tr align="center" class="statistic_table_td"'.(isset($bgcolor)?' bgcolor="'.$bgcolor.'"':'')
			.'><td align="left">'.$title.'</td>';
	foreach ($domains as $domain) {
		if (isset($statistic[$domain]['total_reports_bydomain']))
			echo '<td width="60">'.$statistic[$domain]['total_reports_bydomain'].'</td><td width="60">'
				.number_format($statistic[$domain]['total_reports_bydomain']/$statistic['total_reports']*100, 2).'%</td>';
		else echo '<td width="60">0</td><td width="60">0%</td>';
	}
	if (isset($statistic['total_reports']))
		echo '<td width="60">'.$statistic['total_reports'].'</td><td width="60">100%</td>';
	else echo '<td width="60">0</td><td width="60">0%</td>';
	echo '</tr>';
?>