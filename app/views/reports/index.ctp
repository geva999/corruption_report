<?php echo $this->element('top_menu', array('top_menu_title'=>'Rapoarte online'));?>

<div id="line">
	<?php if ($countprojects > 0) echo '<div id="info">Proiecte spre acceptare - '.$countprojects.'.</div>';?>
	<?php echo $this->element('expert_menu');?>
</div>

<div id="listcontent">

	<div id="caption" class="red">Rapoarte respinse - <?php echo $countrejected;?></div>

	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="red">
		<tr>
			<th width="5">Nr.</th>
			<th width="50">Numărul raportului</th>
			<th align="left">Denumirea raportului</th>
			<th width="50">Vizualizare</th>
			<th width="50">PDF</th>
			<th width="50">Statut</th>
			<th width="50">Acţiune</th>
		</tr>
		<?php
		$i = 1;
		foreach ($reportsrejected as $report) {?>
		<tr valign="top">
			<td align="center"><?php echo $i.'.'; $i++;?></td>
			<td align="center"><?php echo $report['Project']['reportnumber'];?></td>
			<td>
				<?php
					$projectname = $report['Project']['name'];
					echo 'Raport de expertiză la '.$projectname;
					if (substr($projectname, 0, 9) == 'proiectul') $projectname = substr($projectname, 9, strlen($projectname)-9);
					if ($report['Project']['projecttype'] == 'по запросу')
						echo ', la solicitarea '.nl2br($report['Project']['namesolicitare']);
				?>
			</td>
			<td align="center"><?php echo $this->element('viewlink', array('viewlink'=>'/reports/view/'.$report['Report']['id']));?></td>
			<td align="center"><a href="/reports/view/<?php echo $report['Report']['id'];?>/pdf"><img src="/images/pdf.png" border="0" title="Trage PDF"/></a></td>
			<td align="center"><img src="/images/returned.png"/></td>
			<td align="center"><a href="/reports/edit/<?php echo $report['Report']['id'];?>"><img src="/images/edit.png" border="0" title="Editează"/></a></td>
		</tr>
		<?php }?>
	</table>


	<div id="caption" class="red">Rapoarte spre aprobare - <?php echo $countsenttoadmin;?></div>

	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="red">
		<tr>
			<th width="5">Nr.</th>
			<th width="50">Numărul raportului</th>
			<th align="left">Denumirea raportului</th>
			<th width="50">Vizualizare</th>
			<th width="50">PDF</th>
			<th width="50">Statut</th>
			<th width="50">Acţiune</th>
		</tr>
		<?php
		$i = 1;
		foreach ($reportssenttoadmin as $report) {?>
		<tr valign="top">
			<td align="center"><?php echo $i.'.'; $i++;?></td>
			<td align="center"><?php echo $report['Project']['reportnumber'];?></td>
			<td>
				<?php
					$projectname = $report['Project']['name'];
					echo 'Raport de expertiză la '.$projectname;
					if (substr($projectname, 0, 9) == 'proiectul') $projectname = substr($projectname, 9, strlen($projectname)-9);
					if ($report['Project']['projecttype'] == 'по запросу')
						echo ', la solicitarea '.nl2br($report['Project']['namesolicitare']);
				?>
			</td>
			<td align="center"><?php echo $this->element('viewlink', array('viewlink'=>'/reports/view/'.$report['Report']['id']));?></td>
			<td align="center"><a href="/reports/view/<?php echo $report['Report']['id'];?>/pdf"><img src="/images/pdf.png" border="0" title="Trage PDF"/></a></td>
			<td align="center"><img src="/images/gone.png"/></td>
			<td align="center"><img src="/images/locked.png"/></td>
		</tr>
		<?php }?>
	</table>

	<div id="caption" class="red">Rapoarte cu posibilitatea editării de către mai mulţi experţi - <?php echo $countmultipleedit;?></div>

	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="red">
		<tr>
			<th width="5">Nr.</th>
			<th width="50">Numărul raportului</th>
			<th align="left">Denumirea raportului</th>
			<th width="50">Vizualizare</th>
			<th width="50">PDF</th>
			<th width="50">Editare</th>
		</tr>
		<?php
		$i = 1;
		foreach ($reportmultipleedit as $report) {?>
		<tr valign="top">
			<td align="center"><?php echo $i.'.'; $i++;?></td>
			<td align="center"><?php echo $report['Project']['reportnumber'];?></td>
			<td>
				<?php
					$projectname = $report['Project']['name'];
					echo 'Raport de expertiză la '.$projectname;
					if (substr($projectname, 0, 9) == 'proiectul') $projectname = substr($projectname, 9, strlen($projectname)-9);
					if ($report['Project']['projecttype'] == 'по запросу')
						echo ', la solicitarea '.nl2br($report['Project']['namesolicitare']);
				?>
			</td>
			<td align="center"><?php echo $this->element('viewlink', array('viewlink'=>'/reports/view/'.$report['Report']['id']));?></td>
			<td align="center"><a href="/reports/view/<?php echo $report['Report']['id'];?>/pdf"><img src="/images/pdf.png" border="0" title="Trage PDF"/></a></td>
			<td align="center"><a href="/reports/edit/<?php echo $report['Report']['id'];?>"><img src="/images/edit.png" border="0" title="Editează"/></a></td>
		</tr>
		<?php }?>
	</table>

	<div id="caption" class="green">Rapoarte salvate - <?php echo $countsaved;?></div>

	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="green">
		<tr>
			<th width="5">Nr.</th>
			<th width="50">Numărul raportului</th>
			<th align="left">Denumirea raportului</th>
			<th width="50">Vizualizare</th>
			<th width="50">PDF</th>
			<th width="50">Editare</th>
		</tr>
		<?php
		$i = 1;
		foreach ($reportssaved as $report) {?>
		<tr valign="top">
			<td align="center"><?php echo $i.'.'; $i++;?></td>
			<td align="center"><?php echo $report['Project']['reportnumber'];?></td>
			<td>
				<?php
					$projectname = $report['Project']['name'];
					echo 'Raport de expertiză la '.$projectname;
					if (substr($projectname, 0, 9) == 'proiectul') $projectname = substr($projectname, 9, strlen($projectname)-9);
					if ($report['Project']['projecttype'] == 'по запросу')
						echo ', la solicitarea '.nl2br($report['Project']['namesolicitare']);
				?>
			</td>
			<td align="center"><?php echo $this->element('viewlink', array('viewlink'=>'/reports/view/'.$report['Report']['id']));?></td>
			<td align="center"><a href="/reports/view/<?php echo $report['Report']['id'];?>/pdf"><img src="/images/pdf.png" border="0" title="Trage PDF"/></a></td>
			<td align="center"><a href="/reports/edit/<?php echo $report['Report']['id'];?>"><img src="/images/edit.png" border="0" title="Editează"/></a></td>
		</tr>
		<?php }?>
	</table>

	<div id="caption" class="orange">Rapoarte publicate - <?php echo $countpublished;?></div>

	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="orange">
		<tr>
			<th width="5">Nr.</th>
			<th width="50"><?php echo $paginator->sort('Număr raport', 'Project.reportnumber', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'sortare după Număr raport'));?></th>
			<th width="70"><?php echo $paginator->sort('Data raport', 'Report.reportdate', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'sortare după Data raport'));?></th>
			<th align="left"><?php echo $paginator->sort('Denumirea raportului', 'Project.name', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'sortare după Denumirea raportului'));?></th>
			<th width="50">Vizualizare</th>
			<th width="50">PDF</th>
		</tr>
		<?php
		$i = intval($paginator->counter(array('format'=>'%start%')));
		foreach ($reportspublished as $report) {?>
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
			<td align="center"><?php echo $this->element('viewlink', array('viewlink'=>'/reports/view/'.$report['Report']['id']));?></td>
			<td align="center"><a href="/reports/view/<?php echo $report['Report']['id'];?>/pdf"><img src="/images/pdf.png" border="0" title="Trage PDF"/></a></td>
		</tr>
		<?php }?>
	</table>

	<?php
		echo $this->element('paginator');
		echo $this->element('expert_legend');
		echo $this->element('error_messages');
		echo $this->element('sponsor');
	?>

</div>