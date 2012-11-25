<?php
App::uses('AppModel', 'Model');
/**
 * Celem Model
 *
 * @property Pelem $Pelem
 * @property Subreport $Subreport
 */
class Celem extends AppModel {
  public $displayField = 'name';

  public $validate = array(
    'name' => array(
      'notempty' => array(
        'rule' => array('notempty'),
        'message' => 'Имя не может быть пустым'
      )
    ),
    'number' => array(
      'notempty' => array(
        'rule' => array('notempty'),
        'message' => 'Число не может быть пустым'
      )
    )
  );

  public $hasOne = array(
    'Pelem' => array(
      'className' => 'Pelem',
      'foreignKey' => 'celem_id',
      'dependent' => true,
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );

  public $hasAndBelongsToMany = array(
    'Subreport' => array(
      'className' => 'Subreport',
      'joinTable' => 'subreports_celems',
      'foreignKey' => 'celem_id',
      'associationForeignKey' => 'subreport_id',
      'unique' => true,
      'conditions' => '',
      'fields' => '',
      'order' => '',
      'limit' => '',
      'offset' => '',
      'finderQuery' => '',
      'deleteQuery' => '',
      'insertQuery' => ''
    )
  );

}
