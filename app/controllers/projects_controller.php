<?php
class ProjectsController extends AppController {

	var $name = 'Projects';
	var $helpers = array('Html', 'Form', 'Javascript', 'Ajax');
	var $components = array('RequestHandler');

	function isAuthorized() {
		$adminrights = array('admin_index', 'admin_index_expert', 'admin_add', 'admin_edit', 'admin_delete');
		$expertrights = array('index', 'accept', 'reject');
		if ($this->Auth->user('isadmin') == 1 && in_array($this->action, $adminrights)) return true;
		elseif ($this->Auth->user('isadmin') == 0 && in_array($this->action, $expertrights)) return true;
		else return false;
    }
	
	function index() {
		$this->Project->recursive = -1;
		$loginedexpertid = $this->Auth->user('id');
		$countsaved = $this->Project->find('count', array('conditions'=>array('Project.projectreportstate'=>2, 'Project.expert_id'=>$loginedexpertid)));
		$countaccepted = $this->Project->find('count', array('conditions'=>array('Project.projectreportstate'=>3, 'Project.expert_id'=>$loginedexpertid)));
		$projectssaved = $this->Project->find('all', array('conditions'=>array('Project.projectreportstate'=>2, 'Project.expert_id'=>$loginedexpertid)));
		$projectsaccepted = $this->paginate('Project', array('Project.projectreportstate'=>3, 'Project.expert_id'=>$loginedexpertid));
		$this->set(compact('countsaved', 'countaccepted', 'countrejected', 'projectssaved', 'projectsaccepted', 'projectsrejected'));
	}
	
	function accept($id = null) {
		Configure::write('debug', '0');
		$this->layout = 'ajaxlayout';
		if (isset($id)) {
			$this->Project->id = $id;
			if ($this->Project->saveField('projectreportstate', 3, true)) {
				$this->Project->recursive = -1;
				$project = $this->Project->read(null, $id);
				$this->data = array();
				$this->data['Report']['project_id'] = $project['Project']['id'];
				$this->data['Report']['p08text1'] = 'Potrivit lit. c) a  articolului 20 al Legii 780/2001privind actele legislative, nota informativă trebuie să includă referinţe la reglementările corespondente ale legislaţiei comunitare şi nivelul compatibilităţii proiectului de act legislativ cu reglementările în cauză.';
				$this->data['Report']['p09text1'] = 'Potrivit lit. d) a art.20 din Legea 780/2001 privind actele legislative, nota informativă trebuie să conţină informaţii  privind „fundamentarea economico-financiară în cazul în care realizarea noilor reglementări necesită cheltuieli financiare şi de altă natură”. Potrivit art.47 alin.(6) din Regulamentul Parlamentului, În cazul în care realizarea noilor reglementări necesită cheltuieli financiare, materiale şi de altă natură, se anexează fundamentarea economico-financiară.';
				$this->data['Report']['p11text1'] = 'Din textul proiectului nu rezultă stabilirea şi promovarea expresă a unor interese/beneficii de grup sau individuale, necorelate/contrare interesului public general.';
				$this->data['Report']['p12text1'] = 'Din textul proiectului şi aplicarea ulterioară a acestuia nu rezultă expres prejudicierea intereselor (drepturilor, libertăţilor) anumitor categorii de persoane sau prejudicierea interesului public.';
				$this->data['Report']['p13text1'] = 'Prevederile proiectului nu sînt concurente cu alte prevederi ale legislaţiei.';
				$this->data['Report']['p14text1'] = 'Formulările conţinute în proiect sînt suficient de clare şi concise, exprimările întrunind rigorile tehnicii legislative, ale limbajului juridic, respectă regulile de ortografie şi punctuaţie.';
				$this->data['Report']['p15text1'] = 'Proiectul nu stabileşte atribuţii ale autorităţilor publice, nici proceduri administrative noi sau alte chestiuni vizînd activitatea acestora.';
				$this->Project->Report->create();
				$this->Project->Report->save($this->data);
			}	
		}
		$this->redirect('/projects');
	}
	
	function reject($id = null) {
		Configure::write('debug', '0');
		$this->layout = 'ajaxlayout';
		if (isset($id)) {
			$this->Project->id = $id;
			$this->Project->saveField('projectreportstate', 4, true);
		}
		$this->redirect('/projects');
	}

