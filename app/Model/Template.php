<?php
App::uses('AppModel', 'Model');
/**
 * Template Model
 *
 */
class Template extends AppModel {
  public $displayField = 'name';

  public $validate = array(
    'name' => array(
      'notempty' => array(
        'rule' => array('notempty'),
        'message' => 'Имя не может быть пустым'
      )
    )
  );

}
