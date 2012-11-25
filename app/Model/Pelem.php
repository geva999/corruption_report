<?php
App::uses('AppModel', 'Model');
/**
 * Pelem Model
 *
 * @property Celem $Celem
 * @property Subreport $Subreport
 */
class Pelem extends AppModel {
  public $displayField = 'number';

  public $validate = array(
    'celem_id' => array(
      'numeric' => array(
        'rule' => array('numeric')
      )
    ),
    'pelem' => array(
      'notempty' => array(
        'rule' => array('notempty'),
        'message' => 'Имя не может быть пустым'
      )
    )
  );

  public $belongsTo = array(
    'Celem' => array(
      'className' => 'Celem',
      'foreignKey' => 'celem_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );

  public $hasAndBelongsToMany = array(
    'Subreport' => array(
      'className' => 'Subreport',
      'joinTable' => 'subreports_pelems',
      'foreignKey' => 'pelem_id',
      'associationForeignKey' => 'subreport_id',
      'unique' => true,
      'conditions' => '',
      'fields' => 'Subreport.id, Subreport.report_id',
      'order' => '',
      'limit' => '',
      'offset' => '',
      'finderQuery' => '',
      'deleteQuery' => '',
      'insertQuery' => ''
    )
  );

}
