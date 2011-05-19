<?php echo $this->element('top_menu', array('top_menu_title'=>'Он-лайн заключения'));?>

<div id="line">
	<?php if ($countprojects > 0) echo '<div id="info">Проекты для одобрения - '.$countprojects.'.</div>';?>
	<?php echo $this->element('expert_menu');?>
</div>

<div id="listcontent">

	<div id="caption" class="red">Отклоненные заключения - <?php echo $countrejected;?></div>

	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="red">
		<tr>
			<th width="5">№</th>
			<th width="50">Номер заключения</th>
			<th align="left">Название заключения</th>
			<th width="50">Визуализация</th>
			<th width="50">PDF</th>
			<th width="50">Статус</th>
			<th width="50">Действие</th>
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
					echo 'Экспертное заключение по '.$projectname;
					if (substr($projectname, 0, 9) == 'проект') $projectname = substr($projectname, 9, strlen($projectname)-9);
					if ($report['Project']['projecttype'] == 'по запросу')
						echo ', по запросу '.nl2br($report['Project']['namesolicitare']);
				?>
			</td>
			<td align="center"><?php echo $this->element('viewlink', array('viewlink'=>'/reports/view/'.$report['Report']['id']));?></td>
			<td align="center"><a href="/reports/view/<?php echo $report['Report']['id'];?>/pdf"><img src="/images/pdf.png" border="0" title="Скачать PDF"/></a></td>
			<td align="center"><img src="/images/returned.png"/></td>
			<td align="center"><a href="/reports/edit/<?php echo $report['Report']['id'];?>"><img src="/images/edit.png" border="0" title="Редактировать"/></a></td>
		</tr>
		<?php }?>
	</table>


	<div id="caption" class="red">Заключения на одобрение - <?php echo $countsenttoadmin;?></div>

	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="red">
		<tr>
			<th width="5">№</th>
			<th width="50">Номер заключения</th>
			<th align="left">Название заключения</th>
			<th width="50">Визуализация</th>
			<th width="50">PDF</th>
			<th width="50">Статус</th>
			<th width="50">Действие</th>
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
					echo 'Экспертное заключение по '.$projectname;
					if (substr($projectname, 0, 9) == 'проект') $projectname = substr($projectname, 9, strlen($projectname)-9);
					if ($report['Project']['projecttype'] == 'по запросу')
						echo ', по запросу '.nl2br($report['Project']['namesolicitare']);
				?>
			</td>
			<td align="center"><?php echo $this->element('viewlink', array('viewlink'=>'/reports/view/'.$report['Report']['id']));?></td>
			<td align="center"><a href="/reports/view/<?php echo $report['Report']['id'];?>/pdf"><img src="/images/pdf.png" border="0" title="Скачать PDF"/></a></td>
			<td align="center"><img src="/images/gone.png"/></td>
			<td align="center"><img src="/images/locked.png"/></td>
		</tr>
		<?php }?>
	</table>

	<div id="caption" class="red">Заключения с возможностью редактирования несколькими экспертами - <?php echo $countmultipleedit;?></div>

	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="red">
		<tr>
			<th width="5">№</th>
			<th width="50">Номер заключения</th>
			<th align="left">Название заключения</th>
			<th width="50">Визуализация</th>
			<th width="50">PDF</th>
			<th width="50">Редактировать</th>
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
					echo 'Экспертное заключение по '.$projectname;
					if (substr($projectname, 0, 9) == 'проект') $projectname = substr($projectname, 9, strlen($projectname)-9);
					if ($report['Project']['projecttype'] == 'по запросу')
						echo ', по запросу '.nl2br($report['Project']['namesolicitare']);
				?>
			</td>
			<td align="center"><?php echo $this->element('viewlink', array('viewlink'=>'/reports/view/'.$report['Report']['id']));?></td>
			<td align="center"><a href="/reports/view/<?php echo $report['Report']['id'];?>/pdf"><img src="/images/pdf.png" border="0" title="Скачать PDF"/></a></td>
			<td align="center"><a href="/reports/edit/<?php echo $report['Report']['id'];?>"><img src="/images/edit.png" border="0" title="Редактировать"/></a></td>
		</tr>
		<?php }?>
	</table>

	<div id="caption" class="green">Сохраненные заключения - <?php echo $countsaved;?></div>

	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="green">
		<tr>
			<th width="5">№</th>
			<th width="50">Номер заключения</th>
			<th align="left">Название заключения</th>
			<th width="50">Визуализация</th>
			<th width="50">PDF</th>
			<th width="50">Редактировать</th>
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
					echo 'Экспертное заключение по '.$projectname;
					if (substr($projectname, 0, 9) == 'проект') $projectname = substr($projectname, 9, strlen($projectname)-9);
					if ($report['Project']['projecttype'] == 'по запросу')
						echo ', по запросу '.nl2br($report['Project']['namesolicitare']);
				?>
			</td>
			<td align="center"><?php echo $this->element('viewlink', array('viewlink'=>'/reports/view/'.$report['Report']['id']));?></td>
			<td align="center"><a href="/reports/view/<?php echo $report['Report']['id'];?>/pdf"><img src="/images/pdf.png" border="0" title="Скачать PDF"/></a></td>
			<td align="center"><a href="/reports/edit/<?php echo $report['Report']['id'];?>"><img src="/images/edit.png" border="0" title="Редактировать"/></a></td>
		</tr>
		<?php }?>
	</table>

	<div id="caption" class="orange">Опубликованные заключения - <?php echo $countpublished;?></div>

	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="orange">
		<tr>
			<th width="5">№</th>
			<th width="50"><?php echo $paginator->sort('Номер заключения', 'Project.reportnumber', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'сортировка по Номеру заключения'));?></th>
			<th width="70"><?php echo $paginator->sort('Дата заключения', 'Report.reportdate', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'сортировка по Дате заключения'));?></th>
			<th align="left"><?php echo $paginator->sort('Название заключения', 'Project.name', array('update' => 'content', 'indicator' => 'spinner', 'title' => 'сортировка по Названию заключения'));?></th>
			<th width="50">Визуализация</th>
			<th width="50">PDF</th>
		</tr>
		<?php
		$i = intval($paginator->counter(array('format'=>'%start%')));
		foreach ($reportspublished as $report) {?>
		<tr valign="top">
			<td align="center"><?php echo $i.'.'; $i++;?></td>
			<td align="center"><?php echo $report['Project']['reportnumber'];?></td>
			<td><?php if ($report['Report']['reportdate'] != '') echo date('d-m-Y', strtotime($report['Report']['reportdate']));?></td>
			<td>
				<?php
					$projectname = $report['Project']['name'];
					echo 'Экспертное заключение по '.$projectname;
					if (substr($projectname, 0, 9) == 'проект') $projectname = substr($projectname, 9, strlen($projectname)-9);
					if ($report['Project']['projecttype'] == 'по запросу')
						echo ', по запросу '.nl2br($report['Project']['namesolicitare']);
				?>
			</td>
			<td align="center"><?php echo $this->element('viewlink', array('viewlink'=>'/reports/view/'.$report['Report']['id']));?></td>
			<td align="center"><a href="/reports/view/<?php echo $report['Report']['id'];?>/pdf"><img src="/images/pdf.png" border="0" title="Скачать PDF"/></a></td>
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
