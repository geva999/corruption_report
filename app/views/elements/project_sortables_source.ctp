<br/>
Lista utilizatorilor din sistem
<form>
	<div id="sortablesource" class="connectedsortable">
			<?php
				foreach ($projectexpertslist as $expertid => $expertname) {
					$found = 0;
					foreach ($this->data['Projectexpert'] as $projectexpert)
						if ($expertid == $projectexpert['expert_id']) $found = 1;
					if ($found == 0)
						echo '<div class="sortableitems">'.$form->hidden('Projectexpert.][expert_id', array('value'=>$expertid)).$expertname.'</div>';
				}
			?>
	</div>
</form>