	function admin_index($action = null) {
		$conditions = array();
		$viewtext = 'Proiecte';
		switch ($action) {
			case 'examinare':
				$conditions = array('Project.projectstate'=>1);
				$viewtext = 'Proiecte în curs de examinare';
				break;
			case 'adoptate':
				$conditions = array('Project.projectstate'=>2);
				$viewtext = 'Proiecte adoptate';
				break;
			case 'retrase':
				$conditions = array('Project.projectstate'=>3);
				$viewtext = 'Proiecte retrase';
				break;
			case 'spreaprobare':
				$conditions = array('Project.projectreportstate'=>2);
				$viewtext = 'Proiecte trimise spre aprobare către expert';
				break;
			case 'acceptate':
				$conditions = array('Project.projectreportstate'=>3);
				$viewtext = 'Proiecte acceptate de expert';
				break;
			case 'respinse':
				$conditions = array('Project.projectreportstate'=>4);
				$viewtext = 'Proiecte respinse de expert';
				break;
		}
		if ($this->data['Project']['search'] !='') {
			if ($this->data['Project']['searchtype'] == 1)
				$conditions = array('Project.reportnumber LIKE'=>'%'.$this->data['Project']['search'].'%');
			elseif ($this->data['Project']['searchtype'] == 2)
				$conditions = array('Project.projectnumber LIKE'=>'%'.$this->data['Project']['search'].'%');
			elseif ($this->data['Project']['searchtype'] == 3)
				$conditions = array('Project.name LIKE'=>'%'.$this->data['Project']['search'].'%');
			else {
				$this->Project->Expert->recursive = -1;
				$experts = $this->Project->Expert->find('list', array('fields'=>array('Expert.id'), 'conditions'=>array('Expert.isadmin'=>0, 'Expert.fullname LIKE'=>'%'.$this->data['Project']['search'].'%')));
				$conditions = array('Project.expert_id'=>$experts);
			}
			$viewtext = 'Proiecte găsite';
			$action = null;
		}
		$this->Project->recursive = 0;
		$countprojects = $this->Project->find('count', array('conditions'=>$conditions));
		$projects = $this->paginate('Project', $conditions);
		$this->set(compact('countprojects', 'projects', 'viewtext', 'action'));
	}

