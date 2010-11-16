<?php
class AuthorsController extends AppController {

	var $name = 'Authors';
	var $helpers = array('Html', 'Form', 'Javascript', 'Ajax');
	var $components = array('RequestHandler');

	function isAuthorized() {
		$adminrights = array('admin_index', 'admin_add', 'admin_edit', 'admin_delete');
		if ($this->Auth->user('isadmin') == 1 && in_array($this->action, $adminrights)) return true;
		else return false;
    }

	function index() {
	}

	function admin_index() {
		$this->Author->recursive = -1;
		$countauthors = $this->Author->find('count');
		$authors = $this->paginate('Author');
		$this->set(compact('countauthors', 'authors'));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Author->create();
			if ($this->Author->save($this->data)) {
				$this->Session->setFlash(__('Autorul nemijlocit a fost salvat.', true), 'jgrowl');
				$this->redirect('/admin/authors');
			} else {
				$this->Session->setFlash(__('Autorul nemijlocit nu poate fi salvat. Posibil există deja un expert cu acelaşi login. Verificaţi datele introduse şi mai incercaţi încă o data.', true));
			}
		}
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('ID invalid pentru autor nemijlocit.', true), 'jgrowl');
			$this->redirect('/admin/experts');
		}
		if (!empty($this->data)) {
			if ($this->Author->save($this->data)) {
				$this->Session->setFlash(__('Autorul nemijlocit a fost salvat.', true), 'jgrowl');
				$this->redirect('/admin/authors');
			} else {
				$this->Session->setFlash(__('Autorul nemijlocit nu poate fi salvat. Posibil există deja un expert cu acelaşi login. Verificaţi datele introduse şi mai incercaţi încă o data.', true));
			}
		}
		if (empty($this->data)) {
			$this->Author->recursive = -1;
			$this->data = $this->Author->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('ID invalid pentru autor nemijlocit.', true), 'jgrowl');
			$this->redirect('/admin/authors');
		}
		if ($this->Author->del($id)) {
			$this->Session->setFlash(__('Autorul nemijlocit a fost şters.', true), 'jgrowl');
			$this->redirect('/admin/authors');
		}
	}

}
?>