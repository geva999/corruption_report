<?php
App::uses('AppModel', 'Model');
/**
 * Project Model
 *
 * @property Report $Report
 * @property Expert $Expert
 * @property Author $Author
 * @property Projectexpert $Projectexpert
 */
class Project extends AppModel {
  public $displayField = 'name';

  public $validate = array(
    'name' => array(
      'notempty' => array(
        'rule' => array('notempty'),
        'message' => 'Имя не может быть пустым'
      )
    ),
    'reportnumber' => array(
      'numeric' => array(
        'rule' => array('numeric'),
        'message' => 'Номер не может быть пустым или уже существует заключение под тем же номером'
      )
    ),
    'projectdatetext' => array(
      'notempty' => array(
        'rule' => array('notempty'),
        'message' => 'Дата не может быть пустой'
      )
    ),
    'numberpages' => array(
      'numeric' => array(
        'rule' => array('numeric'),
        'message' => 'Число страниц не может быть пустым'
      )
    ),
    'datelimitexperttext' => array(
      'notempty' => array(
        'rule' => array('notempty'),
        'message' => 'Предельный срок для эксперта не может быть пустым'
      )
    ),
    'datelimitparlamenttext' => array(
      'notempty' => array(
        'rule' => array('notempty'),
        'message' => 'Предельный срок для Парламента не может быть пустым'
      )
    )
  );

  public $belongsTo = array(
    'Expert' => array(
      'className' => 'Expert',
      'foreignKey' => 'expert_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    ),
    'Author' => array(
      'className' => 'Author',
      'foreignKey' => 'author_id',
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );

  public $hasOne = array(
    'Report' => array(
      'className' => 'Report',
      'foreignKey' => 'project_id',
      'dependent' => true,
      'conditions' => '',
      'fields' => '',
      'order' => ''
    )
  );

  public $hasMany = array(
    'Projectexpert' => array(
      'className' => 'Projectexpert',
      'foreignKey' => 'project_id',
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
