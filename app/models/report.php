<?php
class Report extends AppModel {

  var $name = 'Report';

  //The Associations below have been created with all possible keys, those that are not needed can be removed
  var $belongsTo = array(
      'Project' => array('className' => 'Project',
                'foreignKey' => 'project_id',
                'conditions' => '',
                'fields' => '',
                'order' => ''
      )
  );

  var $hasMany = array(
      'Subreport' => array('className' => 'Subreport',
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
      'Attachment' => array('className' => 'Attachment',
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
?>
