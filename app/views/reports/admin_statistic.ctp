<?php echo $this->element('top_menu', array('top_menu_title'=>'Статистика'));?>

<div id="line">
	<?php echo $this->element('admin_menu');?>
</div>

<div id="listcontent" style="color: black;">

	<div align="center">
		<?php echo $form->create('Report', array('id'=>'ReportStatisticForm', 'action'=>'statistic'));?>
		<table cellpadding="5" cellspacing="0" border="0">
			<tr>
				<td rowspan="4">Criterii de filtrare a statisticii :</td>
				<?php
					echo '<td>'.$form->input('Project.projectstate', array(
								'label'=>'Statutul proiectului: ',
								'div'=>false,
								'empty'=>'toate',
								'options'=>array(2=>'Adoptat', 3=>'Retras'))).'</td>'.
						'<td>'.$form->input('Project.projecttype', array(
								'label'=>'Tipul proiectului: ',
								'div'=>false,
								'empty'=>'toate',
								'options'=>array('проект закона'=>'проект закона', 'по запросу'=>'по запросу'))).'</td>'.
						'<td rowspan="4">'.$ajax->submit('Filtrare', array('div'=>false, 'update'=>'content', 'indicator'=>'spinner')).'</td>'.
						'<tr><td colspan="2">Perioada de afişare - '.$form->input('Report.date1text', array('label'=>'&nbsp;&nbsp;&nbsp;de la: ', 'div'=>false, 'size'=>'17', 'maxlength'=>'18', 'readonly'=>'readonly')).
						$form->hidden('Report.date1').
						$form->input('Report.date2text', array('label'=>'&nbsp;&nbsp;&nbsp;pînă la: ', 'div'=>false, 'size'=>'17', 'maxlength'=>'18', 'readonly'=>'readonly')).
						$form->hidden('Report.date2').'</td></tr>'.
						'<tr><td>'.$form->input('Project.expert_id', array('empty'=>'toţi', 'label'=>'Nume expert: ', 'div'=>false)).'</td>'.
						'<td>'.$form->input('Report.p06radio1', array(
								'label'=>'Respectarea termenului de cooperare cu societatea civilă: ',
								'div'=>false,
								'empty'=>'toate',
								'options'=>array(1=>'da', 2=>'nu'))).
						'</td></tr><tr><td>'.$form->input('Project.initiative', array(
								'label'=>'Iniţiativa legislativă: ',
								'div'=>false,
								'empty'=>'toţi',
								'options'=>array(	'Правительство'=>'Правительство',
													'deputaţi în Parlament'=>'deputaţi în Parlament',
													'Preşedintele RM'=>'Preşedintele RM',
													'Adunarea Populară a UTA Gagauzia'=>'Adunarea Populară a UTA Gagauzia'))).
						'</td><td>'.$form->input('Project.author_id', array('empty'=>'toţi', 'label'=>'Autor nemijlocit al proiectului: ', 'div'=>false)).'</td></tr>';
				?>
			</tr>
		</table>
		<?php echo $form->end();?>
	</div>
	<div id="spinner" style="display: none; text-align: center;"><br/><img src="/img/loadinganimation.gif"/><br/></div>

	<br/>
	<div id="caption" class="red" align="center">Statutul proiectelor expertizate</div>
	<?php
		echo $this->element('admin_statistic_projects', array('statistic'=>$statisticprojectsall));
	?>
	<br/><br/>

	<div id="caption" class="red" align="center">Volum de lucru experţi</div>
	<?php
		echo $this->element('admin_statistic_experts', array('statistic'=>$statisticexpertsauthors, 'experts'=>$experts));
	?>
	<br/><br/>

	<div id="caption" class="red" align="center">Autori ai iniţiativelor legislative ai proiectelor supuse expertizei anticorupţie</div>
	<?php
		echo $this->element('admin_statistic_initiative_bydomain', array('statistic'=>$statisticexpertsauthors['проект закона']));
	?>
	<br/><br/>

	<div id="caption" class="red" align="center">Autori nemijlociţi ai proiectelor supuse expertizei anticorupţie</div>
	<?php
		echo $this->element('admin_statistic_authors', array('statistic'=>$statisticexpertsauthors, 'authors'=>$authors));
	?>
	<br/><br/>

	<div id="caption" class="red" align="center">Evaluarea generală, fundamentarea şi evaluarea de fond a coruptibilităţii (toate rapoartele)</div>
	<?php
		echo $this->element('admin_statistic_reports', array('statistic'=>$statisticreportsall));
	?>
	<br/><br/>

	<div id="caption" class="red" align="center">Răspîndirea elementelor de coruptibilitate în proiecte – ponderea, frecvenţa elementelor de coruptibilitate în proiecte, ponderea fiecărui element în categoria sa (toate proiectele expertizate - <?php echo $statisticelementsall['total_reports'];?>)</div>
	<?php
		echo $this->element('admin_statistic_elements_all', array('statistic'=>$statisticelementsall, 'elemgroups'=>$celemgroups, 'elems'=>$celems));
	?>
	<br/><br/>

	<div id="caption" class="red" align="center">Eficienţa obiecţiilor referitoare la coruptiblilitate pe domenii de expertiză (din rapoartele la proiectele adoptate sau retrase - <?php echo $statisticelementsefficiency['total_reports'];?>)</div>
	<?php
		echo $this->element('admin_statistic_elements_efficiency', array('statistic'=>$statisticelementsefficiency, 'elemgroups'=>$celemgroups, 'elems'=>$celems));
	?>
	<br/><br/>

	<div id="caption" class="red" align="center">Lista rapoartelor la proiectele adoptate în care au fost acceptate elemente de coruptibilitate</div>
	<?php
		echo $this->element('admin_statistic_pelems', array('statistic'=>$statisticpelems, 'elemgroups'=>$celemgroups, 'elems'=>$celems));
	?>
	<br/><br/>
	<?php echo $this->element('sponsor');?>

</div>

<?php echo $this->element('admin_statistic_js');?>