<table border="1" cellpadding="0" cellspacing="0" align="center" width="100%" class="statistic_table">
	<!--- Lista domeniilor --->
	<tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
		<td width="260">&nbsp;</td>
		<?php foreach ($this->domains as $domainvalue) echo '<td width="120" colspan="2">Domeniul '.$domainvalue.'</td>';?>
		<td width="120" colspan="2">Total</td>
	</tr>
	<?php
		//00
		$criterias = array('integrală', 'de modificare', 'de completare', 'de modificare şi completare', 'de abrogare');
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Tipul actului legislativ vizat de proiect',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'projecttypevizat',
			'bgcolor'=>'#DDDDDD'
		));
		//02
		$criterias = array('lege organică', 'lege ordinară', 'lege constituţională', 'hotărîre a Parlamentului', 'nu este determinată');
		echo $this->element('admin_statistic_reports_advanced_rows', array(
			'title'=>'Categoria actului legislativ determinată corespunzător',
			'criterias'=>$criterias,
			'criteria_by'=>'corespunde',
			'statistic'=>$statistic,
			'element_name'=>'p02list'
		));
		echo $this->element('admin_statistic_reports_advanced_rows', array(
			'title'=>'Categoria actului legislativ determinată necorespunzător',
			'criterias'=>$criterias,
			'criteria_by'=>'nu corespunde',
			'statistic'=>$statistic,
			'element_name'=>'p02list'
		));
		//03
		$criterias = array(
			'Transparenţa decizională a fost respectată',
			'Transparenţa decizională nu a fost respectată'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Transparenţa decizională',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p03radio',
			'bgcolor'=>'#DDDDDD'
		));
		//05
		$criterias = array('este plasată pe site-ul Parlamentului', 'nu este plasată pe site-ul Parlamentului');
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Nota informativă',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p05list'
		));
		//06
		$criterias = array(
			'Termenul de cooperare cu societatea civilă a fost respectat',
			'Termenul de cooperare cu societatea civilă nu a fost respectat'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Respectarea termenului de cooperare cu societatea civilă',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p06radio',
			'bgcolor'=>'#DDDDDD'
		));
		//07
		$criterias = array(
			'Argumentarea e suficientă',
			'Argumentarea nu e suficientă'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Suficienţa argumentării',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p07radio'
		));
		//08
		$criterias = array(
			'Nota informativă / proiectul conţine referinţe la acquis-ul comunitar',
			'Nota informativă / proiectul conţine referinţe la alte standarde internaţionale relevante',
			'Nota informativă / proiectul conţine referinţe la acquis-ul comunitar şi la alte standarde internaţionale',
			'Nota informativă / proiectul NU conţine referinţe nici la acquis-ul comunitar, nici la alte standarde internaţionale'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Compatibilitatea cu legislaţia comunitară şi alte standarde internaţionale',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p08radio',
			'bgcolor'=>'#DDDDDD'
		));
		//09
		$criterias = array(
			'Implementarea proiectului presupune cheltuieli financiare',
			'Nota informativă conţine fundamentarea economico-financiară',
			'Implementarea proiectului presupune cheltuieli, dar nota nu conţine fundamentarea economico-financiară',
			'Implementarea proiectului nu presupune cheltuieli financiare'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Fundamentarea economico-financiară',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p09radio',
			'advanced'=>true
		));
		//10
		$criterias = array(
			'Proiectul a fost supus analizei impactului de reglementare',
			'Proiectul nu a fost supus analizei impactului de reglementare'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Analiza impactului de reglementare a proiectului',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p10radio',
			'bgcolor'=>'#DDDDDD'
		));
		//11
		$criterias = array(
			'Proiectul promovează interese, beneficii',
			'Promovarea se face conform interesului public',
			'Promovarea se face contrar interesului public',
			'Proiectul nu promovează interese, beneficii'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Stabilirea şi promovarea unor interese / beneficii',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p11radio',
			'advanced'=>true
		));
		//12
		$criterias = array(
			'La aplicare, proiectul va aduce prejudicii',
			'Prejudicierea intereselor respectă criteriul interesului public',
			'Prejudicierea intereselor nu respectă criteriul interesului public',
			'La aplicare, proiectul nu va aduce prejudicii'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Prejudicii aduse prin aplicarea actului',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p12radio',
			'advanced'=>true,
			'bgcolor'=>'#DDDDDD'
		));
		//13
		$criterias = array(
			'Proiectul este compatibil cu legislaţia în vigoare',
			'Proiectul nu este compatibil cu legislaţia în vigoare'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Compatibilitatea proiectului cu prevederile legislaţiei naţionale',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p13radio'
		));
		//14
		$criterias = array(
			'Expertul are obiecţii substanţiale la formularea lingvistică',
			'Expertul nu are obiecţii substanţiale la formularea lingvistică'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Formularea lingvistică a prevederilor proiectului',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p14radio',
			'bgcolor'=>'#DDDDDD'
		));
		//15
		$criterias = array(
			'Proiectul reglementează activitatea AP',
			'Expertul are obiecţii la modul reglementării activităţii AP',
			'Expertul nu are obiecţii la modul reglementării activităţii AP',
			'Proiectul nu reglementează activitatea AP'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Reglementarea activităţii autorităţilor publice',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p15radio',
			'advanced'=>true
		));
		//total
		echo $this->element('admin_statistic_reports_total', array(
			'title'=>'Total rapoarte pe domenii',
			'statistic'=>$statistic,
			'bgcolor'=>'#BBBBBB'
		));
	?>
</table>