<?php
App::uses('AppModel', 'Model');
/**
 * Projectexpert Model
 *
 * @property Project $Project
 */
class Projectexpert extends AppModel {
  public $belongsTo = array(
    'Project' => array(
      'className' => 'Project',
      'foreignKey' => 'project_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );

}
