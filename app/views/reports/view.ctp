<?php
	$projecttype = $this->data['Project']['projecttype'];
	$pointdigit = 1;
	$projectname = $this->data['Project']['name'];
?>
<?php echo $this->element('top_menu', array('top_menu_title'=>'Rapoarte online'));?>
<div id="line">
	<?php echo $this->element('backlink_menu', array('backlink'=>$backlink, 'backlinktitle'=>'Înapoi la listă rapoarte'));?>
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
			<span><?php echo $this->data['Report']['reportdatetext'];?>, nr. <?php echo $this->data['Project']['reportnumber'];?></span>
			<h1 align="center">RAPORT DE EXPERTIZĂ</h1>
			<h3 align="center">la <?php echo $projectname;?></h3>
			<?php
				if (substr($projectname, 0, 9) == 'proiectul') $projectname = substr($projectname, 9, strlen($projectname)-9);
				if ($projecttype == 'proiect de lege')
					echo	'<p align="center" class="evidentiat">(înregistrat în Parlament cu numărul '.$this->data['Project']['projectnumber'].
							' din '.$this->data['Project']['projectdatetext'].')</p>'.
							'<p>În temeiul Concepţiei de cooperare dintre Parlament şi societatea civilă, '.
							'aprobată prin Hotărîrea Parlamentului nr.373-XVI din 29 decembrie 2005, '.
							'Centrul de Analiză şi Prevenire a Corupţiei prezintă raportul de expertiză a coruptibilităţii proiectului '.
							nl2br($projectname).'.</p>';
				else echo	'<p align="center">La solicitarea '.nl2br($this->data['Project']['namesolicitare']).'</p>';
			?>

			<br/><br/>
			<h2>Evaluarea generală</h2>
			<?php
				if ($projecttype == 'proiect de lege') {
					echo	'<br/><p><span class="h3">1. Autor al iniţiativei legislative</span> este '.$this->data['Project']['initiative'];
					if ($this->data['Project']['initiative'] == 'Guvernul RM') echo ', autor nemijlocit - '.$author;
					echo ', ceea ce corespunde art. 73 din Constituţie şi art. 44 din Regulamentul Parlamentului.</p>'.
							'<br/><p><span class="h3">2. Categoria actului legislativ</span> propus este '.
							$this->data['Report']['p02list1'].', ceea ce '.$this->data['Report']['p02list2'].
							' art.72 din Constituţie şi art. 6-11, 27, 35 şi 39 din Legea privind actele legislative, nr.780-XV din 27.12.2001. '.
							nl2br($this->data['Report']['p02text1']).'</p>';
					$pointdigit = 3;
				}
			?>

			<?php
				if ($this->data['Project']['reporttrasnparenta'] == 1) {
					echo '<br/><p><span class="h3">'.$pointdigit.'. Transparenţa decizională</span> '.nl2br($this->data['Report']['p03text1']).'</p>';
					$pointdigit++;
				}
			?>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Scopul promovării proiectului</span> <?php echo nl2br($this->data['Report']['p04text1']);?>
			</p>

			<br/><br/>
			<h2>Fundamentarea proiectului</h2>

			<?php
				if ($projecttype == 'proiect de lege') {
					echo '<p><span class="h3">'.$pointdigit.'. '.
						'Nota informativă</span> a proiectului de act legislativ supus expertizei '.$this->data['Report']['p05list1'].'.</p>'.
						'<p>Considerăm că în acest fel Parlamentul ';
					if ($this->data['Report']['p05list1'] == 'este plasată pe site-ul Parlamentului') echo 'respectă';
						elseif ($this->data['Report']['p05list1'] == 'nu este plasată pe site-ul Parlamentului') echo 'nu respectă';
					echo ' principiul transparenţei procesului legislativ şi principiile de cooperare cu societatea civilă.</p>'.
					'<p>'.nl2br($this->data['Report']['p05text1']).'</p>';
					$pointdigit++;
				}

				if ($this->data['Project']['reportrespectaretermen'] == 1) {
					echo '<br/><p><span class="h3">'.$pointdigit.'. Respectarea termenului de cooperare cu societatea civilă</span> '.nl2br($this->data['Report']['p06text1']).'</p>';
					$pointdigit++;
				}
			?>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Suficienţa argumentării.</span> <?php echo nl2br($this->data['Report']['p07text1']);?>
			</p>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Compatibilitatea cu legislaţia comunitară şi alte standarde internaţionale.</span> <?php echo nl2br($this->data['Report']['p08text1']);?>
			</p>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Fundamentarea economico-financiară.</span> <?php echo nl2br($this->data['Report']['p09text1']);?>
			</p>

			<?php
				if ($this->data['Project']['reportimpact'] == 1) {
					echo '<br/><p><span class="h3">'.$pointdigit.'. Analiza impactului de reglementare a proiectului.</span> '.nl2br($this->data['Report']['p10text1']).'</p>';
					$pointdigit++;
				}
			?>

			<br/><br/>
			<h2>Evaluarea de fond a coruptibilităţii</h2>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Stabilirea şi promovarea unor interese/beneficii.</span> <?php echo nl2br($this->data['Report']['p11text1']);?>
			</p>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Prejudicii aduse prin aplicarea actului.</span> <?php echo nl2br($this->data['Report']['p12text1']);?>
			</p>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Compatibilitatea proiectului cu prevederile legislaţiei naţionale.</span> <?php echo nl2br($this->data['Report']['p13text1']);?>
			</p>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Formularea lingvistică a prevederilor proiectului.</span> <?php echo nl2br($this->data['Report']['p14text1']);?>
			</p>

			<br/>
			<p>
				<span class="h3"><?php echo $pointdigit.'. '; $pointdigit++;?>Reglementarea activităţii autorităţilor publice.</span> <?php echo nl2br($this->data['Report']['p15text1']);?>
			</p>

			<br/>
			<?php
				if (!empty($subreports)) {
			?>
					<p class="h3"><?php echo $pointdigit.'. ';?>Analiza detaliată a prevederilor potenţial coruptibile.</p>
					<div id="rowsdiv">
						<br/>
						<table align="center" bgcolor="#d4d0c8" border="1" bordercolor="#ffffff" cellpadding="5" cellspacing="0">
							<tr valign="top">
								<td bgcolor="#c0c0c0" width="30" align="center"><strong>Nr.</strong></td>
								<td bgcolor="#dfdfdf" width="60" align="center"><strong>Articol</strong></td>
								<td bgcolor="#c0c0c0" width="120" align="center"><strong>Text</strong></td>
								<td bgcolor="#dfdfdf" width="220" align="center"><strong>Obiecţia</strong></td>
								<td bgcolor="#c0c0c0" width="180" align="center"><strong>Elemente de coruptibilitate şi alte riscuri</strong></td>
								<td bgcolor="#dfdfdf" width="120" align="center"><strong>Recomandarea</strong></td>
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
												echo '<strong><em>Coruptibilitate</em></strong><br/>';
												foreach ($tempsubreportvalue['Celem'] as $tempcelemkey => $tempcelemvalue) {
													echo $tempcelemvalue['name'].'<br/>';
												}
												if (!empty($tempsubreportvalue['Subreport']['alteelemente']))
													echo nl2br($tempsubreportvalue['Subreport']['alteelemente']).'<br/>';
												echo '<br/>';
											}
											if (!empty($tempsubreportvalue['Subreport']['alteriscuri']))
												echo '<strong>Alte riscuri</strong><br/>'.nl2br($tempsubreportvalue['Subreport']['alteriscuri']);
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
			<h2>Concluzii</h2>
			<p><?php echo nl2br($this->data['Report']['concluzii']);?></p>

			<br/><br/>
			<p align="right"><font size=2><b>Centrul de Analiză şi Prevenire a Corupţiei</b></font></p>

			<?php
				if (!empty($this->data['Attachment'])) {
			?>
					<br/><br/>
					<h2>Anexe</h2>
					<p>
						<table cellpadding="5" cellspacing="0" border="0" width="100%">
						<?php
							foreach ($this->data['Attachment'] as $attachment) {
								echo '<tr><td>';
								if ($attachment['filename'] != '')
									echo $html->link($attachment['name'], '/uploaded/annexes/'.$attachment['filename']).' - '.
									$html->link($attachment['filename'], '/uploaded/annexes/'.$attachment['filename']);
								else echo $attachment['name'].' - Nu exista fişier pentru această anexă';
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
<div align="center"><?php echo $this->element('backlink', array('backlink'=>$backlink, 'backlinktitle'=>'Înapoi la listă rapoarte'));?></div>
<br/>
</div>