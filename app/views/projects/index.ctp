<?php echo $this->element('top_menu', array('top_menu_title'=>'Administrare proiecte'))?>

<div id="line">
	<?php echo $this->element('expert_menu');?>
</div>

<div id="listcontent">

	<div id="caption" class="green">Proiecte spre acceptare - <?php echo $countsaved;?></div>

	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="green">
		<tr>
			<th width="5">Nr.</th>
			<th width="80">Număr raport</th>
			<th>Denumire proiect</th>
			<th width="80">Număr proiect</th>
			<th width="70">Data limită expert</th>
			<th width="70">Data limită autoritate</th>
			<th width="100">Nume fişier</th>
			<th width="50">Acceptare</th>
			<th width="50">Respingere</th>
		</tr>
		<?php
		$i = 1;
		foreach ($projectssaved as $projectsaved) {?>
		<tr>
			<td align="center"><?php echo $i.'.'; $i++;?></td>
			<td align="center"><?php echo $projectsaved['Project']['reportnumber'];?></td>
			<td><?php echo $projectsaved['Project']['name'];?></td>
			<td align="center"><?php echo $projectsaved['Project']['projectnumber'];?></td>
			<?php
				$bgexpertcolor = null;
				$bgparlamentcolor = null;
				$date = strtotime(date('d-m-Y', time()));
				$dateexpert = strtotime($projectsaved['Project']['datelimitexpert']);
				$dateparlament = strtotime($projectsaved['Project']['datelimitparlament']);
				if (($dateexpert - $date) < 0) $bgexpertcolor = '#ffd462';
				if (($dateparlament - $date) < 0) $bgparlamentcolor = '#f0523b';
				echo '<td'.(isset($bgexpertcolor)?' bgcolor="'.$bgexpertcolor.'"':'').'>'.date('d-m-Y', $dateexpert).'</td>';
				echo '<td'.(isset($bgexpertcolor)?' bgcolor="'.$bgparlamentcolor.'"':'').'>'.date('d-m-Y', $dateparlament).'</td>';
			?>
			<td>
				<?php
					if (isset($projectsaved['Project']['filename']) && $projectsaved['Project']['filename'] != '')
						echo $html->link($projectsaved['Project']['filename'], '/uploaded/projects/'.$projectsaved['Project']['filename']);
					else echo 'Nu există';
				?>
			</td>
			<td align="center"><?php echo $this->element('aprove_link', array('aprovelink'=>'/projects/accept/'.$projectsaved['Project']['id']));?></td>
			<td align="center"><?php echo $this->element('reject_link', array('rejectlink'=>'/projects/reject/'.$projectsaved['Project']['id']));?></td>
		</tr>
		<?php }?>
	</table>

	<div id="caption" class="orange">Proiecte acceptate - <?php echo $countaccepted;?></div>

	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="orange">
		<tr>
			<th width="5">Nr.</th>
			<th width="80"><?php echo $paginator->sort('Număr raport', 'Project.reportnumber', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'sortare după Număr raport'));?></th>
			<th><?php echo $paginator->sort('Denumire proiect', 'Project.name', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'sortare după Denumire proiect'));?></th>
			<th width="80"><?php echo $paginator->sort('Număr proiect', 'Project.projectnumber', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'sortare după Număr proiect'));?></th>
			<th width="70"><?php echo $paginator->sort('Data limită expert', 'Project.datelimitexpert', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'sortare după Data limită expert'));?></th>
			<th width="70"><?php echo $paginator->sort('Data limită autoritate', 'Project.datelimitparlament', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'sortare după Data limită autoritate'));?></th>
			<th width="100">Nume fişier</th>
		</tr>
		<?php
		$i = intval($paginator->counter(array('format'=>'%start%')));
		foreach ($projectsaccepted as $projectaccepted) {?>
		<tr>
			<td align="center"><?php echo $i.'.'; $i++;?></td>
			<td align="center"><?php echo $projectaccepted['Project']['reportnumber'];?></td>
			<td><?php echo $projectaccepted['Project']['name'];?></td>
			<td align="center"><?php echo $projectaccepted['Project']['projectnumber'];?></td>
			<?php
				$bgexpertcolor = null;
				$bgparlamentcolor = null;
				$date = strtotime(date('d-m-Y', time()));
				$dateexpert = strtotime($projectaccepted['Project']['datelimitexpert']);
				$dateparlament = strtotime($projectaccepted['Project']['datelimitparlament']);
				if (($dateexpert - $date) < 0) $bgexpertcolor = '#ffd462';
				if (($dateparlament - $date) < 0) $bgparlamentcolor = '#f0523b';
				echo '<td'.(isset($bgexpertcolor)?' bgcolor="'.$bgexpertcolor.'"':'').'>'.date('d-m-Y', $dateexpert).'</td>';
				echo '<td'.(isset($bgexpertcolor)?' bgcolor="'.$bgparlamentcolor.'"':'').'>'.date('d-m-Y', $dateparlament).'</td>';
			?>
			<td>
				<?php
					if (isset($projectaccepted['Project']['filename']) && $projectaccepted['Project']['filename'] != '')
						echo $html->link($projectaccepted['Project']['filename'], '/uploaded/projects/'.$projectaccepted['Project']['filename']);
					else echo 'Nu există';
				?>
			</td>
		</tr>
		<?php }?>
	</table>

	<?php
		echo $this->element('paginator');
		echo $this->element('expert_simple_legend');
		echo $this->element('error_messages');
		echo $this->element('sponsor');
	?>

</div>