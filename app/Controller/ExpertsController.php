<?php
App::uses('AppController', 'Controller');
/**
 * Experts Controller
 *
 * @property Expert $Expert
 */
class ExpertsController extends AppController {

  function isAuthorized() {
    $adminrights = array('admin_index', 'admin_add', 'admin_edit', 'admin_delete', 'logout');
    $expertrights = array('logout');
    //if ($this->Auth->loggedIn())
    if ($this->Auth->user('isadmin') == 1 && in_array($this->request->action, $adminrights)) return true;
    elseif ($this->Auth->user('isadmin') == 0 && in_array($this->request->action, $expertrights)) return true;
    else return false;
  }

  function login() {
    $this->layout = 'login';

    if ($this->request->is('post')) {
      if ($this->Auth->login()) {
        if ($this->Auth->user('isadmin') == 1) $this->redirect('/admin/reports');
        else if ($this->Auth->user('isadmin') == 0) $this->redirect('/reports');
      } else {
        $this->Auth->flash('Авторизация не произведена! Неправильные имя пользователя или пароль!');
      }
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
    if (!empty($this->request->data)) {
      $this->Expert->create();
      if ($this->Expert->save($this->request->data)) {
        $this->Session->setFlash(__('Эксперт был сохранен.'), 'jgrowl');
        $this->redirect('/admin/experts');
      } else {
        $this->Session->setFlash(__('Эксперт не может быть сохранен. Наверное уже существует эксперт под тем же именем. Проверьте введенные данные и попробуйте еще раз.'), 'jgrowl');
      }
    }
  }

  function admin_edit($id = null) {
    if (!$id && empty($this->request->data)) {
      $this->Session->setFlash(__('Неверный ID для эксперта.'), 'jgrowl');
      $this->redirect('/admin/experts');
    }
    if (!empty($this->request->data)) {
      if ($this->Expert->save($this->request->data)) {
        $this->Session->setFlash(__('Эксперт был сохранен.'), 'jgrowl');
        $this->redirect('/admin/experts');
      } else {
        $this->Session->setFlash(__('Эксперт не может быть сохранен. Наверное уже существует эксперт под тем же именем. Проверьте введенные данные и попробуйте еще раз.'), 'jgrowl');
      }
    }
    if (empty($this->request->data)) {
      $this->Expert->recursive = -1;
      $this->request->data = $this->Expert->read(null, $id);
    }
  }

  function admin_delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Неверный ID для эксперта.'), 'jgrowl');
      $this->redirect('/admin/experts');
    }
    if ($this->Expert->delete($id)) {
      $this->Session->setFlash(__('Эксперт был удален.'), 'jgrowl');
      $this->redirect('/admin/experts');
    }
  }

}
