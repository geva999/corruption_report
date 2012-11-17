<?php
class CelemsController extends AppController {
  var $name = 'Celems';

  function isAuthorized() {
    $adminrights = array('admin_index', 'admin_add', 'admin_edit', 'admin_delete');
    if ($this->Auth->user('isadmin') == 1 && in_array($this->action, $adminrights)) return true;
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
    if (!empty($this->data)) {
      $this->data['Celem']['celem'] = $this->data['Celem']['number'].'. '.$this->data['Celem']['name'];
      $this->Celem->create();
      $this->Celem->Pelem->create();
      if ($this->Celem->save($this->data)) {
        $this->data['Pelem']['id']=$this->Celem->id;
        $this->data['Pelem']['celem_id']=$this->Celem->id;
        $this->data['Pelem']['number']=$this->data['Celem']['number'];
        if ($this->Celem->Pelem->save($this->data)) {
          $this->Session->setFlash(__('Фактор коррупционности был сохранен.', true), 'jgrowl');
          $this->redirect('/admin/celems');
        }
        else $this->Session->setFlash(__('Фактор коррупционности не может быть сохранен. Наверное уже существует фактор под тем же номером или названием. Проверьте введенные данные и попробуйте еще раз.', true), 'jgrowl');
      }
      else $this->Session->setFlash(__('Фактор коррупционности не может быть сохранен. Наверное уже существует фактор под тем же номером или названием. Проверьте введенные данные и попробуйте еще раз.', true), 'jgrowl');
    }
  }

  function admin_edit($id = null) {
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Неверный ID для фактора коррупционности.', true), 'jgrowl');
      $this->redirect('/admin/celems');
    }
    if (!empty($this->data)) {
      $this->data['Celem']['celem'] = $this->data['Celem']['number'].'. '.$this->data['Celem']['name'];
      if ($this->Celem->save($this->data)) {
        $this->data['Pelem']['id']=$this->Celem->id;
        $this->data['Pelem']['celem_id']=$this->Celem->id;
        $this->data['Pelem']['number']=$this->data['Celem']['number'];
        if ($this->Celem->Pelem->save($this->data)) {
          $this->Session->setFlash(__('Фактор коррупционности был сохранен.', true), 'jgrowl');
          $this->redirect('/admin/celems');
        }
        else $this->Session->setFlash(__('Фактор коррупционности не может быть сохранен. Наверное уже существует фактор под тем же номером или названием. Проверьте введенные данные и попробуйте еще раз.', true), 'jgrowl');
      }
      else $this->Session->setFlash(__('Фактор коррупционности не может быть сохранен. Наверное уже существует фактор под тем же номером или названием. Проверьте введенные данные и попробуйте еще раз.', true), 'jgrowl');
    }
    if (empty($this->data)) {
      $this->Celem->recursive = 0;
      $this->data = $this->Celem->read(null, $id);
    }
  }

  function admin_delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Неверный ID для фактора коррупционности.', true), 'jgrowl');
      $this->redirect('/admin/celems');
    }
    if ($this->Celem->delete($id)) {
      $this->Session->setFlash(__('Фактор коррупционности был удален.', true), 'jgrowl');
      $this->redirect('/admin/celems');
    }
  }

}
?>
