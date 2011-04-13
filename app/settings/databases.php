<?php
//location of the mysql db
if(stristr($_SERVER['HTTP_HOST'], 'local') === false) {
	SweetFramework::getClass('lib', 'Config')->setAll('databases', array(
		'default' => array(
			'driver' => 'My_SQL',
			'host' => 'localhost',
			'username' => 'ajcates',
			'password' => 'aldo20',
			'databaseName' => 'holster-data'
		)
	));
} else {	
	SweetFramework::getClass('lib', 'Config')->setAll('databases', array(
		'default' => array(
			'driver' => 'My_SQL',
			'host' => 'localhost',
			'username' => 'root',
			'password' => 'dworkram',
			'databaseName' => 'holster-data'
		)
	));
}