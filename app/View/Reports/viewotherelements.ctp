<div style="padding:20px;">
    <table align="center" id="elementehover" width="100%" border="0" cellspacing="1" cellpadding="4" style="font-weight:bold;font-size:100%;text-align:center;">
        <tr style="background-color:#c4c4c4;">
            <td>Фактор коррупционности</td>
            <td>Сколько раз был установлен</td>
        </tr>
        <?php
            foreach ($otherelements as $otherelement)
            {
                echo '<tr><td class="sector" style="text-align:left; width:80%;"> - '.strip_tags($otherelement['Subreport']['alteelemente']).'</td>';
                echo '<td align="center"><b>'.$otherelement[0]['countalteelemente'].'</b></td><tr>';
            }
        ?>
    </table>
</div>
