<?php
App::uses('AppModel', 'Model');
/**
 * Subreport Model
 *
 * @property Report $Report
 * @property Celem $Celem
 * @property Pelem $Pelem
 */
class Subreport extends AppModel {
  public $validate = array(
    'report_id' => array(
      'numeric' => array(
        'rule' => array('numeric')
      )
    )
  );

  public $belongsTo = array(
    'Report' => array(
      'className' => 'Report',
      'foreignKey' => 'report_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );

  public $hasAndBelongsToMany = array(
    'Celem' => array(
      'className' => 'Celem',
      'joinTable' => 'subreports_celems',
      'foreignKey' => 'subreport_id',
      'associationForeignKey' => 'celem_id',
      'unique' => true,
      'conditions' => '',
      'fields' => '',
      'order' => '',
      'limit' => '',
      'offset' => '',
      'finderQuery' => '',
      'deleteQuery' => '',
      'insertQuery' => ''
    ),
    'Pelem' => array(
      'className' => 'Pelem',
      'joinTable' => 'subreports_pelems',
      'foreignKey' => 'subreport_id',
      'associationForeignKey' => 'pelem_id',
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
