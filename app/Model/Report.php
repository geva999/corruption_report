<?php
App::uses('AppModel', 'Model');
/**
 * Report Model
 *
 * @property Project $Project
 * @property Attachment $Attachment
 * @property Subreport $Subreport
 */
class Report extends AppModel {
  public $belongsTo = array(
    'Project' => array(
      'className' => 'Project',
      'foreignKey' => 'project_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );

  public $hasMany = array(
    'Subreport' => array(
      'className' => 'Subreport',
      'foreignKey' => 'report_id',
      'dependent' => true,
      'conditions' => '',
      'fields' => '',
      'order' => '',
      'limit' => '',
      'offset' => '',
      'exclusive' => '',
      'finderQuery' => '',
      'counterQuery' => ''
    ),
    'Attachment' => array(
      'className' => 'Attachment',
      'foreignKey' => 'report_id',
      'dependent' => true,
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
