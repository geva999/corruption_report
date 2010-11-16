<?php
class ExpertsController extends AppController {

	var $name = 'Experts';
	var $helpers = array('Html', 'Form', 'Javascript', 'Ajax');
	var $components = array('RequestHandler');

	function isAuthorized() {
		$adminrights = array('admin_index', 'admin_add', 'admin_edit', 'admin_delete', 'logout');
		$expertrights = array('logout');
		if ($this->Auth->user('isadmin') == 1 && in_array($this->action, $adminrights)) return true;
		elseif ($this->Auth->user('isadmin') == 0 && in_array($this->action, $expertrights)) return true;
		else return false;
    }
	
	function login() {
		$this->layout='login';
		if ($this->Auth->user()) {
			if ($this->Auth->user('isadmin') == 1) $this->redirect('/admin/reports');
			else if ($this->Auth->user('isadmin') == 0) $this->redirect('/reports');
		}
	}
	
	function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	function index() {
	}

	function admin_index() {
		$this->Expert->recursive = -1;
		$countexperts = $this->Expert->find('count');
		$experts = $this->paginate('Expert');
		$this->set(compact('experts', 'countexperts'));
		
	}
	
	function admin_add() {
		if (!empty($this->data)) {
			$this->Expert->create();
			if ($this->Expert->save($this->data)) {
				$this->Session->setFlash(__('Expertul a fost salvat.', true), 'jgrowl');
				$this->redirect('/admin/experts');
			} else {
				$this->Session->setFlash(__('Expertul nu poate fi salvat. Posibil există deja un expert cu acelaşi login. Verificaţi datele introduse şi mai incercaţi încă o data.', true), 'jgrowl');
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('ID invalid pentru expert.', true), 'jgrowl');
			$this->redirect('/admin/experts');
		}
		if (!empty($this->data)) {
			if ($this->Expert->save($this->data)) {
				$this->Session->setFlash(__('Expertul a fost salvat.', true), 'jgrowl');
				$this->redirect('/admin/experts');
			} else {
				$this->Session->setFlash(__('Expertul nu poate fi salvat. Posibil există deja un expert cu acelaşi login. Verificaţi datele introduse şi mai incercaţi încă o data.', true), 'jgrowl');
			}
		}
		if (empty($this->data)) {
			$this->Expert->recursive = -1;
			$this->data = $this->Expert->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID invalid pentru expert.', true), 'jgrowl');
			$this->redirect('/admin/experts');
		}
		if ($this->Expert->del($id)) {
			$this->Session->setFlash(__('Expertul a fost şters.', true), 'jgrowl');
			$this->redirect('/admin/experts');
		}
	}

}
?>