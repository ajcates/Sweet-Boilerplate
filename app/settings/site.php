<?php
SweetFramework::getClass('lib', 'Config')->setAll('site', array(
	'name' => 'Holster Data Kungfu',
	'tagline' => 'Chopping up holster data since 1754',
	'prettyUrls' => false,
	'database' => 'default',
	'autoload' => array('SweetModel'),
	'theme' => 'default',
	'mainController' => 'Main',
	'salt' => '8b350e497==RANDOM CRAP IS THE SALT==dc21c3017a8ff'
));