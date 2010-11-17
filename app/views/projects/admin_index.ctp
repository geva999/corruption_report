<?php echo $this->element('top_menu', array('top_menu_title'=>'Administrare proiecte'));?>

<div id="line">
	<?php echo $this->element('admin_menu');?>
</div>

<div id="listcontent">

	<div align="left">
		<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<td>
					<table border="0" cellpadding="5" cellspacing="0">
						<?php
							$links = array (
								'în curs de examinare'=>'examinare',
								'adoptate'=>'adoptate',
								'retrase'=>'retrase',
								'trimise spre acceptare către expert'=>'spreaprobare',
								'respinse de expert'=>'respinse',
								'acceptate de expert'=>'acceptate'
							);
							echo '<tr><td>Proiecte:</td>';
							foreach ($links as $linktitle=>$linkaction)
								echo '<td>'.$this->element('ajaxlink', array('link'=>'/admin/projects/index/'.$linkaction, 'linktitle'=>$linktitle)).'</td>';
							echo '</tr>';
						?>
					</table>
				</td>
				<td align="right" valign="top" width="25%">
					<?php
						echo $form->create('Project', array('action'=>'index')).
							$form->input('Project.searchtype', array('label'=>'Criteriu de căutare: ', 'div'=>false, 'options'=>array(1=>'nr. raport', 2=>'nr. proiect', 3=>'nume proiect', 4=>'nume expert'))).
							$form->input('Project.search', array('label'=>false, 'div'=>false)).
							$ajax->submit('Caută', array('update'=>'content', 'indicator'=>'spinner', 'div'=>false)).
							$form->end();
					?>
				</td>
			</tr>
		</table>
	</div>

	<div id="caption" class="green"><?php echo $viewtext.' - '.$countprojects;?></div>

	<?php $paginator->options(array('url'=>$action, 'update'=>'content', 'indicator'=>'spinner'));?>

	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="green">
		<tr>
			<th width="5">Nr.</th>
			<th width="80"><?php echo $paginator->sort('Număr raport', 'Project.reportnumber', array('title'=>'sortare după Număr raport'));?></th>
			<th><?php echo $paginator->sort('Denumire proiect', 'Project.name', array('title'=>'sortare după Denumire proiect'));?></th>
			<th width="80"><?php echo $paginator->sort('Număr proiect', 'Project.projectnumber', array('title'=>'sortare după Număr proiect'));?></th>
			<th width="200"><?php echo $paginator->sort('Nume expert', 'Expert.fullname', array('title'=>'sortare după Nume expert'));?></th>
			<th width="70"><?php echo $paginator->sort('Data limită expert', 'Project.datelimitexpert', array('title'=>'sortare după Data limită expert'));?></th>
			<th width="70"><?php echo $paginator->sort('Data limită autoritate', 'Project.datelimitparlament', array('title'=>'sortare după Data limită autoritate'));?></th>
			<th width="100">Имя файла</th>
			<th width="50">Editare</th>
			<th width="50">Ştergere</th>
		</tr>
		<?php
		$i = intval($paginator->counter(array('format'=>'%start%')));
		foreach ($projects as $project) {?>
		<tr align="center" valign="top">
			<td><?php echo $i.'.'; $i++;?></td>
			<td><?php echo $project['Project']['reportnumber'];?></td>
			<td align="left"><?php echo $project['Project']['name'];?></td>
			<td><?php echo $project['Project']['projectnumber'];?></td>
			<td align="left"><?php echo $project['Expert']['fullname'];?></td>
			<?php
				$bgexpertcolor = null;
				$bgparlamentcolor = null;
				$date = strtotime(date('d-m-Y', time()));
				$dateexpert = strtotime($project['Project']['datelimitexpert']);
				$dateparlament = strtotime($project['Project']['datelimitparlament']);
				if (($dateexpert - $date) < 0) $styleexpert = ' style="color:#000000; background-color:#ffd462;"'; else $styleexpert = null;
				if (($dateparlament - $date) < 0) $styleparlament = ' style="color:#000000; background-color:#f0523b;"'; else $styleparlament = null;
				echo '<td'.$styleexpert.'>'.date('d-m-Y', $dateexpert).'</td>';
				echo '<td'.$styleparlament.'>'.date('d-m-Y', $dateparlament).'</td>';
			?>
			<td align="left">
				<?php
					if (isset($project['Project']['filename']) && $project['Project']['filename'] != '')
						echo $html->link($project['Project']['filename'], '/uploaded/projects/'.$project['Project']['filename']);
					else echo 'Nu există';
				?>
			</td>
			<td><?php echo $this->element('editlink', array('editlink'=>'/admin/projects/edit/'.$project['Project']['id']));?></td>
			<td><?php echo $this->element('deletelink', array('deletelink'=>'/admin/projects/delete/'.$project['Project']['id'], 'deletelinkquestion'=>'proiect'));?></td>
		</tr>
		<?php }?>
	</table>

	<?php
		echo $this->element('paginator');
		echo $this->element('addlink', array('addlink'=>'/admin/projects/add', 'addtitle'=>' Adaugă proiect'));
		echo $this->element('simple_legend');
		echo $this->element('error_messages');
		echo $this->element('sponsor');
	?>

</div>