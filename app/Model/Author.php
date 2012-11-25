<?php
App::uses('AppModel', 'Model');
/**
 * Author Model
 *
 * @property Project $Project
 */
class Author extends AppModel {
  public $displayField = 'name';

  public $validate = array(
    'name' => array(
      'notempty' => array(
        'rule' => array('notempty'),
        'message' => 'Имя не может быть пустым'
      )
    )
  );

  public $hasMany = array(
    'Project' => array(
      'className' => 'Project',
      'foreignKey' => 'author_id',
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

}
