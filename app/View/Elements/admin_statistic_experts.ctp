<?php $criteriashorizontal = array('проект закона', 'по запросу');?>
<table border="1" cellpadding="0" cellspacing="0" align="center" class="statistic_table">
    <tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
        <td rowspan="2">Эксперты</td>
        <?php
            foreach ($criteriashorizontal as $criteriavalue) {
                echo '<td width="150" colspan="2">'.$criteriavalue.'</td>';
            }
        ?>
        <td colspan="2">Итого</td>
    </tr>
    <tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
        <td>число проектов</td><td>число страниц</td>
        <td>число проектов</td><td>число страниц</td>
        <td>число проектов</td><td>число страниц</td>
    </tr>

    <?php
        foreach ($experts as $expertkey => $expertvalue) {
            echo '<tr align="center"><td align="left" width="200">'.$expertvalue.'</td>';
            foreach ($criteriashorizontal as $criteriashorizontalvalue) {
                if (isset($statistic[$criteriashorizontalvalue]['Experts'][$expertkey]['projects']))
                    echo '<td>'.$statistic[$criteriashorizontalvalue]['Experts'][$expertkey]['projects'].'</td>';
                else echo '<td>0</td>';
                if (isset($statistic[$criteriashorizontalvalue]['Experts'][$expertkey]['numberpages']))
                    echo '<td>'.$statistic[$criteriashorizontalvalue]['Experts'][$expertkey]['numberpages'].'</td>';
                else echo '<td>0</td>';
            }
            if (isset($statistic['Experts'][$expertkey]['total']))
                echo '<td>'.$statistic['Experts'][$expertkey]['total'].'</td>';
            else echo '<td>0</td>';
            if (isset($statistic['Experts'][$expertkey]['total_numberpages']))
                echo '<td>'.$statistic['Experts'][$expertkey]['total_numberpages'].'</td></tr>';
            else echo '<td>0</td>';
        }
    ?>
    <tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
        <td align="left">Итого</td>
        <?php
            foreach ($criteriashorizontal as $criteriashorizontalvalue) {
                if (isset($statistic[$criteriashorizontalvalue]['total']))
                    echo '<td>'.$statistic[$criteriashorizontalvalue]['total'].'</td>';
                else echo '<td>0</td>';
                if (isset($statistic[$criteriashorizontalvalue]['total_numberpages']))
                    echo '<td>'.$statistic[$criteriashorizontalvalue]['total_numberpages'].'</td>';
                else echo '<td>0</td>';
            }
            if (isset($statistic['total']))
                echo '<td>'.$statistic['total'].'</td>';
            else echo '<td>0</td>';
            if (isset($statistic['total_numberpages']))
                echo '<td>'.$statistic['total_numberpages'].'</td></tr>';
            else echo '<td>0</td>';
        ?>
    </tr>
</table>
