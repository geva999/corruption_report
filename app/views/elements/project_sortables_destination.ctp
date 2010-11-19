<br/>
Список пользователей с правом совместного редактирования по данному проекту
<div id="expertslist">
	<div id="sortabledestination" class="connectedsortable">
		<?php
			if (isset($this->data['Projectexpert']))
				foreach ($this->data['Projectexpert'] as $projectexpert)
					echo '<div class="sortableitems">'.$form->hidden('Projectexpert.][expert_id', array('value'=>$projectexpert['expert_id'])).$projectexpertslist[$projectexpert['expert_id']].'</div>';
		?>
	</div>
</div>