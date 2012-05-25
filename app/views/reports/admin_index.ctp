<?php echo $this->element('top_menu', array('top_menu_title'=>'Администрирование заключений'));?>

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
                'все'=>'',
								'в процессе расмотрения администратором'=>'рассмотрение',
								'опубликованные с размещением на сайте'=>'опубликованные',
								'по принятым проекта'=>'принятые',
								'редактированные несколькими экспертами'=>'несколькоэкспертов');
							echo '<tr><td>Заключения:</td>';
							foreach ($links as $linktitle=>$linkaction)
								echo '<td>'.$html->link($linktitle, '/admin/reports/index/'.$linkaction).'</td>';
							echo '</tr>';
						?>
					</table>
				</td>
				<td align="right" valign="top">
					<?php
						echo $form->create('Report', array('action'=>'index')).
							$form->input('Project.searchtype', array('label'=>'Критерии поиска: ', 'div'=>false, 'options'=>array(1=>'№ заключения', 2=>'№ проекта', 3=>'название проекта'))).
							$form->input('Project.search', array('label'=>false, 'div'=>false)).
							$form->submit('Поиск', array('div'=>false)).
							$form->end();
					?>
				</td>
			</tr>
		</table>
	</div>

	<div id="caption" class="red"><?php echo $viewtext.' - '.$countreports;?></div>

	<?php $paginator->options(array('url'=>$action));?>

	<table width="100%" border="0" cellspacing="1" cellpadding="5" id="orange">
		<tr>
			<th width="5">№</th>
			<th width="50"><?php echo $paginator->sort('Номер заключения', 'Project.reportnumber', array('title'=>'сортировка по Номеру заключения'));?></th>
			<th width="70"><?php echo $paginator->sort('Дата заключения', 'Report.reportdate', array('title'=>'сортировка по Дате заключения'));?></th>
			<th align="left"><?php echo $paginator->sort('Название заключения', 'Project.name', array('title'=>'сортировка по Названию заключения'));?></th>
			<th width="200">Эксперт</th>
			<th width="50">Визуализация</th>
			<th width="50">PDF</th>
			<th width="50">Редактирование</th>
		</tr>
		<?php
		$i = intval($paginator->counter(array('format'=>'%start%')));
		foreach ($reports as $report) {?>
		<tr valign="top">
			<td align="center"><?php echo $i.'.'; $i++;?></td>
			<td align="center"><?php echo $report['Project']['reportnumber'];?></td>
			<td><?php if ($report['Report']['reportdate'] != '0000-00-00') echo date('d-m-Y', strtotime($report['Report']['reportdate']));?></td>
			<td>
				<?php
					$projectname = $report['Project']['name'];
					echo 'Экспертное заключение по '.$projectname;
					if (substr($projectname, 0, 9) == 'проект') $projectname = substr($projectname, 9, strlen($projectname)-9);
					if ($report['Project']['projecttype'] == 'по запросу')
						echo ', по запросу '.nl2br($report['Project']['namesolicitare']);
				?>
			</td>
			<td><?php echo $experts[$report['Project']['expert_id']];?></td>
			<td align="center"><?php echo $this->element('viewlink', array('viewlink'=>'/reports/view/'.$report['Report']['id']));?></td>
			<td align="center"><a href="/reports/view/<?php echo $report['Report']['id'];?>/pdf"><img src="/images/pdf.png" border="0" title="Скачать PDF"/></a></td>
			<td align="center"><a href="/reports/edit/<?php echo $report['Report']['id'];?>"><img src="/images/edit.png" border="0" title="Редактировать"/></a></td>
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
