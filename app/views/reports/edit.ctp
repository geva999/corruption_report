<div id="div-report-edit">
  <?php
    echo $form->create('Report', array('id'=>'ReportEditForm', 'enctype'=>'multipart/form-data'));
    echo $form->hidden('Report.id');
    echo $form->hidden('Report.project_id');
    echo $form->hidden('Project.projecttype');
    echo $form->hidden('Project.reportmultipleedit');
    echo $form->hidden('Project.name');
    //echo $form->hidden('Project.Author.name');
    echo $form->hidden('Project.namesolicitare');
    echo $form->hidden('Project.projecttypevizat');
    echo $form->hidden('Project.projectdomain');
    echo $form->hidden('Project.projectnumber');
    echo $form->hidden('Project.projectdatetext');
    echo $form->hidden('Project.initiative');
    echo $form->hidden('Project.reporttrasnparenta');
    echo $form->hidden('Project.reportrespectaretermen');
    echo $form->hidden('Project.reportimpact');
    echo $form->hidden('Project.projectstate');
    $projecttype = $this->data['Project']['projecttype'];
    $pointdigit = 1;
    $this->countattachment = 0;
    $projectname = $this->data['Project']['name'];
  ?>

  <br/>
  <table align="center" border="0" cellpadding="0" cellspacing="0" width="972">
  <!--- Data si numarul --->
  <tr>
    <td>
      <table valign="top" align="left" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top" width="220">
            <?php
              if ($isadmin == 1)
                echo $form->input('Report.reportdatetext', array('label'=>false, 'size'=>'17', 'maxlength'=>'18', 'readonly'=>'readonly')).
                  '<span class="green"></span>'.
                  $form->hidden('Report.reportdate');
            ?>
          </td>
          <td valign="top" align="right" width="752"><a href="<?php echo $backlink;?>">înapoi la listă rapoarte</a></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>
      <br/><br/>
      <h1>RAPORT DE EXPERTIZĂ</h1>
      <h1>la <?php echo $projectname;?></h1>
      <h3>
        <?php
          if (substr($projectname, 0, 9) == 'proiectul') $projectname = substr($projectname, 9, strlen($projectname)-9);
          if ($projecttype == 'проект закона')
            echo	'<p align="center" class="evidentiat">(înregistrat în Parlament cu numărul '.$this->data['Project']['projectnumber'].
                ' din '.$this->data['Project']['projectdatetext'].')</p>';
          else echo	'<p align="center">La solicitarea '.nl2br($this->data['Project']['namesolicitare']).'</p>';
        ?>
      </h3>
    </td>
  </tr>
  <tr>
    <td>
      <br/>
      <div class="gri">
          <!--- Punctul 0 - 1 --->
          <table width="100%" border="0" cellspacing="0" cellpadding="5">
            <tr>
              <td valign="top" width="390"><?php echo 'Tipul actului vizat de proiect: '.$this->data['Project']['projecttypevizat'];?></td>
              <td valign="top"><?php echo 'Domeniul: '.$this->data['Project']['projectdomain'];?></td>
            </tr>
            <?php
              if ($projecttype == 'проект закона') {
                echo '<tr><td valign="top" width="390">Înregistrat în Parlament cu nr. '.$this->data['Project']['projectnumber'].'</td>'.
                  '<td valign="top">din: '.$this->data['Project']['projectdatetext'].'</td></tr>';
              }
            ?>
          </table>
      </div>
    </td>
  </tr>
  <?php if ($multipleeditcontrol) {?>
  <tr>
    <td>
      <br/>
      <div class="bej">
        <h2>Evaluarea generală</h2>

        <?php
          if ($projecttype == 'проект закона') {
            //<!--- Punctul 1 --->
            $headcontent = ' este '.$this->data['Project']['initiative'];
            if ($this->data['Project']['initiative'] == 'Правительство') $headcontent = $headcontent.', autor nemijlocit - '.$author;
            echo $this->element('report_edit_pointhead', array(
                'letter'=>$pointdigit,
                'headtext'=>'Autor al iniţiativei legislative',
                'headcontent'=>$headcontent.'.'));
            $pointdigit++;

            //<!--- Punctul 2 --->
            echo $this->element('report_edit_pointhead', array(
                'letter'=>$pointdigit,
                'headtext'=>'Categoria actului legislativ',
                'headcontent'=>' propus: <span>'.
                  $form->input('Report.p02list1', array(
                    'class' => 'required_dependent',
                    'label' => false,
                    'div' => false,
                    'empty' => 'выберите',
                    'options' => array( 'органический закон'=>'органический закон',
                              'ординарный закон'=>'ординарный закон',
                              'конституционный закон'=>'конституционный закон',
                              'постановление Парламента'=>'постановление Парламента',
                              'не указана'=>'не указана'))).
                  '</span><span class="green"></span>, ceea ce <span>'.
                  $form->input('Report.p02list2', array(
                    'class' => 'required_dependent',
                    'label' => false,
                    'div' => false,
                    'empty' => 'выберите',
                    'options' => array(	'corespunde'=>'corespunde',
                              'nu corespunde'=>'nu corespunde'))).
                  '</span><span class="green"></span> art.72 din Constituţie şi art. 6-11, 27, 35 şi 39 din Legea privind actele legislative, nr.780-XV din 27.12.2001.',
                'headsmalltext'=>'Inseraţi mai jos textul concret pentru a explica în ce constă necorespunderea sau pentru a elucida alte idei în legătură cu această problemă.',
                'textareanotrequired'=>true,
                'textareaname'=>'p02text1'));
            $pointdigit++;
            echo '<div class="blue">';
            echo $form->input('Report.p02option1', array('type'=>'checkbox', 'label'=>' Expertul are obiecţii la categoria actului legislativ'));
            if ($isadmin == 1) echo $form->input('Report.p02option2', array('type' => 'checkbox', 'label'=>' Obiecţie acceptată'));
            echo '</div>';
          }
        ?>

        <!--- Punctul 3 --->
        <?php
          if ($this->data['Project']['reporttrasnparenta'] == 1) {
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Transparenţa decizională.',
              'textareaname'=>'p03text1'));
            $pointdigit++;
        ?>
            <table width="100%" border="0" cellpadding="3" cellspacing="0" class="blue">
              <?php echo $this->element('report_edit_radio', array('tdtext'=>'A fost respectată transparenţa decizională?', 'radioname'=>'p03radio1'));?>
            </table>
        <?php }?>

        <!--- Punctul 4 --->
        <?php
          echo $this->element('report_edit_pointhead', array(
            'letter'=>$pointdigit,
            'headtext'=>'Scopul promovării proiectului.',
            'headsmalltext'=>'Indicaţi scopul proiectului care rezultă din nota informativă sau nemijlocit din textul proiectului (din Preambul, clauza de adoptare sau un articol separat), în cazul în care există. Dacă sînteţi de altă opinie sau doriţi să completaţi scopul declarat de autori, indicaţi expres acest fapt.',
            'textareaname'=>'p04text1'));
          $pointdigit++;
        ?>
      </div>
    </td>
  </tr>
  <tr>
    <td>
      <br/>
      <div class="gri">
          <h2>Fundamentarea proiectului</h2>

          <?php
            if ($projecttype == 'проект закона') {
              //<!--- Punctul 5 --->
              echo $this->element('report_edit_pointhead', array(
                'letter'=>$pointdigit,
                'headtext'=>'Nota informativă',
                'headcontent'=>' a proiectului de act legislativ supus expertizei <span>'.
                  $form->input('Report.p05list1', array(
                    'class' => 'required_dependent',
                    'label' => false,
                    'div' => false,
                    'empty' => 'выберите',
                    'options' => array(	'опубликована на сайте Парламента'=>'опубликована на сайте Парламента',
                              'не опубликована на сайте Парламента'=>'не опубликована на сайте Парламента'))).
                  '</span><span class="green"></span>'.
                  '<br/>Considerăm că în acest fel Parlamentul <b><span id="ReportP05list2">...</span></b> principiul transparenţei procesului legislativ şi principiile de cooperare cu societatea civilă.',
                'headsmalltext'=>'Indicaţi şi alte idei / păreri.',
                'textareanotrequired'=>true,
                'textareaname'=>'p05text1'));
              $pointdigit++;
            }
          ?>

          <!--- Punctul 6 --->
          <?php
            if ($this->data['Project']['reportrespectaretermen'] == 1) {
              echo $this->element('report_edit_pointhead', array(
                'letter'=>$pointdigit,
                'headtext'=>'Respectarea termenului de cooperare cu societatea civilă.',
                'textareanotrequired'=>true,
                'textareaname'=>'p06text1'));
              $pointdigit++;
          ?>
              <table width="100%" border="0" cellpadding="3" cellspacing="0" class="blue">
                <?php echo $this->element('report_edit_radio', array('tdtext'=>'A fost respectat termenul de cooperare cu societatea civilă?', 'radioname'=>'p06radio1'));?>
              </table>
          <?php }?>

          <!--- Punctul 7 --->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Suficienţa argumentării.',
              'headsmalltext'=>'Indicaţi părerea Dvs. sa dacă nota informativă conţine o justificare suficientă a promovării proiectului de act legislativ.',
              'textareaname'=>'p07text1'));
            $pointdigit++;
          ?>
          <table width="100%" border="0" cellpadding="3" cellspacing="0" class="blue">
            <?php echo $this->element('report_edit_radio', array('tdtext'=>'Argumentarea e suficientă?', 'radioname'=>'p07radio1'));?>
          </table>

          <!--- Punctul 8 --->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Compatibilitatea cu legislaţia comunitară şi alte standarde internaţionale.',
              'headsmalltext'=>'Indicaţi despre existenţa referinţelor în nota informativă sau în textul proiectului la legislaţia comunitară şi alte standarde internaţionale sau lipsa acestor referinţe în cazul prezenţei unor acte de acest gen identificate de expert.',
              'textareaname'=>'p08text1'));
            $pointdigit++;
          ?>
          <table border="0" cellpadding="3" cellspacing="0" width="100%" class="blue">
            <?php echo $this->element('report_edit_radio', array('tdtext'=>'Nota / proiectul conţine referinţe la acquis-ul comunitar?', 'radioname'=>'p08radio1'));?>
            <?php echo $this->element('report_edit_radio', array('tdtext'=>'Nota / proiectul conţine referinţe la alte standarde internaţionale relevante?', 'radioname'=>'p08radio2'));?>
          </table>

          <!--- Punctul 9 --->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Fundamentarea economico-financiară.',
              'headsmalltext'=>'Constataţi existenţa şi relevanţa justificării financiar-economice a prevederilor proiectului în nota informativă.',
              'textareanotrequired'=>true,
              'textareaname'=>'p09text1'));
            $pointdigit++;
          ?>
          <table border="0" cellpadding="3" cellspacing="0" width="100%" class="blue">
            <?php echo $this->element('report_edit_radio', array('tdtext'=>'Presupune implementarea proiectului cheltuieli financiare?', 'radioname'=>'p09radio1'));?>
            <?php
              if ($this->data['Report']['p09radio1'] == 2) $trstyle = 'display: none;'; else $trstyle = null;
              echo $this->element('report_edit_radio', array('tdtext'=>'Nota informativă conţine fundamentarea economico-financiară?', 'radioname'=>'p09radio2', 'trclass'=>'divtohidep09radio1', 'trstyle'=>$trstyle));
            ?>
            </tr>
          </table>

          <!--- Punctul 10 --->
          <?php
            if ($this->data['Project']['reportimpact'] == 1) {
              echo $this->element('report_edit_pointhead', array(
                'letter'=>$pointdigit,
                'headtext'=>'Analiza impactului de reglementare a proiectului.',
                'textareaname'=>'p10text1'));
              $pointdigit++;
          ?>
            <table width="100%" border="0" cellpadding="3" cellspacing="0" class="blue">
                <?php echo $this->element('report_edit_radio', array('tdtext'=>'Proiectul a fost supus analizei impactului de reglementare?', 'radioname'=>'p10radio1'));?>
            </table>
        <?php }?>
      </div>
    </td>
  </tr>
  <?php }?>
  <tr>
    <td>
      <br/>
      <div class="bej">
          <h2>Evaluarea de fond a coruptibilităţii</h2>

          <?php if ($multipleeditcontrol) {?>
          <!--- Punctul 11 --->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Stabilirea şi promovarea unor interese / beneficii.',
              'headsmalltext'=>'Constataţi dacă proiectul stabileşte şi / sau promovează interese sau beneficii de grup sau particulare şi dacă în opinia expertului acest lucru are o justificare legitimă sau nu.',
              'textareaname'=>'p11text1'));
            $pointdigit++;
          ?>
          <table border="0" cellpadding="3" cellspacing="0" width="100%" class="blue">
            <?php echo $this->element('report_edit_radio', array('tdtext'=>'Proiectul promovează interese, beneficii?', 'radioname'=>'p11radio1'));?>
            <?php
              if ($this->data['Report']['p11radio1'] == 2) $trstyle = 'display: none;'; else $trstyle = null;
              echo $this->element('report_edit_radio', array('tdtext'=>'Promovarea este conformă interesului public?', 'radioname'=>'p11radio2', 'trclass'=>'divtohidep11radio1', 'trstyle'=>$trstyle));
            ?>
          </table>

          <!--- Punctul 12 --->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Prejudicii aduse prin aplicarea actului.',
              'headsmalltext'=>'Constataţi dacă promovarea proiectului este susceptibilă de a prejudicia anumite categorii şi dacă în opinia expertului acest lucru are o justificare legitimă sau nu.',
              'textareaname'=>'p12text1'));
            $pointdigit++;
          ?>
          <table border="0" cellpadding="3" cellspacing="0" width="100%" class="blue">
            <?php echo $this->element('report_edit_radio', array('tdtext'=>'La aplicare, proiectul va aduce prejudicii?', 'radioname'=>'p12radio1'));?>
            <?php
              if ($this->data['Report']['p12radio1'] == 2) $trstyle = 'display: none;'; else $trstyle = null;
              echo $this->element('report_edit_radio', array('tdtext'=>'Prejudicierea va respecta interesul public?', 'radioname'=>'p12radio2', 'trclass'=>'divtohidep12radio1', 'trstyle'=>$trstyle));
            ?>
          </table>

          <!--- Punctul 13 --->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Compatibilitatea proiectului cu prevederile legislaţiei naţionale.',
              'textareaname'=>'p13text1'));
            $pointdigit++;
          ?>
          <table border="0" cellpadding="3" cellspacing="0" width="100%" class="blue">
            <?php echo $this->element('report_edit_radio', array('tdtext'=>'Proiectul este compatibil legislaţiei naţionale?', 'radioname'=>'p13radio1'));?>
          </table>

          <!--- Punctul 14 --->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Formularea lingvistică a prevederilor proiectului.',
              'textareaname'=>'p14text1'));
            $pointdigit++;
          ?>
          <table border="0" cellpadding="3" cellspacing="0" width="100%" class="blue">
            <?php echo $this->element('report_edit_radio', array('tdtext'=>'Expertul are obiecţii substanţiale la formularea lingvistică?', 'radioname'=>'p14radio1'));?>
          </table>

          <!--- Punctul 15 --->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Reglementarea activităţii autorităţilor publice.',
              'headsmalltext'=>'Constataţi dacă proiectul se referă la autorităţile publice: organizare, funcţionare, competenţe, etc. şi face aprecierea generală a acestor reglementări din perspectiva prezenţei sau lipsei elementelor coruptibilităţii. Formulaţi comentariile detaliate vizavi de formulările problematice care ţin de activitatea autorităţilor publice prevăzute de proiect în tabelul cu analiza detaliată ale prevederilor potenţial coruptibile.',
              'textareaname'=>'p15text1'));
            $pointdigit++;
          ?>
          <table border="0" cellpadding="3" cellspacing="0" width="100%" class="blue">
            <?php echo $this->element('report_edit_radio', array('tdtext'=>'Proiectul reglementează activitatea autorităţilor publice?', 'radioname'=>'p15radio1'));?>
            <?php
              if ($this->data['Report']['p15radio1'] == 2) $trstyle = 'display: none;'; else $trstyle = null;
              echo $this->element('report_edit_radio', array('tdtext'=>'Expertul are obiecţii?', 'radioname'=>'p15radio2', 'trclass'=>'divtohidep15radio1', 'trstyle'=>$trstyle));
            ?>
          </table>

          <?php }?>

          <!--- Punctul 16 --->
          <?php
            echo $this->element('report_edit_pointhead', array(
              'letter'=>$pointdigit,
              'headtext'=>'Analiza detaliată a prevederilor potenţial coruptibile.',
              'headsmalltext'=>'În cazul depistării elementelor de coruptibilitate în prevederile concrete ale proiectului, expertul va completa tabelul de mai jos.'));
          ?>
          <div>
            <br/>
            <div id="rowsdiv" class="sortable">
              <?php
                echo $this->element('report_edit_lastpoint');
              ?>
            </div>
            <div align="center"><br/><input type="button" onclick="addrow();" value="Adaugă rînd"></div>
            <br/><br/>
            <?php echo $form->input('Report.simplesubreport', array('type'=>'textarea', 'label'=>false, 'style'=>"height: 150px;"));?>
          </div>

      </div>
    </td>
  </tr>
  <tr>
    <td>
      <br/>
      <div class="gri">
          <!--- Concluzii --->
          <h2>Concluzii</h2>
          <span class="green" style="float:right;margin-bottom:-10px;"></span>
          <?php echo $form->input('Report.concluzii', array('type'=>'textarea', 'class'=>'required_dependent', 'label'=>false));?>
      </div>
    </td>
  </tr>
  <?php if ($multipleeditcontrol) {?>
  <tr>
    <td>
      <br/>
      <div class="bej">
          <!--- Concluzii --->
          <h2>Anexe</h2>
          <?php
            echo $this->element('report_edit_attachments');
          ?>
          <div align="center"><br/><input type="button" onclick="addattachment();" value="Adaugă anexă"></div>
      </div>
    </td>
  </tr>
  <?php }?>
  <?php
    if ($this->data['Report']['admincoments']!='' || $isadmin == 1)
    {
  ?>
      <!--- Obiectiile administratorului catre expert --->
      <tr>
        <td>
          <br/>
          <div class="gri">
              <h2>Obiecţiile administratorului către expert</h2>
              <?php
                if ($isadmin == 1) echo $form->input('Report.admincoments', array('type'=>'textarea', 'label'=>false));
                  else echo $form->input('Report.admincoments', array('type'=>'textarea', 'label'=>false, 'readonly'=>'readonly'));
              ?>
          </div>
          <br/><br/>
        </td>
      </tr>
  <?php
    }
  ?>
  <tr>
    <td>
      <br/>
      <div align="center">
        <!--- Save area --->
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="450">
          <tr id="saverow">
            <td align="center" valign="center">
              <input name="savebutton" id="savebutton" style="width: 100px; font-size:18px;" value="Salvează" type="submit"/>
            </td>
            <?php
              if ($isadmin == 1)
              {
                echo '<td align="center" valign="center">';
                echo $form->input('Report.reportstate', array(
                    'legend' => false,
                    'label' => ' statutul raportului: ',
                    'div' => false,
                    'type' => 'select',
                    'options' => array(
                      '1'=>'În curs de examinare de către administrator',
                      '2'=>'Respins către expert cu obiecţiile administratorului',
                      '3'=>'Aprobat spre publicare cu postare pe site')
                    ));
                echo '</td>';
              }
              elseif ($multipleeditcontrol)
              {
                echo '<td align="center" valign="center">';
                echo $form->input('Report.reportstate', array(
                    'legend' => false,
                    'label' => false,
                    'div' => false,
                    'type' => 'checkbox',
                    'value' => '1'
                    ));
                echo '<font size="+0" color="#CC0000"><b>&nbsp;&nbsp;Trimite spre aprobare</b></font></td>';
              }
            ?>
          </tr>
          <tr>
            <td align="center" colspan="2">
              <div id="submit-message-append" class="error-message"></div>
            </td>
          </tr>
          <tr>
            <td align="center" colspan="2">
              <br/><br/>
              <a href="<?php echo $backlink;?>">înapoi la listă rapoarte</a>
            </td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
  </table>

  <?php echo $form->end();?>
</div>
<br/><br/>
<div name="savebutton2" id="savebutton2"></div>
<?php
	echo $this->element('sponsor');
	echo $javascript->codeBlock('var isadmin = '.$isadmin.'; var celemsacceptance = '.$celemsacceptance.'; var countattachment = '.$this->countattachment.';');
	echo $javascript->link('reportedit');
?>