<?php
	echo $ajax->link(
		$html->image('/images/aproved.png', array('title' => 'Утверждение')),
		$aprovelink,
		array('update'=>'content', 'indicator' => 'spinner'),
		null, false);
?>