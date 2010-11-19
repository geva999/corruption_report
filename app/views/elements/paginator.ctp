<?php
	//Sets the update and indicator elements by DOM ID
	$paginator->options(array('update'=>'content', 'indicator'=>'spinner'));
	echo $paginator->counter(array('format'=>__('Страница %page% из %pages%, показываются %current% регистраций из общего числа %count%, начиная с %start%, до %end%', true)));
?>
<table border="0" cellspacing="5" cellpadding="0">
	<tr>
		<td><?php echo $paginator->first('<< начальная');?></td>
		<td><?php if ($paginator->hasPrev()) echo $paginator->prev('< предыдущая');?></td>
		<td><?php echo $paginator->numbers(array('modulus'=>14));?></td>
		<td><?php if ($paginator->hasNext()) echo $paginator->next('следующая >');?></td>
		<td><?php echo $paginator->last('последняя >>');?></td>
	</tr>
</table>

<div id="spinner" style="display: none; text-align: center;"><img src="/img/loadinganimation.gif"/></div>