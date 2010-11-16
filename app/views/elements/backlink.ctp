<div id="spinner" style="display: none; text-align: center;"><img src="/img/loadinganimation.gif"/></div>
<br/>
<?php
	echo $ajax->link(
		$backlinktitle,
		$backlink,
		array('update'=>'content', 'indicator' => 'spinner'),
		null, false);
?>
<br/><br/>