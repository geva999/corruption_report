<?php
class Subreport extends AppModel {

  var $name = 'Subreport';
  var $validate = array(
    'report_id' => array('numeric')
  );

  var $belongsTo = array(
      'Report' => array('className' => 'Report',
                'foreignKey' => 'report_id',
                'conditions' => '',
                'fields' => '',
                'order' => ''
      )
  );

  var $hasAndBelongsToMany = array(
      'Celem' => array('className' => 'Celem',
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
      'Pelem' => array('className' => 'Pelem',
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
?>
