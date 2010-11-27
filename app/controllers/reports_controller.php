<?php
class ReportsController extends AppController {
	var $name = 'Reports';

	function isAuthorized() {
		$adminrights = array('admin_index', 'admin_statistic', 'edit', 'save', 'view', 'viewpdf', 'viewelements', 'viewotherelements', 'generatesubreportcode');
		$expertrights = array('index', 'edit', 'save', 'view', 'viewpdf', 'viewelements', 'viewotherelements', 'generatesubreportcode');
		if ($this->Auth->user('isadmin') == 1 && in_array($this->action, $adminrights)) return true;
		elseif ($this->Auth->user('isadmin') == 0 && in_array($this->action, $expertrights)) return true;
		else return false;
	}

	function index() {
		$loginedexpertid = $this->Auth->user('id');

		$this->Report->recursive = -1;
		$fields = array('Report.id', 'Project.author_id', 'Project.projecttype', 'Project.name', 'Project.reportnumber');
		$conditions = array(
				'Report.reportstate <>'=>3,
				'Project.expert_id <>'=>$loginedexpertid,
				'Project.reportmultipleedit'=>1,
				'Projectexpert.expert_id'=>$loginedexpertid);
		$joins = array('LEFT JOIN `projects` AS `Project` ON ( `Report`.`project_id` = `Project`.`id` ) LEFT JOIN `projectexperts` AS `Projectexpert` ON ( `Project`.`id` = `Projectexpert`.`project_id` )');

		$countmultipleedit = $this->Report->find('count', array('conditions'=>$conditions, 'joins'=>$joins));
		$reportmultipleedit = $this->Report->find('all', array('fields'=>$fields, 'conditions'=>$conditions, 'joins'=>$joins, 'order'=>'Project.reportnumber ASC'));

		$this->Report->recursive = 0;
		$this->Report->Project->recursive = -1;
		$countprojects = $this->Report->Project->find('count', array('conditions'=>array('Project.projectreportstate'=>2, 'Project.expert_id'=>$loginedexpertid)));
		$countsenttoadmin = $this->Report->find('count', array('conditions'=>array('Report.reportstate'=>1, 'Project.expert_id'=>$loginedexpertid)));
		$countrejected = $this->Report->find('count', array('conditions'=>array('Report.reportstate'=>2, 'Project.expert_id'=>$loginedexpertid)));
		$countsaved = $this->Report->find('count', array('conditions'=>array('Report.reportstate'=>0, 'Project.expert_id'=>$loginedexpertid)));
		$countpublished = $this->Report->find('count', array('conditions'=>array('Report.reportstate'=>3, 'Project.expert_id'=>$loginedexpertid)));

		$reportssenttoadmin = $this->Report->find('all', array('fields'=>$fields, 'conditions'=>array('Report.reportstate'=>1, 'Project.expert_id'=>$loginedexpertid)));
		$reportsrejected = $this->Report->find('all', array('fields'=>$fields, 'conditions'=>array('Report.reportstate'=>2, 'Project.expert_id'=>$loginedexpertid)));
		$reportssaved = $this->Report->find('all', array('fields'=>$fields, 'conditions'=>array('Report.reportstate'=>0, 'Project.expert_id'=>$loginedexpertid)));
		$reportspublished = $this->paginate('Report', array('Report.reportstate'=>3, 'Project.expert_id'=>$loginedexpertid));

		$this->Report->Project->Author->recursive = -1;
		$authors = $this->Report->Project->Author->find('list', array('fields'=>array('Author.id', 'Author.name'), 'order'=>'Author.name ASC'));
		$this->set(compact('countprojects', 'countsenttoadmin', 'countrejected', 'countsaved', 'countmultipleedit', 'countpublished', 'reportssenttoadmin', 'reportsrejected', 'reportssaved', 'reportmultipleedit', 'reportspublished', 'authors'));
	}

