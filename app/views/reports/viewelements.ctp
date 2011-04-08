<div style="padding:20px;">
	<table align="center" id="elementehover" width="100%" border="0" cellspacing="1" cellpadding="4">
		<tr style="font-weight:bold;font-size:120%;background-color:#c4c4c4;">
			<td>Группа</td>
			<td>Фактор коррупционности</td>
		</tr>
		<?php
			foreach ($celemgroups as $celemgroup)
			{
				echo '<tr><td class="sector">'.$celemgroup['Celem']['celemgroup'].'</td><td>';
				foreach ($celems as $celem)
				{
					if ($celem['Celem']['celemgroup'] == $celemgroup['Celem']['celemgroup'])
					{
						echo '<div>';
						echo '<label>'.$celem['Celem']['celem'].'</label>';
						if ($celem['Celem']['description'] !='')
						{
							echo '<div style="padding-left: 20px;">Описание:<br/>'.nl2br($celem['Celem']['description']).'<br/></div>';
						}
						echo '</div>';
					}
				}
				echo '</td></tr>';
			}
		?>
	</table>
</div>
