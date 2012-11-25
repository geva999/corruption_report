<?php
App::uses('AppController', 'Controller');

class CelemsController extends AppController {

  function isAuthorized() {
    $adminrights = array('admin_index', 'admin_add', 'admin_edit', 'admin_delete');
    if ($this->Auth->user('isadmin') == 1 && in_array($this->request->action, $adminrights)) return true;
    else return false;
  }

  function index() {
  }

  function admin_index() {
    $this->Celem->recursive = -1;
    $countcelems = $this->Celem->find('count');
    $celems = $this->paginate('Celem');
    $this->set(compact('countcelems', 'celems'));
  }

  function admin_add() {
    if (!empty($this->request->data)) {
      $this->request->data['Celem']['celem'] = $this->request->data['Celem']['number'].'. '.$this->request->data['Celem']['name'];
      $this->Celem->create();
      $this->Celem->Pelem->create();
      if ($this->Celem->save($this->request->data)) {
        $this->request->data['Pelem']['id']=$this->Celem->id;
        $this->request->data['Pelem']['celem_id']=$this->Celem->id;
        $this->request->data['Pelem']['number']=$this->request->data['Celem']['number'];
        if ($this->Celem->Pelem->save($this->request->data)) {
          $this->Session->setFlash(__('Фактор коррупционности был сохранен.'), 'jgrowl');
          $this->redirect('/admin/celems');
        }
        else $this->Session->setFlash(__('Фактор коррупционности не может быть сохранен. Наверное уже существует фактор под тем же номером или названием. Проверьте введенные данные и попробуйте еще раз.'), 'jgrowl');
      }
      else $this->Session->setFlash(__('Фактор коррупционности не может быть сохранен. Наверное уже существует фактор под тем же номером или названием. Проверьте введенные данные и попробуйте еще раз.'), 'jgrowl');
    }
  }

  function admin_edit($id = null) {
    if (!$id && empty($this->request->data)) {
      $this->Session->setFlash(__('Неверный ID для фактора коррупционности.'), 'jgrowl');
      $this->redirect('/admin/celems');
    }
    if (!empty($this->request->data)) {
      $this->request->data['Celem']['celem'] = $this->request->data['Celem']['number'].'. '.$this->request->data['Celem']['name'];
      if ($this->Celem->save($this->request->data)) {
        $this->request->data['Pelem']['id']=$this->Celem->id;
        $this->request->data['Pelem']['celem_id']=$this->Celem->id;
        $this->request->data['Pelem']['number']=$this->request->data['Celem']['number'];
        if ($this->Celem->Pelem->save($this->request->data)) {
          $this->Session->setFlash(__('Фактор коррупционности был сохранен.'), 'jgrowl');
          $this->redirect('/admin/celems');
        }
        else $this->Session->setFlash(__('Фактор коррупционности не может быть сохранен. Наверное уже существует фактор под тем же номером или названием. Проверьте введенные данные и попробуйте еще раз.'), 'jgrowl');
      }
      else $this->Session->setFlash(__('Фактор коррупционности не может быть сохранен. Наверное уже существует фактор под тем же номером или названием. Проверьте введенные данные и попробуйте еще раз.'), 'jgrowl');
    }
    if (empty($this->request->data)) {
      $this->Celem->recursive = 0;
      $this->request->data = $this->Celem->read(null, $id);
    }
  }

  function admin_delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Неверный ID для фактора коррупционности.'), 'jgrowl');
      $this->redirect('/admin/celems');
    }
    if ($this->Celem->delete($id)) {
      $this->Session->setFlash(__('Фактор коррупционности был удален.'), 'jgrowl');
      $this->redirect('/admin/celems');
    }
  }

}