	function edit($id = null) {
		$this->layout='reportedit';
		$isadmin = $this->Auth->user('isadmin');
		$loginedexpertid = $this->Auth->user('id');
		$multipleedit = 0;
		if ($isadmin == 1) $backlink = '/admin/reports/index';
			else $backlink = '/reports/index';
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Неверный ID для заключения.', true), 'jgrowl');
			$this->redirect($backlink);
		}
		if (!empty($this->data)) {
			//if ($this->data['Report']['reportstate'] == 1) $this->data['Report']['admincoments'] = '';
			$savecontrol1 = false;
			$savecontrol2 = false;
			if ($this->Report->save($this->data)) {
				$savecontrol1 = true;
				if ($this->data['subraport']) {
					$tempcount = 1;
					$multipleedit = $this->data['Project']['reportmultipleedit'];
					$projectexperts = $this->Report->Project->Projectexpert->find('list', array('fields'=>array('Projectexpert.id', 'Projectexpert.expert_id'), 'order'=>'Projectexpert.id ASC'));
					$tempcountarray = array();
					foreach ($projectexperts as $projectexpertkey => $projectexpertid)
						$tempcountarray[$projectexpertid] = ($projectexpertkey * 1000) + 1;
					foreach ($this->data['subraport'] as $tempsubraportkey => $tempsubraportvalue) {
						$this->data['subraport'][$tempsubraportkey]['Subreport']['report_id'] = $this->Report->id;
						if ($this->data['subraport'][$tempsubraportkey]['Subreport']['expert_id'] == '')
							$this->data['subraport'][$tempsubraportkey]['Subreport']['expert_id'] = $loginedexpertid;
						$this->data['subraport'][$tempsubraportkey]['Subreport']['text'] = str_replace(chr(194).chr(160), ' ', $this->data['subraport'][$tempsubraportkey]['Subreport']['text']);
						$this->data['subraport'][$tempsubraportkey]['Subreport']['obiectia'] = str_replace(chr(194).chr(160), ' ', $this->data['subraport'][$tempsubraportkey]['Subreport']['obiectia']);
						//if ($isadmin != 1 || !($this->data['subraport'][$tempsubraportkey]['Subreport']['subreportorder']))
						if ($multipleedit == 0 || $isadmin == 1) {
							if ($this->data['subraport'][$tempsubraportkey]['Subreport']['todelete'] != 1) {
								$this->data['subraport'][$tempsubraportkey]['Subreport']['subreportorder'] = $tempcount;
								$tempcount++;
							}
						}
						else {
							if ($this->data['subraport'][$tempsubraportkey]['Subreport']['todelete'] != 1) {
								$this->data['subraport'][$tempsubraportkey]['Subreport']['subreportorder'] = $tempcountarray[$this->data['subraport'][$tempsubraportkey]['Subreport']['expert_id']];
								$tempcountarray[$this->data['subraport'][$tempsubraportkey]['Subreport']['expert_id']]++;
							}
						}
					}
					if ($this->Report->Subreport->saveAll($this->data['subraport'])) {
						$savecontrol2 = true;
						$this->Report->Subreport->deleteAll(array('Subreport.todelete'=>1));
					}
				}
				else $savecontrol2 = true;
				if ($this->data['Attachment']) {
					foreach ($this->data['Attachment'] as $attachmentkey => $attachmentvalue) {
						$this->data['Attachment'][$attachmentkey]['report_id'] = $this->Report->id;
						if ($attachmentvalue['attachmentfile']['error'] == 0) {
							$this->data['Attachment'][$attachmentkey]['filename'] = $attachmentvalue['attachmentfile']['name'];
							move_uploaded_file($attachmentvalue['attachmentfile']['tmp_name'], 'uploaded/annexes/'.$attachmentvalue['attachmentfile']['name']);
						}
						else if (!isset($this->data['Attachment'][$attachmentkey]['filename']))
							$this->data['Attachment'][$attachmentkey]['filename'] = '';
					}
					$this->Report->Attachment->saveAll($this->data['Attachment']);
					$this->Report->Attachment->deleteAll(array('Attachment.todelete'=>1));
				}
			}
			if ($savecontrol1 && $savecontrol2) {
				$this->Session->setFlash(__('Заключение было сохранено.', true), 'jgrowl');
				$this->redirect($backlink);
			}
			else $this->Session->setFlash(__('Заключение не может быть сохранено. Проверьте введенные данные и попробуйте еще раз.', true), 'jgrowl');
		}
		if (empty($this->data)) {
			$this->Report->recursive = 1;
			$this->Report->Subreport->recursive = 1;
			$this->Report->Atachment->recursive = 0;
			$this->Report->Project->Author->recursive = -1;
			$this->data = $this->Report->read(null, $id);
			$multipleedit = $this->data['Project']['reportmultipleedit'];
			$conditions = array('Subreport.report_id'=>$id);
			if ($isadmin == 0 && $multipleedit == 1 && $loginedexpertid != $this->data['Project']['expert_id'])
				$conditions = array_merge($conditions, array('Subreport.expert_id'=>$loginedexpertid));
			$subreports = $this->Report->Subreport->find('all', array(
					'conditions'=>$conditions,
					'order'=>array('Subreport.subreportorder')));
			//Example of parsing an table
			//$userArray['Subreport'] = Set::extract($subreports, '{n}.Subreport');
			foreach ($subreports as $tempsubraportkey => $tempsubraportvalue) {
				unset($subreports[$tempsubraportkey]['Report']);
				foreach ($subreports[$tempsubraportkey]['Celem'] as $tempcelemkey => $tempcelemvalue) {
					$subreports[$tempsubraportkey]['Celem']['Celem'][$tempcelemkey] = $tempcelemvalue['id'];
					unset($subreports[$tempsubraportkey]['Celem'][$tempcelemkey]);
				}
				foreach ($subreports[$tempsubraportkey]['Pelem'] as $temppelemkey => $temppelemvalue) {
					$subreports[$tempsubraportkey]['Pelem']['Pelem'][$temppelemkey] = $temppelemvalue['id'];
					unset($subreports[$tempsubraportkey]['Pelem'][$temppelemkey]);
				}
			}
			$this->data['subraport'] = $subreports;
			unset($this->data['Project']['Report']);
			unset($this->data['Subreport']);
		}
		if (($this->data['Project']['projectstate'] == 2) && ($isadmin == 1)) $celemsacceptance = 1;
		else $celemsacceptance = 0;
		$this->Report->Subreport->Celem->recursive = -1;
		$celems = $this->Report->Subreport->Celem->find('list', array('fields'=>array('Celem.id', 'Celem.celem')));
		$pelems = $this->Report->Subreport->Pelem->find('list', array('fields'=>array('Pelem.id', 'Pelem.number')));
		$experts = $this->Report->Project->Expert->find('list', array('fields'=>array('Expert.id', 'Expert.fullname')));
		$author = $this->Report->Project->Author->find('list');
		$author = $author[$this->data['Project']['author_id']];
		if ($multipleedit == 0 || ($multipleedit == 1 && $isadmin == 1) || ($multipleedit == 1 && $loginedexpertid == $this->data['Project']['expert_id']))
			$multipleeditcontrol = true;
		else $multipleeditcontrol = false;

