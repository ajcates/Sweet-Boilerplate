<?php

class Main extends App {

	static $urlPattern = array(
	);

	function __construct() {
		$this->lib(array('Template', 'Uri', 'Config'));
		$this->model(array());
		
		$this->libs->Template->set(array(
			'siteName' => $this->libs->Config->get('site', 'name'),
			'siteTagline' => $this->libs->Config->get('site', 'tagline'),
			'navLocation' => ''
		));
	}

	function index() {
		//D::log($this->models->User->loggedIn(), 'is logged in');
		return $this->libs->Template->set(array(
			'title' => 'Sweet-Framework Boilerplate App',
			'content' => 'Winning.',
		))->render('bases/default');
	}
	
	function __DudeWheresMyCar() {
		header('HTTP/1.0 404 Not Found');
		
		return $this->libs->Template->set(array(
			'title' => '404 Error',
			'content' => T::get('parts/common/404')
		))->render('bases/default');
	}
}