	function admin_add() {
		if (!empty($this->data)) {
			if (is_uploaded_file($this->data['Project']['file']['tmp_name'])) {
				$filename = $this->data['Project']['file']['name'];
				//$filename = substr($filename, 0, strlen($filename)-strlen(strrchr($filename, "."))).'_'.mt_rand().'.'.substr(strrchr($filename, "."), 1);
				move_uploaded_file($this->data['Project']['file']['tmp_name'], 'uploaded/projects/'.$filename);
				$this->data['Project']['filename'] = $filename;
			}
			if ($this->data['Project']['initiative'] != 'Guvernul RM' && $this->data['Project']['projecttype'] == 'proiect de lege') $this->data['Project']['author_id'] = 0;
			$this->Project->create();
			$this->Project->set($this->data);
			if ($this->Project->validates()) {
				if ($this->Project->save($this->data, false)) {
					if (!empty($this->data['Projectexpert'])) {
						foreach ($this->data['Projectexpert'] as $projectexpertkey => $projectexpertvalue)
							$this->data['Projectexpert'][$projectexpertkey]['project_id'] = $this->Project->id;
						$this->Project->Projectexpert->saveAll($this->data['Projectexpert']);
					}
					$this->Session->setFlash(__('Proiectul a fost salvat.', true), 'jgrowl');
					$this->redirect('/admin/projects');
				}
				else $this->Session->setFlash(__('Proiectul nu poate fi salvat. Verificaţi datele introduse şi mai incercaţi incă o dată.', true), 'jgrowl');
			}
		}
		$this->Project->Expert->recursive = -1;
		$this->Project->Author->recursive = -1;
		$experts = $this->Project->Expert->find('list', array('fields'=>array('Expert.id', 'Expert.fullname'), 'conditions'=>array('Expert.isadmin'=>0), 'order'=>'Expert.fullname ASC'));
		$projectexpertslist = $this->Project->Expert->find('list', array('fields'=>array('Expert.id', 'Expert.fullname'), 'order'=>'Expert.fullname ASC'));
		$authors = $this->Project->Author->find('list', array('fields'=>array('Author.id', 'Author.name'), 'order'=>'Author.name ASC'));
		$this->set(compact('experts', 'projectexpertslist', 'authors'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('ID invalid pentru proiect.', true), 'jgrowl');
			$this->redirect('/admin/projects');
		}
		if (!empty($this->data)) {
			if (is_uploaded_file($this->data['Project']['file']['tmp_name'])) {
				$filename = $this->data['Project']['file']['name'];
				//$filename = substr($filename, 0, strlen($filename)-strlen(strrchr($filename, "."))).'_'.mt_rand().'.'.substr(strrchr($filename, "."), 1);
				move_uploaded_file($this->data['Project']['file']['tmp_name'], 'uploaded/projects/'.$filename);
				$this->data['Project']['filename'] = $filename;
			}
			if ($this->data['Project']['initiative'] != 'Guvernul RM' && $this->data['Project']['projecttype'] == 'proiect de lege') $this->data['Project']['author_id'] = 0;
			$this->Project->set($this->data);
			if ($this->Project->validates()) {
				if ($this->Project->save($this->data, false)) {
					if ($this->data['Project']['projecttype'] == 'solicitare expresă')
						$reportupdate = array('Report.p02list1'=>NULL, 'Report.p02list2'=>NULL, 'Report.p02text1'=>NULL, 'Report.p02option1'=>0, 'Report.p02option2'=>0, 'Report.p05list1'=>NULL, 'Report.p05text1'=>NULL);
					else $reportupdate = array();
					if ($this->data['Project']['reporttrasnparenta'] != 1)
						$reportupdate = array_merge($reportupdate, array('Report.p03text1'=>NULL, 'Report.p03radio1'=>0));
					if ($this->data['Project']['reportrespectaretermen'] != 1)
						$reportupdate = array_merge($reportupdate, array('Report.p06text1'=>NULL, 'Report.p06radio1'=>0));
					if ($this->data['Project']['reportimpact'] != 1)
						$reportupdate = array_merge($reportupdate, array('Report.p10text1'=>NULL, 'Report.p10radio1'=>0));
					$this->Project->Report->updateAll($reportupdate, array('Report.project_id'=>$id));
					$this->Project->Projectexpert->deleteAll(array('Projectexpert.project_id'=>$this->Project->id));
					if (!empty($this->data['Projectexpert'])) {
						foreach ($this->data['Projectexpert'] as $projectexpertkey => $projectexpertvalue)
							$this->data['Projectexpert'][$projectexpertkey]['project_id'] = $this->Project->id;
						$this->Project->Projectexpert->saveAll($this->data['Projectexpert']);
					}
					$this->Session->setFlash(__('Proiectul a fost salvat.', true), 'jgrowl');
					$this->redirect('/admin/projects');
				}
				else $this->Session->setFlash(__('Proiectul nu poate fi salvat. Verificaţi datele introduse şi mai incercaţi incă o dată.', true), 'jgrowl');
			}
		}
		if (empty($this->data)) {
			$this->Project->recursive = -1;
			$this->data = $this->Project->read(null, $id);
			$this->Project->Projectexpert->recursive = -1;
			$projectexperts = $this->Project->Projectexpert->find('all', array('conditions'=>array('Projectexpert.project_id'=>$id), 'order'=>'Projectexpert.id ASC'));
			$this->data['Projectexpert'] = Set::extract($projectexperts, '{n}.Projectexpert');
			//     Example of parsing an table                $userArray['Subreport'] = Set::extract($subreports, '{n}.Subreport');
		}
		$this->Project->Expert->recursive = -1;
		$this->Project->Author->recursive = -1;
		$experts = $this->Project->Expert->find('list', array('fields'=>array('Expert.id', 'Expert.fullname'), 'conditions'=>array('Expert.isadmin'=>0), 'order'=>'Expert.fullname ASC'));
		$projectexpertslist = $this->Project->Expert->find('list', array('fields'=>array('Expert.id', 'Expert.fullname'), 'order'=>'Expert.fullname ASC'));
		$authors = $this->Project->Author->find('list', array('fields'=>array('Author.id', 'Author.name'), 'order'=>'Author.name ASC'));
		$this->set(compact('experts', 'projectexpertslist', 'authors'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID invalid pentru proiect.', true), 'jgrowl');
			$this->redirect('/admin/projects');
		}
		if ($this->Project->del($id)) {
			$this->Session->setFlash(__('Proiectul a fost şters.', true), 'jgrowl');
			$this->redirect('/admin/projects');
		}
	}

}
?>