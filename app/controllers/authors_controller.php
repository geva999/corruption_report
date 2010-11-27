<?php
class AuthorsController extends AppController {
	var $name = 'Authors';

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
				$this->Session->setFlash(__('Непосредственный автор был сохранен.', true), 'jgrowl');
				$this->redirect('/admin/authors');
			} else {
				$this->Session->setFlash(__('Непосредственный автор не может быть сохранен. Наверно уже существует автор под тем же именем. Проверьте введенные данные и попробуйте еще раз.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Неверный ID для непосредственного автора.', true), 'jgrowl');
			$this->redirect('/admin/experts');
		}
		if (!empty($this->data)) {
			if ($this->Author->save($this->data)) {
				$this->Session->setFlash(__('Непосредственный автор был сохранен.', true), 'jgrowl');
				$this->redirect('/admin/authors');
			} else {
				$this->Session->setFlash(__('Непосредственный автор не может быть сохранен. Наверно существует автор под тем же именем. Проверьте введенные данные и попробуйте еще раз.', true));
			}
		}
		if (empty($this->data)) {
			$this->Author->recursive = -1;
			$this->data = $this->Author->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Неверный ID для непосредственного автора.', true), 'jgrowl');
			$this->redirect('/admin/authors');
		}
		if ($this->Author->del($id)) {
			$this->Session->setFlash(__('Непосредственный автор был удален.', true), 'jgrowl');
			$this->redirect('/admin/authors');
		}
	}

}
?>