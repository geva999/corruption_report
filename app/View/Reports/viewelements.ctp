<div style="padding:20px;">
    <table align="center" id="elementehover" width="100%" border="0" cellspacing="1" cellpadding="4">
        <tr style="font-weight:bold;font-size:120%;background-color:#c4c4c4;">
            <td>Группа</td>
            <td>Фактор коррупционности</td>
        </tr>
        <?php
            foreach ($celem_groups as $celem_group)
            {
                echo '<tr><td class="sector">'.$celem_group.'</td><td>';
                foreach ($celems as $celem)
                {
                    if ($celem['Celem']['celemgroup'] == $celem_group)
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
