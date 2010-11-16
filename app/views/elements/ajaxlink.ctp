<?php
	echo $ajax->link(
		$linktitle,
		$link,
		array('update'=>'content', 'indicator' => 'spinner'),
		null, false);
?>