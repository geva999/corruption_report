<div class="Submit" style="padding-left:25%">
	<?php
		echo $ajax->submit('Сохранить', array('id'=>'submitbutton', 'update'=>'content', 'indicator' => 'spinner'));
		echo $form->end();
	?>
</div>