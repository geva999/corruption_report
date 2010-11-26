<table border="1" cellpadding="0" cellspacing="0" align="center" width="100%" class="statistic_table">
	<!-- Список областей -->
	<tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
		<td>Категории элементов</td>
		<td>Список заключений</td>
	</tr>
	<?php
		//элементы
		foreach ($elemgroups as $elemgroupkey => $elemgroupvalue) {
			//отображение группы
			$bgcolor = '#BBBBBB';
			echo '<tr align="center" class="statistic_table_head" bgcolor="'.$bgcolor.'"><td align="left" width="30%">'.$elemgroupvalue.'</td><td>&nbsp;</td>';
			//отображение элементов из группы
			foreach ($elems as $elemkey => $elemvalue) {
				$bgcolor = '#DDDDDD';
				if ($elemgroupvalue == $elemvalue['celemgroup']) {
					echo '<tr valign="top"><td>'.$elemvalue['celem'].'</td><td>';
					$countreports = 0;
					foreach ($statistic[$elemvalue['id']] as $reportkey => $reportvalue) {
						if ($countreports > 0) echo ', ';
						echo $reportkey;
						$countreports++;
					}
					echo '</td></tr>';
				}
			}
		}
	?>
</table>