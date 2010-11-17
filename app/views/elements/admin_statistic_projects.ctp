<table border="1" cellpadding="0" cellspacing="0" align="center" class="statistic_table">
	<tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
		<td>&nbsp;</td>
		<td width="100">Nr. real</td>
		<td width="100">%</td>
		<td width="100">Nr. de pagini</td>
		<td width="100">Nr. echivalent de proiecte standart</td>
	</tr>
	<?php
		$total = 0;
		$totalnumberprojectsstandard = 0;
		$total  = $statistic['examinare'][0][0]['countproject'] + $statistic['adoptate'][0][0]['countproject'] + $statistic['retrase'][0][0]['countproject'];
		$totalnumberpages  = $statistic['examinare'][0][0]['numberpages'] + $statistic['adoptate'][0][0]['numberpages'] + $statistic['retrase'][0][0]['numberpages'];
		$totalnumberprojectsstandard  = $statistic['examinare'][0][0]['numberprojectsstandard'] + $statistic['adoptate'][0][0]['numberprojectsstandard'] + $statistic['retrase'][0][0]['numberprojectsstandard'];
	?>
	<tr align="center">
		<td align="left" width="200"> - проекты в процессе расмотрения</td>
		<td><?php echo $statistic['examinare'][0][0]['countproject'];?></td>
		<td><?php echo number_format($statistic['examinare'][0][0]['countproject']/$total*100, 2);?></td>
		<td><?php echo isset($statistic['examinare'][0][0]['numberpages'])?$statistic['examinare'][0][0]['numberpages']:0;?></td>
		<td><?php echo isset($statistic['examinare'][0][0]['numberprojectsstandard'])?$statistic['examinare'][0][0]['numberprojectsstandard']:0;?></td>
	</tr>
	<tr align="center">
		<td align="left"> - принятые проекты</td>
		<td><?php echo $statistic['adoptate'][0][0]['countproject'];?></td>
		<td><?php echo number_format($statistic['adoptate'][0][0]['countproject']/$total*100, 2);?></td>
		<td><?php echo isset($statistic['adoptate'][0][0]['numberpages'])?$statistic['adoptate'][0][0]['numberpages']:0;?></td>
		<td><?php echo isset($statistic['adoptate'][0][0]['numberprojectsstandard'])?$statistic['adoptate'][0][0]['numberprojectsstandard']:0;?></td>
	</tr>
	<tr align="center">
		<td align="left"> - отозванные проекты</td>
		<td><?php echo $statistic['retrase'][0][0]['countproject'];?></td>
		<td><?php echo number_format($statistic['retrase'][0][0]['countproject']/$total*100, 2);?></td>
		<td><?php echo isset($statistic['retrase'][0][0]['numberpages'])?$statistic['retrase'][0][0]['numberpages']:0;?></td>
		<td><?php echo isset($statistic['retrase'][0][0]['numberprojectsstandard'])?$statistic['retrase'][0][0]['numberprojectsstandard']:0;?></td>
	</tr>
	<tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
		<td align="left">Total</td>
		<td><?php echo $total;?></td>
		<td>100%</td>
		<td><?php echo $totalnumberpages;?></td>
		<td><?php echo $totalnumberprojectsstandard;?></td>
	</tr>
</table>