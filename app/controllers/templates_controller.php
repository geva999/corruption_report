<?php
class TemplatesController extends AppController {
	var $name = 'Templates';

	function isAuthorized() {
		$adminrights = array('admin_index', 'admin_add', 'admin_edit', 'admin_delete');
		if ($this->Auth->user('isadmin') == 1 && in_array($this->action, $adminrights)) return true;
		else return false;
    }

	function index() {
	}

	function admin_index() {
		$this->Template->recursive = -1;
		$counttemplates = $this->Template->find('count');
		$templates = $this->paginate('Template');
		$this->set(compact('counttemplates', 'templates'));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Template->create();
			if ($this->Template->save($this->data)) {
				$this->Session->setFlash(__('Шаблон был сохранен.', true), 'jgrowl');
				$this->redirect('/admin/templates');
			}
			else $this->Session->setFlash(__('Невозможно сохранить шаблон. Наверное уже существует шаблон под тем же названием. Проверьте введенные данные и попробуйте еще раз.', true), 'jgrowl');
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Неверный ID для шаблона.', true), 'jgrowl');
			$this->redirect('/admin/templates');
		}
		if (!empty($this->data)) {
			if ($this->Template->save($this->data)) {
				$this->Session->setFlash(__('Шаблон был сохранен.', true), 'jgrowl');
				$this->redirect('/admin/templates');
			}
			else $this->Session->setFlash(__('Невозможно сохранить шаблон. Наверное уже существует шаблон под тем же названием. Проверьте введенные данные и попробуйте еще раз.', true), 'jgrowl');
		}
		if (empty($this->data)) {
			$this->Template->recursive = -1;
			$this->data = $this->Template->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Неверный ID для шаблона.', true), 'jgrowl');
			$this->redirect('/admin/templates');
		}
		if ($this->Template->del($id)) {
			$this->Session->setFlash(__('Шаблон был удален.', true), 'jgrowl');
			$this->redirect('/admin/templates');
		}
	}

}
?>