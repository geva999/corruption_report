<?php
	//Sets the update and indicator elements by DOM ID
	$paginator->options(array('update'=>'content', 'indicator'=>'spinner'));
	echo $paginator->counter(array('format'=>__('Pagina %page% din %pages%, se afişează %current% înregistrări din totalul de %count%, începînd de la %start%, pînă la %end%', true)));
?>
<table border="0" cellspacing="5" cellpadding="0">
	<tr>
		<td><?php echo $paginator->first('<< prima');?></td>
		<td><?php if ($paginator->hasPrev()) echo $paginator->prev('< precedenta');?></td>
		<td><?php echo $paginator->numbers(array('modulus'=>14));?></td>
		<td><?php if ($paginator->hasNext()) echo $paginator->next('următoarea >');?></td>
		<td><?php echo $paginator->last('ultima >>');?></td>
	</tr>
</table>

<div id="spinner" style="display: none; text-align: center;"><img src="/img/loadinganimation.gif"/></div>