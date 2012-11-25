<?php
    echo $this->Paginator->counter(array('format'=>__('Страница %page% из %pages%, показываются %current% строк из общего числа %count%, начиная с %start%, до %end%')));
?>
<table border="0" cellspacing="5" cellpadding="0">
    <tr>
        <td><?php echo $this->Paginator->first('<< начальная');?></td>
        <td><?php if ($this->Paginator->hasPrev()) echo $this->Paginator->prev('< предыдущая');?></td>
        <td><?php echo $this->Paginator->numbers(array('modulus'=>14));?></td>
        <td><?php if ($this->Paginator->hasNext()) echo $this->Paginator->next('следующая >');?></td>
        <td><?php echo $this->Paginator->last('последняя >>');?></td>
    </tr>
</table>

<div id="spinner" style="display: none; text-align: center;"><img src="/img/loadinganimation.gif"/></div>
