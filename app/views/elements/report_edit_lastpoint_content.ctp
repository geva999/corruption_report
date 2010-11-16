<?php
	if (!isset($celemsacceptance)) $celemsacceptance = 0;
	if ($rowid % 2 == 0) $rowstyle = ' style="background-color: #e0e0e0;"';
	else $rowstyle = ' style="background-color: #f5f5f5;"';
	$rowidtext = 'row'.$rowid;
?>
<div id="<?php echo$rowidtext;?>" class="subreportrow">
	<?php
		if (isset($subreportid))
			echo $form->input('subraport.'.$rowid.'.Subreport.id', array('type'=>'hidden', 'value'=>$subreportid));
		else
			echo $form->input('subraport.'.$rowid.'.Subreport.id', array('type'=>'hidden'));
		echo $form->input('subraport.'.$rowid.'.Subreport.report_id', array('type'=>'hidden'));
		echo $form->input('subraport.'.$rowid.'.Subreport.expert_id', array('type'=>'hidden'));
		echo $form->input('subraport.'.$rowid.'.Subreport.todelete', array('type'=>'hidden', 'value'=>0));
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="2">
		<tr <?php echo $rowstyle;?>>
			<td valign="top"><?php echo ($rowid+1);?></td>
			<td>
				<div id="<?php echo $rowidtext;?>list">
					<ul>
						<li class="ui-tabs-nav-item"><a href="#<?php echo $rowidtext;?>body1">Articol</a></li>
						<li class="ui-tabs-nav-item"><a href="#<?php echo $rowidtext;?>body2">Text / Obiecţia / Elemente de coruptibilitate şi alte riscuri / Recomandarea</a></li>
						<div align="right">
							<span style="vertical-align:top"><?php if (($loginedexpertid == $this->data['Project']['expert_id'] || $isadmin == 1) && $multipleedit == 1) echo 'Creat de utilizatorul: '.$experts[$this->data['subraport'][$rowid]['Subreport']['expert_id']];?></span>
							<img src="/images/move.png" width="20" height="20" class="handle" title="Mută rînd"/>
							<img src="/images/delete.png" width="20" height="20" title="Şterge rînd" onclick="confirmDelete(<?php echo $rowid;?>);"/>
						</div>
					</ul>
					<div id="<?php echo $rowidtext;?>body1">
						<?php echo $form->input('subraport.'.$rowid.'.Subreport.articol', array('type'=>'text', 'label'=>false, 'size'=>'150'));?>
					</div>
					<div id="<?php echo $rowidtext;?>body2">
						<br/>Text<br/>
						<?php echo $form->textarea('subraport.'.$rowid.'.Subreport.text', array('class'=>'tinymceeditor'));?>
						<a href="javascript:void(0);" onclick="return toogletinymce('subraport<?php echo $rowid;?>SubreportText');">adaugă/şterge editor</a>
						<br/><br/>Obiecţia<br/>
						<?php echo $form->textarea('subraport.'.$rowid.'.Subreport.obiectia', array('class'=>'tinymceeditor'));?>
						<a href="javascript:void(0);" onclick="return toogletinymce('subraport<?php echo $rowid;?>SubreportObiectia');">adaugă/şterge editor</a>
						<br/><br/>
						<?php if ($celemsacceptance != 1) echo '<br/>Elemente de coruptibilitate<br/><br/>';?>
						<table id="elemente" width="98%" border="0" cellspacing="1" cellpadding="4">
						<?php if ($celemsacceptance == 1) echo '<tr><td>Elemente de coruptibilitate</td><td>Acceptate</td></tr>';?>
							<tr class="divcheckboxtohide">
								<td valign="top">
									<?php
										echo $form->input('subraport.'.$rowid.'.Celem.Celem', array(
													'type'=>'select',
													'multiple'=>'checkbox',
													'options'=>$celems,
													'label'=>false
										));
									?>
								</td>
								<?php
									if ($celemsacceptance == 1 & $pelems)
										echo '<td valign="top" width="40">'.$form->input('subraport.'.$rowid.'.Pelem.Pelem', array(
													'type'=>'select',
													'multiple'=>'checkbox',
													'options'=>$pelems,
													'label'=>false
											)).'</td>';
								?>
							</tr>
							<tr>
								<td align="center" <?php if ($isadmin ==1) echo ' colspan="2"';?>>
									<a href="javascript:void(0);" onclick="return showelements(<?php echo $rowid;?>);">vezi toate</a>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="javascript:void(0);" onclick="return hideelements(<?php echo $rowid;?>);">ascunde neselectate</a>
									<br/><br/>
									<a href="javascript:void(0);" onclick="return showdivelementecoruptibilitate(1);">vezi lista detaliată a elementelor de coruptibilitate</a>
									<br/>
									<a href="javascript:void(0);" onclick="return showdivelementecoruptibilitate(2);">vezi lista detaliată a altor elemente de coruptibilitate detectate de experţi</a>
								</td>
							</tr>
						</table>
						<br/><br/>Alte elemente<br/>
						<?php
							echo $form->textarea('subraport.'.$rowid.'.Subreport.alteelemente');
							if ($celemsacceptance == 1) echo $form->input('subraport.'.$rowid.'.Subreport.alteelementeacceptate', array('type'=>'checkbox', 'label'=>' acceptă alte elemente'));
						?>
						<br/>Alte riscuri<br/>
						<?php
							echo $form->textarea('subraport.'.$rowid.'.Subreport.alteriscuri');
							if ($celemsacceptance == 1) echo $form->input('subraport.'.$rowid.'.Subreport.alteriscuriacceptate', array('type'=>'checkbox', 'label'=>' acceptă alte riscuri'));
						?>
						<br/>Recomandarea<br/>
						<?php echo $form->textarea('subraport.'.$rowid.'.Subreport.recomandarea');?>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>