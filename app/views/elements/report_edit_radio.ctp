<?php
	if (!isset($trclass)) $trclass='';
	if (!isset($trstyle)) $trstyle='';
?>
<tr class="<?php echo $trclass;?>" style="<?php echo $trstyle;?>">
	<td width="100%"><?php echo $tdtext;?></td>
	<td width="1"><strong>DA</strong></td>
	<td width="1">
		<?php
			if ($this->data['Report'][$radioname] >0 ) $pvalue = $this->data['Report'][$radioname];
			else $pvalue = 0;
			echo $form->input('Report.'.$radioname, array(
						'class'=>'required_dependent',
						'legend' => false,
						'label' => false,
						'div' => false,
						'type' => 'radio',
						'separator' => '</td><td width="1"><strong>NU</strong></td><td width="1">',
						'options' => array('1'=>'','2'=>''),
						'value' => $pvalue
				));
		?>
	</td>
	<td class="green" NOWRAP align="left"></td>
</tr>