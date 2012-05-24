<br/>
Список пользователей с правом совместного редактирования по данному проекту
(сортировка или перенос пользователей обратно в "Список пользователей из системы" осущевстляется путем перетягивания иконки
<?php echo $html->image("/images/draggable.png"); ?>
&nbsp;слева от имени пользователей)
<div id="expertslist">
	<div id="sortabledestination" class="connectedsortable">
		<?php
			if (isset($this->data['Projectexpert']))
				foreach ($this->data['Projectexpert'] as $projectexpert)
					echo '<div class="sortableitems">'.$form->hidden('Projectexpert.][expert_id', array('value'=>$projectexpert['expert_id'])).$projectexpertslist[$projectexpert['expert_id']].'</div>';
		?>
	</div>
</div>
