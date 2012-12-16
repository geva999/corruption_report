<?php
App::uses('AppController', 'Controller');

class ProjectsController extends AppController {

  function isAuthorized() {
    $adminrights = array('admin_index', 'admin_index_expert', 'admin_add', 'admin_edit', 'admin_delete');
    $expertrights = array('index', 'accept', 'reject');
    if ($this->Auth->user('isadmin') == 1 && in_array($this->request->action, $adminrights)) return true;
    elseif ($this->Auth->user('isadmin') == 0 && in_array($this->request->action, $expertrights)) return true;
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
      $project = $this->Project->read(null, $id);
      if ($project['Project']['projectreportstate'] == 2) {
        $this->Project->id = $id;
        if ($this->Project->saveField('projectreportstate', 3, true)) {
          $this->Project->recursive = -1;
          $project = $this->Project->read(null, $id);
          $this->request->data = array();
          $this->request->data['Report']['project_id'] = $project['Project']['id'];
          $this->request->data['Report']['p09text1'] = 'Согласно п. 7) статьи 21 Закона о нормативных правовых актах Р. Казахстан, к проекту должны прилагаться финансово-экономические затраты, если проект предусматривает сокращение государственных доходов или увеличение государственных расходов.';
          $this->request->data['Report']['p11text1'] = 'Из текста проекта не вытекает установление или прямое продвижение груповых или личных интересов/выгод, несовместимые/противоречащие общим интересам общества.';
          $this->request->data['Report']['p12text1'] = 'Из текста проекта и его последующего применения не вытекает прямое ущемление интересов (прав, свобод) определенной категории лиц или ущемление общих интересов общества.';
          $this->request->data['Report']['p13text1'] = 'Предписания проекта не противоречат предписаниям другого законодательства.';
          $this->request->data['Report']['p14text1'] = 'Формулировки, содержащиеся в проекте, являются достаточно четкими и сжатыми, а изложение текста соответствует правилам законодательной техники, юридического языка, соблюдают правила орфографии и пунктуации.';
          $this->request->data['Report']['p15text1'] = 'Проект не регулирует полномочия государственных органов, новые административные процедуры ил другие аспекты, касающиеся их деятельности.';
          $this->Project->Report->create();
          $this->Project->Report->save($this->request->data);
        }
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
    $viewtext = 'Проекты';
    switch ($action) {
      case 'рассмотрение':
        $conditions = array('Project.projectstate'=>1);
        $viewtext = 'Проекты в процессе расмотрения';
        break;
      case 'принятые':
        $conditions = array('Project.projectstate'=>2);
        $viewtext = 'Принятые проекты';
        break;
      case 'отозванные':
        $conditions = array('Project.projectstate'=>3);
        $viewtext = 'Отозванные проекты';
        break;
      case 'дляободрения':
        $conditions = array('Project.projectreportstate'=>2);
        $viewtext = 'Проекты направленные на утверждение эксперту';
        break;
      case 'одобренные':
        $conditions = array('Project.projectreportstate'=>3);
        $viewtext = 'Проекты принятые экспертом к рассмотрению';
        break;
      case 'отклоненные':
        $conditions = array('Project.projectreportstate'=>4);
        $viewtext = 'Проекты отклоненные экспертом';
        break;
    }
    if ($this->request->data['Project']['search'] !='') {
      if ($this->request->data['Project']['searchtype'] == 1)
        $conditions = array('Project.reportnumber LIKE'=>'%'.$this->request->data['Project']['search'].'%');
      elseif ($this->request->data['Project']['searchtype'] == 2)
        $conditions = array('Project.projectnumber LIKE'=>'%'.$this->request->data['Project']['search'].'%');
      elseif ($this->request->data['Project']['searchtype'] == 3)
        $conditions = array('Project.name LIKE'=>'%'.$this->request->data['Project']['search'].'%');
      else {
        $this->Project->Expert->recursive = -1;
        $experts = $this->Project->Expert->find('list', array('fields'=>array('Expert.id'), 'conditions'=>array('Expert.isadmin'=>0, 'Expert.fullname LIKE'=>'%'.$this->request->data['Project']['search'].'%')));
        $conditions = array('Project.expert_id'=>$experts);
      }
      $viewtext = 'Найденные проекты';
      $action = null;
    }
    $this->Project->recursive = 0;
    $countprojects = $this->Project->find('count', array('conditions'=>$conditions));
    $projects = $this->paginate('Project', $conditions);
    $this->set(compact('countprojects', 'projects', 'viewtext', 'action'));
  }

  function admin_add() {
    if (!empty($this->request->data)) {
      if (is_uploaded_file($this->request->data['Project']['file']['tmp_name'])) {
        $filename = $this->request->data['Project']['file']['name'];
        //$filename = substr($filename, 0, strlen($filename)-strlen(strrchr($filename, "."))).'_'.mt_rand().'.'.substr(strrchr($filename, "."), 1);
        move_uploaded_file($this->request->data['Project']['file']['tmp_name'], 'uploaded/projects/'.$filename);
        $this->request->data['Project']['filename'] = $filename;
      }
      if ($this->request->data['Project']['initiative'] != 'Правительство' && $this->request->data['Project']['projecttype'] == 'проект закона') $this->request->data['Project']['author_id'] = 0;
      $this->Project->create();
      $this->Project->set($this->request->data);
      if ($this->Project->validates()) {
        if ($this->Project->save($this->request->data, false)) {
          if (!empty($this->request->data['Projectexpert'])) {
            foreach ($this->request->data['Projectexpert'] as $projectexpertkey => $projectexpertvalue)
              $this->request->data['Projectexpert'][$projectexpertkey]['project_id'] = $this->Project->id;
            $this->Project->Projectexpert->saveAll($this->request->data['Projectexpert']);
          }
          $this->Session->setFlash(__('Проект был сохранен.'), 'jgrowl');
          $this->redirect('/admin/projects');
        }
        else $this->Session->setFlash(__('Проект не может быть сохранен. Проверьте введенные данные и попробуйте еще раз.'), 'jgrowl');
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
    if (!$id && empty($this->request->data)) {
      $this->Session->setFlash(__('Неверный ID для проекта.'), 'jgrowl');
      $this->redirect('/admin/projects');
    }
    if (!empty($this->request->data)) {
      if (is_uploaded_file($this->request->data['Project']['file']['tmp_name'])) {
        $filename = $this->request->data['Project']['file']['name'];
        //$filename = substr($filename, 0, strlen($filename)-strlen(strrchr($filename, "."))).'_'.mt_rand().'.'.substr(strrchr($filename, "."), 1);
        move_uploaded_file($this->request->data['Project']['file']['tmp_name'], 'uploaded/projects/'.$filename);
        $this->request->data['Project']['filename'] = $filename;
      }
      if ($this->request->data['Project']['initiative'] != 'Правительство' && $this->request->data['Project']['projecttype'] == 'проект закона') $this->request->data['Project']['author_id'] = 0;
      $this->Project->set($this->request->data);
      if ($this->Project->validates()) {
        if ($this->Project->save($this->request->data, false)) {
          if ($this->request->data['Project']['projecttype'] == 'по запросу')
            $reportupdate = array('Report.p02list1'=>NULL, 'Report.p02list2'=>NULL, 'Report.p02text1'=>NULL, 'Report.p02option1'=>0, 'Report.p02option2'=>0, 'Report.p05list1'=>NULL, 'Report.p05text1'=>NULL);
          else
            $reportupdate = array();
          if ($this->request->data['Project']['reportimpact'] != 1)
            $reportupdate = array_merge($reportupdate, array('Report.p10text1'=>NULL, 'Report.p10radio1'=>0));
          if (!empty($reportupdate))
            $this->Project->Report->updateAll($reportupdate, array('Report.project_id'=>$id));
          $this->Project->Projectexpert->deleteAll(array('Projectexpert.project_id'=>$this->Project->id));
          if (!empty($this->request->data['Projectexpert'])) {
            foreach ($this->request->data['Projectexpert'] as $projectexpertkey => $projectexpertvalue)
              $this->request->data['Projectexpert'][$projectexpertkey]['project_id'] = $this->Project->id;
            $this->Project->Projectexpert->saveAll($this->request->data['Projectexpert']);
          }
          $this->Session->setFlash(__('Проект был сохранен.'), 'jgrowl');
          $this->redirect('/admin/projects');
        }
        else $this->Session->setFlash(__('Проект не может быть сохранен. Проверьте введенные данные и попробуйте еще раз.'), 'jgrowl');
      }
    }
    if (empty($this->request->data)) {
      $this->Project->recursive = -1;
      $this->request->data = $this->Project->read(null, $id);
      $this->Project->Projectexpert->recursive = -1;
      $projectexperts = $this->Project->Projectexpert->find('all', array('conditions'=>array('Projectexpert.project_id'=>$id), 'order'=>'Projectexpert.id ASC'));
      $this->request->data['Projectexpert'] = Set::extract($projectexperts, '{n}.Projectexpert');
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
      $this->Session->setFlash(__('Неверный ID для проекта.'), 'jgrowl');
      $this->redirect('/admin/projects');
    }
    if ($this->Project->delete($id)) {
      $this->Session->setFlash(__('Проект был удален.'), 'jgrowl');
      $this->redirect('/admin/projects');
    }
  }

}