		$this->set(compact('celems', 'pelems', 'author', 'isadmin', 'loginedexpertid', 'celemsacceptance', 'backlink', 'experts', 'multipleedit', 'multipleeditcontrol'));
	}

	function view($id = null, $type = null) {
		Configure::write('debug',0);
		$isadmin = $this->Auth->user('isadmin');
		if ($isadmin == 1) $backlink = '/admin/reports/index';
			else $backlink = '/reports/index';
		if (!$id) {
			$this->Session->setFlash(__('Неверный ID для заключения.', true), 'jgrowl');
			$this->redirect($backlink);
		}
		App::import('Model','Template');
		$templatemodel = new Template();
		$templatemodel->recursive = -1;
		$this->Report->recursive = 1;
		$this->Report->Subreport->recursive = 1;
		$this->Report->Atachment->recursive = -1;
		$this->Report->Project->Author->recursive = -1;
		$this->Report->Subreport->Celem->recursive = -1;
		$this->data = $this->Report->read(null, $id);
		$subreports = $this->Report->Subreport->find('all', array('conditions'=>array('Subreport.report_id'=>$id), 'order'=>'Subreport.subreportorder'));
		$template = $templatemodel->find('first', array(	'conditions'=>array('Template.date <'=>$this->data['Report']['reportdate']),
															'order'=>'Template.date DESC',
															'fields'=>array('Template.header', 'Template.footer', 'Template.headerpdf', 'Template.footerpdf')));
		foreach ($subreports as $tempsubraportkey => $tempsubraportvalue) {
			unset($subreports[$tempsubraportkey]['Report']);
			unset($subreports[$tempsubraportkey]['Pelem']);
		}
		foreach ($this->data['Attachment'] as $attachmentkey => $attachmentvalue) {
			unset($this->data['Attachment'][$attachmentkey]['Report']);
		}
		unset($this->data['Project']['Report']);
		unset($this->data['Subreport']);
		$author = $this->Report->Project->Author->find('list');
		$author = $author[$this->data['Project']['author_id']];
		$this->set(compact('subreports', 'author', 'template', 'backlink'));

		if ($type == 'pdf') $this->layout = 'pdf';
		if ($type == 'ajax') $this->layout='ajaxlayout';
		$this->render('view'.$type);
	}

	function viewelements() {
		Configure::write('debug', '0');
		$this->layout='viewelements';
		$this->Report->Subreport->Celem->recursive = -1;
		$celemgroups = $this->Report->Subreport->Celem->find('all', array('fields'=>array('DISTINCT Celem.celemgroup')));
		$celems = $this->Report->Subreport->Celem->find('all', array('order'=>'Celem.number ASC'));
		$this->set(compact('celemgroups', 'celems'));
    }

	function viewotherelements() {
		Configure::write('debug', '0');
		$this->layout='viewelements';
		$this->Report->Subreport->recursive = -1;
		$otherelements = $this->Report->Subreport->find('all', array(
			'fields'=>array('COUNT(Subreport.alteelemente) AS countalteelemente', 'Subreport.alteelemente'),
			'conditions'=>array('Subreport.alteelemente <>'=>''), 'group'=>'Subreport.alteelemente', 'order'=>'countalteelemente DESC'));
		$this->set(compact('otherelements'));
    }

	function generatesubreportcode($rowid = null, $celemsacceptance = null, $celemgroup = null) {
		Configure::write('debug', '0');
		$this->layout='ajaxlayout';

		$this->Report->Subreport->create();
		$this->Report->Subreport->save();
		$subreportid = $this->Report->Subreport->id;

		$this->Report->Subreport->Celem->recursive = -1;
		$this->Report->Subreport->Pelem->recursive = -1;
		$celems = $this->Report->Subreport->Celem->find('list', array('fields'=>array('Celem.id', 'Celem.celem')));
		$pelems = $this->Report->Subreport->Pelem->find('list', array('fields'=>array('Pelem.id', 'Pelem.number')));
		$this->set(compact('celems', 'pelems', 'rowid', 'celemsacceptance', 'subreportid'));
	}

	function admin_index($action = null) {
		$conditions = array('Report.reportstate'=>array(1, 3));
		$viewtext = 'Rapoarte';
		if ($action == 'рассмотрение') {
			$conditions = array('Report.reportstate'=>1);
			$viewtext = 'Заключения в процессе рассмотрения администратором';
		}
		elseif ($action == 'опубликованные') {
			$conditions = array('Report.reportstate'=>3);
			$viewtext = 'Заключения опубликованные на сайте';
		}
		elseif ($action == 'принятые') {
			$conditions = array('Project.projectstate'=>2);
			$viewtext = 'Заключения по принятым проектам';
		}
		elseif ($action == 'несколькоэкспертов') {
			$conditions = array('Project.reportmultipleedit'=>1);
			$viewtext = 'Заключения с возможностью редактирования несколькими экспертами';
		}
		if ($this->data['Project']['search'] !='') {
			if ($this->data['Project']['searchtype'] == 1)
				$conditions = array('Project.reportnumber LIKE'=>'%'.$this->data['Project']['search'].'%');
			elseif ($this->data['Project']['searchtype'] == 2)
				$conditions = array('Project.projectnumber LIKE'=>'%'.$this->data['Project']['search'].'%');
			elseif ($this->data['Project']['searchtype'] == 3)
				$conditions = array('Project.name LIKE'=>'%'.$this->data['Project']['search'].'%');
			$viewtext = 'Найденные заключения';
			$action = null;
		}
		$this->Report->recursive = 0;
		$this->Project->Expert->recursive = -1;
		$countreports = $this->Report->find('count', array('conditions'=>$conditions));
		$reports = $this->paginate('Report', $conditions);
		$experts = $this->Report->Project->Expert->find('list', array('fields'=>array('Expert.id', 'Expert.fullname'), 'conditions'=>array('Expert.isadmin'=>0), 'order'=>'Expert.fullname ASC'));
		$this->Report->Project->Author->recursive = -1;
		$authors = $this->Report->Project->Author->find('list', array('fields'=>array('Author.id', 'Author.name'), 'order'=>'Author.name ASC'));
		$this->set(compact('countreports', 'reports', 'viewtext', 'experts', 'authors', 'action'));
	}

	function admin_statistic() {
		$safeMode = ( @ini_get("safe_mode") == 'On' || @ini_get("safe_mode") === 1 ) ? TRUE : FALSE;
		if ( $safeMode === FALSE ) {
			set_time_limit(300); // Sets maximum execution time to 5 minutes (300 seconds)
			ini_set("max_execution_time", "300"); // this does the same as "set_time_limit(300)"
		}
		$filter = array();
		if ($this->data['Project']['expert_id'] != '')
			$filter = array_merge($filter, array('Project.expert_id'=>$this->data['Project']['expert_id']));
		if ($this->data['Project']['author_id'] != '')
			$filter = array_merge($filter, array('Project.author_id'=>$this->data['Project']['author_id']));
		if ($this->data['Project']['projecttype'] != '')
			$filter = array_merge($filter, array('Project.projecttype'=>$this->data['Project']['projecttype']));
		if ($this->data['Project']['projectstate'] != '')
			$filter = array_merge($filter, array('Project.projectstate'=>$this->data['Project']['projectstate']));
		if ($this->data['Project']['initiative'] != '')
			if ($this->data['Project']['initiative'] == 'депутаты Парламента')
				$filter = array_merge($filter, array('Project.initiative'=>array('депутат', 'группа депутатов')));
			else $filter = array_merge($filter, array('Project.initiative'=>$this->data['Project']['initiative']));
		if ($this->data['Report']['p06radio1'] != '')
			$filter = array_merge($filter, array('Report.p06radio1'=>$this->data['Report']['p06radio1']));
		$filterprojects = $filter;
		$filterreports = $filter;
		if ($this->data['Report']['date1'] != '') {
			$filterreports = array_merge($filterreports, array('Report.reportdate >= '=>$this->data['Report']['date1']));
			$filterprojects = array_merge($filterprojects, array('Project.projectdate >= '=>$this->data['Report']['date1']));
		}
		if ($this->data['Report']['date2'] != '') {
			$filterreports = array_merge($filterreports, array('Report.reportdate <= '=>$this->data['Report']['date2']));
			$filterprojects = array_merge($filterprojects, array('Project.projectdate <= '=>$this->data['Report']['date2']));
		}
		$filterreports = array_merge(array('Report.reportstate'=>3), $filterreports);

		$this->Report->Project->recursive = 0;
		$statisticprojectsall = array();
		$fields = array('COUNT(projectnumber) AS countproject', 'SUM(numberpages) AS numberpages', 'SUM(numberprojectsstandard) AS numberprojectsstandard');
		$statisticprojectsall['examinare'] = $this->Report->Project->find('all', array('fields'=>$fields, 'conditions'=>array_merge($filterprojects, array('Project.projectstate'=>1))));
		$statisticprojectsall['adoptate'] = $this->Report->Project->find('all', array('fields'=>$fields, 'conditions'=>array_merge($filterprojects, array('Project.projectstate'=>2))));
		$statisticprojectsall['retrase'] = $this->Report->Project->find('all', array('fields'=>$fields, 'conditions'=>array_merge($filterprojects, array('Project.projectstate'=>3))));

		$fields = array('Project.expert_id', 'Project.author_id', 'Project.initiative', 'Project.projecttype', 'Project.projectdomain', 'Project.numberpages');
		$statisticexpertsauthors = $this->Report->Project->find('all', array('fields'=>$fields, 'conditions'=>$filterprojects));
		$statisticexpertsauthors = $this->__statistic_experts_authors_total($statisticexpertsauthors);

		$this->Report->recursive = 0;
		$fields = array('Report.id', 'Project.projecttype', 'Project.projecttypevizat', 'Project.projectdomain',
						'Report.p02list1', 'Report.p02list2', 'Report.p03radio1', 'Report.p05list1', 'Report.p06radio1',
						'Report.p07radio1', 'Report.p08radio1', 'Report.p08radio2', 'Report.p09radio1', 'Report.p09radio2',
						'Report.p10radio1', 'Report.p11radio1', 'Report.p11radio2', 'Report.p12radio1', 'Report.p12radio2',
						'Report.p13radio1', 'Report.p14radio1', 'Report.p15radio1', 'Report.p15radio2');

		$statisticreportsall = $this->Report->find('all', array('fields'=>$fields, 'conditions'=>$filterreports));
		$statisticreportsall = $this->__statistic_reports_total($statisticreportsall);

		$this->Report->Subreport->Celem->recursive = -1;
		$this->Report->Subreport->Pelem->recursive = -1;
		$celemgroups = $this->Report->Subreport->Celem->find('all', array('fields'=>array('DISTINCT Celem.celemgroup')));
		$celemgroups = Set::extract('/Celem/celemgroup', $celemgroups);
		$celems = $this->Report->Subreport->Celem->find('all', array('order'=>'Celem.number ASC'));
		$celems = Set::combine($celems, '{n}.Celem.id', '{n}.Celem');

		$this->Report->recursive = 2;
		$fields = array('Report.id', 'Project.projectdomain');
		$this->Report->unbindModel(array('hasMany'=>array('Attachment')));
		$this->Report->Subreport->unbindModel(array('belongsTo'=>array('Report'), 'hasAndBelongsToMany'=>array('Pelem')));
		$statisticelementsall = $this->Report->find('all', array('fields'=>$fields, 'conditions'=>$filterreports));
		$statisticelementsall = $this->__statistic_elements_all_total($statisticelementsall, $celems);

		$fields = array('Report.id', 'Project.projectdomain', 'Project.projectstate');
		if ($this->data['Project']['projectstate'] == '')
			$filterreports = array_merge(array('Project.projectstate'=>array(2, 3)), $filterreports);
		$this->Report->unbindModel(array('hasMany'=>array('Attachment')));
		$this->Report->Subreport->unbindModel(array('belongsTo'=>array('Report')));
		$statisticelementsefficiency = $this->Report->find('all', array('fields'=>$fields, 'conditions'=>$filterreports));
		$statisticelementsefficiency = $this->__statistic_elements_efficiency_total($statisticelementsefficiency, $celems);

		$this->Report->recursive = 0;
		$this->Report->Subreport->Pelem->recursive = 1;
		$reportsnumbers = $this->Report->find('all', array('fields'=>array('Report.id', 'Project.reportnumber')));
		$reportsnumbers = Set::combine($reportsnumbers, '{n}.Report.id', '{n}.Project.reportnumber');
		$statisticpelems = $this->Report->Subreport->Pelem->find('all');
		foreach ($statisticpelems as $statisticpelemskey => $statisticpelemsvalue) {
			foreach ($statisticpelemsvalue['Subreport'] as $subreportvalue) {
				$statisticpelems[$statisticpelemskey]['Report'][$reportsnumbers[$subreportvalue['report_id']]] = 1;
			}
		}
		$statisticpelems = Set::combine($statisticpelems, '{n}.Pelem.celem_id', '{n}.Report');

		$this->Report->Project->Expert->recursive = -1;
		$experts = $this->Report->Project->Expert->find('list', array('fields'=>array('Expert.id', 'Expert.fullname'), 'conditions'=>array('Expert.isadmin'=>0), 'order'=>'Expert.fullname ASC'));

		$this->Report->Project->Author->recursive = -1;
		$authors = $this->Report->Project->Author->find('list', array('fields'=>array('Author.id', 'Author.name'), 'order'=>'Author.name ASC'));

		$this->set(compact('statisticprojectsall', 'statisticexpertsauthors', 'statisticreportsall', 'statisticelementsall',
			'statisticelementsefficiency', 'statisticpelems', 'celems', 'celemgroups', 'experts', 'authors'));
	}

	function __statistic_experts_authors_total($table) {
		$result = array();
		foreach ($table as $tablevalue) {
			$project = $tablevalue['Project'];
			$result['total']++;
			$result['total_numberpages'] = $result['total_numberpages'] + $project['numberpages'];
			$result[$project['projecttype']]['total']++;
			$result[$project['projecttype']]['total_numberpages'] = $result[$project['projecttype']]['total_numberpages'] + $project['numberpages'];
			$result['Experts'][$project['expert_id']]['total']++;
			$result['Experts'][$project['expert_id']]['total_numberpages'] = $result['Experts'][$project['expert_id']]['total_numberpages'] + $project['numberpages'];
			$result[$project['projecttype']]['Experts'][$project['expert_id']]['projects']++;
			$result[$project['projecttype']]['Experts'][$project['expert_id']]['numberpages'] = $result[$project['projecttype']]['Experts'][$project['expert_id']]['numberpages'] + $project['numberpages'];
			if ($project['initiative'] == 'Правительство' || $project['projecttype'] == 'по запросу') {
				$result['Authors']['total']++;
				$result['Authors'][$project['author_id']]['total']++;
				$result[$project['projecttype']]['Authors']['total']++;
				$result[$project['projecttype']]['Authors'][$project['author_id']]['projects']++;
			}
			if ($project['projecttype'] == 'проект закона') {
				$result[$project['projecttype']]['bydomain'][$project['projectdomain']]['total']++;
				$result[$project['projecttype']]['bydomain'][$project['initiative']]['total']++;
				$result[$project['projecttype']]['bydomain'][$project['projectdomain']][$project['initiative']]['total']++;
			}
		}
		return $result;
	}

	function __statistic_elements_efficiency_total($reports, $celems) {
		$result = array();
		$result['total_reports'] = 0;
		foreach ($reports as $report) {
			$domain = $report['Project']['projectdomain'];
			$projectstate = $report['Project']['projectstate'];
			foreach ($report['Subreport'] as $subreport) {
				foreach ($subreport['Celem'] as $celem) {
					$result[$domain][$celem['celemgroup']]['total_celem_bygroup']++;
					$result[$domain]['celems'][$celem['id']]['total']++;
					$result[$domain]['total_celems_bydomain']++;
					$result['total_celems']++;
				}
				if ($projectstate == 3) $subreport_pelem = $subreport['Celem'];
				else $subreport_pelem = $subreport['Pelem'];
				foreach ($subreport_pelem as $pelem) {
					$result[$domain][$celems[$pelem['id']]['celemgroup']]['total_pelem_bygroup']++;
					$result[$domain]['pelems'][$pelem['id']]['total']++;
					$result[$domain]['total_pelems_bydomain']++;
					$result['total_pelems']++;
				}
				if ($subreport['alteelemente'] !='') {
					$result[$domain]['total_other_elements_bydomain']++;
					$result['total_other_elements']++;
					$result[$domain]['total_celems_bydomain']++;
					$result['total_celems']++;
					if ($projectstate == 3 || $subreport['alteelementeacceptate'] == 1) {
						$result[$domain]['total_other_pelements_bydomain']++;
						$result['total_other_pelements']++;
						$result[$domain]['total_pelems_bydomain']++;
						$result['total_pelems']++;
					}
				}
			}
			$result[$domain]['total_reports_bydomain']++;
			$result['total_reports']++;
		}
		return $result;
	}

	function __statistic_elements_all_total($reports, $celems) {
		$result = array();
		$result['total_reports'] = 0;
		foreach ($reports as $report) {
			$domain = $report['Project']['projectdomain'];
			$fenomen_celem = array();
			$fenomen_other_elements = 0;
			foreach ($report['Subreport'] as $subreport) {
				foreach ($subreport['Celem'] as $celem) {
					$fenomen_celem[$celem['id']] = 1;
					$result[$domain][$celem['celemgroup']]['total_celem_bygroup']++;
					$result[$domain]['celems'][$celem['id']]['total']++;
					$result[$domain]['total_celems_bydomain']++;
					$result['total_celems']++;
				}
				if ($subreport['alteelemente'] !='') {
					$fenomen_other_elements = 1;
					$result[$domain]['total_other_elements_bydomain']++;
					$result['total_other_elements']++;
					$result[$domain]['total_celems_bydomain']++;
					$result['total_celems']++;
				}
				if ($subreport['alteriscuri'] !='') {
					$result[$domain]['total_other_riscs_bydomain']++;
					$result['total_other_riscs']++;
				}
			}
			foreach ($fenomen_celem as $fenomenkey => $fenomenvalue) {
				$result[$domain]['celems'][$fenomenkey]['fenomen']++;
				$result[$domain][$celems[$fenomenkey]['celemgroup']]['total_celem_fenomen_bygroup']++;
				$result[$domain]['total_celems_fenomen_bydomain']++;
				$result['total_celems_fenomen']++;
			}
			if ($fenomen_other_elements == 1) {
				$result[$domain]['total_other_elements_fenomen_bydomain']++;
				$result['total_other_elements_fenomen']++;
				$result[$domain]['total_celems_fenomen_bydomain']++;
				$result['total_celems_fenomen']++;
			}
			$result[$domain]['total_reports_bydomain']++;
			$result['total_reports']++;
		}
		return $result;
	}

	function __statistic_reports_total($table) {
		$result = array();
		$result['total_reports'] = 0;
		foreach ($table as $tablevalue) {
			$project = $tablevalue['Project'];
			$report = $tablevalue['Report'];
			$domain = $project['projectdomain'];
			$result[$domain]['total_reports_bydomain']++;
			$result['total_reports']++;
			//00
			$criterias = array('общий', 'о внесении изменений', 'о внесении дополнений', 'о внесении изменений и дополнений', 'о признании утратившим силу');
			$result = $this->__statistic_reports_total_list($domain, $result, $criterias, null, 'projecttypevizat', $project['projecttypevizat']);
			//02
			$criterias = array('органический закон', 'ординарный закон', 'конституционный закон', 'постановление Парламента', 'не указана');
			$result = $this->__statistic_reports_total_list($domain, $result, $criterias, $report['p02list2'], 'p02list', $report['p02list1']);
			//03
			$criterias = array(1, 2);
			$result = $this->__statistic_reports_total_list($domain, $result, $criterias, null, 'p03radio', $report['p03radio1']);
			//05
			$criterias = array('опубликована на сайте Парламента', 'не опубликована на сайте Парламента');
			$result = $this->__statistic_reports_total_list($domain, $result, $criterias, null, 'p05list', $report['p05list1']);
			//06
			$criterias = array(1, 2);
			$result = $this->__statistic_reports_total_list($domain, $result, $criterias, null, 'p06radio', $report['p06radio1']);
			//07
			$result = $this->__statistic_reports_total_list($domain, $result, $criterias, null, 'p07radio', $report['p07radio1']);
			//08
			$result = $this->__statistic_reports_total_radio($domain, $result, 'p08radio', $report['p08radio1'], $report['p08radio2']);
			//09
			$result = $this->__statistic_reports_total_advanced_radio($domain, $result, 'p09radio', $report['p09radio1'], $report['p09radio2']);
			//10
			$result = $this->__statistic_reports_total_list($domain, $result, $criterias, null, 'p10radio', $report['p10radio1']);
			//11
			$result = $this->__statistic_reports_total_advanced_radio($domain, $result, 'p11radio', $report['p11radio1'], $report['p11radio2']);
			//12
			$result = $this->__statistic_reports_total_advanced_radio($domain, $result, 'p12radio', $report['p12radio1'], $report['p12radio2']);
			//13
			$result = $this->__statistic_reports_total_list($domain, $result, $criterias, null, 'p13radio', $report['p13radio1']);
			//14
			$result = $this->__statistic_reports_total_list($domain, $result, $criterias, null, 'p14radio', $report['p14radio1']);
			//15
			$result = $this->__statistic_reports_total_advanced_radio($domain, $result, 'p15radio', $report['p15radio1'], $report['p15radio2']);
		}
		return $result;
	}

	function __statistic_reports_total_list($domain, $result, $criterias, $criterias_by = null, $element_name, $element_value) {
		foreach ($criterias as $criteriakey => $criteriavalue) {
			if ($element_value == $criteriavalue) {
				if (isset($criterias_by)) {
					$result[$domain][$element_name][$criterias_by][$criteriakey+1]++;
				}
				else {
					$result[$domain][$element_name][$criteriakey+1]++;
				}
			}
		}
		return $result;
	}

	function __statistic_reports_total_radio($domain, $result, $element_name, $radio1, $radio2) {
		if ($radio1 == 1 && $radio2 == 2) $result[$domain][$element_name][1]++;
		elseif ($radio1 == 2 && $radio2 == 1) $result[$domain][$element_name][2]++;
		elseif ($radio1 == 1 && $radio2 == 1) $result[$domain][$element_name][3]++;
		elseif ($radio1 == 2 && $radio2 == 2) $result[$domain][$element_name][4]++;
		return $result;
	}

	function __statistic_reports_total_advanced_radio($domain, $result, $element_name, $radio1, $radio2) {
		if ($radio1 == 1) $result[$domain][$element_name][1]++;
		elseif ($radio1 == 2) $result[$domain][$element_name][4]++;
		if ($radio1 == 1 && $radio2 == 1) $result[$domain][$element_name][2]++;
		elseif ($radio1 == 1 && $radio2 == 2) $result[$domain][$element_name][3]++;
		return $result;
	}

}
?>