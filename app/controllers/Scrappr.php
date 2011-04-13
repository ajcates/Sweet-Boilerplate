<?php

Class Scrappr extends App {

	static $urlPattern = array();

	function __construct() {
		$this->lib(array('Template', 'Uri', 'Config', 'scrapr'));
		$this->model('Bianchi');
		
		$this->libs->Template->set(array(
			'siteName' => $this->libs->Config->get('site', 'name'),
			'siteTagline' => $this->libs->Config->get('site', 'tagline'),
			'navLocation' => ''
		));
	}

	function index() {
		//D::log($this->models->User->loggedIn(), 'is logged in');
		return $this->libs->Template->set(array(
			'title' => 'Scrapping',
			'content' => 'Testing',
		))->render('bases/default');
	}
	
	function product() {
		//D::show($this->libs->Uri->getPart(1), 'uri part');
		
		
		$pageId = $this->libs->Uri->getPart(1);
		
		return $this->libs->Template->set(array(
			'title' => 'Scrapping',
			'content' => B::code(htmlspecialchars($this->models->Bianchi->getProductInfo($pageId))),
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
