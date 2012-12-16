<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
  public $components = array('RequestHandler', 'Session', 'Auth');
  public $helpers = array('Html', 'Form', 'Js', 'Session', 'Time');

  public $paginate = array(
    'Project' => array(
      'order' => 'Project.reportnumber ASC',
      'limit' => 25),
    'Projectexpert' => array('order' => 'Projectexpert.id ASC'),
    'Report' => array(
      'fields' => array(
          'Report.id',
          'Report.reportdate',
          'Report.modified',
          'Project.expert_id',
          'Project.author_id',
          'Project.projecttype',
          'Project.name',
          'Project.namesolicitare',
          'Project.reportnumber'),
      'order' => 'Project.reportnumber ASC',
      'recursive' => 0,
      'limit' => 25),
    'Expert' => array(
      'order' => 'Expert.fullname ASC',
      'limit' => 30),
    'Author' => array(
      'order' => 'Author.name ASC',
      'limit' => 50),
    'Celem' => array(
      'order' => 'Celem.number ASC',
      'limit' => 50),
    'Template' => array(
      'order'=>'Template.date DESC',
      'limit' => 20)
  );

  public function beforeFilter() {
    $this->Auth->authenticate = array(
        'Form' => array('userModel' => 'Expert'),
    );
    $this->Auth->authorize = array('Controller');
    $this->Auth->allow('view', 'display');
    //$this->Auth->allow();

    $this->Auth->authError = 'Вы не авторизированны чтобы войти в систему!';

    //$this->Auth->loginRedirect = false;
    //$this->Auth->logoutRedirect = false;
    $this->Auth->loginAction = array('admin' => false, 'controller' => 'experts', 'action' => 'login');

    $this->Auth->ajaxLogin = null;
    $this->Auth->flash = array('element' => 'jgrowl', 'key' => 'auth', 'params' => array());

    //if ($this->Auth->loggedIn())
    if ($this->Auth->user()) {
      $loginedexpertid = $this->Auth->user('id');
      $logineduserfullname = $this->Auth->user('fullname');
      $isadmin = $this->Auth->user('isadmin');
      $this->set(compact('loginedexpertid', 'logineduserfullname', 'isadmin'));
    }

    //set domains
    $domains = array(
      'I. Права и свободы гражданина',
      'II. Экономика и финансы',
      'III. Государственная администрация',
      'IV. Юстиция, оборона и безопасность',
      'V. Образование, здравоохранение и социальное обеспечение');
    $domains_select = array(
      $domains[0]=>$domains[0],
      $domains[1]=>$domains[1],
      $domains[2]=>$domains[2],
      $domains[3]=>$domains[3],
      $domains[4]=>$domains[4]);
    $celem_groups = array(
      'I. Коррупционные факторы, связанные с реализацией дискреционных полномочий',
      'II. Коррупционные факторы, связанные с правовыми пробелами',
      'III. Коррупционные факторы системного характера',
      'IV. Другие коррупционные проявления'
    );
    $celem_groups_select = array(
      $celem_groups[0]=>$celem_groups[0],
      $celem_groups[1]=>$celem_groups[1],
      $celem_groups[2]=>$celem_groups[2],
      $celem_groups[3]=>$celem_groups[3]
    );
    $this->set(compact('domains', 'domains_select', 'celem_groups', 'celem_groups_select'));
  }
}
