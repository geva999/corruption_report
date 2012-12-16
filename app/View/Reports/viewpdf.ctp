<?php
    $safeMode = ( @ini_get("safe_mode") == 'On' || @ini_get("safe_mode") === 1 ) ? TRUE : FALSE;
    if ( $safeMode === FALSE ) {
        set_time_limit(300); // Sets maximum execution time to 5 minutes (300 seconds)
        ini_set("max_execution_time", "300"); // this does the same as "set_time_limit(300)"
        ini_set("memory_limit", "128M");
    }

    App::import('Vendor', 'mytcpdf'); // http://book.cakephp.org/2.0/en/core-utility-libraries/app.html#loading-vendor-files
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
    global $l;
    $l = Array();

    // PAGE META DESCRIPTORS --------------------------------------

    $l['a_meta_charset'] = 'UTF-8';
    $l['a_meta_dir'] = 'ltr';
    $l['a_meta_language'] = 'ru';

    // TRANSLATIONS --------------------------------------
    $l['w_page'] = 'страница';
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

    $projecttype = $this->request->data['Project']['projecttype'];
    $pointdigit = 1;
    $projectname = $this->request->data['Project']['name'];
  $htmlcontent = '';
  if ($this->request->data['Report']['reportdatetext'] != '') $htmlcontent = $htmlcontent.$this->request->data['Report']['reportdatetext'].', ';
  if ($this->request->data['Project']['reportnumber'] != '') $htmlcontent = $htmlcontent.'№. '.$this->request->data['Project']['reportnumber'];
    $htmlcontent = $htmlcontent = $htmlcontent.'<br/>';
    $htmlcontent = $htmlcontent.'<h1 style="color: #CC0000; text-align: center;">ЭКСПЕРТНОЕ ЗАКЛЮЧЕНИЕ</h1>';
    $htmlcontent = $htmlcontent.'<h3 align="center">по '.nl2br($projectname).'</h3>';
    if (substr($projectname, 0, 7) == 'проекту') $projectname = substr($projectname, 7, strlen($projectname)-7);
    if ($projecttype == 'проект закона')
        $htmlcontent = $htmlcontent.'<p align="center">(зарегистрированный в Парламенте под номером '.$this->request->data['Project']['projectnumber'].
            ' от '.$this->request->data['Project']['projectdatetext'].')</p>'.
            '<p>В соответствии с Концепцией сотрудничества между Парламентом и гражданским обществом, '.
            'утвержденной Постановлением Парламента №373-XVI от 29 декабря 2005 г., '.
            'Фонд Евразия Центральной Азии представляет экспертное заключение о коррупционности проекта  '.
            nl2br($projectname).'.</p>';
    else $htmlcontent = $htmlcontent.'<p align="center">По запросу '.nl2br($this->request->data['Project']['namesolicitare']).'</p>';

    $pdf->writeHTML($htmlcontent, true, 0, true, 0);

    $htmlcontent = '<br><h2 align="center" color="#ff6600">Общая оценка</h2>';
    $htmlcontent .= '<div style="text-align: justify;">';

    if ($projecttype == 'проект закона') {
        $htmlcontent = $htmlcontent.'<p><strong>1. Автором законодательной инициативы</strong> является '.
      $this->request->data['Project']['initiative'];
        if ($this->request->data['Project']['initiative'] == 'Правительство')
      $htmlcontent = $htmlcontent.', непосредственный автор - '.$author;
        $htmlcontent = $htmlcontent.', что соответствует ст. 73 Конституции и ст. 44 Регламента Парламента.</p>'.
            '<p><strong>2. Категория предложенного законодательного акта</strong> является '.
      $this->request->data['Report']['p02list1'].', что '.$this->request->data['Report']['p02list2'].
      ' ст. 72 Конституции и ст. 6-11, 27, 35 и 39 Закона о законодательных актах, №780-XV от 27.12.2001. '.
            nl2br($this->request->data['Report']['p02text1']).'</p>';
        $pointdigit = 3;
    }

    $htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Цель продвижения проекта. </strong> '.
    nl2br($this->request->data['Report']['p04text1']).'</p>';
    $pointdigit++;

    $htmlcontent .= '</div>';

    $pdf->writeHTML($htmlcontent, true, 0, true, 0);

    $htmlcontent = '<div style="text-align: justify;">';
    $htmlcontent .= '<h2 align="center" color="#ff6600">Обоснование проекта</h2>';

    $htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Пояснительная записка и достаточность обоснования.</strong> '.
    nl2br($this->request->data['Report']['p07text1']).'</p>';
    $pointdigit++;

    $htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Соответствие законодательству Сообщества и другим международным стандартам.</strong> '.
    nl2br($this->request->data['Report']['p08text1']).'</p>';
    $pointdigit++;

    $htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Финансово-экономическое обоснование.</strong> '.
    nl2br($this->request->data['Report']['p09text1']).'</p>';
    $pointdigit++;

    if ($this->request->data['Project']['reportimpact'] == 1) {
        $htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Согласование с аккредитованными объединениями субъектов частного предпринимательства.</strong> '.
    nl2br($this->request->data['Report']['p10text1']).'</p>';
        $pointdigit++;
    }

    $htmlcontent .= '</div>';

    $pdf->writeHTML($htmlcontent, true, 0, true, 0);

    $htmlcontent = '<div style="text-align: justify;">';

    $htmlcontent .= '<h2 align="center" color="#ff6600">Оценка коррупционности по существу</h2>';

    $htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Установление и продвижение интересов/выгод.</strong> '.
    nl2br($this->request->data['Report']['p11text1']).'</p>';
    $pointdigit++;

    $htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Ущерб, нанесенный применением акта.</strong> '.
    nl2br($this->request->data['Report']['p12text1']).'</p>';
    $pointdigit++;

    $htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Соответствие проекта положениям национального законодательства.</strong> '.
    nl2br($this->request->data['Report']['p13text1']).'</p>';
    $pointdigit++;

    $htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Лингвистические формулировки положений проекта.</strong> '.
    nl2br($this->request->data['Report']['p14text1']).'</p>';
    $pointdigit++;

    $htmlcontent = $htmlcontent.'<p><strong>'.$pointdigit.'. Регулирование деятельности государственных органов.</strong> '.
    nl2br($this->request->data['Report']['p15text1']).'</p>';
    $pointdigit++;

    $htmlcontent .= '</div>';

    $pdf->writeHTML($htmlcontent, true, 0, true, 0);

    $htmlcontent = '<p></p>';

    if (!empty($subreports)) {
        $htmlcontent = '<p></p><p><strong>'.$pointdigit.'. Подробный анализ потенциально коррупционных положений проекта.</strong></p>';

        $pdf->writeHTML($htmlcontent, true, 0, true, 0);

        $htmlcontent = '<br/><table align="center" border="0" cellpadding="5" cellspacing="1">'.
                '<tr valign="top">
           <td bgcolor="#dadada" width="20" align="center"><strong>№</strong></td>'.
          '<td bgcolor="#e4e4e4" width="90" align="center"><strong>Статья</strong></td>'.
          '<td bgcolor="#dadada" width="105" align="center"><strong>Текст</strong></td>'.
          '<td bgcolor="#e4e4e4" width="107" align="center"><strong>Замечание</strong></td>'.
          '<td bgcolor="#dadada" width="107" align="center"><strong>Факторы коррупционности и другие риски</strong></td>'.
          '<td bgcolor="#e4e4e4" width="90" align="center"><strong>Рекомендация</strong></td>'.
        '</tr>';
        $rowid=1;
        foreach ($subreports as $tempsubreportkey => $tempsubreportvalue) {
            $htmlcontent = $htmlcontent.'<tr align="left">'.
                    '<td bgcolor="#e2e2e2" width="20" valign="top"><p>'.$rowid.'</p></td>'.
                    '<td bgcolor="#ececec" width="90" valign="top"><p>'.$this->App->content_for_pdf($tempsubreportvalue['Subreport']['articol']).'</p></td>'.
                    '<td bgcolor="#e2e2e2" width="105" valign="top">'.$this->App->content_for_pdf($tempsubreportvalue['Subreport']['text']).'</td>'.
                    '<td bgcolor="#ececec" width="107" valign="top">'.$this->App->content_for_pdf($tempsubreportvalue['Subreport']['obiectia']).'</td>'.
                    '<td bgcolor="#e2e2e2" width="107" valign="top"><p>';
            if (!empty($tempsubreportvalue['Celem']) || !empty($tempsubreportvalue['Subreport']['alteelemente'])) {
                $htmlcontent = $htmlcontent.'<strong><em>Коррупционность</em></strong><br/>';
                foreach ($tempsubreportvalue['Celem'] as $tempcelemkey => $tempcelemvalue) {
                    $htmlcontent = $htmlcontent.$this->App->content_for_pdf($tempcelemvalue['name']).'<br/>';
                }
                if (!empty($tempsubreportvalue['Subreport']['alteelemente']))
                    $htmlcontent = $htmlcontent.$this->App->content_for_pdf($tempsubreportvalue['Subreport']['alteelemente']).'<br/>';
                $htmlcontent = $htmlcontent.'<br/>';
            }
            if (!empty($tempsubreportvalue['Subreport']['alteriscuri']))
                $htmlcontent = $htmlcontent.'<strong>Другие риски</strong><br/>'.$this->App->content_for_pdf($tempsubreportvalue['Subreport']['alteriscuri']);
            $htmlcontent = $htmlcontent.'</p></td>'.
                '<td bgcolor="#ececec" width="90" valign="top"><p>'.$this->App->content_for_pdf($tempsubreportvalue['Subreport']['recomandarea']).'</p></td>'.
      '</tr>';
            $rowid++;
        }
        $htmlcontent = $htmlcontent.'</table>';

        $pdf->SetFont('arial', '', 8);
        $pdf->writeHTML($htmlcontent, true, 0, true, 0);
    }

    $htmlcontent = '<div style="text-align: justify;">';
    $htmlcontent .= '<p>'.nl2br($this->request->data['Report']['simplesubreport']).'</p>';
    $htmlcontent .= '</div>';

    $pdf->SetFont('arial', '', 11);
    $pdf->writeHTML($htmlcontent, true, 0, true, 0);

    $htmlcontent = '<div style="text-align: justify;">';
    $htmlcontent .= '<h2 align="center" color="#ff6600">Выводы</h2><p>'.nl2br($this->request->data['Report']['concluzii']).'</p>'.
        '<br/><p align="right"><b>'.$expert['Expert']['fullname'].'<br/>Фонд Евразия Центральной Азии</b></p>';
    $htmlcontent .= '</div';

    $pdf->writeHTML($htmlcontent, true, 0, true, 0);

    //Close and output PDF document
    $filename = 'report-number-'.$this->request->data['Project']['reportnumber'].'.pdf';
    $pdf->Output($filename, "D");

    //============================================================+
    // END OF FILE
    //============================================================+
?>
