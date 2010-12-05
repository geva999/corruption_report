<?php
	$projecttype = $this->data['Project']['projecttype'];
	$pointdigit = 1;
	$projectname = $this->data['Project']['name'];
?>
<?php echo $this->element('top_menu', array('top_menu_title'=>'Администрирование заключений'));?>
<div id="line">
	<?php echo $this->element('backlink_menu', array('backlink'=>$backlink, 'backlinktitle'=>'Назад к списку заключений'));?>
</div>

<div id="listcontent" style="color: black;">

<br/>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="900">
	<tr>
		<td>
			<?php echo $template['Template']['header'];?>
			<br/><br/>
		</td>
	</tr>
	<tr>
		<td>
			<span><?php echo $this->data['Report']['reportdatetext'];?>, №. <?php echo $this->data['Project']['reportnumber'];?></span>
			<h1 align="center">ЭКСПЕРТНОЕ ЗАКЛЮЧЕНИЕ</h1>
			<h3 align="center">по <?php echo $projectname;?></h3>
			<?php
				if (substr($projectname, 0, 7) == 'проекту') $projectname = substr($projectname, 7, strlen($projectname)-7);
				if ($projecttype == 'проект закона')
					echo '<p align="center" class="evidentiat">(зарегистрированный в Парламенте под номером '.
            $this->data['Project']['projectnumber'].
						' от '.$this->data['Project']['projectdatetext'].')</p>'.
						'<p>В соответствии с Концепцией сотрудничества между Парламентом и гражданским обществом, '.
						'утвержденной Постановлением Парламента №373-XVI от 29 декабря 2005 г., '.
						'Фонд Евразия Центральной Азии представляет экспертное заключение о коррупциогенности проекта '.
						nl2br($projectname).'.</p>';
				else
          echo '<p align="center">По запросу '.nl2br($this->data['Project']['namesolicitare']).'</p>';
			?>

			<br/><br/>
			<h2>Общая оценка</h2>
			<?php
				if ($projecttype == 'проект закона') {
					echo '<br/><p><span class="h3">1. Автором законодательной инициативы</span> является '.
            $this->data['Project']['initiative'];
					if ($this->data['Project']['initiative'] == 'Правительство')
            echo ', непосредственный автор - '.$author;
					echo ', что соответствует ст. 73 Конституции и ст. 44 Регламента Парламента.</p>'.
						'<br/><p><span class="h3">2. Категория предложенного законодательного акта</span> является '.
						$this->data['Report']['p02list1'].', что '.$this->data['Report']['p02list2'].
						' ст. 72 Конституции и ст. 6-11, 27, 35 и 39 Закона о законодательных актах, №780-XV от 27.12.2001. '.
						nl2br($this->data['Report']['p02text1']).'</p>';
					$pointdigit = 3;
				}
			?>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Цель продвижения проекта</span>
        <?php echo nl2br($this->data['Report']['p04text1']);?>
			</p>

			<br/><br/>
			<h2>Обоснование проекта</h2>

			<?php
				if ($projecttype == 'проект закона') {
					echo '<p><span class="h3">'.$pointdigit.'. '.
						'Пояснительная записка</span> проекта законодательного акта, подвергнутого экспертизе '.
            $this->data['Report']['p05list1'].'.</p>'.
						'<p>Считаем, что таким образом Парламент ';
					if ($this->data['Report']['p05list1'] == 'опубликована на сайте Парламента')
            echo 'соблюдает';
					elseif ($this->data['Report']['p05list1'] == 'не опубликована на сайте Парламента')
            echo 'не соблюдает';
					echo ' принцип прозрачности законодательного процесса и принципы сотрудничества с гражданским обществом.</p>'.
            '<p>'.nl2br($this->data['Report']['p05text1']).'</p>';
					$pointdigit++;
				}
			?>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Достаточность обоснования.</span>
        <?php echo nl2br($this->data['Report']['p07text1']);?>
			</p>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Соответствие законодательству Сообщества и другим международным стандартам.</span>
        <?php echo nl2br($this->data['Report']['p08text1']);?>
			</p>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Финансово-экономическое обоснование.</span>
        <?php echo nl2br($this->data['Report']['p09text1']);?>
			</p>

			<?php
				if ($this->data['Project']['reportimpact'] == 1) {
					echo '<br/><p><span class="h3">'.$pointdigit.'. Согласование с аккредитованными объединениями субъектов частного предпринимательства.</span> '.
            nl2br($this->data['Report']['p10text1']).'</p>';
					$pointdigit++;
				}
			?>

			<br/><br/>
			<h2>Оценка коррупциогенности по существу</h2>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Установление и продвижение интересов/выгод.</span>
        <?php echo nl2br($this->data['Report']['p11text1']);?>
			</p>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Ущерб, нанесенный применением акта.</span>
        <?php echo nl2br($this->data['Report']['p12text1']);?>
			</p>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Соответствие проекта положениям национального законодательства.</span>
        <?php echo nl2br($this->data['Report']['p13text1']);?>
			</p>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Лингвистические формулировки положений проекта.</span>
        <?php echo nl2br($this->data['Report']['p14text1']);?>
			</p>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Регулирование деятельности государственных органов.</span>
        <?php echo nl2br($this->data['Report']['p15text1']);?>
			</p>

			<br/>
			<?php
				if (!empty($subreports)) {
			?>
					<p class="h3"><?php echo $pointdigit.'. ';?>Подробный анализ потенциально коррупциогенных положений проекта.</p>
					<div id="rowsdiv">
						<br/>
						<table align="center" bgcolor="#d4d0c8" border="1" bordercolor="#ffffff" cellpadding="5" cellspacing="0">
							<tr valign="top">
								<td bgcolor="#c0c0c0" width="30" align="center"><strong>№</strong></td>
								<td bgcolor="#dfdfdf" width="60" align="center"><strong>Статья</strong></td>
								<td bgcolor="#c0c0c0" width="120" align="center"><strong>Текст</strong></td>
								<td bgcolor="#dfdfdf" width="220" align="center"><strong>Замечание</strong></td>
								<td bgcolor="#c0c0c0" width="180" align="center"><strong>Элементы коррупциогенности и другие риски</strong></td>
								<td bgcolor="#dfdfdf" width="120" align="center"><strong>Рекомендация</strong></td>
							</tr>
							<?php
								$rowid=1;
								foreach ($subreports as $tempsubreportkey => $tempsubreportvalue) {
									echo '<tr align="left" valign="top"><td bgcolor="#c0c0c0"><p>'.($rowid).'</p></td>'.
										'<td bgcolor="#dfdfdf"><p>'.$tempsubreportvalue['Subreport']['articol'].'</p></td>'.
										'<td bgcolor="#c0c0c0"><p>'.$tempsubreportvalue['Subreport']['text'].'</p></td>'.
										'<td bgcolor="#dfdfdf"><p>'.$tempsubreportvalue['Subreport']['obiectia'].'</p></td>'.
										'<td bgcolor="#c0c0c0"><p>';
											if (!empty($tempsubreportvalue['Celem']) || !empty($tempsubreportvalue['Subreport']['alteelemente'])) {
												echo '<strong><em>Коррупциогенность</em></strong><br/>';
												foreach ($tempsubreportvalue['Celem'] as $tempcelemkey => $tempcelemvalue) {
													echo $tempcelemvalue['name'].'<br/>';
												}
												if (!empty($tempsubreportvalue['Subreport']['alteelemente']))
													echo nl2br($tempsubreportvalue['Subreport']['alteelemente']).'<br/>';
												echo '<br/>';
											}
											if (!empty($tempsubreportvalue['Subreport']['alteriscuri']))
												echo '<strong>Другие риски</strong><br/>'.nl2br($tempsubreportvalue['Subreport']['alteriscuri']);
										echo '</p></td>'.
										'<td bgcolor="#dfdfdf"><p>'.nl2br($tempsubreportvalue['Subreport']['recomandarea']).'</p></td></tr>';
									$rowid++;
								}
							?>
						</table>
					</div>
					<br/><br/>
			<?php
				}
				echo nl2br($this->data['Report']['simplesubreport']);
			?>

			<br/><br/>
			<h2>Выводы</h2>
			<p><?php echo nl2br($this->data['Report']['concluzii']);?></p>

			<br/><br/>
			<p align="right"><font size=2><b>Фонд Евразия Центральной Азии</b></font></p>

			<?php
				if (!empty($this->data['Attachment'])) {
			?>
					<br/><br/>
					<h2>Приложения</h2>
					<p>
						<table cellpadding="5" cellspacing="0" border="0" width="100%">
						<?php
							foreach ($this->data['Attachment'] as $attachment) {
								echo '<tr><td>';
								if ($attachment['filename'] != '')
									echo $html->link($attachment['name'], '/uploaded/annexes/'.$attachment['filename']).' - '.
									$html->link($attachment['filename'], '/uploaded/annexes/'.$attachment['filename']);
								else
                  echo $attachment['name'].' - Не существует файла для данного приложения';
								echo '</td></tr>';
							}
						?>
						</table>
					</p>
			<?php }?>
		</td>
	</tr>
	<tr>
		<td>
			<br/><br/>
			<small><?php echo $template['Template']['footer'];?></small>
		</td>
	</tr>
</table>
<br/>
<div align="center"><?php echo $this->element('backlink', array('backlink'=>$backlink, 'backlinktitle'=>'Назад к списку заключений'));?></div>
<br/>
</div>