<?php
App::uses('AppModel', 'Model');
/**
 * Attachment Model
 *
 * @property Report $Report
 */
class Attachment extends AppModel {
  public $displayField = 'name';

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

}
