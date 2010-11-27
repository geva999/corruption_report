<table border="1" cellpadding="0" cellspacing="0" align="center" width="100%" class="statistic_table">
	<!-- Список областей -->
	<tr align="center" bgcolor="#BBBBBB" class="statistic_table_head">
		<td width="260">&nbsp;</td>
		<?php foreach ($domains as $domainvalue) echo '<td width="120" colspan="2">Область: '.$domainvalue.'</td>';?>
		<td width="120" colspan="2">Итого</td>
	</tr>
	<?php
		//00
		$criterias = array('общий', 'о внесении изменений', 'о внесении дополнений', 'о внесении изменений и дополнений', 'о признании утратившим силу');
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Вид законодательного акта предусмотренный проектом',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'projecttypevizat',
			'bgcolor'=>'#DDDDDD'
		));
		//02
		$criterias = array('органический закон', 'ординарный закон', 'конституционный закон', 'постановление Парламента', 'не указана');
		echo $this->element('admin_statistic_reports_advanced_rows', array(
			'title'=>'Категория законодательного акта установлена правильно',
			'criterias'=>$criterias,
			'criteria_by'=>'соответствует',
			'statistic'=>$statistic,
			'element_name'=>'p02list'
		));
		echo $this->element('admin_statistic_reports_advanced_rows', array(
			'title'=>'Категория законодательного акта установлена неправильно',
			'criterias'=>$criterias,
			'criteria_by'=>'не соответствует',
			'statistic'=>$statistic,
			'element_name'=>'p02list'
		));
		//03
		$criterias = array(
			'Принцип прозрачности принятия решений был соблюден',
			'Принцип прозрачности принятия решений не был соблюден'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Прозрачность принятия решений',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p03radio',
			'bgcolor'=>'#DDDDDD'
		));
		//05
		$criterias = array('опубликована на сайте Парламента', 'не опубликована на сайте Парламента');
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Пояснительная записка',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p05list'
		));
		//06
		$criterias = array(
			'Срок сотрудничества с гражданским обществом был соблюден',
			'Срок сотрудничества с гражданским обществом не был соблюден'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Соблюдение срока сотрудничества с гражданским обществом',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p06radio',
			'bgcolor'=>'#DDDDDD'
		));
		//07
		$criterias = array(
			'Обоснование достаточное',
			'Обоснование недостаточное'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Обоснование достаточное',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p07radio'
		));
		//08
		$criterias = array(
			'Пояснительная записка / проект содержит ссылки на законодательство Сообщества',
			'Пояснительная записка / проект содержит ссылки на другие релевантные международные стандарты',
			'Пояснительная записка / проект содержит ссылки на законодательство Сообщества и на другие релевантные международные стандарты',
			'Пояснительная записка / проект НЕ содержит ссылки на законодательство Сообщества и на другие релевантные международные стандарты'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Совместимость с законодательством Сообщества и другими международными стандартами',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p08radio',
			'bgcolor'=>'#DDDDDD'
		));
		//09
		$criterias = array(
			'Имплементация проекта предполагает финансовых затрат',
			'Пояснительная записка содержит финансово-экономическое обоснование',
			'Имплементация проекта предполагает финансовые затраты, но пояснительная записка не содержит финансово-экономическое обоснование',
			'Имплементация проекта не предполагает финансовых затрат'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Финансово-экономическое обоснование',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p09radio',
			'advanced'=>true
		));
		//10
		$criterias = array(
			'Проект был подвергнут анализу последствий регулирования',
			'Проект не был подвергнут анализу последствий регулирования'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Анализ последствий регулирования проекта',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p10radio',
			'bgcolor'=>'#DDDDDD'
		));
		//11
		$criterias = array(
			'Проект продвигает интересы, выгоды',
			'Продвижение осуществляется в соответсвии с общими интересами общества',
			'Продвижение осуществляется с нарушением общих интересов общества',
			'Проект не продвигает интересы, выгоды'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Установление и продвижение интересов / выгод',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p11radio',
			'advanced'=>true
		));
		//12
		$criterias = array(
			'В процессе применения, проект будет ущемлять интересы',
			'Ущемление интересов соблюдает критерий общего интереса общества',
			'Ущемление интересов не соблюдает критерий общего интереса общества',
			'В процессе применения, проект не будет ущемлять интересы'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Ущемление интересов посредством применения акта',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p12radio',
			'advanced'=>true,
			'bgcolor'=>'#DDDDDD'
		));
		//13
		$criterias = array(
			'Проект не противоречит предписаниям действующего законодательства',
			'Проект противоречит предписаниям действующего законодательства'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Совместимость проекта с предписаниями действующего законодательства',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p13radio'
		));
		//14
		$criterias = array(
			'У эксперта существенные замечания относительно лингвистических формулировок',
			'У эксперта нет существенных замечаний относительно лингвистических формулировок'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Лингвистические формулировки предписаний проекта',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p14radio',
			'bgcolor'=>'#DDDDDD'
		));
		//15
		$criterias = array(
			'Проект регулирует деятельность государственных органов',
			'У эксперта есть замечания относительно порядка регулирования деятельности государственных органов',
			'У эксперта нет замечаний относительно порядка регулирования деятельности государственных органов',
			'Проект не регулирует деятельность государственных органов'
		);
		echo $this->element('admin_statistic_reports_rows', array(
			'title'=>'Регулирование деятельности государственных органов',
			'criterias'=>$criterias,
			'statistic'=>$statistic,
			'element_name'=>'p15radio',
			'advanced'=>true
		));
		//Итого
		echo $this->element('admin_statistic_reports_total', array(
			'title'=>'Итого заключений согласно областям',
			'statistic'=>$statistic,
			'bgcolor'=>'#BBBBBB'
		));
	?>
</table>