<?php
App::uses('AppController', 'Controller');

class TemplatesController extends AppController {

  function isAuthorized() {
    $adminrights = array('admin_index', 'admin_add', 'admin_edit', 'admin_delete', 'about');
    $expertrights = array('about');
    if ($this->Auth->user('isadmin') == 1 && in_array($this->request->action, $adminrights))
      return true;
    elseif ($this->Auth->user('isadmin') == 0 && in_array($this->request->action, $expertrights))
      return true;
    else
      return false;
  }

  function index() {
  }

  function about() {
  }

  function admin_about() {
    $this->render("about");
  }

  function admin_index() {
    $this->Template->recursive = -1;
    $counttemplates = $this->Template->find('count');
    $templates = $this->paginate('Template');
    $this->set(compact('counttemplates', 'templates'));
  }

  function admin_add() {
    if (!empty($this->request->data)) {
      $this->Template->create();
      if ($this->Template->save($this->request->data)) {
        $this->Session->setFlash(__('Шаблон был сохранен.'), 'jgrowl');
        $this->redirect('/admin/templates');
      }
      else $this->Session->setFlash(__('Невозможно сохранить шаблон. Наверное уже существует шаблон под тем же названием. Проверьте введенные данные и попробуйте еще раз.'), 'jgrowl');
    }
  }

  function admin_edit($id = null) {
    if (!$id && empty($this->request->data)) {
      $this->Session->setFlash(__('Неверный ID для шаблона.'), 'jgrowl');
      $this->redirect('/admin/templates');
    }
    if (!empty($this->request->data)) {
      if ($this->Template->save($this->request->data)) {
        $this->Session->setFlash(__('Шаблон был сохранен.'), 'jgrowl');
        $this->redirect('/admin/templates');
      }
      else $this->Session->setFlash(__('Невозможно сохранить шаблон. Наверное уже существует шаблон под тем же названием. Проверьте введенные данные и попробуйте еще раз.'), 'jgrowl');
    }
    if (empty($this->request->data)) {
      $this->Template->recursive = -1;
      $this->request->data = $this->Template->read(null, $id);
    }
  }

  function admin_delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Неверный ID для шаблона.'), 'jgrowl');
      $this->redirect('/admin/templates');
    }
    if ($this->Template->delete($id)) {
      $this->Session->setFlash(__('Шаблон был удален.'), 'jgrowl');
      $this->redirect('/admin/templates');
    }
  }

}
