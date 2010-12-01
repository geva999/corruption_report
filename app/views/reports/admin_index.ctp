<?php echo $this->element('top_menu', array('top_menu_title'=>'Administrare rapoarte'));?>

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
							$links = array(
								'в процессе расмотрения администратором'=>'рассмотрение',
								'опубликованные с размещением на сайте'=>'опубликованные',
								'по принятым проекта'=>'принятые',
								'редактированные несколькими экспертами'=>'несколькоэкспертов');
              echo '<tr><td>Rapoarte:</td>';
							foreach ($links as $linktitle=>$linkaction)
								echo '<td>'.$this->element('ajaxlink', array('link'=>'/admin/reports/index/'.$linkaction, 'linktitle'=>$linktitle)).'</td>';
							echo '</tr>';
						?>
					</table>
				</td>
				<td align="right" valign="top">
					<?php
						echo $form->create('Report', array('action'=>'index')).
							$form->input('Project.searchtype', array('label'=>'Criteriu de căutare: ', 'div'=>false, 'options'=>array(1=>'nr. raport', 2=>'nr. proiect', 3=>'nume proiect'))).
							$form->input('Project.search', array('label'=>false, 'div'=>false)).
							$ajax->submit('Caută', array('update'=>'content', 'indicator'=>'spinner', 'div'=>false)).
							$form->end();
					?>
				</td>
			</tr>
		</table>
	</div>

	<div id="caption" class="red"><?php echo $viewtext.' - '.$countreports;?></div>

	<?php $paginator->options(array('url'=>$action, 'update'=>'content', 'indicator'=>'spinner'));?>

	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="orange">
		<tr>
			<th width="5">Nr.</th>
			<th width="50"><?php echo $paginator->sort('Număr raport', 'Project.reportnumber', array('title'=>'sortare după Număr raport'));?></th>
			<th width="70"><?php echo $paginator->sort('Data raport', 'Report.reportdate', array('title'=>'sortare după Data raport'));?></th>
			<th align="left"><?php echo $paginator->sort('Denumirea raportului', 'Project.name', array('title'=>'sortare după Denumirea raportului'));?></th>
			<th width="200">Expert</th>
			<th width="50">Vizualizare</th>
			<th width="50">PDF</th>
			<th width="50">Editare</th>
		</tr>
		<?php
		$i = intval($paginator->counter(array('format'=>'%start%')));
		foreach ($reports as $report) {?>
		<tr valign="top">
			<td align="center"><?php echo $i.'.'; $i++;?></td>
			<td align="center"><?php echo $report['Project']['reportnumber'];?></td>
			<td><?php echo date('d-m-Y', strtotime($report['Report']['reportdate']));?></td>
			<td>
				<?php
					$projectname = $report['Project']['name'];
					echo 'Raport de expertiză la '.$projectname;
					if (substr($projectname, 0, 9) == 'proiectul') $projectname = substr($projectname, 9, strlen($projectname)-9);
					if ($report['Project']['projecttype'] == 'по запросу')
						echo ', la solicitarea '.nl2br($report['Project']['namesolicitare']);
				?>
			</td>
			<td><?php echo $experts[$report['Project']['expert_id']];?></td>
			<td align="center"><?php echo $this->element('viewlink', array('viewlink'=>'/reports/view/'.$report['Report']['id']));?></td>
			<td align="center"><a href="/reports/view/<?php echo $report['Report']['id'];?>/pdf"><img src="/images/pdf.png" border="0" title="Trage PDF"/></a></td>
			<td align="center"><a href="/reports/edit/<?php echo $report['Report']['id'];?>"><img src="/images/edit.png" border="0" title="Editează"/></a></td>
		</tr>
		<?php }?>
	</table>

	<?php
		echo $this->element('paginator');
		echo $this->element('admin_legend');
		echo $this->element('error_messages');
		echo $this->element('sponsor');
	?>

</div>