<?php
	$safeMode = ( @ini_get("safe_mode") == 'On' || @ini_get("safe_mode") === 1 ) ? TRUE : FALSE;
	if ( $safeMode === FALSE ) {
		set_time_limit(300); // Sets maximum execution time to 5 minutes (300 seconds)
		ini_set("max_execution_time", "300"); // this does the same as "set_time_limit(300)"
	}

	App::import('Vendor','mytcpdf');
	$pdf = new MYTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor("www.capc.md");
	$pdf->SetTitle("www.capc.md");

	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH);

	//set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	//set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	//set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	//set some language-dependent strings
	$l = Array();
	// PAGE META DESCRIPTORS --------------------------------------
	$l['a_meta_charset'] = "UTF-8";
	$l['a_meta_dir'] = "ltr";
	$l['a_meta_language'] = "en";
	// TRANSLATIONS --------------------------------------
	$l['w_page'] = "page";
	$pdf->setLanguageArray($l);

	$pdf->xfootertext = $template['Template']['footerpdf'];

	//initialize document
	$pdf->AliasNbPages();

	// add a page
	$pdf->AddPage();

	// ---------------------------------------------------------

	$pdf->SetTextColor(0);
	$pdf->SetFont('arial', '', 11);

	$pdf->writeHTML($template['Template']['headerpdf'], true, 0, true, 0);

	$projecttype = $this->data['Project']['projecttype'];
	$pointdigit = 1;
	$projectname = $this->data['Project']['name'];

	$htmlcontent = ''.$this->data['Report']['reportdatetext'].', nr. '.$this->data['Project']['reportnumber'].'<br/>';
	$htmlcontent = $htmlcontent.'<h1 style="color: #CC0000; text-align: center;">RAPORT DE EXPERTIZĂ</h1>';
	$htmlcontent = $htmlcontent.'<h3 align="center">la '.nl2br($projectname).'</h3>';
	if (substr($projectname, 0, 9) == 'proiectul') $projectname = substr($projectname, 9, strlen($projectname)-9);
	if ($projecttype == 'proiect de lege')
		$htmlcontent = $htmlcontent.'<p align="center">(înregistrat în Parlament cu numărul '.$this->data['Project']['projectnumber'].
			' din '.$this->data['Project']['projectdatetext'].')</p>'.
			'<p>În temeiul Concepţiei de cooperare dintre Parlament şi societatea civilă, '.
			'aprobată prin Hotărîrea Parlamentului nr.373-XVI din 29 decembrie 2005, '.
			'Centrul de Analiză şi Prevenire a Corupţiei prezintă raportul de expertiză a coruptibilităţii proiectului '.
			nl2br($projectname).'.</p>';
	else $htmlcontent = $htmlcontent.'<p align="center">La solicitarea '.nl2br($this->data['Project']['namesolicitare']).'</p>';

	$pdf->writeHTML($htmlcontent, true, 0, true, 0);

	$htmlcontent = '<br><h2 align="center" color="#ff6600">Evaluarea generală</h2>';
	if ($projecttype == 'proiect de lege') {
		$htmlcontent = $htmlcontent.'<p><strong>1. Autor al iniţiativei legislative </strong> este '.$this->data['Project']['initiative'];
		if ($this->data['Project']['initiative'] == 'Guvernul RM') $htmlcontent = $htmlcontent.', autor nemijlocit - '.$author;
		$htmlcontent = $htmlcontent.', ceea ce corespunde art. 73 din Constituţie şi art. 44 din Regulamentul Parlamentului.</p>'.
			'<p><strong>2. Categoria actului legislativ</strong> propus este '.$this->data['Report']['p02list1'].
			', ceea ce '.$this->data['Report']['p02list2'].' art.72 din Constituţie şi art. 6-11, 27, 35 şi 39 din Legea privind actele legislative, nr.780-XV din 27.12.2001. '.
			nl2br($this->data['Report']['p02text1']).'</p>';
		$pointdigit = 3;
	}

	if ($this->data['Project']['reporttrasnparenta'] == 1) {
		$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Transparenţa decizională</strong> '.nl2br($this->data['Report']['p03text1']).'</p>';
		$pointdigit++;
	}

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Scopul promovării proiectului.</strong> '.nl2br($this->data['Report']['p04text1']).'</p>';
	$pointdigit++;

	$pdf->writeHTML($htmlcontent, true, 0, true, 0);

	$htmlcontent = '<br><h2 align="center" color="#ff6600">Fundamentarea proiectului</h2>';

	if ($projecttype == 'proiect de lege') {
		$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Nota informativă</strong> a proiectului de act legislativ supus expertizei '.$this->data['Report']['p05list1'].'.</p>'.
			'<p>Considerăm că în acest fel Parlamentul ';
		if ($this->data['Report']['p05list1'] == 'este plasată pe site-ul Parlamentului') $htmlcontent = $htmlcontent.'respectă';
			elseif ($this->data['Report']['p05list1'] == 'nu este plasată pe site-ul Parlamentului') $htmlcontent = $htmlcontent.'nu respectă';
		$htmlcontent = $htmlcontent.' principiul transparenţei procesului legislativ şi principiile de cooperare cu societatea civilă.</p>'.
			'<p>'.nl2br($this->data['Report']['p05text1']).'</p>';
		$pointdigit++;
	}

	if ($this->data['Project']['reportrespectaretermen'] == 1) {
		$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Respectarea termenului de cooperare cu societatea civilă</strong> '.nl2br($this->data['Report']['p06text1']).'</p>';
		$pointdigit++;
	}

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Suficienţa argumentării.</strong> '.nl2br($this->data['Report']['p07text1']).'</p>';
	$pointdigit++;

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Compatibilitatea cu legislaţia comunitară şi alte standarde internaţionale.</strong> '.nl2br($this->data['Report']['p08text1']).'</p>';
	$pointdigit++;

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Fundamentarea economico-financiară.</strong> '.nl2br($this->data['Report']['p09text1']).'</p>';
	$pointdigit++;

	if ($this->data['Project']['reportimpact'] == 1) {
		$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Analiza impactului de reglementare a proiectului.</strong> '.nl2br($this->data['Report']['p10text1']).'</p>';
		$pointdigit++;
	}

	$pdf->writeHTML($htmlcontent, true, 0, true, 0);

	$htmlcontent = '<br><h2 align="center" color="#ff6600">Evaluarea de fond a coruptibilităţii</h2>';

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Stabilirea şi promovarea unor interese/beneficii.</strong> '.nl2br($this->data['Report']['p11text1']).'</p>';
	$pointdigit++;

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Prejudicii aduse prin aplicarea actului.</strong> '.nl2br($this->data['Report']['p12text1']).'</p>';
	$pointdigit++;

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Compatibilitatea proiectului cu prevederile legislaţiei naţionale.</strong> '.nl2br($this->data['Report']['p13text1']).'</p>';
	$pointdigit++;

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Formularea lingvistică a prevederilor proiectului.</strong> '.nl2br($this->data['Report']['p14text1']).'</p>';
	$pointdigit++;

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Reglementarea activităţii autorităţilor publice.</strong> '.nl2br($this->data['Report']['p15text1']).'</p>';
	$pointdigit++;

	$pdf->writeHTML($htmlcontent, true, 0, true, 0);

	$htmlcontent = '<p></p>';

	if (!empty($subreports)) {
		$htmlcontent = '<p></p><p><strong>'.$pointdigit.'. Analiza detaliată a prevederilor potenţial coruptibile.</strong></p>';

		$pdf->writeHTML($htmlcontent, true, 0, true, 0);

		$htmlcontent = '<br/><table align="center" border="0" cellpadding="5" cellspacing="1">'.
				'<tr valign="top">
				 <td bgcolor="#dadada" width="15" align="center"><strong>Nr.</strong></td>'.
				'<td bgcolor="#e4e4e4" width="50" align="center"><strong>Articol</strong></td>'.
				'<td bgcolor="#dadada" width="85" align="center"><strong>Text</strong></td>'.
				'<td bgcolor="#e4e4e4" width="140" align="center"><strong>Obiecţia</strong></td>'.
				'<td bgcolor="#dadada" width="140" align="center"><strong>Elemente de coruptibilitate şi alte riscuri</strong></td>'.
				'<td bgcolor="#e4e4e4" width="85" align="center"><strong>Recomandarea</strong></td></tr>';
		$rowid=1;
		foreach ($subreports as $tempsubreportkey => $tempsubreportvalue) {
			$htmlcontent = $htmlcontent.'<tr align="left">
					 <td bgcolor="#e2e2e2" width="15" valign="top"><p>'.$rowid.'</p></td>'.
					'<td bgcolor="#ececec" width="50" valign="top"><p>'.$tempsubreportvalue['Subreport']['articol'].'</p></td>'.
					'<td bgcolor="#e2e2e2" width="85" valign="top">'.$tempsubreportvalue['Subreport']['text'].'</td>'.
					'<td bgcolor="#ececec" width="140" valign="top">'.$tempsubreportvalue['Subreport']['obiectia'].'</td>'.
					'<td bgcolor="#e2e2e2" width="140" valign="top"><p>';
			if (!empty($tempsubreportvalue['Celem']) || !empty($tempsubreportvalue['Subreport']['alteelemente'])) {
				$htmlcontent = $htmlcontent.'<strong><em>Coruptibilitate</em></strong><br/>';
				foreach ($tempsubreportvalue['Celem'] as $tempcelemkey => $tempcelemvalue) {
					$htmlcontent = $htmlcontent.$tempcelemvalue['name'].'<br/>';
				}
				if (!empty($tempsubreportvalue['Subreport']['alteelemente']))
					$htmlcontent = $htmlcontent.nl2br($tempsubreportvalue['Subreport']['alteelemente']).'<br/>';
				$htmlcontent = $htmlcontent.'<br/>';
			}
			if (!empty($tempsubreportvalue['Subreport']['alteriscuri']))
				$htmlcontent = $htmlcontent.'<strong>Alte riscuri</strong><br/>'.nl2br($tempsubreportvalue['Subreport']['alteriscuri']);
			$htmlcontent = $htmlcontent.'</p></td>'.
				'<td bgcolor="#ececec" width="85" valign="top"><p>'.nl2br($tempsubreportvalue['Subreport']['recomandarea']).'</p></td></tr>';
			$rowid++;
		}
		$htmlcontent = $htmlcontent.'</table>';

		$pdf->SetFont('arial', '', 8);
		$pdf->writeHTML($htmlcontent, true, 0, true, 0);
	}
	$htmlcontent = '<p>'.nl2br($this->data['Report']['simplesubreport']).'</p>';

	$pdf->SetFont('arial', '', 11);
	$pdf->writeHTML($htmlcontent, true, 0, true, 0);

	$htmlcontent = '<br/><h2 align="center" color="#ff6600">Concluzii</h2><p>'.nl2br($this->data['Report']['concluzii']).'</p>'.
		'<br/><p align="right"><b>Centrul de Analiză şi Prevenire a Corupţiei</b></p>';

	$pdf->writeHTML($htmlcontent, true, 0, true, 0);

	//Close and output PDF document
	$filename = 'raport-nr.-'.$this->data['Project']['reportnumber'].'.pdf';
	$pdf->Output($filename, "D");

	//============================================================+
	// END OF FILE
	//============================================================+
?>