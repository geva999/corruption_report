<br/>
<div style="text-align: center;">
	<?php
		echo $ajax->link(
			$html->image('/images/add.png').$addtitle,
			$addlink,
			array('update'=>'content', 'indicator' => 'spinner'),
			null, false);
	?>
</div>
<br/>