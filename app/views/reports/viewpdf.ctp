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
	$pdf->SetAuthor("www.ef-ca.org");
	$pdf->SetTitle("www.ef-ca.org");

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

	$htmlcontent = ''.$this->data['Report']['reportdatetext'].', № '.$this->data['Project']['reportnumber'].'<br/>';
	$htmlcontent = $htmlcontent.'<h1 style="color: #CC0000; text-align: center;">ЭКСПЕРТНОЕ ЗАКЛЮЧЕНИЕ</h1>';
	$htmlcontent = $htmlcontent.'<h3 align="center">по '.nl2br($projectname).'</h3>';
	if (substr($projectname, 0, 7) == 'проекту') $projectname = substr($projectname, 7, strlen($projectname)-7);
	if ($projecttype == 'проект закона')
		$htmlcontent = $htmlcontent.'<p align="center">(зарегистрированный в Парламенте под номером '.$this->data['Project']['projectnumber'].
			' от '.$this->data['Project']['projectdatetext'].')</p>'.
			'<p>В соответствии с Концепцией сотрудничества между Парламентом и гражданским обществом, '.
			'утвержденной Постановлением Парламента №373-XVI от 29 декабря 2005 г., '.
			'Центр по Анализу и Предупреждению Коррупции представляет экспертное заключение о коррупциогенности проекта  '.
			nl2br($projectname).'.</p>';
	else $htmlcontent = $htmlcontent.'<p align="center">По запросу '.nl2br($this->data['Project']['namesolicitare']).'</p>';

	$pdf->writeHTML($htmlcontent, true, 0, true, 0);

	$htmlcontent = '<br><h2 align="center" color="#ff6600">Общая оценка</h2>';
	if ($projecttype == 'проект закона') {
		$htmlcontent = $htmlcontent.'<p><strong>1. Автором законодательной инициативы </strong> является '.
      $this->data['Project']['initiative'];
		if ($this->data['Project']['initiative'] == 'Правительство')
      $htmlcontent = $htmlcontent.', непосредственный автор - '.$author;
		$htmlcontent = $htmlcontent.', что соответствует ст. 73 Конституции и ст. 44 Регламента Парламента.</p>'.
			'<p><strong>2. Категория предложенного законодательного акта</strong> является '.
      $this->data['Report']['p02list1'].', что '.$this->data['Report']['p02list2'].
      ' ст. 72 Конституции и ст. 6-11, 27, 35 и 39 Закона о законодательных актах, №780-XV от 27.12.2001. '.
			nl2br($this->data['Report']['p02text1']).'</p>';
		$pointdigit = 3;
	}

	if ($this->data['Project']['reporttrasnparenta'] == 1) {
		$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Прозрачность принятия решений</strong> '.
      nl2br($this->data['Report']['p03text1']).'</p>';
		$pointdigit++;
	}

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Цель продвижения проекта. </strong> '.
    nl2br($this->data['Report']['p04text1']).'</p>';
	$pointdigit++;

	$pdf->writeHTML($htmlcontent, true, 0, true, 0);

	$htmlcontent = '<br><h2 align="center" color="#ff6600">Обоснование проекта</h2>';

	if ($projecttype == 'проект закона') {
		$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.
      '. Концепция законопроекта</strong> проекта законодательного акта, подвергнутого экспертизе '.
      $this->data['Report']['p05list1'].'.</p>'.
			'<p>Считаем, что таким образом Парламент ';
		if ($this->data['Report']['p05list1'] == 'опубликована на сайте Парламента')
      $htmlcontent = $htmlcontent.'соблюдает';
		elseif ($this->data['Report']['p05list1'] == 'не опубликована на сайте Парламента')
      $htmlcontent = $htmlcontent.'не соблюдает';
		$htmlcontent = $htmlcontent.' принцип прозрачности законодательного процесса и принципы сотрудничества с гражданским обществом.</p>'.
			'<p>'.nl2br($this->data['Report']['p05text1']).'</p>';
		$pointdigit++;
	}

	if ($this->data['Project']['reportrespectaretermen'] == 1) {
		$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Соблюдение сроков сотрудничества с гражданским обществом</strong> '.
      nl2br($this->data['Report']['p06text1']).'</p>';
		$pointdigit++;
	}

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Достаточность обоснования.</strong> '.
    nl2br($this->data['Report']['p07text1']).'</p>';
	$pointdigit++;

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Соответствие законодательству Сообщества и другим международным стандартам.</strong> '.
    nl2br($this->data['Report']['p08text1']).'</p>';
	$pointdigit++;

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Финансово-экономическое обоснование.</strong> '.
    nl2br($this->data['Report']['p09text1']).'</p>';
	$pointdigit++;

	if ($this->data['Project']['reportimpact'] == 1) {
		$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Согласование с аккредитованными объединениями субъектов частного предпринимательства.</strong> '.
    nl2br($this->data['Report']['p10text1']).'</p>';
		$pointdigit++;
	}

	$pdf->writeHTML($htmlcontent, true, 0, true, 0);

	$htmlcontent = '<br><h2 align="center" color="#ff6600">Оценка коррупциогенности по существу</h2>';

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Установление и продвижение интересов/выгод.</strong> '.
    nl2br($this->data['Report']['p11text1']).'</p>';
	$pointdigit++;

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Ущерб, нанесенный применением акта.</strong> '.
    nl2br($this->data['Report']['p12text1']).'</p>';
	$pointdigit++;

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Соответствие проекта положениям национального законодательства.</strong> '.
    nl2br($this->data['Report']['p13text1']).'</p>';
	$pointdigit++;

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Лингвистические формулировки положений проекта.</strong> '.
    nl2br($this->data['Report']['p14text1']).'</p>';
	$pointdigit++;

	$htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Регулирование деятельности государственных органов.</strong> '.
    nl2br($this->data['Report']['p15text1']).'</p>';
	$pointdigit++;

	$pdf->writeHTML($htmlcontent, true, 0, true, 0);

	$htmlcontent = '<p></p>';

	if (!empty($subreports)) {
		$htmlcontent = '<p></p><p><strong>'.$pointdigit.'. Подробный анализ потенциально коррупциогенных положений проекта.</strong></p>';

		$pdf->writeHTML($htmlcontent, true, 0, true, 0);

		$htmlcontent = '<br/><table align="center" border="0" cellpadding="5" cellspacing="1">'.
				'<tr valign="top">
				 <td bgcolor="#dadada" width="15" align="center"><strong>№</strong></td>'.
				'<td bgcolor="#e4e4e4" width="50" align="center"><strong>Статья</strong></td>'.
				'<td bgcolor="#dadada" width="85" align="center"><strong>Текст</strong></td>'.
				'<td bgcolor="#e4e4e4" width="140" align="center"><strong>Замечание</strong></td>'.
				'<td bgcolor="#dadada" width="140" align="center"><strong>Элементы коррупциогенности и другие риски</strong></td>'.
				'<td bgcolor="#e4e4e4" width="85" align="center"><strong>Рекомендация</strong></td></tr>';
		$rowid=1;
		foreach ($subreports as $tempsubreportkey => $tempsubreportvalue) {
			$htmlcontent = $htmlcontent.'<tr align="left">
					 <td bgcolor="#e2e2e2" width="15" valign="top"><p>'.$rowid.'</p></td>'.
					'<td bgcolor="#ececec" width="50" valign="top"><p>'.$tempsubreportvalue['Subreport']['articol'].'</p></td>'.
					'<td bgcolor="#e2e2e2" width="85" valign="top">'.$tempsubreportvalue['Subreport']['text'].'</td>'.
					'<td bgcolor="#ececec" width="140" valign="top">'.$tempsubreportvalue['Subreport']['obiectia'].'</td>'.
					'<td bgcolor="#e2e2e2" width="140" valign="top"><p>';
			if (!empty($tempsubreportvalue['Celem']) || !empty($tempsubreportvalue['Subreport']['alteelemente'])) {
				$htmlcontent = $htmlcontent.'<strong><em>Коррупциогенность</em></strong><br/>';
				foreach ($tempsubreportvalue['Celem'] as $tempcelemkey => $tempcelemvalue) {
					$htmlcontent = $htmlcontent.$tempcelemvalue['name'].'<br/>';
				}
				if (!empty($tempsubreportvalue['Subreport']['alteelemente']))
					$htmlcontent = $htmlcontent.nl2br($tempsubreportvalue['Subreport']['alteelemente']).'<br/>';
				$htmlcontent = $htmlcontent.'<br/>';
			}
			if (!empty($tempsubreportvalue['Subreport']['alteriscuri']))
				$htmlcontent = $htmlcontent.'<strong>Другие риски</strong><br/>'.nl2br($tempsubreportvalue['Subreport']['alteriscuri']);
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

	$htmlcontent = '<br/><h2 align="center" color="#ff6600">Выводы</h2><p>'.nl2br($this->data['Report']['concluzii']).'</p>'.
		'<br/><p align="right"><b>Центр по Анализу и Предупреждению Коррупции</b></p>';

	$pdf->writeHTML($htmlcontent, true, 0, true, 0);

	//Close and output PDF document
	$filename = 'raport-nr.-'.$this->data['Project']['reportnumber'].'.pdf';
	$pdf->Output($filename, "D");

	//============================================================+
	// END OF FILE
	//============================================================+
?>