<table border="1" cellpadding="0" cellspacing="0" align="center" class="statistic_table">
    <tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
        <td>&nbsp;</td>
        <td width="100">Реальное число</td>
        <td width="100">%</td>
        <td width="100">Число страниц</td>
    </tr>
    <?php
        $total = 0;
        $total  = $statistic['examinare'][0][0]['countproject'] + $statistic['adoptate'][0][0]['countproject'] + $statistic['retrase'][0][0]['countproject'];
        $totalnumberpages  = $statistic['examinare'][0][0]['numberpages'] + $statistic['adoptate'][0][0]['numberpages'] + $statistic['retrase'][0][0]['numberpages'];
  ?>
    <tr align="center">
        <td align="left" width="200"> - проекты в процессе рассмотрения</td>
        <td><?php echo $this->App->number_or_zero($statistic['examinare'][0][0]['countproject']);?></td>
        <td><?php echo $this->App->number_to_percent($statistic['examinare'][0][0]['countproject'], $total);?></td>
        <td><?php echo $this->App->number_or_zero($statistic['examinare'][0][0]['numberpages']);?></td>
    </tr>
    <tr align="center">
        <td align="left"> - принятые проекты</td>
        <td><?php echo $this->App->number_or_zero($statistic['adoptate'][0][0]['countproject']);?></td>
        <td><?php echo $this->App->number_to_percent($statistic['adoptate'][0][0]['countproject'], $total);?></td>
        <td><?php echo $this->App->number_or_zero($statistic['adoptate'][0][0]['numberpages']);?></td>
    </tr>
    <tr align="center">
        <td align="left"> - отозванные проекты</td>
        <td><?php echo $this->App->number_or_zero($statistic['retrase'][0][0]['countproject']);?></td>
        <td><?php echo $this->App->number_to_percent($statistic['retrase'][0][0]['countproject'], $total);?></td>
        <td><?php echo $this->App->number_or_zero($statistic['retrase'][0][0]['numberpages']);?></td>
    </tr>
    <tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
        <td align="left">Итого</td>
        <td><?php echo $total;?></td>
        <td>100%</td>
        <td><?php echo $totalnumberpages;?></td>
    </tr>
</table>
