<?php
class AppController extends Controller {
	var $components = array('RequestHandler', 'Auth');
	var $paginate = array(
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
	function beforeFilter() {
		$this->Auth->userModel = 'Expert';
		$this->Auth->autoRedirect = false;
		$this->Auth->loginAction = array('admin' => false, 'controller' => 'experts', 'action' => 'login');
		//$this->Auth->logoutRedirect = array('admin' => false, 'controller' => 'reports', 'action' => 'indexall');
		$this->Auth->authorize = 'controller';
		$this->Auth->ajaxLogin = null;
		$this->Auth->loginError = 'Авторизация не произведена! Неправильные имя пользователя или пароль!';
		$this->Auth->authError = 'Вы не авторизированны чтобы войти в систему!';
		$this->Auth->allow('view');
		//$this->Auth->allow('*');
		if ($this->Auth->user()) {
			$loginedexpertid = $this->Auth->user('id');
			$logineduserfullname = $this->Auth->user('fullname');
			$isadmin = $this->Auth->user('isadmin');
			$this->set(compact('loginedexpertid', 'logineduserfullname', 'isadmin'));
		}

		//set domains
		$domains = array(
			'I. Юстиция и внутренние дела, права и свободы человека',
			'II. Экономика и торговля',
			'III. Бюджет и финансы',
			'IV. Образование, культура, культы и СМИ',
			'V. Законодательство о труде, социальном обеспечении и об охране здоровья');
		$domainsforselect = array(
			$domains[0]=>$domains[0],
			$domains[1]=>$domains[1],
			$domains[2]=>$domains[2],
			$domains[3]=>$domains[3],
			$domains[4]=>$domains[4]);
		$this->set(compact('domains', 'domainsforselect'));
	}
}
?>