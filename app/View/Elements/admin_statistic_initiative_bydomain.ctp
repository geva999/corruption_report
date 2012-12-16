<?php $cr_h = $domains;?>
<table border="1" cellpadding="0" cellspacing="0" align="center" class="statistic_table">
    <tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
        <td rowspan="2">Вид акта</td>
        <?php
            foreach ($cr_h as $cr_h_val) {
                echo '<td width="150" colspan="2">'.$cr_h_val.'</td>';
            }
        ?>
        <td colspan="2">Итого</td>
    </tr>
    <tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
        <td>число проектов</td><td>%</td>
        <td>число проектов</td><td>%</td>
        <td>число проектов</td><td>%</td>
        <td>число проектов</td><td>%</td>
        <td>число проектов</td><td>%</td>
        <td>число проектов</td><td>%</td>
    </tr>

    <?php
        $cr_v = $author_groups;
        foreach ($cr_v as $cr_v_key => $cr_v_val) {
            echo '<tr align="center"><td align="left" width="150">'.$cr_v_val.'</td>';
            foreach ($cr_h as $cr_h_val) {
                if (isset($statistic['bydomain'][$cr_h_val][$cr_v_key]['total']))
                    echo '<td>'.$statistic['bydomain'][$cr_h_val][$cr_v_key]['total'].'</td><td>'.
                        number_format($statistic['bydomain'][$cr_h_val][$cr_v_key]['total']/$statistic['bydomain'][$cr_v_key]['total']*100, 2).'%</td>';
                else echo '<td>0</td><td>0%</td>';
            }
            if (isset($statistic['bydomain'][$cr_v_key]['total']))
                echo '<td>'.$statistic['bydomain'][$cr_v_key]['total'].'</td><td>'.
                    number_format($statistic['bydomain'][$cr_v_key]['total']/$statistic['total']*100, 2).'%</td>';
            else echo '<td>0</td><td>0%</td>';
        }
    ?>
    <tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
        <td align="left">Итого</td>
        <?php
            foreach ($cr_h as $cr_h_val) {
                if (isset($statistic['bydomain'][$cr_h_val]['total']))
                    echo '<td>'.$statistic['bydomain'][$cr_h_val]['total'].'</td><td>'.
                        number_format($statistic['bydomain'][$cr_h_val]['total']/$statistic['total']*100, 2).'%</td>';
                else echo '<td>0</td><td>0%</td>';
            }
            if (isset($statistic['total']))
                echo '<td>'.$statistic['total'].'</td><td>100%</td>';
            else echo '<td>0</td><td>0%</td>';
        ?>
    </tr>
</table>
