<?php
class AppSchema extends CakeSchema {

  public function before($event = array()) {
    return true;
  }

  public function after($event = array()) {
  }

  public $attachments = array(
    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
    'report_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
    'name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'filename' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'todelete' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
    'created' => array('type' => 'date', 'null' => true, 'default' => null),
    'modified' => array('type' => 'date', 'null' => true, 'default' => null),
    'indexes' => array(
      'PRIMARY' => array('column' => 'id', 'unique' => 1),
      'report_id' => array('column' => 'report_id', 'unique' => 0)
    ),
    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
  );
  public $authors = array(
    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
    'author_group_id' => array('type' => 'string', 'null' => false, 'length' => 5, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'created' => array('type' => 'date', 'null' => true, 'default' => null),
    'modified' => array('type' => 'date', 'null' => true, 'default' => null),
    'indexes' => array(
      'PRIMARY' => array('column' => 'id', 'unique' => 1),
      'author_group_id' => array('column' => 'author_group_id', 'unique' => 0)
    ),
    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
  );
  public $celems = array(
    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
    'celem' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'number' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'unique'),
    'name' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'celemgroup' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'description' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'indexes' => array(
      'PRIMARY' => array('column' => 'id', 'unique' => 1),
      'name' => array('column' => 'name', 'unique' => 1),
      'number' => array('column' => 'number', 'unique' => 1),
      'celem' => array('column' => 'celem', 'unique' => 0),
      'number_2' => array('column' => 'number', 'unique' => 0)
    ),
    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
  );
  public $experts = array(
    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
    'username' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'password' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'fullname' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'isadmin' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
    'created' => array('type' => 'date', 'null' => true, 'default' => null),
    'modified' => array('type' => 'date', 'null' => true, 'default' => null),
    'indexes' => array(
      'PRIMARY' => array('column' => 'id', 'unique' => 1),
      'username' => array('column' => 'username', 'unique' => 1)
    ),
    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
  );
  public $pelems = array(
    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
    'celem_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
    'number' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
    'indexes' => array(
      'PRIMARY' => array('column' => 'id', 'unique' => 1),
      'celem_id' => array('column' => 'celem_id', 'unique' => 0)
    ),
    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
  );
  public $projectexperts = array(
    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
    'project_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
    'expert_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
    'created' => array('type' => 'date', 'null' => true, 'default' => null),
    'modified' => array('type' => 'date', 'null' => true, 'default' => null),
    'indexes' => array(
      'PRIMARY' => array('column' => 'id', 'unique' => 1),
      'project_id' => array('column' => 'project_id', 'unique' => 0),
      'expert_id' => array('column' => 'expert_id', 'unique' => 0)
    ),
    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
  );
  public $projects = array(
    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
    'expert_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
    'author_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'key' => 'index'),
    'name' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'namesolicitare' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'projecttype' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'projecttypevizat' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'projectdomain' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'projectnumber' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 15, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'projectdate' => array('type' => 'date', 'null' => true, 'default' => null),
    'projectdatetext' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'initiative' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'reportnumber' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'unique'),
    'reportimpact' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
    'numberpages' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10),
    'datelimitparlament' => array('type' => 'date', 'null' => false, 'default' => null),
    'datelimitparlamenttext' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'datelimitexpert' => array('type' => 'date', 'null' => false, 'default' => null),
    'datelimitexperttext' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'filename' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'projectreportstate' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 2, 'key' => 'index'),
    'projectstate' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 2),
    'reportmultipleedit' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
    'created' => array('type' => 'date', 'null' => true, 'default' => null),
    'modified' => array('type' => 'date', 'null' => true, 'default' => null),
    'indexes' => array(
      'PRIMARY' => array('column' => 'id', 'unique' => 1),
      'reportnumber' => array('column' => 'reportnumber', 'unique' => 1),
      'expert_id' => array('column' => 'expert_id', 'unique' => 0),
      'author_id' => array('column' => 'author_id', 'unique' => 0),
      'projecttype' => array('column' => 'projecttype', 'unique' => 0),
      'reportnumber_2' => array('column' => 'reportnumber', 'unique' => 0),
      'projectreportstate' => array('column' => 'projectreportstate', 'unique' => 0),
      'projecttypevizat' => array('column' => 'projecttypevizat', 'unique' => 0),
      'projectdomain' => array('column' => 'projectdomain', 'unique' => 0),
      'projectnumber' => array('column' => 'projectnumber', 'unique' => 0)
    ),
    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
  );
  public $reports = array(
    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
    'project_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
    'reportdate' => array('type' => 'date', 'null' => false, 'default' => null),
    'reportdatetext' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'p02list1' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'p02list2' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'p02text1' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'p02option1' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 1),
    'p02option2' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 1),
    'p04text1' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'p05list1' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'p05text1' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'p07text1' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'p07radio1' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
    'p08text1' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'p08radio1' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
    'p08radio2' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 22),
    'p09radio1' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
    'p09radio2' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
    'p09text1' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'p10text1' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'p10radio1' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
    'p11text1' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'p11radio1' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
    'p11radio2' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
    'p12text1' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'p12radio1' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
    'p12radio2' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
    'p13text1' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'p13radio1' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
    'p14text1' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'p14radio1' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
    'p15text1' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'p15radio1' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
    'p15radio2' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2),
    'simplesubreport' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'concluzii' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'admincoments' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'reportstate' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 2, 'key' => 'index'),
    'created' => array('type' => 'date', 'null' => true, 'default' => null),
    'modified' => array('type' => 'date', 'null' => true, 'default' => null),
    'indexes' => array(
      'PRIMARY' => array('column' => 'id', 'unique' => 1),
      'project_id' => array('column' => 'project_id', 'unique' => 0),
      'reportstate' => array('column' => 'reportstate', 'unique' => 0)
    ),
    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
  );
  public $subreports = array(
    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
    'report_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index'),
    'expert_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'subreportorder' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10),
    'articol' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'text' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'obiectia' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'alteelemente' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'alteelementeacceptate' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
    'alteriscuri' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'alteriscuriacceptate' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
    'recomandarea' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'todelete' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
    'created' => array('type' => 'date', 'null' => true, 'default' => null),
    'modified' => array('type' => 'date', 'null' => true, 'default' => null),
    'indexes' => array(
      'PRIMARY' => array('column' => 'id', 'unique' => 1),
      'report_id' => array('column' => 'report_id', 'unique' => 0),
      'expert_id' => array('column' => 'expert_id', 'unique' => 0)
    ),
    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
  );
  public $subreports_celems = array(
    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
    'subreport_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
    'celem_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
    'indexes' => array(
      'PRIMARY' => array('column' => 'id', 'unique' => 1),
      'subreport_id' => array('column' => 'subreport_id', 'unique' => 0),
      'celem_id' => array('column' => 'celem_id', 'unique' => 0)
    ),
    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
  );
  public $subreports_pelems = array(
    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
    'subreport_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
    'pelem_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
    'indexes' => array(
      'PRIMARY' => array('column' => 'id', 'unique' => 1),
      'subreport_id' => array('column' => 'subreport_id', 'unique' => 0),
      'pelem_id' => array('column' => 'pelem_id', 'unique' => 0)
    ),
    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
  );
  public $templates = array(
    'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
    'name' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'header' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'footer' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'headerpdf' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'footerpdf' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'date' => array('type' => 'date', 'null' => true, 'default' => null),
    'datetext' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
    'created' => array('type' => 'date', 'null' => true, 'default' => null),
    'modified' => array('type' => 'date', 'null' => true, 'default' => null),
    'indexes' => array(
      'PRIMARY' => array('column' => 'id', 'unique' => 1),
      'name' => array('column' => 'name', 'unique' => 1)
    ),
    'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
  );
}
