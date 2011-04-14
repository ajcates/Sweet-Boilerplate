<?php
if(stristr($_SERVER['HTTP_HOST'], 'local') === false) {
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
} else {	
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
}
