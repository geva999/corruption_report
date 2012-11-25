<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Expert Model
 *
 * @property Project $Project
 */
class Expert extends AppModel {
  public $displayField = 'username';

  public $validate = array(
    'username' => array(
      'notempty' => array(
        'rule' => array('notempty'),
        'message' => 'Логин не может быть пустым',
        //'allowEmpty' => false,
        //'required' => false,
        //'last' => false, // Stop validation after this rule
        //'on' => 'create', // Limit validation to 'create' or 'update' operations
      )
    ),
    'password' => array(
      'notempty' => array(
        'rule' => array('notempty'),
        'message' => 'Пароль не может быть пустым'
      )
    ),
    'fullname' => array(
      'notempty' => array(
        'rule' => array('notempty'),
        'message' => 'Имя не может быть пустым'
      )
    )
  );

  public $hasMany = array(
    'Project' => array(
      'className' => 'Project',
      'foreignKey' => 'expert_id',
      'dependent' => false,
      'conditions' => '',
      'fields' => '',
      'order' => '',
      'limit' => '',
      'offset' => '',
      'exclusive' => '',
      'finderQuery' => '',
      'counterQuery' => ''
    )
  );

  public function beforeSave($options = array()) {
    if (isset($this->data['Expert']['password'])) {
      $this->data['Expert']['password'] = AuthComponent::password($this->data['Expert']['password']);
    }
    return true;
  }

}
