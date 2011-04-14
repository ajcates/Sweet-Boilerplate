<?php
if(stristr(@$_SERVER['USER'], 'ajcates') || stristr(@$_SERVER['HTTP_HOST'], 'ajcates') || stristr(@$_SERVER['HTTP_HOST'], 'localhost')) {
    //Dev DB
	SweetFramework::getClass('lib', 'Config')->setAll('databases', array(
		'default' => array(
			'driver' => 'My_SQL',
			'host' => 'localhost',
			'username' => 'root',
			'password' => '',
			'databaseName' => ''
		)
	));
} else {	
    //Live DB
	SweetFramework::getClass('lib', 'Config')->setAll('databases', array(
		'default' => array(
			'driver' => 'My_SQL',
			'host' => 'localhost',
			'username' => 'ajcates',
			'password' => '',
			'databaseName' => ''
		)
	));
}
